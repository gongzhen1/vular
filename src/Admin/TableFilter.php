<?php
namespace Water\Vular\Admin;

use Water\Vular\Admin\Page;
use Water\Vular\VularAble;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VCardActions;
use Water\Vular\Elements\Vuetify\VSpacer;
use Water\Vular\Elements\Vular\VularDataTableFilter;
use Water\Vular\Elements\VularAction;

class TableFilter implements VularAble{

    protected $layout;
    protected $items = [];
    protected $vularTableFilter;

    public function __construct(){
        $this->layout =VLayout::make()
            ->row()
            ->wrap()
            ->style('min-width','300px');
        $this->vularTableFilter = VularDataTableFilter::make()
            ->field('filters')
            ->activatorText('筛选')
            ->title('筛选条件')
            ->clearText('清空')
            ->confirmText('确认');
    }

    function bindsTo($owner){
        $this->vularTableFilter->bindsTo($owner);
    }

    static public function make(){
        return new TableFilter();
    }

    function item(\Closure $callback){
        $item = TableFilterItem::make($this->vularTableFilter);
        $callback($item);
        array_push($this->items, $item);
        return $this;
    }

    function toVular(){
        foreach ($this->items as $item) {
            $this->layout->children(
                $item->toVular()
            );
        }
        return $this->vularTableFilter
            //->bindsTo($this->owner)
            ->children($this->layout);
    }

    function toExpressions($viewModel){
        $expressions = [];
        foreach ($this->items as $item) {
            $exp = $item->toExpression($viewModel);
            if($exp){
                array_push($expressions, $exp);
            }
        }

        return $expressions;
    }

    //function defaultModel($viewModel){
        //$viewModel = new \stdClass;
   //     foreach ($this->items as $item) {
   //         $fieldName = $item->field;
    //        $viewModel->$fieldName = 'xxxxx';//$item->defaultValue();
    //    }
    //    return $viewModel;
    //}
}