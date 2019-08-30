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
// Redirect from /
Route::get('/', function () {
	$root = auth()->check() ? '/users' : '/login';

	return redirect($root);
});

Route::resource('/users', 'UsersController');

// Categories
Route::get('/categories/{category}', 'CategoriesController@index'); // Make resourceful later!


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
