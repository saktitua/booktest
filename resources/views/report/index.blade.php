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
                <form action="{{route('admin.report.export')}}" id="form-report" method="POST">
                    @csrf
                    <input type="hidden" id="from_date" name="from_date">
                    <input type="hidden" id="to_date"   name="to_date">
                </form>
                  
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button type="submit" value="pdf" name="submit" form="form-report" formtarget="_blank" class="btn btn-primary-custom btn-icon-sm">
                            <i class="la la-file-pdf-o"></i>
                            PDF
                        </button>
                        &nbsp;
                        <button type="submit" value="excel" name="submit" form="form-report" formtarget="_blank" class="btn btn-add btn-primary-custom btn-icon-sm">
                            <i class="la la-file-excel-o"></i>
                           EXCEL
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row kt-margin-b-20">
                <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                    <label>Filter Date:</label>
                    <div class="input-daterange input-group" id="kt_datepicker">
                        <input type="text" class="form-control kt-input" id="start" name="start" placeholder="From" />
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                        </div>
                        <input type="text" class="form-control kt-input" id="end" name="end" placeholder="To" />
                    </div>
                </div> 
            </div>
            <div class="kt-separator kt-separator--md kt-separator--dashed"></div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <a href="javascript:;" class="btn btn-filter btn-primary-custom btn-icon-sm">
                        <i class="la la-search"></i>
                        Terapkan
                    </a>
                    &nbsp;
                    <a href="javascript:;" class="btn btn-refresh btn-primary-custom btn-icon-sm">
                        <i class="la la-refresh"></i>
                        Refresh
                    </a>
                </div>
            </div>
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable " id="kt_table_1">
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
        let from;
        let to;
        $(document).on('click','.btn-filter',function(e){
            from = $('#start').val();
            to   = $('#end').val();
            $('input[name="from_date"]').val(from);
            $('input[name="to_date"]').val(to);

            if(from != null && to != null){
                $('#kt_table_1').DataTable().clear();
                $('#kt_table_1').DataTable().destroy();
                reportFunction(from,to);
            }   
        });
        reportFunction(from,to)
        function reportFunction(from,to){
            $("#kt_table_1").DataTable({
                processing:true,
                serverSide:true,
                searching:true,
                responsive:true,
                ajax:{
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
                    },
                    data:{
                        from:from,
                        to:to,
                    },
                    method:'POST',
                    url:'{!! route('admin.report.ajax') !!}',  
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
        }
        $(document).on('click','.btn-refresh',function(e){
            e.preventDefault();
            $('#kt_table_1').DataTable().clear();
            $('#kt_table_1').DataTable().destroy();
            $('input[name="from"]').val('');
            $('input[name="to"]').val('');
            $('input[name="start"]').val('');
            $('input[name="end"]').val('');
        });
    });
    
</script>
@endpush