<?php
namespace Water\Vular\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Water\Vular\Admin\Vular;

class AdminController extends Controller{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(){
        return response()->json((new Vular)->rootNode());
    }

}