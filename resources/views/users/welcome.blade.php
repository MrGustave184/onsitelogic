@extends('layouts.app')

@section('content')
	<users-component></users-component>
	
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
						<td id="asistente">{{ $user->status }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $users->links() }}
	@else
		<p>There are no users yet!</p>
	@endif --}}
	
@endsection