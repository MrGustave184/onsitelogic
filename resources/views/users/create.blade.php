@extends('layouts.app')

@section('content')
	<form method="POST" action="/users">
		@csrf
		
		<div class="form-group">
			<label for="name">Name: </label>
		<input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}" required>
		</div>
		<div class="form-group">
			<label for="lastname">Lastname: </label>
			<input name="lastname" type="text" class="form-control" id="lastname" placeholder="Lastname" value="{{ old('lastname') }}" required>
		</div>
		<div class="form-group">
			<label for="idNumber">ID Number: </label>
			<input name="idNumber" type="text" class="form-control" id="idNumber" placeholder="V- / E-" value="{{ old('idNumber') }}" required>
		</div>
		<div class="form-group">
			<label for="email">Email: </label>
			<input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
		</div>
		<div class="form-group">
			<label for="phone">Phone: </label>
			<input name="phone" type="text" class="form-control" id="phone" placeholder="Phone" value="{{ old('phone') }}">
		</div>
		<div class="form-group">
			<label for="address">Address: </label>
			<input name="address" type="text" class="form-control" id="address" placeholder="Address" value="{{ old('address') }}">
		</div>
		<div class="form-group">
			<label for="birthdate">Birthdate: </label>
			<input name="birthdate" type="date" class="form-control" id="birthdate" value="{{ old('birthdate') }}" required>
		</div>
		<div class="form-group">
			<label for="category">Category </label>
			<select name="category_id" class="form-control" id="category" required>
				
				@if($categories->count())
					<option value="">Select a category...</option>
					@foreach($categories as $category)
					{{-- Here we check if current category id == old category id to rememeber the selection --}}
						<option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name}}</option>
					@endforeach
				@else
						<option value="">There are no categories yet</option>
				@endif
			</select>
		</div>

		<button type="submit" class="btn btn-primary">Register</button>
	</form>
@endsection