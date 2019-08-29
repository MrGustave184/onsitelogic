<?php

use Illuminate\Http\Request;
use App\User;

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

// Create a group of routes to protect them under the API middleware

// I still need to remove this logic from the api routes. Same user controller or dedicated api controller?
Route::group([], function () {

	// Fetch all users
	Route::get('users', function () {

		// Here we need to join the users and categories tables to return 
		// the name of the user's category
		// There is another more readable way to do this????????
			$users = DB::table('users')
				->join('categories', 'users.category_id', '=', 'categories.id')
				->select('users.name', 'users.lastname', 'users.email', 'users.status', 'users.id', 'categories.name as category')
				->orderBy('users.created_at', 'desc')
				->paginate(15);

			return $users;
	});

	// Fetch single user
	Route::get('users/{user}', function (User $user) {
		return $user;
	});

	// Check in user
	Route::post('users/{user}/check', function (User $user) {
		$status = $user->status == 'asistente' ? 'inasistente' : 'asistente';

		$user->update(
			['status' => $status]
		);
		return $user->status;
	});

	// Delete User
	Route::delete('users/{user}', function (User $user) {
		$user->delete();

		return 'User deleted...';
	});
});
