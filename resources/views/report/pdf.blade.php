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
            font-size: 0.5rem;
        }
        .f-size-table{
            font-size: 0.5rem;
        }
        .inline-p{
            bottom: 12px;
        }
        table, th, td, tr {
            border: 0.005em solid black;
          
        }
        th{
            background-color: aliceblue;
        }

    </style>
     <div style="display:inline-block; ">
        
        <table class="inline-p" style="margin-top:20px;width:100%">
            <thead>
                <tr>
                    <th class="f-size-table-header f-bold" style="text-align: center;height:30px; width:37px;">No</th>
                    <th class="f-size-table-header f-bold" style="text-align: center;height:30px; width:37px;">Cabang</th>
                    <th class="f-size-table-header f-bold" style="text-align: center;height:30px; width:37px;">Jenis Layanan</th>
                    <th class="f-size-table-header f-bold" style="text-align: center;height:30px; width:37px;">Nama Petugas</th>
                    <th class="f-size-table-header f-bold" style="text-align: center;height:30px; width:37px;">Nama Nasabah</th>
                    <th class="f-size-table-header f-bold" style="text-align: center;height:30px; width:37px;">Kritik dan Saran</th>
                    <th class="f-size-table-header f-bold" style="text-align: center;height:30px; width:37px;">Tanggal</th>
                    <th class="f-size-table-header f-bold" style="text-align: center;height:30px; width:37px;">Total Point Dari Semua Pertanyaan</th>
                </tr>
            </thead>
            <tbody>
            @foreach($temp as $key => $die)
            @php 
            $totalpoint = App\Models\DetailReport::where('report_id',$die->id)->sum('point');
            @endphp
            <tr>
                <td class="f-size-table" style="text-align: center;height:30px;">{{$key + 1}}</td>
                <td class="f-size-table" style="text-align: left;height:30px;">{!!$die->nama_cabang!!}</td>
                <td class="f-size-table" style="text-align: left;height:30px;">{!!$die->jenis_layanan!!}</td>
                <td class="f-size-table" style="text-align: left;height:30px;">{!!$die->nama_petugas!!}</td>
                <td class="f-size-table" style="text-align: left;height:30px;">{!!$die->nama_nasabah!!}</td>
                <td class="f-size-table" style="text-align: left;height:30px;">{!!$die->reason!!}</td>
                <td class="f-size-table" style="text-align: center;height:30px;">{{date('m/d/Y',strtotime($die->created_at)); }}</td>
                <td class="f-size-table" style="text-align: center;height:30px;">{{$totalpoint }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</html>