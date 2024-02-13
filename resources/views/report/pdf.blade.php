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
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:80px;">Tanggal</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:80px;">Cabang</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:80px;">Kritik & Saran</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:80px;">Jenis Layanan</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:80px;">Petugas</th>
                    <th class="f-size-table-header f-bold th" style="text-align: center;width:80px;">Nasabah</th>
                    @foreach($report['questions'] as $key => $die)
                        <th class="f-size-table-header f-bold th" style="text-align: center;width:120px;">{{$die['question']}}</th>
                    @endforeach                 
                </tr>
            </thead>
            <tbody>
                @foreach($report['nasabah'] as $key => $k)
                    <tr>
                        
                        <td class="f-size-table td" style="text-align: center;width:40px;">{!!$k['date']!!}</td>
                        <td class="f-size-table td" style="text-align: center;width:40px;">{!!$k['nama_cabang']!!}</td>
                        <td class="f-size-table td" style="text-align: center;width:40px;">{!!$k['kritik_saran']!!}</td>
                        <td class="f-size-table td" style="text-align: center;width:40px;">{!!$k['jenis_layanan']!!}</td>
                        <td class="f-size-table td" style="text-align: center;width:40px;">{!!$k['petugas']!!}</td>
                        <td class="f-size-table td" style="text-align: center;width:40px;">{!!$k['nama']!!}</td>
                        @foreach($k['point'] as $key)
                            <td class="f-size-table-header td" style="text-align: center;width:120px;"> {{$key['point']}} </td>
                        @endforeach   
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</html>