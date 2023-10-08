<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>Microsite | Dashboard</title>
		<meta name="description" content="Updates and statistics">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf_token" content="{{ csrf_token() }}">
        @include('layouts.css')
		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico')}}" />
	</head>
	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		
        <!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		@include('layouts.partial.header-mobile')
		<!-- end:: Header Mobile -->
		
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
                @include('layouts.partial.aside')
				<!-- end:: Aside -->

				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
                    @include('layouts.partial.header')
					<!-- end:: Header -->
					
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                        
						<!-- begin:: Content Head -->
						@include('layouts.partial.head-content')
						<!-- end:: Content Head -->

						<!-- begin:: Content -->
                        @yield('content')
						<!-- end:: Content -->
					</div>

					<!-- begin:: Footer -->
                    @include('layouts.partial.footer')
					<!-- end:: Footer -->
				</div>
			</div>
		</div>
		<!-- end:: Page -->

    	<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
		<!-- end::Scrolltop -->
        
        @include('layouts.js')

		@if(\Session::has('success'))
			<div class="alert-text-success">{{\Session::get('success')}}</div>
			<script>
				var alertSuccess = $('.alert-text-success').html();
				swal.fire({
					position:"top-right",
					type:"success",
					title:alertSuccess,
					showConfirmButton:false,
					timer:15000,
				});
			</script>
		@endif
		@if(\Session::has('danger'))
			<div class="alert-text-danger">{{\Session::get('danger')}}</div>
			<script>
				var alertDanger = $('.alert-text-danger').html();
				swal.fire({
					position:"top-right",
					type:"error",
					title:alertDanger,
					showConfirmButton:false,
					timer:15000,
				});
			</script>
		@endif
		@if(\Session::has('warning'))
			<div class="alert-text-warning">{{\Session::get('warning')}}</div>
			<script>
				var alertWarning = $('.alert-text-warning').html();
				swal.fire({
					position:"top-right",
					type:"warning",
					title:alertWarning,
					showConfirmButton:false,
					timer:15000,
				});
			</script>
		@endif
		
		@stack('script')
	</body>
	<!-- end::Body -->
</html>