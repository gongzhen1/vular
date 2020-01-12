<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Media extends Model
{
    protected $table = 'medias';

    function localPath(){
        return config('filesystems.disks.local.root').'/originals/' .$this->file_name;
    }

    function localThumbnailPath(){
        return config('filesystems.disks.local.root').'/thumbnails/' .$this->thumbnail;
    }

    function localFitDirPath(){
        return config('filesystems.disks.local.root').'/fits/';
    }

    function localFitPath($width, $height){
        return $this->localFitDirPath() . $this->fitName($width, $height);
    }

    //1个参数时是数组，两个参数是宽高
    function fitName($arg1, $arg2=null){
        if($arg2){
            return str_replace('.', $arg1.'x'.$arg2 .'.', $this->file_name);
        }
        else{
            return str_replace('.', $arg1[0].'x'.$arg1[1] .'.', $this->file_name);
        }
    }

    function resize($width, $height){
        $dir = $this->localFitDirPath();
        $path = $this->localFitPath($width, $height);

        if(file_exists($path) ) return;

        if(!is_dir($dir))
        {
            mkdir($dir, 0777);
            chmod($dir, 0777);        
        }
        //\Log::notice($path);
        $img = Image::make($this->localPath())->fit($width, $height)->save($path);
        $img->destroy();
    }

}
