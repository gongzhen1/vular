<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;

final class VularMedias extends VularNode{
    public function __construct(){
        parent::__construct();
        //$this->uploadApi(uploadMediaApi());
        //$this->getApi(mediasApi());
        //$this->removeApi(removeMediaApi());
        //$this->updateApi(updateMediaApi());
        //$this->uploadThumbnailApi(uploadMediaThumbnailApi());
        //$this->getCategoriesApi(getMediaCateogriesApi());
        //$this->saveCategoriesApi(saveMediaCateogriesApi());
    }

 /*   function modelClass($modelClass){
        $modelId = vularize($modelClass);
        //Route name 不起作用，暂时先这样
        $url = 'util/sortable/' . $modelId;
        return $this->props('getCategoriesApi', $url  )
                   ->props('saveCategoriesApi', $url );
    }*/

    function uploadApi($value){
        return $this->props(__FUNCTION__, $value);
    }

    function getApi($value){
        return $this->props(__FUNCTION__, $value);
    }

    function removeApi($value){
        return $this->props(__FUNCTION__, $value);
    }

    function updateApi($value){
        return $this->props(__FUNCTION__, $value);
    }

    function getCategoriesApi($value){
        return $this->props(__FUNCTION__, $value);
    }

    function saveCategoriesApi($value){
        return $this->props(__FUNCTION__, $value);
    }

    function uploadThumbnailApi($value){
        return $this->props(__FUNCTION__, $value);
    }

    function mediaType($value){
        return $this->props(__FUNCTION__, $value);
    }

    function acceptMatch($value){
        return $this->props(__FUNCTION__, $value);
    }

    function typeName($value){
        return $this->props(__FUNCTION__, $value);
    }

}