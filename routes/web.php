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

Route::get('login', 'SessionsController@login')->name('login');
Route::post('login', 'SessionsController@login_store')->name('login.store');
Route::get('logout', 'SessionsController@logout')->name('logout');

Route::get('signup', 'UsersController@signup')->name('signup');
Route::post('signup', 'UsersController@signup_store')->name('signup.store');

Route::resource('articles', 'ArticlesController');
Route::resource('comments', 'CommentsController');
Route::resource('galleries', 'GalleriesController');

Route::get('articles.index', 'ArticlesController@index');
Route::get('galleries.index', 'GalleriesController@index');
Route::get('export_articles', 'ImportExportExcelController@exportExcelArticles')
		->name('export.articles');
Route::post('import_articles', 'ImportExportExcelController@importExcelArticles')
		->name('import.articles');
Route::get('export_comments/{id}', 'ImportExportExcelController@exportExcelComments')
		->name('export.comments');	

Route::get('/', ['as' => 'root', 'uses' => function () {
    return view('welcome');
}]);
