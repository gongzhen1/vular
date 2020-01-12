<?php
namespace Water\Vular\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Water\Vular\Admin\Vular;

class PageController extends Controller{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(){
        //sleep(1);
        $className = ucfirst(un_vularize(request('pageid')));
        $page = new $className;
        $page->build();
        return response()->json($page);
    }

}