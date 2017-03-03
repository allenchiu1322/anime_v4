<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AnimeController@index')->name('index');
Route::get('/title', 'AnimeController@title')->name('anime.title');
Route::get('/seiyuu', 'AnimeController@seiyuu')->name('anime.seiyuu');
Route::get('/character', 'AnimeController@character')->name('anime.character');
Route::get('/maintain', 'AnimeController@maintain')->name('anime.maintain');
