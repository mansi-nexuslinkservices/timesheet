<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:title" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:description" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:image" content="https://jobick.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>@hasSection('title')@yield('title') @else Now Online @endif</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('backend/images/favicon.svg') }}" />
	<link href="{{ asset('admin/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/style.css') }}" rel="stylesheet">
    <style>
    	.btn-primary:active, .btn-primary:focus, .btn-primary:hover {
	        border-color: #0c2746 !important;
	        background-color: #0c2746 !important;
    	}
    </style>

</head>

<body class="vh-100">
	@yield('content')
    
	<!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
	
    <script src="{{ asset('admin/global/global.min.js') }}"></script>
	<script src="{{ asset('admin/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('admin/custom.min.js') }}"></script>
    <script src="{{ asset('admin/dlabnav-init.js') }}"></script>
	<script src="{{ asset('backend/js/styleSwitcher.js') }}"></script>
</body>
</html>