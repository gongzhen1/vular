<?php
namespace Water\Vular\Elements;

class VularNode implements MakeAble{
    use Authable;
    /**
     * The tag name of Node.
     *
     * @var string defaut is div
     */
	public $name = "div";


    public function __construct($name = null){
        $vid = request('vularId');
        $this->props('vularId', $vid ? $vid:uniqid('vid'));

        if($name){
            $this->name = $name;
        }
        else{
            $this->name = getbase(get_called_class());
        }
	}


    static public function make($text = null){
        $className = get_called_class();
        $node = new $className;
        if($text){
            $node->text($text);
        }
        return $node;
    }

    public function becomeTo($name){
        $this->name = $name;
        return $this;
    }

    function vularId(){
        return $this->props->vularId;
    }

    /**
     * Add a css class to node
     *
     * @param  string  $class css class name
     * @return self
     */
	function class( $class, $value = true ) {
        if(!property_exists($this,'class')){
            $this->class = new NodeData;
        }

        $classes = explode(" ", $class);
        foreach ($classes as $perClass) {
            $perClass = trim($perClass);
            if($perClass){
                $this->class->add($perClass, $value);
            }
        }
        return $this;
	}

    function style( ... $args ) {
        if(count($args) == 1 && is_string($args[0])){
            $args = explode(';',$args[0]);
            foreach ($args as $arg) {
                $attCouple = explode(':', $arg);
                if(count($attCouple) == 2){
                    $this->attachData('style', $attCouple);
                }
            }
            return $this;
        }
        return $this->attachData('style', $args);
    }

    function attrs( ... $args ) {
        return $this->attachData('attrs', $args);
    }

    function props( ... $args ) {
        return $this->attachData('props', $args);
    }

    function domProps( ... $args ) {
        return $this->attachData('domProps', $args);
    }

    function on( ... $args ) {
        return $this->attachData('on', $args);
    }

    function keyup($action){
        return $this->on('keyup', $action);
    }
    
    function click($action){
        return $this->on('click', $action);
    }

    function nativeOn( ... $args ) {
        return $this->attachData('nativeOn', $args);
    }

    function directives( ... $args ) {
        return $this->attachData('directives', $args);
    }

    function scopedSlots( ... $args ) {
        return $this->attachData('scopedSlots', $args);
    }

    function attachData($name, $args){
        if(!property_exists($this,$name)){
            $this->$name = new NodeData();
        }
        if(count($args) == 1){
            $args[0]( $this->$name );
        }
        if(count($args) == 2){
            $this->$name->add(trim($args[0]), $args[1]);
        }
        return $this;
    }


    /**
     * set slot name to node
     *
     * @param  string  $slot slot name
     * @return self
     */
    function slot( $slot ) {
        $this->slot = $slot;
        return $this;
    }

    function ref($ref){
        $this->ref = $ref;
        return $this;
    }


    //function prop($name){
    //    return $this->props($name, true);
    //}

    function children( ... $args){
        if(!property_exists($this,'children')){
            $this->children = [];
        }

        foreach ($args as $arg){
            if(is_array($arg)){
                $this->children = array_merge_recursive($this->children, $arg);
            }
            else{
                array_push($this->children, $arg);
            }
        }
        return $this;
    }

    function text($text){
        $this->children(
            PlainText::make($text)
        );
        return $this;
    }

    function removeHidden(){
        $children = property_exists($this, 'children')? $this->children : [];
        $this->children = [];

        if($this->isHidden()){
            return $this;
        }

        foreach ($children as $child) {
            if($child && !$child->isHidden()){
                $child->removeHidden();
                array_push($this->children, $child);
            }
            
        }
        return $this;
    }


   //function guardAction($action, $authPointSlug){
    //    return $this;
    //}


}