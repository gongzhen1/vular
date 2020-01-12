<?php
namespace Water\Vular\Admin\Templates;

use Water\Vular\Admin\FormPage;

abstract class OneColumnFormPage extends FormPage{
	use MultiColumnsForm;

    function register(){
        parent::register();
        $this->makeFormAttributes();
        $this->column($this->cards())
            ->class('xs12');

    }
    
    abstract function cards();

}