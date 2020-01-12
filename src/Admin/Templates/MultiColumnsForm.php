<?php
namespace Water\Vular\Admin\Templates;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Html\Span;
use Water\Vular\Elements\Vuetify\VContainer;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
use Water\Vular\Elements\Vuetify\VForm;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VSpacer;
use Water\Vular\Core\VularResponse;
use Water\Vular\Elements\Vular\VularForm;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\VularEvent;

trait MultiColumnsForm{
    private $cards = [];

    private $layout;

    private $topButtons = [];

    private $bottomButtons = [];

    private $saveBtn;
    private $saveContinueBtn;
    private $cancelBtn;


    function makeFormAttributes(){
        $this->layout = VLayout::make()
                ->row()
                ->wrap();
        $this->saveBtn = VBtn::make(trans('vular.save'))
                        ->large()
                        ->round()
                        ->light()
                        ->valid()
                        ->color('primary')
                        ->click(
                            VularAction::make()
                                ->action('save')
                                ->post()
                                ->valid()
                                //->bindsTo($this->form)
                        );
        $this->saveContinueBtn = VBtn::make(trans('vular.save-continue'))
                        ->large()
                        ->round()
                        ->dark()
                        ->valid()
                        ->color('green')
                        ->click(
                            VularAction::make()
                                ->action('saveAndContinue')
                                ->post()
                                ->valid()
                                //->bindsTo($this->form)
                        );
        $this->cancelBtn = VBtn::make(trans('vular.return'))
                        ->large()
                        ->round()
                        ->light()
                        ->click(
                            VularEvent::make('closePage')
                        );
    }
    
    function saveBtn(){
        return $this->saveBtn;
    }

    function saveContinueBtn(){
        return $this->saveContinueBtn;
    }

    function cancelBtn(){
        return $this->cancelBtn;
    }

    //UI相关
    function makeUI(){
        //$this->initialize();
        $this->form
            ->children(
                VLayout::make()
                ->row()
                ->wrap()
                ->class('pa-2 mt-2 mb-2')
                ->style('height:36px')
                ->children(
                    Span::make()
                        ->style('font-size: 30px')
                        ->text($this->title),
                    VSpacer::make(),
                    $this->cancelBtn,
                    $this->saveBtn,
                    $this->saveContinueBtn
                    
                )
                ->children($this->topButtons),

                $this->layout,


                //VDivider::make(),
                VLayout::make()
                ->row()
                ->wrap()
                ->class('pa-2 mt-2 mb-3')
                ->style('height:36px')
                ->children(
                    VSpacer::make(),
                    $this->cancelBtn,
                    $this->saveBtn,
                    $this->saveContinueBtn
                    
                )
                ->children($this->bottomButtons)

            );

        $this->children(
                $this->breadcrumbs,
                $this->form
            );
    }

    function topButton($button){
        array_push($this->topButtons, $button);
    }

    function bottomButton($button){
        array_push($this->bottomButtons, $button);
    }

    function flexCards($cards){
        $flexs = [];
        foreach ($cards as $card) {
        //\Log::notice(json_encode($card));
            $flex =  VFlex::make()
                ->class('md12 sm12 mt-5')
                ->children(
                    $card
                );
            array_push($flexs, $flex);
        }

        return $flexs;
    }

    /*function fields(){
        $fields = [];
        $cards = $this->cards;
        foreach ($cards as $card) {
            $fields = array_merge_recursive($fields, $card->fields());
        }
        return $fields;
    }*/

    //添加列，返回刚添加的flex
    function column(...$cards){
        //\Log::notice(json_encode($cards));
        //$this->mergeCards($cards);
        $flex = VFlex::make()
            ->children(
                VLayout::make()
                    ->column()
                    ->children(
                        $this->flexCards($this->parseCardsFromArgs($cards))
                    )
            );
        $this->layout->children(
            $flex
        );

        return $flex;
    }

    function parseCardsFromArgs($args){
        $cards = [];
        foreach ($args as $card){
            if(is_array($card)){
                $cards = array_merge_recursive($cards, $card);
            }
            else{
                array_push($cards, $card);
            }
        }
        return $cards;
    }
    //function mergeCards($cards){
    //    $this->cards = array_merge_recursive($this->cards, $this->parseCardsFromArgs($cards));
    //}

}