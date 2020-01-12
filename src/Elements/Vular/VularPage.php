<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\RouteAble;
use Water\Vular\Elements\ActionAble;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\Vuetify\VContainer;

abstract class VularPage extends VContainer implements RouteAble, ActionAble{
    use AuthorityCheck;

    //protected $toMeRoute;

    //protected $toMeAction;
    protected $pageid;
    protected $routeName;
    //protected $vularId;

    public function __construct($routeName){
        parent::__construct();
        $this->pageid = vularize(get_called_class());
        $this->routeName = $routeName;
    }

    function viewModel($viewModel){
        $this->props('viewModel', $viewModel);
        return $this;
    }

    //function vularId(){
    //    return $this->vularId;
    //}
    function pageId(){
        return $this->pageid;
    }


    function toMeRoute(){
        $toMeRoute = new \stdClass;
        $toMeRoute->name = $this->routeName;
        $toMeRoute->params = new \stdClass;
        $toMeRoute->params->pageid = $this->pageid;

        return $toMeRoute;
    }

    function toMeAction(){
        return VularAction::make()
            ->action('toPage')
            ->param('pageid', $this->pageid);
    }

    function vularizeAction($actionName){
        $pageid = vularize(get_called_class());
        $action = vularize($actionName);

        return 'action/'.$pageid.'/'.$action.'/'.$this->vularId;
    }


}