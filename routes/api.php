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

Route::post('registerclient', 'AuthauController@registerclient');

Route::post('registeragence', 'AuthauController@registeragence');

Route::post('loginclient', 'AuthauController@LoginClient');

Route::post('loginagence', 'AuthauController@LoginAgence');

Route::get('aa', function (){
    return 'kdfjfk';
});

Route::get('/ala','HelloController@ala');


//offer routes

Route::post('/createoffer', 'OfferController@createoffer');


Route::get('/getofferall', 'OfferController@getofferall');
Route::get('/getofferid/{a}/{b}/{c}', 'OfferController@getofferid');
Route::get('/getofferagence/{a}', 'OfferController@getofferagence');
Route::get('/getoffercategorie/{a}', 'OfferController@getoffercategorie');

Route::post('/updateoffer/{a}', 'OfferController@updateoffer');
Route::delete('/deleteoffer/{a}', 'OfferController@deleteoffer');

//user routes
Route::get('/getuser', 'UserController@getuser');
Route::post('/updateagence/{id}', 'UserController@updateagence');
Route::post('/updateclient/{id}', 'UserController@updateclient');
Route::get('/searchagence/{search}', 'UserController@search');


// favorite routes

Route::post('/addfavorite', 'FavoriteController@ajouterfavorit');
Route::delete('/deletefavorite/{a}/{b}', 'FavoriteController@deletefavorite');
Route::get('/getfavorite/{a}', 'FavoriteController@getfavorite');


// messages routes


Route::post('/addmessage', 'MessageController@ajoutermessage');
Route::delete('/deletemessage/{a}', 'MessageController@deletemessage');
Route::get('/getmessage/{a}', 'MessageController@getmessage');
