@extends('layouts.app')

@section('content')
	@if($participantes->count())
		<table class="table table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
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
						
						<th scope="row">{{ $participante->id }}</th>
						<td><a href="/participantes/{{ $participante->id }}">{{ $participante->nombre }}</a></td>
						<td>{{ $participante->apellido }}</td>
						<td>{{ $participante->email }}</td>
						<td>{{ $participante->categoria->nombre }}</td>
						<td>{{ $participante->status }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p>Aún no hay participantes registrados</p>
	@endif
@endsection