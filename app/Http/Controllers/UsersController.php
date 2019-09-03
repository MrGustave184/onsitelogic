<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
			$users = User::select('name', 'lastname', 'email', 'status', 'id', 'category_id')
					->latest()
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
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			// Validation 
			$this->validate($request, [
				'name' 				=> 'required',
				'lastname' 		=> 'required',
				'idNumber' 		=> 'required|alpha_dash|unique:users|starts_with:V-,E-',
				'email' 			=> 'email|unique:users',
				'birthdate' 	=> 'date|required|before:today',
				'category_id'	=> 'required|integer|exists:categories,id'
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
				'password'		=> 'password', // I NEED TO ADD LOGIN FUNCTIONALITY
				'is_admin'		=> 0,
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
      return view('users.edit', compact('user'));
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
				$this->validate($request, [
					'name' 				=> 'required',
					'lastname' 		=> 'required',
					'email' 			=> 'email',
					'birthdate' 	=> 'date|required',
					'category_id'	=> 'integer|exists:categories,id'
				]);	

				$user->update(request(
					['name', 'lastname', 'email', 'phone', 'address', 'birthdate']
				));

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
			$status = $user->status == 'asistente' ? 'inasistente' : 'asistente';

			$user->update(['status' => $status]);

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
