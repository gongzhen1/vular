<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'vular/v1'],function($app)
{
    $app->post('login','\Water\Vular\Http\Controllers\LoginController@login');
    $app->get('logout','\Water\Vular\Http\Controllers\LoginController@logout');
    $app->get('admin','\Water\Vular\Http\Controllers\AdminController');
    $app->get('action/{phpClass}/{action}/{vularId}','\Water\Vular\Http\Controllers\ActionController');
    $app->post('action/{phpClass}/{action}/{vularId}','\Water\Vular\Http\Controllers\ActionController');
    $app->post('page','\Water\Vular\Http\Controllers\PageController');
    $app->get('page','\Water\Vular\Http\Controllers\PageController');

    $app->get('util/sortable/{modelId}','\Water\Vular\Http\Controllers\SortableItemController@get')->name('sortable.items.get');
    $app->post('util/sortable/{modelId}','\Water\Vular\Http\Controllers\SortableItemController@save')->name('sortable.items.save');//name不起作用，以后解决

    $app->post('media/upload','\Water\Vular\Http\Controllers\MediaController@upload')->name('media.upload');

    $app->post('media/medias','\Water\Vular\Http\Controllers\MediaController@medias')->name('media.list');

    $app->post('media/remove','\Water\Vular\Http\Controllers\MediaController@remove')->name('media.remove');
    $app->post('media/update','\Water\Vular\Http\Controllers\MediaController@update')->name('media.update');
    $app->post('media/upload-thumbnail','\Water\Vular\Http\Controllers\MediaController@uploadThumbnail')->name('media.uploadThumbnail');

});
