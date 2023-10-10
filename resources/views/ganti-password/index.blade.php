@extends('layouts.administrator',[
    'title'=>'Ganti Password Admin'
])
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    &nbsp;
                </span>
                <h3 class="kt-portlet__head-title">
                    Ganti Password Admin
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <form action="{{route('ganti-password-admin.update',Auth::user()->id)}}" id="update-password-form" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Passwrod Lama</label>
                            <input type="text" required class="form-control" autocomplete="off" name="password" placeholder="Silahkan masukkan password lama">
                            <span class="form-text text-muted">silahkan di isi</span>
                        </div>
                        <div class="form-group">
                            <label>Passwrod Baru</label>
                            <input type="text" required class="form-control" autocomplete="off" name="new_password" placeholder="Silahkan masukkan password Baru">
                            <span class="form-text text-muted">silahkan di isi</span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="text" class="form-control" autocomplete="off" name="confirm_password" placeholder="Confirm password Baru">
                            <span class="form-text text-muted">silahkan di isi</span>
                        </div>
                    </div>
                </div>
            </form>
            <!--end: Datatable -->
        </div>
        <div class="kt-portlet__footer mb-5 ml-4">
            <div class="form-group">
            <button type="submit" form="update-password-form" class="btn btn-primary-custom">Ganti Password</button>
            </div>
        </div>
    </div>
</div>
@endsection
