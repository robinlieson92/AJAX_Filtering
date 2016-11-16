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

Route::resource('articles', 'ArticlesController');
Route::resource('galleries', 'GalleriesController');

Route::get('articles.index', 'ArticlesController@index');
Route::get('galleries.index', 'GalleriesController@index');

Route::get('/', ['as' => 'root', 'uses' => function () {
    return view('welcome');
}]);
