<?php
namespace Water\Vular\Admin\Templates;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Water\Vular\Admin\FormPage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
use Water\Vular\Elements\Vuetify\VForm;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Core\VularResponse;
use Water\Vular\Elements\Vular\VularForm;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\VularEvent;
//Use Log;

abstract class SimpleFormPage extends FormPage{
    protected $saveBtn;
    protected $cancelBtn;

    abstract function fields();

    function register(){
        parent::register();
        $this->saveBtn = VBtn::make(trans('vular.save'))
            ->valid()
            ->color('primary')
            ->round()
            ->click(
                VularAction::make()
                    ->action('save')
                    ->post()
                    ->valid()
                    //->bindsTo($this->form)
            );
        $this->cancelBtn = VBtn::make(trans('vular.cancel'))
            ->round()
            ->click(
                VularEvent::make('closePage')
            );
    }

    function saveBtn(){
        return $this->saveBtn;
    }

    function cancelBtn(){
        return $this->cancelBtn;
    }

    function makeUI(){
        //$this->initialize();
        $this->form
            ->children(
                VLayout::make()
                ->row()
                ->wrap()
                ->children(
                    VFlex::make()
                        ->class('md10 sm12')
                        ->children(
                            VCard::make()
                                ->children(
                                    VToolbar::make()
                                        //->dark()
                                        //->color('transparent')
                                        ->flat()
                                        ->card()
                                        ->children(
                                            VToolbarTitle::make($this->title)
                                        ),
                                    VDivider::make()
                                )
                                ->children(
                                    VCardText::make()
                                    ->class('pa-4')
                                    ->children(
                                        
                                        //->field('vularValid')
                                        //->props('ref',$this->vularId())
                                        //->ref($this->vularId())
                                        $this->fields()
                                    )
                                    ->children(
                                        $this->saveBtn,
                                        $this->cancelBtn
                                            
                                    )
                                )
                        )
                )
            );

        $this->children(
                $this->breadcrumbs,
                $this->form
            );
    }

}