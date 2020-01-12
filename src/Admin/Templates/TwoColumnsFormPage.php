<?php
namespace Water\Vular\Admin\Templates;

use Water\Vular\Admin\FormPage;

abstract class TwoColumnsFormPage extends FormPage{
    use MultiColumnsForm;

	private $firstColumn;
	private $secondColumn;

    function register(){
        parent::register();
        $this->makeFormAttributes();

        $this->firstColumn = $this->column($this->firstColumnCards())
            ->class('xs8');
        $this->secondColumn = $this->column($this->secondColumnCards())
            ->class('xs4');
    }
    
    abstract function firstColumnCards();
    abstract function secondColumnCards();

    function firstColumn(){
    	return $this->firstColumn;
    }

    function secondColumn(){
    	return $this->secondColumn;
    }

}