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

//Route Login Logout
Route::get('login', 'SessionsController@login')->name('login');
Route::post('login', 'SessionsController@login_store')->name('login.store');
Route::get('logout', 'SessionsController@logout')->name('logout');

// Route Signup
Route::get('signup', 'UsersController@signup')->name('signup');
Route::post('signup', 'UsersController@signup_store')->name('signup.store');

//this routes for check if email user is exist in database
Route::get('forgot-password', 'ReminderController@create')->name('reminders.create');
Route::post('forgot-password', 'ReminderController@store')->name('reminders.store');
//this routes for handle changes password
Route::get('reset-password/{id}/{token}', 'ReminderController@edit')->name('reminders.edit');
Route::post('reset-password/{id}/{token}', 'ReminderController@update')->name('reminders.update');

// Route Menu
Route::resource('articles', 'ArticlesController');
Route::resource('comments', 'CommentsController');
Route::resource('galleries', 'GalleriesController');

Route::get('articles', 'ArticlesController@index')->name('articles.index');
Route::get('galleries', 'GalleriesController@index')->name('galleries.index');
Route::get('export_articles', 'ImportExportExcelController@exportExcelArticles')
		->name('export.articles');
Route::post('import_articles', 'ImportExportExcelController@importExcelArticles')
		->name('import.articles');
Route::get('export_comments/{id}', 'ImportExportExcelController@exportExcelComments')
		->name('export.comments');	

// Route Root
Route::get('/', ['as' => 'root', 'uses' => function () {
    return view('welcome');
}]);
