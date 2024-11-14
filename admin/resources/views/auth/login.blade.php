<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ config("app.name") }}</title>
		<link rel="icon" type="image/x-icon" href="{{ asset('imgs/shawarma_station_logo_transparent.png') }}">

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">

		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
		<script>
			$(document).ready(function()
			{
				var randomNum = Math.floor(Math.random() * 100000);
				var cssUrl = "{{ asset('css/style.css') }}?hash=" + randomNum;

				$("html head").append("<link rel='stylesheet' href='" + cssUrl + "'/>");
			});
		</script>
	</head>

	<body class="admin-login">
		<div class="contents">
			<x-validation-errors class="mb-4" />

			<div class="card">
				<h1>{{ __('ADMIN LOGIN') }}</h1>
				<form method="POST" action="{{ route('login') }}">
					@csrf

					<input type="text" placeholder="{{ __('Username') }}" title="{{ __('Masukkan username Anda') }}" id="name" name="name" :value="old('name')" required autofocus autocomplete="username">
					<input type="password" placeholder="{{ __('Password') }}" title="{{ __('Masukkan password Anda') }}" id="password" name="password" required autocomplete="current-password">
					<button type="submit" title="{{ __('Login') }}">{{ __("Login") }}</button>
				</form>
			</div>
		</div>
	</body>
</html>