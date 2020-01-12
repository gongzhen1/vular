<?php
namespace Water\Vular\Elements\Vular;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait AuthorityCheck {
    protected $forbiddenActions = [];

    function permitActionBy($action, $authPoint){
        if(!user()->isPermitted($action)){
            array_push($this->forbiddenActions, $action);
        }
        else{
            array_diff($this->forbiddenActions, [$action]);
        }

        //\Log::notice(json_encode($this->forbiddenActions));
    }

    function isActionForbidden($action){
        //\Log::notice(json_encode($this->forbiddenActions));
        foreach ($this->forbiddenActions as  $forbiddenAction) {
            if($forbiddenAction == $action){
                return true;
            }
        }
        return false;
    }

}