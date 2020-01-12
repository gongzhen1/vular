<?php
namespace Water\Vular\Admin;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Water\Vular\Admin\Page;
use Water\Vular\Core\VularResponse;
use Water\Vular\Elements\Vular\VularForm;
use Water\Vular\Core\Form;

abstract class FormPage extends Page{
    use Form;
    protected $newTitle;
    protected $editTitle;

    function register(){
        parent::register();
        $this->form = VularForm::make()
            ->bindsToPage($this);
        $this->title = request('id')? $this->editTitle : $this->newTitle;
    }

    function bindsData(){
        parent::bindsData();
        $this->bindsFormData(request('id'));
    }

    function save($viewModel){
        return $this->doSave($viewModel)->success()
            ->closePage();
    }

    function saveAndContinue($viewModel){
        return $this->doSave($viewModel)->success();
    }

}