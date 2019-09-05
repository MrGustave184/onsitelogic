@extends('layouts.app')

@section('content')
		<div class="text-center title">
			<h1>Users</h1>
		</div>

		@if($users->count())
			<users-component></users-component>
		@else 
			<hr>
			<h3 class="text-center">There are no users yet!</h3>
		@endif
	
	{{-- @if($users->count())
		<table class="table table-hover" id="participantes">
			<thead class="thead-dark" id="mytable">
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Category</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td><a href="/users/{{ $user->id }}">{{ $user->name }}</a></td>
						<td>{{ $user->lastname }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->category->name }}</td>
						<td id="live">{{ $user->status }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $users->links() }}
	@else
		<p>There are no users yet!</p>
	@endif --}}
	
@endsection