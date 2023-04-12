
<!DOCTYPE html>
<html lang="en">
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
	<link rel="shortcut icon" type="image/png" href="{{ asset('backend/images/favicon.svg') }}" type="image/svg+xml" />

	<link href="{{ asset('admin/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
	<link href="{{ asset('admin/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
	
	<!-- Style css -->
	@include('backend.partials.css')	
	@yield('css')
</head>
<body>
	<div id="app">
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('backend.layouts.nav-header')
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		@include('backend.layouts.chatbox')
		<!--**********************************
            Chat box End
        ***********************************-->
		
		<!--**********************************
            Header start
        ***********************************-->
        @include('backend.layouts.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('backend.layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        @yield('content')

        <!--**********************************
            Content body end
        ***********************************-->
		
		
		
        <!--**********************************
            Footer start
        ***********************************-->
        @include('backend.layouts.footer')
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
	 @include('backend.modal.index')
	

    <!--**********************************
        Scripts
    ***********************************-->
    @include('backend.partials.script')
    @yield('js')
	    <script>
			function JobickCarousel()
				{
					jQuery('.front-view-slider').owlCarousel({
						loop:false,
						margin:30,
						nav:true,
						autoplaySpeed: 1000,
						navSpeed: 1000,
						autoWidth:true,
						paginationSpeed: 1000,
						slideSpeed: 1000,
						smartSpeed: 1000,
						autoplay: false,
						animateOut: 'fadeOut',
						dots:true,
						navText: ['', ''],
						responsive:{
							0:{
								items:1
							},
							
							480:{
								items:1
							},			
							
							767:{
								items:3
							},
							1750:{
								items:3
							}
						}
					})
				}

				jQuery(window).on('load',function(){
					setTimeout(function(){
						JobickCarousel();
					}, 1000); 
				});
		</script>
	</div>
	</body>
</html>