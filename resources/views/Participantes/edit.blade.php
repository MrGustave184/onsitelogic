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
				<td class="bg-dark text-white">Categoría</td>
				<td>{{ $participante->categoria->nombre }}</td>
			</tr>
			<tr>
				<td class="bg-dark text-white">Status</td>
				<td>{{ $participante->status }}</td>
			</tr>
		</tbody>
	</table>
	<div style="margin:40px 0 40px 0">
		<h3 class="text-center">Editar</h3>
	</div>
	
	<form method="POST" action="/participantes/{{ $participante->id }}">
		@csrf
		{{ method_field('PATCH') }}
		
		<div class="form-group">
			<label for="nombre">Nombre: </label>
			<input name="nombre" type="text" class="form-control" id="nombre" value="{{ $participante->nombre }}">
		</div>
		<div class="form-group">
			<label for="apellido">Apellido: </label>
			<input name="apellido" type="text" class="form-control" id="apellido" value="{{ $participante->apellido }}">
		</div>

		<div class="form-group">
			<label for="email">Email: </label>
			<input name="email" type="email" class="form-control" id="email" value="{{ $participante->email }}">
		</div>
		<div class="form-group">
			<label for="telefono">Teléfono: </label>
			<input name="telefono" type="text" class="form-control" id="telefono" value="{{ $participante->telefono }}">
		</div>
		<div class="form-group">
			<label for="direccion">Dirección: </label>
			<input name="direccion" type="text" class="form-control" id="direccion" value="{{ $participante->direccion }}">
		</div>
		<div class="form-group">
			<label for="fechaNacimiento">Fecha de nacimiento: </label>
			<input name="fechaNacimiento" type="date" class="form-control" id="fechaNacimiento" value="{{ $participante->fechaNacimiento->toDateString() }}">
		</div>
		<button type="submit" class="btn btn-success">Actualizar</button>
	</form>

@endsection