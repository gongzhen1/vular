<?php
namespace Water\Vular\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SortableItemController extends Controller{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get(Request $request){
        $modelClass = ucfirst(un_vularize(request('modelId')));
        return response()->json($modelClass::orderBy('order')->get());
    }

    public function save(Request $request){
        $modelClass = ucfirst(un_vularize(request('modelId')));
        $items= $request->getContent();
        //\Log::notice($items);
        $items = json_decode($items);

        $ids = [];

        foreach ($items as $i => $item) {
         	$dbItem = $item->id >0 ? $modelClass::find($item->id) : new $modelClass;
         	$dbItem->id = $item->id;
         	$dbItem->name = $item->name;
         	$dbItem->order = $i;

         	$dbItem->save();

         	array_push($ids, $dbItem->id);
         } 

         $modelClass::whereNotIn('id', $ids)->delete();

        return response()->json($modelClass::orderBy('order')->get());
    }

}