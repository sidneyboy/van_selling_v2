<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'JULMAR_AGENT') }}</title>
		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}" defer></script>
		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="{{ asset('/lapis.css') }}" rel="stylesheet">
		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		
	</head>
	<body>
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
				<div class="container">
					<a class="navbar-brand" href="{{ url('/') }}">
						{{ config('app.name', 'JULMAR_AGENT') }}
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">
						</ul>
					</div>
				</div>
			</nav>
			<main class="py-4" style="">
				{{-- @yield('content') --}}
				<center>
				<div class="container">
					<div class="card">
						<div class="card-body">
							<form action="{{ route('agent_user_submit') }}" method="post">
								@csrf
								<div class="row">
									<div class="col-md-12">
										<label>User ID:</label>
										<input type="number" min="0" name="user_id" class="form-control" required>
									</div>
									<div class="col-md-12">
										<label>Full Name</label>
										<input type="text" min="0" name="full_name" class="form-control" required>
									</div>
									<div class="col-md-12">
										<label>&nbsp;</label><br />
										<button type="submit" clas="btn btn-block btn-success">SUBMIT</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				</center>
			</main>
		</div>
	</body>
</html>