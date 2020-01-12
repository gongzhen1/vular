<?php
namespace Water\Vular\Admin\Menu;

use Water\Vular\VularAble;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Html\Span;
//use Water\Vular\Elements\Html\Div;

use Water\Vular\Elements\Vuetify\VList;
use Water\Vular\Elements\Vuetify\VSubheader;
use Water\Vular\Elements\Vuetify\VListGroup;
use Water\Vular\Elements\Vuetify\VListTile;
use Water\Vular\Elements\Vuetify\VListTileAction;
use Water\Vular\Elements\Vuetify\VListTileAvatar;
use Water\Vular\Elements\Vuetify\VListTileTitle;
use Water\Vular\Elements\Vuetify\VListTileContent;
use Water\Vular\Elements\Vuetify\VBadge;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VChip;
use Water\Vular\Elements\Vuetify\VDivider;

class Node implements VularAble{
    private $children = [];
    private $title;
    private $vularNode;
    private $icon;
    private $to;
    private $badge;
    private $chip;
    private $href;
    private $type;
    private $subGroup = false;
    private $hiddenBy = '';
    private $disabledBy = '';

    public function __construct(){
    }

    function becomeToSubheader($title){
        $this->vularNode = VSubheader::make($title);
        return $this;
    }

    function becomeToTile($title){
        $this->title = $title;
        $this->type = 'tile';
        return $this;
    }

    function becomeToGroup($title){
        $this->title = $title;
        $this->type = 'group';
        return $this;
    }

    function becomeToDivider(){
        $this->vularNode = VDivider::make();
    }

    function icon($icon){
        $this->icon = $icon;
        return $this;
    }

    function to($to){
        $this->to = $to->toMeRoute();
        return $this;
    }

    function href($href){
        $this->href = $href;
        return $this;
    }

    function chip($text, \Closure $callback){
        $this->chip = VChip::make()
            ->small()
            ->text($text);
        $callback($this->chip);
        return $this;
    }

    function badge($text, \Closure $callback){

        $this->badge = VBadge::make()
                ->children(
                    Span::make($text)
                    ->slot('badge')
                );
        $callback($this->badge);
        return $this;
    }


    function subGroup($subGroup = true){
        $this->subGroup = $subGroup;
        return $this;
    }

    function child(\Closure $callback){
        $child = new Node;
        $callback($child);
        array_push($this->children, $child);
        return $this;
    }

    function toVular()
    {
        if($this->type=='tile'){
            $this->makeTile();
        }
        if($this->type=='group'){
            $this->makeGroup();
        }
        if($this->vularNode){
            foreach ($this->children as $node) {
                $this->vularNode->children($node->toVular());
            }
        }
        $this->vularNode->hiddenBy($this->hiddenBy )->disabledBy($this->disabledBy);
        return $this->vularNode;
    }

    function hiddenBy($authPointSlug){
        $this->hiddenBy = $authPointSlug;
        return $this;
    }

    function disabledBy($authPointSlug){
        $this->disabledBy = $authPointSlug;
        return $this;
    }

    protected function makeTile(){
        $this->vularNode = VListTile::make()
            ->ripple()
            ->to($this->to)
            ->href($this->href)
            ->children(
                VListTileAction::make()
                ->children(
                    $this->makeIcon()
                ),
                VListTileContent::make()
                ->children(
                    VListTileTitle::make($this->title)
                ),
                VListTileAction::make()
                ->children($this->chip)
            );

    }

    protected function makeGroup(){
        $this->vularNode = VListGroup::make()
        //->noAction()
        ->prependIcon($this->icon)
        ->subGroup($this->subGroup)
        ->children(
            VListTile::make()
            ->slot("activator")
            ->children(
                VListTileContent::make()
                ->children(
                    VListTileTitle::make($this->title)
                ),
                VListTileAction::make()
                ->children($this->chip)
            )
        );
    }

    protected function makeIcon(){
        if($this->badge){
            return $this->badge->children(VIcon::make($this->icon));
        }
        else{
            return VIcon::make($this->icon);
        }
    }
}