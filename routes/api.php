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


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::middleware('auth:sanctum')->get('/remove', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return 'tokens are deleted';
});
//authcontroller
Route::post('registerclient', 'AuthauController@registerclient');


Route::post('registeragence', 'AuthauController@registeragence');

Route::post('loginclient', 'AuthauController@LoginClient');

Route::post('loginagence', 'AuthauController@LoginAgence');

Route::get('aa', function (){
    return 'kdfjfk';
});

Route::get('/ala','HelloController@ala');


//offer routes
Route::middleware('auth:sanctum')->post('/createoffer', 'OfferController@createoffer');
//Route::post('/createoffer', 'OfferController@createoffer');
Route::middleware('auth:sanctum')->get('/getofferall', 'OfferController@getofferall');
//Route::get('/getofferall', 'OfferController@getofferall');
Route::middleware('auth:sanctum')->get('/getofferid/{a}/{b}/{c}', 'OfferController@getofferid');
//Route::get('/getofferid/{a}/{b}/{c}', 'OfferController@getofferid}');
Route::middleware('auth:sanctum')->get('/getofferagence/{a}', 'OfferController@getofferagence');
//Route::get('/getofferagence/{a}', 'OfferController@getofferagence');
Route::middleware('auth:sanctum')->get('/getoffercategorie/{a}', 'OfferController@getoffercategorie');
//Route::get('/getoffercategorie/{a}', 'OfferController@getoffercategorie');
Route::middleware('auth:sanctum')->post('/updateoffer/{a}', 'OfferController@updateoffer');
//Route::post('/updateoffer/{a}', 'OfferController@updateoffer');
Route::middleware('auth:sanctum')->delete('/deleteoffer/{a}', 'OfferController@deleteoffer');
//Route::delete('/deleteoffer/{a}', 'OfferController@deleteoffer');

//user routes
Route::middleware('auth:sanctum')->get('/getuser', '\App\Http\Controllers\UserController@getuser');
//Route::get('/getuser', 'UserController@getuser');
Route::middleware('auth:sanctum')->post('/updateagence', '\App\Http\Controllers\UserController@updateagence');
//Route::post('/updateagence/{id}', 'UserController@updateagence');
Route::middleware('auth:sanctum')->post('/updateclient', '\App\Http\Controllers\UserController@updateclient');
//Route::post('/updateclient/{id}', 'UserController@updateclient');
//Route::middleware('auth:sanctum')->get('/searchagence', '\App\Http\Controllers\UserController@search');
Route::get('/searchagence/{search}', 'UserController@search');


// favorite routes
Route::middleware('auth:sanctum')->post('/addfavorite', 'FavoriteController@ajouterfavorit');
//Route::post('/addfavorite', 'FavoriteController@ajouterfavorit');
Route::middleware('auth:sanctum')->delete('/deletefavorite/{a}/{b}', 'FavoriteController@deletefavorite');
//Route::delete('/deletefavorite/{a}/{b}', 'FavoriteController@deletefavorite');
Route::middleware('auth:sanctum')->get('/getfavorite/{a}', 'FavoriteController@getfavorite');
//Route::get('/getfavorite/{a}', 'FavoriteController@getfavorite');


// messages routes
Route::middleware('auth:sanctum')->post('/addmessage', 'MessageController@ajoutermessage');
//Route::post('/addmessage', 'MessageController@ajoutermessage');
Route::middleware('auth:sanctum')->delete('/deletemessage/{a}', 'MessageController@deletemessage');
//Route::delete('/deletemessage/{a}', 'MessageController@deletemessage');
Route::middleware('auth:sanctum')->get('/getmessage/{a}', 'MessageController@getmessage');
//Route::get('/getmessage/{a}', 'MessageController@getmessage');
