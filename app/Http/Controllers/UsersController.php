<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests\UserCreateRequest;

use App\Http\Requests\UserUpdateRequest;

use App\User;

use App\Category;

use App\Exports\UsersExport;

use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$users = User::getUsers();

      return view('users.welcome', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
			$user = User::create([
				'name' 				=> $request->input('name'),
				'lastname' 		=> $request->input('lastname'),
				'idNumber'		=> $request->input('idNumber'),
				'email' 			=> $request->input('email'),
				'phone' 			=> $request->input('phone'),
				'address' 		=> $request->input('address'),
				'birthdate' 	=> $request->input('birthdate'),
				'category_id' => $request->input('category_id'),
				'password'		=> 'password', // I NEED TO ADD LOGIN FUNCTIONALITY
				'is_admin'		=> 0,
				'status' 			=> 'non live' // As default in the db?
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
      return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
				$user->update($request->validated());

				return redirect('/users/' . $user->id)->with('success', 'User has been updated');
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

		/**
     * Update user status 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
		public function updateStatus(User $user)
		{
			$user->updateStatus();

			return redirect('/users')->with('success', 'User Updated');
		}

		/**
     * Generate and download user's report
		 */
		 public function export()
		 {
			 return Excel::download(new UsersExport, 'users.xlsx');
		 }
}
