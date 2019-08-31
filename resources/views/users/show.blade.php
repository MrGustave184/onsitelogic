@extends('layouts.app')

@section('content')

<table class="table">
	<tbody>
		<tr>
			<td class="bg-dark text-white" style="width: 16%">Name</td>
			<td>{{ $user->name }}</td>
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

	{{-- Actions --}}
	<a href="/users" class="btn btn-secondary text-white">Back</a>
	<a href="/users/{{ $user->id }}/edit" class="btn btn-info text-white">Edit</a>
	@if($user->status == 'inasistente')
		<form class="inline-form" style="display:inline" method="POST" action="/users/{{ $user->id }}/check">
			@csrf
			<button type="submit" name="submit" class="btn btn-success text-white">Check In</button>
		</form>
	@endif
	<form class="inline-form" style="display:inline" method="POST" action="/users/{{ $user->id }}">
		@csrf
		@method('DELETE')
		<button type="submit" name="submit" class="btn btn-danger text-white">Delete</button>
	</form>




@endsection