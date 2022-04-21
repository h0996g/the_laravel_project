<?php

use App\Models\Agence;
use App\Models\Client;
use App\Models\User;
use Http\Controller\AuthController;
use App\Http\Controllers\UserController;
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


Route::middleware('auth:sanctum')->get('/user', 'UserController@getuser');
// function (Request $request) {
    

//     $a= $request->user();
//      $client = Client::where('user_id', $a['id'])->first();
//      $agence = Agence::where('user_id', $a['id'])->first();
//      if( $client){
// $a['client']=$client;
//      }
//      if($agence){
//       $a['agence']=$agence;   
//      }
//      return $a;
// });


Route::middleware('auth:sanctum')->get('/remove', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return 'tokens are deleted';
});


// Route::middleware('auth:sanctum')->get('/remove', function (Request $request) {
//     $user = $request->user();
//     $user->tokens()->delete();
//     return 'tokens are deleted';
// });

Route::post('registerclient', 'AuthController@registerclient');

Route::post('registeragence', 'AuthController@registeragence');





Route::post('loginclient', 'AuthController@LoginClient');

Route::post('loginagence', 'AuthController@LoginAgence');


// Route::get('/getuser', 'UserController@getuser');
Route::post('/updateagence/{id}', 'UserController@updateagence');
Route::post('/updateclient/{id}', 'UserController@updateclient');
Route::get('/searchagence/{search}', 'UserController@search');



