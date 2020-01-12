<?php
namespace Water\Vular\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Water\Vular\Models\Media;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class MediaController extends Controller{

    function upload(Request $request){
        $userId = 0;
        if( $request->user()){
            $userId = $request->user()->id;
        }
        $data = $request->all();
        $mimeType = $data['mime_type'];
        if(!$mimeType)
        {
            $mimeType = "unknown";
        }

        //$imageSize = $this->filterImageSize();
        $file = request('file');
        $media = new Media;
        //$media->owner_id = request('ownerId');
        //$media->name = $data['file_name'];
        $media->category_id = $data['category_id'];
        $media->media_type = $data['media_type'];
        $media->name = $file->getClientOriginalName();
        //$media->folder = request('folder');
        $fileName = uniqid('img').'.'.$file->getClientOriginalExtension();
        $file = request('file');
        $media->file_name = $fileName;
        $filePath = $file->storeAs('/originals/', $fileName);

        if($media->media_type == 'image'){
            $this->saveImageThumbnail($fileName);
            $media->thumbnail = $fileName;
        }
        else{
            $media->thumbnail = 'video-blank.jpg';
        }
        //foreach ($imageSize->getSizes()  as $key => $value) 
        //{
        //    $this->saveResizedFile($media, $key, $value);
        //}

        $media->user_id = $userId;
        $media->mime_type = $mimeType;
        $media->size = $this->humanFilesize(Storage::size($filePath));


        $media->save();
        return $media;
    }


    function saveImageThumbnail($fileName)
    {
        $file = request('file');
        if($file)
        {
            $dir = config('filesystems.disks.local.root').'/thumbnails/';
            //\Log::notice($dir);
            if(!is_dir($dir))
            {
                mkdir($dir, 0777);
                chmod($dir, 0777);        
            }
            $path = $dir.'/'. $fileName;
            $img = Image::make($file)->fit(200, 200)->save($path);
            $img->destroy();
        }

    }


    /**
     * 返回可读性更好的文件尺寸
     */
    function humanFilesize($bytes, $decimals = 2)
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
    }

    /**
     * 判断文件的MIME类型是否为图片
     */
    function isImage($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }


    function medias(Request $request){
        $model = json_decode($request->getContent());
        $condition = [];
        if($model->keywords){
            array_push($condition, ['name','like', '%'.$model->keywords.'%']);
        }

        if($model->categoryId != 0){
            array_push($condition, ['category_id','=', $model->categoryId]);
        }
        array_push($condition, ['media_type','=', $model->mediaType]);

        $sortField = "";
        $ascendString ="";
        if($model->sortBy == 'a-z'){
            $sortField = 'name';
            $ascendString ="asc";
        }
        if($model->sortBy == 'z-a'){
            $sortField = 'name';
            $ascendString ="desc";
        }
        if($model->sortBy == 'newest'){
            $sortField = 'created_at';
            $ascendString ="desc";
        }
        if($model->sortBy == 'oldest'){
            $sortField = 'created_at';
            $ascendString ="asc";
        }
        if($sortField){
            return Media::where($condition)
                ->orderBy($sortField, $ascendString)
                ->simplePaginate(24);
        }
        return Media::where($condition)->simplePaginate(24);
    }

    function remove(Request $request){
        $ids = json_decode($request->getContent());
        $files = Media::find($ids);
        foreach ($files as $key => $file) 
        {
            Storage::delete($file->localPath());
            Storage::delete($file->localThumbnailPath());
        }
        /*$imgSizes = $this->filterImageSize();
        foreach ($files as $key => $file) 
        {
            foreach ($imgSizes->getSizes()  as $key => $value) 
            {
                Storage::delete($file->filePath($key));
            }
        }*/

        Media::destroy($ids);

        //Media::whereIn('id', $ids)->delete();
    }

    function update(Request $request){
        $model = json_decode($request->getContent());

        $media = Media::find($model->id);

        $media->name = $model->name;
        $media->category_id = $model->category_id;

        $media->save();
    }

    function uploadThumbnail(Request $request){
        $file = request('file');
        $media = Media::find(request('media_id'));

        $fileName = uniqid('img').'.'.$file->getClientOriginalExtension();
        $file = request('file');

        $this->saveImageThumbnail($fileName);
        $media->thumbnail = $fileName;
        //\Log::notice($media->thumbnail);
        $media->save();
        return $media;
    }


}