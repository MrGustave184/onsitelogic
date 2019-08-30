<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/app.css">

	{{-- CSRF token for axios --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Test Project</title>

</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="/users">Onsitelogic</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
					<a class="nav-link" href="/users">All Users <span class="sr-only"></span></a>
				</li>
					{{-- Categories Dropdown --}}
				{{-- <li class="nav-item">

						<div class="dropdown">
							<a class="nav-link dropdown-toggle {{ Request::is('categories/*') ? 'active' : '' }}" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
								Categories
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								@foreach($categories as $category)
								<a class="dropdown-item" href="/categories/{{ $category->id }}">{{ $category->name }}</a>
								@endforeach
							</div>
						</div>

				</li> --}}
				{{-- /Categories Dropdown --}}
						
				<li class="nav-item {{ Request::is('users/create') ? 'active' : '' }}">
					<a class="nav-link" href="/users/create">Register <span class="sr-only"></span></a>
				</li>
				<li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
					<a class="nav-link" href="/login">Login<span class="sr-only"></span></a>
				</li>
			</ul>
			
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				<button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>
			
		</div>
	</nav>

	<main class="container" style="margin-top:20px;">
		<div class="flex-center position-ref full-height">	
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4 text-center">Test Project</h1>
				</div>
			</div>

	
		
			<div class="content" id="app">
				@include('includes.messages')
				
				@yield('content')
			</div>

		</div>

		@include('includes.footer')