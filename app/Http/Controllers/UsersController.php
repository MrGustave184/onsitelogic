<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$users = User::select('name', 'lastname', 'email', 'status', 'id', 'category_id')
					->paginate(15);

      return view('users.welcome', [
				'users' => $users
			]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
				$categories = Category::all();

        return view('users.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			// Validation here!
			$this->validate($request, [
				'name' 				=> 'required',
				'lastname' 		=> 'required',
				'idNumber' 		=> 'required|alpha_dash|starts_with:V-,E-',
				'email' 			=> 'email',
				'birthdate' 	=> 'date',
				'category_id'	=> 'integer'
			]);

			User::create([
				'name' 				=> $request->input('name'),
				'lastname' 		=> $request->input('lastname'),
				'idNumber'		=> $request->input('idNumber'),
				'email' 			=> $request->input('email'),
				'phone' 			=> $request->input('phone'),
				'address' 		=> $request->input('address'),
				'birthdate' 	=> $request->input('birthdate'),
				'category_id' => $request->input('category_id'),
				'status' 			=> 'inasistente' // As default in the db?
			]);

			return redirect('/users')->with('success', 'User Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
			$categories = Category::all();

      return view('users.edit', compact(['user', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {				
				$user->update(request(
					['name', 'lastname', 'email', 'phone', 'address', 'birthdate']
				));

				return redirect('/users/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {		
				$user->delete();

				return redirect('/users')->with('success', 'User Deleted');
    }
}
