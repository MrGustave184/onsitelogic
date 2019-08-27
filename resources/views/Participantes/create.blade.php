@extends('layouts.app')

@section('content')
	<form method="POST" action="/participantes">
		@csrf
		
		<div class="form-group">
			<label for="nombre">Nombre: </label>
			<input name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">
		</div>
		<div class="form-group">
			<label for="apellido">Apellido: </label>
			<input name="apellido" type="text" class="form-control" id="apellido" placeholder="Apellido">
		</div>
		<div class="form-group">
			<label for="cedula">Cédula: </label>
			<input name="cedula" type="text" class="form-control" id="cedula" placeholder="Número de cédula">
		</div>
		<div class="form-group">
			<label for="email">Email: </label>
			<input name="email" type="email" class="form-control" id="email" placeholder="Email">
		</div>
		<div class="form-group">
			<label for="telefono">Teléfono: </label>
			<input name="telefono" type="text" class="form-control" id="telefono" placeholder="Teléfono">
		</div>
		<div class="form-group">
			<label for="direccion">Dirección: </label>
			<input name="direccion" type="text" class="form-control" id="direccion" placeholder="Dirección">
		</div>
		<div class="form-group">
			<label for="fechaNacimiento">Fecha de nacimiento: </label>
			<input name="fechaNacimiento" type="date" class="form-control" id="fechaNacimiento" placeholder="Dirección">
		</div>
		<div class="form-group">
			<label for="categoria">Categoría </label>
			<select name="categoria" class="form-control" id="categoria">
				@if($categorias->count())
					<option value="">Seleccione una cateroría...</option>
					@foreach($categorias as $categoria)
						<option value="{{ $categoria->id }}">{{ $categoria->nombre}}</option>
					@endforeach
				@endif
			</select>
		</div>

			<button type="submit" name="submit" class="btn btn-primary">Registrar</button>

	</form>
@endsection