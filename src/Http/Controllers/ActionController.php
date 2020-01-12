<?php
namespace Water\Vular\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Water\Vular\Admin\Vular;
use Water\Vular\Core\ValidateException;
use Water\Vular\Core\VularResponse;

class ActionController extends Controller{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request){
        $className = ucfirst(un_vularize(request('phpClass')));
        $actionName = un_vularize(request('action'));
        $viewModel= $request->getContent();
        $viewModel = json_decode($viewModel);
        $page = new $className(request('vularId'));
        $page->build();
        //$page->binds();
        //\Log::notice($page->isActionForbidden($actionName));
        if($page->isActionForbidden($actionName)){
            return response('Accession forbidden.', 403);
        }
        try{
            return $this->response($page->$actionName($viewModel));
        }
        catch(ValidateException $e){
            return $this->response(
                VularResponse::make()
                    ->errors($e->errors)
                );
        }
    }

    protected function response($response){
        return response()->json($response);
    }

}