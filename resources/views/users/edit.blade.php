@extends('layouts.app')

@section('content')
	<table class="table">
		<tbody>
			<tr>
				<td class="bg-dark text-white" style="width: 16%">Name</td>
				<td><a href="/users/{{ $user->id }}">{{ $user->name }}</a></td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Lastname</td>
				<td>{{ $user->lastname }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">ID Number</td>
				<td>{{ $user->idNumber }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Category</td>
				<td>{{ $user->category->name }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Status</td>
				<td>{{ $user->status }}</td>
			</tr>
		</tbody>
	</table>
	<div style="margin:40px 0 40px 0">
		<h3 class="text-center">Edit User</h3>
	</div>
	
	<form method="POST" action="/users/{{ $user->id }}">
		@csrf
		{{ method_field('PATCH') }}
		
		<div class="form-group">
			<label for="name">Name: </label>
			<input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}" required>
		</div>
		<div class="form-group">
			<label for="lastname">Lastname: </label>
			<input name="lastname" type="text" class="form-control" id="lastname" value="{{ $user->lastname }}" required>
		</div>

		<div class="form-group">
			<label for="email">Email: </label>
			<input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}">
		</div>
		<div class="form-group">
			<label for="phone">Phone: </label>
			<input name="phone" type="text" class="form-control" id="phone" value="{{ $user->phone }}">
		</div>
		<div class="form-group">
			<label for="address">Address: </label>
			<input name="address" type="text" class="form-control" id="address" value="{{ $user->address }}">
		</div>
		<div class="form-group">
			<label for="birthdate">Birthdate: </label>
			<input name="birthdate" type="date" class="form-control" id="birthdate" value="{{ $user->birthdate->toDateString() }}" required>
		</div>
		<button type="submit" class="btn btn-success">Update</button>
	</form>

@endsection