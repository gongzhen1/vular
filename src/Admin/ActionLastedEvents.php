<?php
namespace Water\Vular\Admin;

use Water\Vular\Elements\Vular\VularAction;
use Water\Vular\Elements\Html\Span;

class ActionLastedEvents extends VularAction{
    //function build(){
    //    $this->action('load', )
    //}

    function do($args = null){
    	return Span::make('哈哈');
    }
}