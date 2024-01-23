@extends('layouts.login',[

])
@section('content')
<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
    <!--begin::Head-->
    <div class="kt-login__head">
        <div class="kt-login__logo">
            <a href="#">
                <img src="{{asset('logo/agilogo.png')}}" width="15%">
            </a>
        </div>
    </div>
    <!--end::Head-->

    <!--begin::Body-->
    <div class="kt-login__body">
        <!--begin::Signin-->
        <div class="kt-login__form">
            <div class="kt-login__title">
                <h3>&nbsp;</h3>
            </div>
            <!--begin::Form-->
            <form class="kt-form" action="" novalidate="novalidate" id="kt_login_form">
                <div class="form-group">
                    <input class="form-control" type="email" placeholder="username" name="email" id="email" autocomplete="off">
                </div>
				<div class="form-group ">
					<div class="kt-input-icon kt-input-icon--right">
						<input type="password" class="form-control" name="password" placeholder="password" id="password">
						<span class="kt-input-icon__icon kt-input-icon__icon--right">
							<span><i class="fa fa-eye btn-open-eye"></i></span>
							<span><i class="fa fa-eye fa-eye-slash btn-close-eye d-none"></i></span>
						</span>
					</div>
				</div>
                <!--begin::Action-->
                <div class="row kt-login__extra mt-5">
                    <div class="col kt-align-right">
                        <a href="javascript:;" data-href="{{route('notif.modal')}}" id="kt_login_forgot" class="kt-link kt-login__link btn-forgot">Forget Password ?</a>
                    </div>
                </div>
                <div class="kt-login__actions">
                    <button id="kt_login_signin_submit" class="btn-block btn btn-primary btn-elevate kt-login__btn-primary">Masuk</button>
                </div>
                <!--end::Action-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signin-->
    </div>
    <!--end::Body-->
</div>
@include('layouts.modal')
@endsection
@push('script')
<script>
// Class Definition
var KTLoginV1 = function () {
	
	var login = $('#kt_login');
	var showErrorMsg = function(form, type, msg) {
        var alert = $('<div class="alert alert-bold alert-solid-' + type + ' alert-dismissible" role="alert">\
			<div class="alert-text">'+msg+'</div>\
			<div class="alert-close">\
                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
            </div>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        KTUtil.animateClass(alert[0], 'fadeIn animated');
    }
	// Private Functions
	var handleSignInFormSubmit = function () {
		$('#kt_login_signin_submit').click(function (e) {
			e.preventDefault();
			let emails = $("[name='email']").val();
			var btn = $(this);
			var form = $('#kt_login_form');
			form.validate({
				rules: {
					email: {
						required: true
					},
					password: {
						required: true
					}
				}
			});
			if (!form.valid()) {
				return;
			}
			KTApp.progress(btn[0]);

			setTimeout(function () {
				KTApp.unprogress(btn[0]);
			}, 2000);
			// ajax form submit:  http://jquery.malsup.com/form/
			// console.log(emails)
			$.get("check/login/"+emails, function(data, status){
				console.log(data.success,data);
				if(data.success == null){
					swal.fire({
						position:"text-center",
						type:"error",
						title:'username dan password tidak cocok',
						showConfirmButton:false,
						timer:15000,
					});
					return false
				}
				if(data.success == false){
					swal.fire({
						position:"text-center",
						type:"error",
						title:'Akun Anda Tidak akitf. Silahkan hubungi admin',
						showConfirmButton:false,
						timer:15000,
					});
					return false
				}

				form.ajaxSubmit({
					headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					method:'POST',
					url: "{{ route('admin.login') }}",
					success: function (response, status, xhr, $form) {
						setTimeout(function () {
							swal.fire({
								position:"text-center",
								type:"success",
								title:'sukses login',
								showConfirmButton:false,
								timer:15000,
							});
							location.reload();
						}, 2000);
					},
					error:function(e){
						swal.fire({
							position:"text-center",
							type:"error",
							title:'username dan password tidak cocok',
							showConfirmButton:false,
							timer:15000,
						});
					}
				});
				
	
			});	
		});
	}
	// Public Functions
	return {
		// public functions
		init: function () {
			handleSignInFormSubmit();
		}
	};
}();
// Class Initialization
jQuery(document).ready(function () {
	KTLoginV1.init();
});

$(document).on('click','.btn-open-eye',function(e){
	e.preventDefault();
	$('#password').get(0).type = 'text';
	$(this).addClass('d-none');
	$('.btn-close-eye').removeClass('d-none');
});

$(document).on('click','.btn-close-eye',function(e){
	e.preventDefault();
	$('#password').get(0).type = 'password';
	$(this).addClass('d-none');
	$('.btn-open-eye').removeClass('d-none');
});

$(document).on('click','.btn-forgot',function(e){
	e.preventDefault();
	const href= $(this).attr('data-href');
	$.ajax({
		url: href,
		success: function(result){
			$('#kt_modal_1').modal('show');
			$('#modalContent').html(result).show();
			$('.modal-dialog').addClass('modal-lg');
		}
	});
});
</script>
@endpush