<?php
namespace Water\Vular\Admin\Templates;

use Water\Vular\Admin\Page ;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VSpacer;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vular\VularTreeEditor;
use Water\Vular\Core\VularResponse;
use Water\Vular\Elements\Vular\VularForm;
use Water\Vular\Elements\VularAction;

abstract class TreeEditPage extends Page{
    protected $editor;
    function register(){
        parent::register();
        $this->form = VularForm::make()
            ->bindsToPage($this);
        $this->editor = VularTreeEditor::make()
                      ->bindsTo($this->form)
                      ->label('文章分类')
                      ->field('tree');
    }

    function makeUI(){
        $modelName = $this->modelClass;
        $tree = (new $modelName)->buildTree();
        $this->editor->defaultValue($tree );
        $this->form->viewModel(['tree'=>$tree ]);

        $this->form
            ->children(
                VLayout::make()
                ->row()
                ->wrap()
                ->children(
                    VFlex::make()
                        ->class('xs12')
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
                                            VBtn::make(trans('vular.save'))
                                                ->large()
                                                ->round()
                                                ->light()
                                                ->valid()
                                                ->color('primary')
                                                ->click(
                                                    VularAction::make()
                                                        ->action('save')
                                                        ->post()
                                                        ->bindsTo($this->form)
                                                )
                                        ),
                                    VDivider::make()
                                )
                                ->children(
                                  $this->editor
                                )
                        )
                )
        );

        $this->children(
                $this->breadcrumbs,
                $this->form
            );

    }

    function modelClass(){
        return $this->modelClass;
    }

    function save($viewModel){
        $modelName = $this->modelClass;
        $itemKey = $this->editor->getItemKey();
        $itemOrder = $this->editor->getItemOrder();
        $ids = [];
        //\Log::notice(json_encode($viewModel));
        foreach ($viewModel->tree as $i => $node) {
            $node->$itemOrder = $i;
            $this->saveNode($node, $ids);
        }
        $modelName::whereNotIn($itemKey, $ids)->delete();
        return VularResponse::make(['tree'=> (new $modelName)->buildTree()])
            ->success();
    }

    function saveNode($viewNode, &$ids, $parentId = null){
        $itemKey = $this->editor->getItemKey();
        $itemOrder = $this->editor->getItemOrder();
        if(strpos($viewNode->$itemKey, 'temp-') === 0){
            $viewNode->$itemKey = null;
        }
        $modelName = $this->modelClass;
        $parentKey = $this->editor->getParentKey();
        $dbNode = $viewNode->$itemKey?$modelName::where($itemKey, $viewNode->$itemKey)->first():new $modelName;
        $dbNode->$parentKey = $parentId;
        $dbNode->$itemKey = $viewNode->$itemKey;
        $dbNode->$itemOrder = $viewNode->$itemOrder;
        $this->convertToDb($viewNode, $dbNode);
        $dbNode->save();
        array_push($ids, $dbNode->$itemKey);
        if(property_exists($viewNode, 'children')){
            foreach ($viewNode->children as $i => $node) {
                $node->$itemOrder = $i;
                $this->saveNode($node, $ids, $dbNode->$itemKey);
            }
        }
    }

    function convertToDb($viewNode, $dbNode){
        foreach ($this->editor->flexs() as $flex) {
            $fieldName = $flex->field->field;
            if(property_exists($viewNode, $fieldName)){
                $dbNode->$fieldName = $viewNode->$fieldName;
            }
        }
    }


}