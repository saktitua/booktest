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
                <form action="{{route('admin.report.export')}}" id="form-report" class="form-report" method="POST">
                    @csrf
                    <input type="hidden" id="from_date" name="from_date">
                    <input type="hidden" id="to_date"   name="to_date">
                    <input type="hidden" id="cabang_id" name="cabang_id">
                </form>
                  
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button type="submit" value="pdf" name="submit" form="form-report" formtarget="_blank" class="btn btn-primary-custom btn-icon-sm btn-pdf">
                            <i class="la la-file-pdf-o"></i>
                            PDF
                        </button>
                        &nbsp;
                        <button type="submit" value="excel" name="submit" form="form-report" formtarget="_blank" class="btn btn-add btn-primary-custom btn-icon-sm btn-excel">
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
                    <div class="form-group">
                        <label>Filter Date:</label>
                        <div class="input-daterange input-group" id="kt_datepicker">
                            <input type="text" class="form-control kt-input" id="start" name="start" placeholder="From" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                            </div>
                            <input type="text" class="form-control kt-input" id="end" name="end" placeholder="To" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Semua Cabang * </label>
                        <select name="cabang_id" class="form-control select2" id="cabang_id" required>
                            <option value="" selected>Semua Cabang</option>
                            @foreach($cabang as $idx)
                            <option value="{{$idx->id}}">{{$idx->nama_cabang}}</option>
                            @endforeach
                        </select>
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
                        <th style="color:white">Kritik Dan Saran</th>
                        <th style="color:white">Tanggal</th>
                        <th style="color:white">Detail Report</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6"></td>
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
    $('.select2').select2();
    $(function(){
        let from;
        let to;
        let cabang_id;
        $(document).on('click','.btn-filter',function(e){
            from = $('#start').val();
            to   = $('#end').val();
            cabang_id = $('select[name="cabang_id"]').val();

            $('input[name="from_date"]').val(from);
            $('input[name="to_date"]').val(to);
            $('input[name="cabang_id"]').val(cabang_id);
  
            
            if(from != null && to != null){
                $('#kt_table_1').DataTable().clear();
                $('#kt_table_1').DataTable().destroy();
                reportFunction(from,to,cabang_id);
            }   
        });

        // $(document).on('click','.btn-pdf',function(e){  
        //     if(cabang_id == ''){
        //         e.preventDefault();
        //         alert('pilih cabang kemudian klik terapkan lalu klik tombol export ke document pdf atau excel!');
        //     }
          
        // });

        // $(document).on('click','.btn-excel',function(e){  
        //     if(cabang_id == ''){
        //         e.preventDefault();
        //         alert('pilih cabang kemudian klik terapkan lalu klik tombol export ke document pdf atau excel!');
        //     }
          
        // });

        reportFunction(from,to,cabang_id)
        function reportFunction(from,to,cabang_id){
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
                        cabang_id:cabang_id,
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
                        data:"reason",
                        name:"reason",
                    },
                    {
                        data:"created_at",
                        name:"created_at",
                    },
                    {
                        data:"total_point",
                        name:"total_point",
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

        $(document).on('click','.btn-report-detail',function(e){
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