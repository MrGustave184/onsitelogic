@extends('layouts.app')

@section('content')
	<table class="table">
		<tbody>
			<tr>
				<td class="bg-dark text-white" style="width: 16%">Nombre</td>
				<td>{{ $participante->nombre }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Apellido</td>
				<td>{{ $participante->apellido }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Número de cédula</td>
				<td>{{ $participante->cedula }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Email</td>
				<td>{{ $participante->email }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Fecha de nacimiento</td>
				<td>{{ $participante->fechaNacimiento->toFormattedDateString() }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Teléfono</td>
				<td>{{ $participante->telefono }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Dirección</td>
				<td>{{ $participante->direccion }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Categoría</td>
				<td>{{ $participante->categoria->nombre }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Status</td>
				<td>{{ $participante->status }}</td>
			</tr>
		</tbody>
	</table>

	{{-- Editar --}}
	<div class="row">
		<div class="col-md-1">
			<a href="/participantes/{{ $participante->id }}/edit"><button class="btn btn-primary">Editar</button></a>
		</div>

		{{-- Eliminar --}}
		<div class="col-md-1">
			<form method="POST" action="/participantes/{{ $participante->id }}">
				@csrf
				@method('DELETE')
				<button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
			</form>
		</div>
	</div>

@endsection