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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function (Request $request) {
    return 'hello';
});

Route::get('/test2', 'ApiController@test2');
Route::get('/test3', 'ApiController@test3');
Route::get('/test4', 'ApiController@test4');
Route::get('/test5', 'ApiController@test5');
Route::get('/test6', 'ApiController@test6');
Route::get('/test7', 'ApiController@test7');
Route::get('/test8', 'ApiController@test8');
Route::post('/test9', 'ApiController@test9');
Route::post('/test10', 'ApiController@test10');

Route::post('/data_process', 'ApiController@data_process');
