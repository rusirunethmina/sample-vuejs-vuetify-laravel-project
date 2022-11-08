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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//-------------------------check login details----------------------------
Route::post('checkLogin', [
    'uses' => 'APIController@checkLogin'
]);
//-------------------------check login details----------------------------

Route::post('dashboard/get-box-data', [
    'uses' => 'APIController@getAlldataForCombobox'
]);

Route::post('dashboard/search', [
    'uses' => 'APIController@search'
]);

Route::post('dashboard/allPlayers', [
    'uses' => 'APIController@AllPlayers'
]);

Route::post('add-users', [
    'uses' => 'APIController@AddUsers'
]);

Route::post('all-user-data', [
    'uses' => 'APIController@GetUserData'
]);

Route::post('get-all-details', [
    'uses' => 'APIController@GetAllDetails'
]);

Route::post('add-detals', [
    'uses' => 'APIController@AddDetails'
]);

// Player details save
Route::post('player/savePlayerDetails', [
    'uses' => 'PlayerController@savePlayerAllDetails'
]);

Route::post('player/getAllProvince', [
    'uses' => 'PlayerController@getAllProvince'
]);

Route::post('player/getAllDistrictAccProv', [
    'uses' => 'PlayerController@getAllDistrictAccProv'
]);

Route::post('player/getAllGameDetails', [
    'uses' => 'PlayerController@getAllGameDetails'
]);

Route::post('player/getAllEvent', [
    'uses' => 'PlayerController@getAllEvent'
]);

Route::post('player/filterDetails', [
    'uses' => 'PlayerController@filterDetails'
]);
