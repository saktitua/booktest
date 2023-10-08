@extends('layouts.administrator',[
    'title'=>'Report'
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
                        <a href="#" class="btn btn-primary-custom btn-icon-sm">
                            <i class="la la-refresh"></i>
                            Refresh
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
                        <th style="color:white">Cabang</th>
                        <th style="color:white">Jenis Layanan</th>
                        <th style="color:white">Nama Petugas</th>
                        <th style="color:white">Nama Nasabah</th>
                        <th style="color:white">Bagaimana penampilan petugas yang melayani</th>
                        <th style="color:white">Bagaimana kecepatan petugas yang melayani</th>
                        <th style="color:white">Bagaimana kepuasan nasabah terhadap pelayanan kami </th>
                        <th style="color:white">Bagaimana kualitas penyambutan oleh security cabang kami</th>    
                        <th style="color:white">Bagaimana keramahan petugas yang melayani</th>
                        <th style="color:white">Bagaimana pengetahuan petugas yang melayani</th>
                        <th style="color:white">Bagaimana ruang banking hall</th>
                        <th style="color:white">Kritik dan Saran</th>
                        <th style="color:white">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="13"></td>
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
                url:'{!! route('admin.report.ajax') !!}'
            },
            columns:[
                {
                    data:"nama_cabang",
                    name:"nama_cabang",
                },
                {
                    data:"jenis_layanan",
                    name:"jenis_layanan",
                },
                {
                    data:"nama_petugas",
                    name:"nama_petugas",
                },
                {
                    data:"nama_nasabah",
                    name:"nama_nasabah",
                },
                {
                    data:"ques1",
                    name:"ques1",
                },
                {
                    data:"ques2",
                    name:"ques2",
                },
                {
                    data:"ques3",
                    name:"ques3",
                },
                {
                    data:"ques4",
                    name:"ques4",
                },
                {
                    data:"ques5",
                    name:"ques5",
                },
                {
                    data:"ques6",
                    name:"ques6",
                },
                {
                    data:"ques7",
                    name:"ques7",
                },
                {
                    data:"reason",
                    name:"reason",
                },
                {
                    data:"created_at",
                    name:"created_at",
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
    });
    
</script>
@endpush