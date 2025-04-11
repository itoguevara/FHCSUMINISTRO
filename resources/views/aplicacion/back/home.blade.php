
<!DOCTYPE HTML>
<!--
	ZeroFour by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>FHC Suministros y Servicios</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{ asset('Back/assets/css/main.css') }}" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0,minimum-scale=1"  />
		<link  rel = "stylesheet"  href = "{{ asset('Back/assets/css/style.css') }}"  />
	</head>
	<body class="homepage is-preload">

		<div id="page-wrapper">
			<!-- Verifico si el Usuario esta Chequeado para Mostrar o No el Menu Principal-->
			@if (Auth::check())
				@include('components.headermenu')    
			@else
				@include('components.notheadermenu')    
			@endif
			@include('components.bodydata') 
			@include('components.footerpage') 
		</div>
		<!-- Scripts -->
			<script src="{{ asset('assets/js/jquery.min.js') }}"></script> 
			<script src="{{ asset('assets/js/jquery.dropotron.min.js') }}"></script>
			<script src="{{ asset('assets/js/browser.min.js') }}"></script>
			<script src="{{ asset('assets/js/breakpoints.min.js') }}"></script>
			<script src="{{ asset('assets/js/util.js') }}"></script>
			<script src="{{ asset('assets/js/main.js') }}"></script>

	</body>
</html>