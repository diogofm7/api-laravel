<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('test', function (Request $request){

    //dd($request->headers->all());
    //dd($request->headers->get('Authorization'));

    $response = new \Illuminate\Http\Response(json_encode(['msg' => 'Minha Primeira respoata de API']));
    $response->header('Content-Type', 'Application/json');

    return $response;
});

Route::namespace('Api')->group(function (){

    Route::prefix('products')->group(function (){
        Route::get('/', 'ProductController@index');
        Route::get('/{id}', 'ProductController@show');
        Route::post('/', 'ProductController@store')->middleware(['auth.basic']);
        Route::put('/', 'ProductController@update');
        Route::delete('/{id}', 'ProductController@destroy');
    });

    Route::resource('/users', 'UserController');

});
