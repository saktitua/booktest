@extends('layouts.administrator',[
    'title'=>'Pengguna'
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
                    &nbsp;
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="javascript:;" class="btn btn-primary-custom btn-icon-sm btn-refresh">
                            <i class="la la-refresh"></i>
                            Refresh
                        </a>
                        &nbsp;
                        <a href="javascript:;" data-href="{{route('pengguna.create')}}" class="btn btn-add btn-primary-custom btn-icon-sm">
                            <i class="la la-plus"></i>
                           Tambah
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead style="background-color:#1e1e2d;color:white">
                    <tr>
                        <th style="color:white">Nama Pengguna</th>
                        <th style="color:white">Username</th>
                        <th style="color:white">Nik</th>
                        <th style="color:white">Cabang</th>
                        <th style="color:white">Jenis Layanan</th>
                        <th style="color:white">Created At</th>
                        <th style="color:white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
</div>
@include('layouts.modal')
@endsection
@push('script')
<script>
    $(function(){
        $("#kt_table_1").DataTable({
            processing:true,
            serverSide:true,
            searching:true,
            responsive:true,
            ajax:{
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
                },
                method:'POST',
                url:'{!! route('admin.pengguna.ajax') !!}'
            },
            columns:[
                {
                    data:"name",
                    name:"name",
                },
                {
                    data:"username",
                    name:"username",
                },
                {
                    data:"nik",
                    name:"nik",
                },
                {
                    data:"nama_cabang",
                    name:"nama_cabang",
                },
                {
                    data:"jenis_layanan",
                    name:"jenis_layanan",
                },
                {
                    data:"created_at",
                    name:"created_at",
                },
                {
                    data:"actions",
                    name:"actions",
                },
            ]
        });

        $(document).on('click','.btn-add',function(e){
            e.preventDefault();
            const href= $(this).attr('data-href');
            console.log(href);
            $.ajax({
                url: href,
                success: function(result){
                    $('#kt_modal_1').modal('show');
                    $('#modalContent').html(result).show();
                    $('.modal-dialog').addClass('modal-lg');
                }
            });
        });

        $(document).on('click','.btn-edit',function(e){
            e.preventDefault();
            const href= $(this).attr('data-href');
            console.log(href);
            $.ajax({
                url: href,
                success: function(result){
                    $('#kt_modal_1').modal('show');
                    $('#modalContent').html(result).show();
                    $('.modal-dialog').addClass('modal-lg');
                }
            });
        });

        $(document).on('click','.btn-refresh',function(e){
            e.preventDefault();
            $('#kt_table_1').DataTable().ajax.reload();
        });
    });
    
</script>
@endpush