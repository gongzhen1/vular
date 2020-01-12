<?php
namespace Water\Vular\Admin;

use Water\Vular\VularAble;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\Vuetify\VMenu;
use Water\Vular\Elements\Vuetify\VList;
use Water\Vular\Elements\Vuetify\VListTile;
use Water\Vular\Elements\Vuetify\VListTileAction;
use Water\Vular\Elements\Vuetify\VListTileContent;
use Water\Vular\Elements\Vuetify\VListTileTitle;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VBtn;

class BatchMenu implements VularAble{

    protected $items = [];
    protected $delete = null;
    protected $vularDataTable = null;
    public function __construct($vularDataTable){
        $this->vularDataTable = $vularDataTable;
        $this->delete = new BatchMenuItem('delete_sweep', trans('vular.delete'), 
            VularAction::make()
                ->action('batchDelete')
                ->confirm(trans('vular.confirm-delete'))
                ->bindsTo($vularDataTable)
        );
        array_push($this->items, $this->delete);
	}

    static public function make($vularDataTable){
    	return new BatchMenu($vularDataTable);
	}

    function toVular(){
        $items = array_filter($this->items,function($item){
            return !$item->isHidden();
        });

        if(count($items) == 0){
            return null;
        }

        $batchMenuList = VList::make()
                    ->class('pa-0');
        foreach ($items as $item) {
            $batchMenuList->children(
                VListTile::make()
                    ->ripple(true)
                    ->rel('noopener')
                    ->disabled($item->isDisabled())
                    ->children(
                        VListTileAction::make()
                            ->children(
                               VIcon::make($item->icon)
                            ),
                        VListTileContent::make()
                            ->children(
                                VlistTileTitle::make($item->label)
                            )
                    )
                   ->click($item->action)
            );
        }

        return VMenu::make()
            ->offsetY()
            ->children(
                VBtn::make(trans('vular.batch-operate'))
                    ->slot('activator')
                    ->flat()
                    ->children(
                        VIcon::make('arrow_drop_down')
                            ->right()
                            ->dark()
                    ),
                $batchMenuList
            );
    }

    function unshiftAction($icon, $label, $action){
        $action->bindsTo($this->vularDataTable);
        array_unshift($this->items, new BatchMenuItem($icon, $label, $action));
        return $this;
    }

    function pushAction($icon, $label, $action){
        $action->bindsTo($this->vularDataTable);
        array_push($this->items, new BatchMenuItem($icon, $label, $action));
        return $this;
    }

    function itemOfDelete(){
        return $this->delete;
    }


}