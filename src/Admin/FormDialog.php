<?php
namespace Water\Vular\Admin;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Water\Vular\Admin\Page;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
use Water\Vular\Elements\Vuetify\VForm;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VSpacer;
use Water\Vular\Elements\Vuetify\VFooter;
use Water\Vular\Core\VularResponse;
use Water\Vular\Elements\Vular\VularForm;
use Water\Vular\Elements\Vular\VularDialog;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\VularEvent;
use Water\Vular\Elements\Fieldable;
//use Water\Vular\Elements\Relations\RelationShip;
use Water\Vular\Core\Form;

abstract class FormDialog extends VularDialog{
    use Form, Fieldable;

    protected $saveBtn;
    protected $cancelBtn;
    protected $async = false;
    public function __construct(){
        parent::__construct();
        //$this->readOnly(true);

        $this->width(660);

    }

    /*function async($modelClass, bool $value = true){
        $this->modelClass = $modelClass;
        $this->async = $value;
        return $this;
    }

    function isAsync(){
        return $this->async;
    }*/

    function build(){
       $this->register();
       $this->makeUi();
       //$this->bindsData();
       return $this;
    }


    function register(){
        $this->form = VularForm::make()
            ->bindsToPage($this);
        /*#####需要主对象保存以后，关联才能保存，异步功能暂不实现
        $saveAction = $this->isAsync()
                ?VularAction::make()
                    ->action('save')
                    ->post()
                    ->valid()
                    ->bindsTo($this->form)
                :VularEvent::make('save')
                    ->valid()
                    ->bindsTo($this->form);
        $saveText = $this->isAsync() ? trans('vular.save') : trans('vular.confirm');*/
        $saveAction = VularEvent::make('save')
                    ->valid()
                    ->bindsTo($this->form);
        $saveText = trans('vular.confirm');
        $this->saveBtn = VBtn::make($saveText)
            ->valid()
            ->color('primary')
            ->round()
            ->click(
                $saveAction
            );
        $this->cancelBtn = VBtn::make(trans('vular.cancel'))
            ->light()
            ->flat()
            ->color('blue')
            ->click(
                VularEvent::make('close')
                    ->bindsTo($this)
            );
    }

    //function bindsData(){
    //    $this->bindsFormData();
        //$this->title = $this->viewModel->id? $this->editTitle : $this->newTitle;
    //}
    function setModelClass($modelClass){
        $this->modelClass = $modelClass;
    }

    function defaultValue($vewModel){
        $this->bindsFormData($vewModel ? $vewModel->id : null);
    }

    function makeUi(){
        $this->form
            ->children(
                VLayout::make()
                ->row()
                ->wrap()
                ->children(
                    VFlex::make()
                        //->class('md10 sm12')
                        ->children(
                            VCard::make()
                                ->children(
                                    VToolbar::make()
                                        //->dark()
                                        //->color('transparent')
                                        ->flat()
                                        ->card()
                                        ->children(
                                            VToolbarTitle::make($this->title),
                                            VSpacer::make(),
                                            VBtn::make()
                                                ->icon()
                                                ->click(
                                                    VularEvent::make('close')
                                                        ->bindsTo($this)
                                                )
                                                ->children(
                                                    VIcon::make('close')
                                                )
                                        ),
                                    VDivider::make()
                                )
                                ->children(
                                    VCardText::make()
                                    ->class('pa-4')
                                    ->children(
                                        $this->contentPanel()
                                    ),
                                        VDivider::make(),
                                        VFooter::make()
                                            ->height('auto')
                                            ->class('pa-2')
                                            ->color('transparent')
                                            ->children(
                                                $this->cancelBtn,
                                                VSpacer::make(),
                                                $this->saveBtn
                                            )
                                            

                                )
                        )
                )
            );
        $this->children(
            $this->createActivator(),
            $this->form
        );
    }

    function preSave($value){
        //$dbModel = $this->formModel->getDbModel();
        foreach ($this->fields() as $field) {
            $field->preSave($value, null);
        }
    }

    function convertToDb($viewModel){
        $this->formModel->viewModel($viewModel);
        $dbModel = $this->formModel->getDbModel();
        return $this->_toDbFilter ? ($this->_toDbFilter)($dbModel) : $dbModel;
    }

    function convertToView($dbModel){
        $formModel = $this->resolveFormModel($dbModel?$dbModel->id:null);
        $viewModel = $this->formModel->getViewModel();
        return $this->_toViewFilter ? ($this->_toViewFilter)($viewModel) : $viewModel;
    }

    function fields(){
        return $this->resolveFields();
        //return $this->formGrid->fields();
    }

    //function sync(bool $value = true){

        //return $this->readOnly(!$value);
    //}

    function save($viewModel){
        return $this->doSave($viewModel)->success()
            ->addBeforeEvent(VularEvent::make('close')
            ->bindsTo($this));
    }

}