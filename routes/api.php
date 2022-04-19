<?php

use Http\Controller\AuthController;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->get('/remove', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return 'tokens are deleted';
});

Route::post('registerclient', 'AuthController@registerclient');

Route::post('registeragence', 'AuthController@registeragence');

Route::post('login', 'AuthController@login');

Route::get('aa', function (){
    return 'kdfjfk';
});
