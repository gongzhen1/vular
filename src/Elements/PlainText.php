<?php
namespace Water\Vular\Elements;

final class PlainText{
    use Authable;
    
    public function __construct($text = ''){
        if($text){
            $this->text = $text;
        }
    }
    static public function make($text = ''){
        return new PlainText($text);
    }
   
    function text( $text ) {
        $this->text = $text;
        return $this;
    }

    function removeHidden(){
        if($this->isHidden){
            $this->text = '';
        }
        return $this;
    }

}