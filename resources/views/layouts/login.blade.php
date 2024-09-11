<!DOCTYPE html>
<html lang="en">
    <!-- begin::Head -->
    <head>
        <base href="../../../">
        <meta charset="utf-8" />
        <title>PT Mark Plus  | Login </title>
        <meta name="description" content="Microsite, Microsite login">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('layouts.css')
    </head>
    <!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

					<!--begin::Aside-->
					<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(/logo/sidebarcode.jpg);">
						<div class="kt-grid__item">
							
						</div>
						<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
							<div class="kt-grid__item kt-grid__item--middle">
								<h3 class="kt-login__title">&nbsp;</h3>
								<h4 class="kt-login__subtitle">&nbsp;</h4>
							</div>
						</div>
						<div class="kt-grid__item">
							<div class="kt-login__info">
								<div class="kt-login__copyright">
									&copy 2024 Markplus
								</div>
							</div>
						</div>
					</div>
					<!--begin::Aside-->

					<!--begin::Content-->
                    @yield('content')
					<!--end::Content-->
				</div>
			</div>
		</div>
		<!-- end:: Page -->
        @include('layouts.js')
        @stack('script')
	</body>
	<!-- end::Body -->
</html>
