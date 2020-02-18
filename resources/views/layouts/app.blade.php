<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Forum') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script>
		window.App = {!! json_encode([
			'user' => Auth::user(),
			'signedIn' => Auth::check()
		]) !!};
	</script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css">

	@yield('header')
</head>
<body class="pb-20">
	<div id="app">
		<div class="pb-20">
			@include('layouts.nav')
		</div>
		<div class="m-auto w-5/6 lg:w-4/6">
			@yield('content')
			<flash message="{{ session('flash') }}"></flash>
		</div>
	</div>
</body>
</html>
