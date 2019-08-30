@extends('layouts.app')

@section('content')
<form action="">
	<table class="table">
		<tbody>
			<tr>
				<td class="bg-dark text-white" style="width: 16%">Name</td>
				<td><input type="text">{{ $user->name }}</td>
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
				<td class="bg-dark text-white">Email</td>
				<td>{{ $user->email }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Birthdate</td>
				<td>{{ $user->birthdate->toFormattedDateString() }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Phone</td>
				<td>{{ $user->phone }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Address</td>
				<td>{{ $user->address }}</td>
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
	</form>

	{{-- Edit User --}}
	<div class="row">
		<div class="col-md-1">
			<a href="/users/{{ $user->id }}/edit"><button class="btn btn-primary">Edit</button></a>
		</div>

		{{-- Delete User --}}
		<div class="col-md-1">
			<form method="POST" action="/users/{{ $user->id }}">
				@csrf
				@method('DELETE')
				<button type="submit" name="eliminar" class="btn btn-danger">Delete</button>
			</form>
		</div>
	</div>

@endsection