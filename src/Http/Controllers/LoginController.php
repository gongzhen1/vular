<?php
namespace Water\Vular\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Auth;
use Water\Vular\Models\Admin;
use Hash;

class LoginController extends Controller{
    public function __construct(){
    }

    public function login(Request $request){
        $user = Admin::where('login_name', $request->login_name)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $access_token =  $user->createToken('vular')->accessToken;
            return response()->json(['access_token' => $access_token], 200);
            //$request->session()->regenerate();
            //return response()->json("");
        } 
        else{
            return response()->json(['error'=>trans('vular.login-error')]);
        }
    }

    public function logout(Request $request){
        return response()->json("");
    }

}