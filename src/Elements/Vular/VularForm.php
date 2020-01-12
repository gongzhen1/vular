<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\MakeAble;
use Water\Vular\Elements\VularNode;

class VularForm extends VularNode{
    public function __construct(){
        parent::__construct();
    }

    //自带viewModel
    function viewModel($value){
        return $this->props(__FUNCTION__, $value);
    }

    //从父form获取viewModel用的字段
    function field($value){
        return $this->props(__FUNCTION__, $value);
    }

    function bindsToPage($page){
        $pageId = vularize(get_class($page));
        $this->props('owner', $page->vularId());
        return $this->props('pageId', $pageId);
    }

}

