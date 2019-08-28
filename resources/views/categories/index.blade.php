@extends('layouts.app')

@section('content')
	<div class="text-center" style="margin-bottom: 40px;">
		<h1>Category: {{ $current_category }}</h1>
	</div>

	@if($users->count())
		<table class="table table-hover" id="participantes">
			<thead class="thead-dark" id="mytable">
				<tr>
					{{-- <th scope="col">#</th> --}}
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
						{{-- $loop->iteration displays the current loop iteration starting from 1 --}}
						{{-- <th scope="row">{{ $loop->iteration }}</th> --}}
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
	@endif
@endsection