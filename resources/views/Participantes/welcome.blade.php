@extends('layouts.app')

@section('content')
	@if($participantes->count())
		<table class="table table-hover" id="participantes">
			<thead class="thead-dark" id="mytable">
				<tr>
					{{-- <th scope="col">#</th> --}}
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Email</th>
					<th scope="col">Categoria</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($participantes as $participante)
					<tr>
						{{-- $loop->iteration displays the current loop iteration starting from 1 --}}
						{{-- <th scope="row">{{ $loop->iteration }}</th> --}}
						<td><a href="/participantes/{{ $participante->id }}">{{ $participante->nombre }}</a></td>
						<td>{{ $participante->apellido }}</td>
						<td>{{ $participante->email }}</td>
						<td>{{ $participante->categoria->nombre }}</td>
						<td id="asistente">{{ $participante->status }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $participantes->links() }}
	@else
		<p>Aún no hay participantes registrados</p>
	@endif
@endsection