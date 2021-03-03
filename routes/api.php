<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
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
Route::group(['prefix' => 'v1'], function () {
    Route::get('blogs', 'BlogController@index');
    Route::get('detailblogs/{slug}', 'BlogController@show');
});

Route::group(['prefix' => 'category'], function () {
    Route::get('categories', 'CategoryController@index');
    // Route::get('parent', 'CategoryController@show');
});

Route::group(['prefix' => 'tag'], function () {
    Route::get('categories', 'CategoryController@index');
});

Route::get('tour','Tour@index');
Route::get('tour/{id}', 'Tour@show');
Route::post('tour_create','Tour@store');

Route::apiResource('city','city');

Route::post('contact','Contacts@store');

Route::get('restaurant','Restaurants@index');
Route::get('restaurant/{id}','Restaurants@show');

Route::get('food','Foods@index');
Route::get('food/{id}','Foods@show');

Route::get('hotel','Hotels@index');
Route::get('hotel/{id}','Hotels@show');

Route::get('place','Places@index');
Route::get('place/{id}','Places@show');

Route::get('all','AllController@index');   
Route::get('touroperators','TourOperators@index');  

Route::get('map','Maps@index');

