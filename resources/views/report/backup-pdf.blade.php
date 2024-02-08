<html>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
         .f-bold{
            font-weight:bold;
            font-stretch: normal;
            text-align: center;
            
        }
        .f-size{
            font-size: 11px;
        }
        .f-size-table-header{
            font-size: 7px;
        }
        .f-size-table{
            font-size: 7px;
        }
        .inline-p{
            bottom: 12px;
        }
        .table-list{
            border-left: 0.01em solid #ccc;
            border-right: 0;
            border-top: 0.01em solid #ccc;
            border-bottom: 0;
            border-collapse: collapse;
            table-layout:fixed;
        }
        .table-list .td,
        .table-list .th {
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
            table-layout:fixed;
        }

    </style>
     <div style="display:inline-block; ">
        
        <table class="inline-p table-list" style="margin-top:20px;width:100%">
            <thead>
                <tr>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:40px;">Tanggal</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:70px;">Cabang</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:70px;">Kritik & Saran</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:70px;">Jenis Layanan</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:70px;">Petugas</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:70px;">Nasabah</th>
                    @foreach($question as $key => $die)
                        <th class="f-size-table-header f-bold th" style="text-align: center;width:70px;">{{$die->question}} {{$key}}</th>
                    @endforeach
                    
                </tr>
            </thead>
            <tbody>
            @foreach($temp as $key => $die)
            @php 
            $point = App\Models\DetailReport::select('point')->where('report_id',$die->id)->get();
            @endphp
            <tr>
                <td class="f-size-table td" style="text-align: left;width:40px;">{{date('m/d/Y',strtotime($die->created_at)); }}</td>
                <td class="f-size-table td" style="text-align: left;width:40px;">{!!$die->nama_cabang!!}</td>
                <td class="f-size-table td" style="text-align: left;width:40px;">{!!$die->reason!!}</td>
                <td class="f-size-table td" style="text-align: left;width:40px;">{!!$die->jenis_layanan!!}</td>
                <td class="f-size-table td" style="text-align: left;width:40px;">{!!$die->nama_petugas!!}</td>
                <td class="f-size-table td" style="text-align: left;width:40px;">{!!$die->nama_nasabah!!}</td>
                    @for ($i = 0; $i < count($question); $i++)
                        @if(isset($point[$i])) 
                        <td class="f-size-table td" style="text-align: center;width:40px;">{{$point[$i]->point}}</td>
                        @else
                        <td class="f-size-table td" style="text-align: center;width:40px;"></td>
                        @endif
                    @endfor
                </tr>
      
            @endforeach
        </tbody>
        </table>
    </div>
</html>