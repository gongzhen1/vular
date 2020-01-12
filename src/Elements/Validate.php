<?php
namespace Water\Vular\Elements;

trait Validate {
    public $unique = false;

    private $validateFunction;

    function rules($value){
        $this->rules = $value;
        return $this;
        //return $this->props(__FUNCTION__, $value);
    }

    function rule($rule)
    {
        if(!property_exists($this, 'rules')){
            $this->rules = [];
        }

        array_push($this->rules, $rule);
        return $this;
    }

    function requried(){
        return $this->rule("v => !!v || 'This field is required'");
    }

    function maxLength($value){
        $rule = "v => !v || v.length <= {0} || '必须少于{0}个字符'";
        return $this->rule(str_replace('{0}', $value, $rule));
    }

    function minLength($value){
        $rule = "v => (!v && v.length > {0}) || '必须大于{0}个字符'";
        return $this->rule(str_replace('{0}', $value, $rule));
    }

    function email(){
        return $this->rule("v =>!v || /.+@.+/.test(v) || 'E-mail must be valid'");
    }

    function loginName(){
        return $this->rule("v =>!v || /^[\u4e00-\u9fa5A-Za-z0-9-_]*/.test(v) || '只能中英文，数字，下划线，减号'");
    }

    function float(){
        return $this->rule("v =>!v || /^\d+(\.\d+)?$/.test(v) || '请输入正确的数字'");
    }

    function integer(){
        return $this->rule("v =>!v || /^\d+$/.test(v) || '请输入正确的数字'");
    }

    

    function unique(bool $value = true){
        $this->unique = $value;
        return $this;
    }

    function validate(\Coluser $callback){
        $this->validateFunction = $callback;
    }

    function doValidate(){
        $validateFunction = $this->validateFunction;
        if($validateFunction){
            return $validateFunction();
        }

        return null;
    }

}