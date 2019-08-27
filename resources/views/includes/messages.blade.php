{{-- Display all errors if any --}}
@if($errors->any())
	@foreach($errors->all() as $error)
		<div class="alert alert-danger">
			{{$error}}
		</div>
	@endforeach
@endif

{{-- Display our custom session success messages if any --}}
@if(session('success'))
	<div class="alert alert-success">
		{{session('success')}}
	</div>
@endif

{{-- Display our custom session error messages  if any--}}
@if(session('error'))
	<div class="alert alert-danger">
		{{session('error')}}
	</div>
@endif