<?php
use Illuminate\Support\Facades\Auth;

if (! function_exists('un_vularize')) {
    function un_vularize($str)
    {
        $str = preg_replace_callback('/([-]+([a-z]{1}))/i',function($matches){
                return '\\'. strtoupper($matches[2]);
            },$str);

        $str = preg_replace_callback('/([_]+([a-z]{1}))/i',function($matches){
                return strtoupper($matches[2]);
            },$str);
        return $str;
    }
}

if (! function_exists('vularize')) {
    function vularize($name)
    {
        return str_replace('\\', '-',uncamelize($name));
    }
}

if (! function_exists('uncamelize')) {
    function uncamelize($camelCaps,$separator='_')
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
    }
}


if (! function_exists('user')) {
    function user()
    {
        return auth()->guard('api')->user();
    }
}

if (! function_exists('getbase')) {
	function getbase($class)
	{
	    $class = is_object($class) ? get_class($class) : $class;

	    return basename(str_replace('\\', '/', $class));
	}
}

if (! function_exists('mediasApi')) {
	function mediasApi()
	{
		return "media/medias";
	}
}

if (! function_exists('uploadMediaApi')) {
	function uploadMediaApi()
	{
		return 'media/upload';
	}
}

if (! function_exists('removeMediaApi')) {
	function removeMediaApi()
	{
		return 'media/remove';
	}
}

if (! function_exists('updateMediaApi')) {
	function updateMediaApi()
	{
		return 'media/update';
	}
}

if (! function_exists('uploadMediaThumbnailApi')) {
	function uploadMediaThumbnailApi()
	{
		return 'media/upload-thumbnail';
	}
}

if (! function_exists('getMediaCateogriesApi')) {
	function getMediaCateogriesApi()
	{
		return 'util/sortable/' . vularize('Water\Vular\Models\MediaCategory');
	}
}

if (! function_exists('saveMediaCateogriesApi')) {
	function saveMediaCateogriesApi()
	{
		return 'util/sortable/' . vularize('Water\Vular\Models\MediaCategory');
	}
}

/*
if (! function_exists('post_media_size')) {
    function post_media_size()
    {
    	$configFile = config('vular.admin-config');
    	return config($configFile.'.'.'post-media-size');
        //return auth()->guard('api')->user();
    }
}

if (! function_exists('post_media_thumb_size')) {
    function post_media_thumb_size()
    {
    	$configFile = config('vular.admin-config');
    	return config($configFile.'.'.'post-media-thumb-size');
        //return auth()->guard('api')->user();
    }
}

if (! function_exists('page_media_size')) {
    function page_media_size()
    {
        $configFile = config('vular.admin-config');
        return config($configFile.'.'.'page-media-size');
        //return auth()->guard('api')->user();
    }
}

if (! function_exists('page_media_thumb_size')) {
    function page_media_thumb_size()
    {
        $configFile = config('vular.admin-config');
        return config($configFile.'.'.'page-media-thumb-size');
        //return auth()->guard('api')->user();
    }
}

if (! function_exists('web_config')) {
    function web_config($name)
    {
        $configFile = config('vular.admin-config');
        return config($configFile.'.'.$name);
        //return auth()->guard('api')->user();
    }
}


if (! function_exists('theme')) {
    function theme()
    {
        return config('webtheme.theme');
        //return auth()->guard('api')->user();
    }
}*/


