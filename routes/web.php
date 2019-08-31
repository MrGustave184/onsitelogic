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

	// redirect($root) to activate the authentication system
	return redirect('/users');
});

Route::resource('/users', 'UsersController');

Route::post('/users/{user}/check', 'UsersController@updateStatus');

// Categories
Route::get('/categories/{category}', 'CategoriesController@index'); // Make resourceful later!

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
