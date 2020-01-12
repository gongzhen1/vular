<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;

final class VularDataTable extends VularNode{
    public function __construct(){
        parent::__construct();
        $vid = request('vularId');
        $this->props('vularId', $vid ? $vid:uniqid('vid'));
        $viewModel = new \stdClass;
        $viewModel->keywords = '';
        $viewModel->pagination = VularTablePagination::make()->rowsPerPage(10);
        $viewModel->selected = [];
        $this->viewModel($viewModel);
        $this->fetch();//缺省获取数据的方法
    }

    function vularId(){
        return $this->props->vularId;
    }
    
    function columns(...$args){
        $columns = [];
        foreach($args as $arg){
            if(is_array($arg)){
                $columns = array_merge_recursive($columns, $arg);
            }
            else{
                array_push($columns, $arg);
            }
        }
        return $this->props(__FUNCTION__, $columns);
    }
	
    function selectAll(bool $value = true){
        //$this->props('selected', []);
        return $this->props(__FUNCTION__, $value);
    }
	
    function rowsPerPageText($value){
        return $this->props(__FUNCTION__, $value);
    }

    function rowsPerPage($value){
        $viewModel->pagination->rowsPerPage($value);
        return $this;
    }
	
    //function totalItems($value){
    //    return $this->props(__FUNCTION__, $value);
    //}
	
    //function page($value){
    //    return $this->props(__FUNCTION__, $value);
    //}

    function itemKey($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function noResultsText($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function noDataText($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function viewModel($value){
        return $this->props(__FUNCTION__, $value);
    }

    function bindsToPage($page){
        $pageId = vularize(get_class($page));
        return $this->props('pageId', $pageId);
    }

    function fetch($value = 'fetch'){
        return $this->props(__FUNCTION__, $value);
    }

    //function pagination(\Closure $callBack){
    //    if(!property_exists($this->props,'pagination')){
    //        $this->props->pagination = VularTablePagination::make();
    //    }
    //    $callBack($this->props->pagination);
    //    return $this;

    //}
    //function bindsTo($panel){
    //    return $this->props('owner', $panel->vularId());
    //}

}