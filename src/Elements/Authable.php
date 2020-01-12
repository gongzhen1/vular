<?php
namespace Water\Vular\Elements;

trait Authable {
    protected $isHidden = false;
    protected $isDisabled = false;

    function hiddenBy($authPointSlug){
        if($authPointSlug && !user()->isPermitted($authPointSlug)){
            $this->isHidden = true;
        }
       return $this;
    }

    function disabledBy($authPointSlug){
        if($authPointSlug && !user()->isPermitted($authPointSlug)){
            if(method_exists($this, 'disabled')){
                $this->disabled(true);
            }
            $this->isDisabled = true;
        }
        return $this;
    }

    function hidden(bool $value = true){
        $this->isHidden = $value;
        return $this;
    }

    function isHidden(){
        return $this->isHidden;
    }

    function isDisabled(){
        return $this->isDisabled;
    }

}