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
        @if(isset($cabang))
        <table class="inline-p">
            <tr>
                <td class="f-size-table">Cabang</td><td class="f-size-table  th">:</td><td class="f-size-table  f-bold" style="text-align: left">{{$cabang->nama_cabang}}</td>
            </tr>
            <tr>
                <td class="f-size-table">Tanggal</td><td class="f-size-table  th">:</td><td class="f-size-table">{{date('d M Y',strtotime($from))}} s/d {{date('d M Y',strtotime($to))}} </td>
            </tr>
        </table>
        @else 
        <table class="inline-p">
            <tr>
                <td class="f-size-table">Cabang</td><td class="f-size-table  th">:</td><td class="f-size-table  f-bold" style="text-align: left">{{"Semua Cabang"}}</td>
            </tr>
            <tr>
                <td class="f-size-table">Tanggal</td><td class="f-size-table  th">:</td><td class="f-size-table">{{date('d M Y',strtotime($from))}} s/d {{date('d M Y',strtotime($to))}} </td>
            </tr>
        </table>
        @endif
        <table class="inline-p table-list" style="margin-top:20px;width:100%">
            <thead>
                <tr>
                    <th class="f-size-table-header f-bold th" style="text-align: left;width:50px;">Tanggal</th>
                    <th class="f-size-table-header f-bold th" style="text-align: left;width:100px;">Cabang</th>
                    <th class="f-size-table-header f-bold th" style="text-align: left;width:80px;">Kritik & Saran</th>
                    <th class="f-size-table-header f-bold th" style="text-align: left;width:80px;">Jenis Layanan</th>
                    <th class="f-size-table-header f-bold th" style="text-align: left;width:80px;">Petugas</th>
                    <th class="f-size-table-header f-bold th" style="text-align: left;width:80px;">Nasabah</th>
                    @foreach($report['question'] as $key => $die)
                        <th class="f-size-table-header f-bold th" style="text-align: center;width:120px;">{{$die['question']}}</th>
                    @endforeach                 
                </tr>
            </thead>
            <tbody>   
                @foreach($report['nasabah'] as $k => $p)
                    @foreach($p as $s => $key)
                    <tr>
                        <td class="f-size-table td" style="text-align: left;width:10px;">{{date('d M Y',strtotime($key['tanggal']))}}</td>
                        <td class="f-size-table td" style="text-align: left;width:10px;">{{$key['cabang']}}</td>
                        <td class="f-size-table td" style="text-align: left;width:10px;">{{$key['kritik_saran']}}</td>
                        <td class="f-size-table td" style="text-align: left;width:10px;">{{$key['jenis_layanan']}}</td>
                        <td class="f-size-table td" style="text-align: left;width:10px;">{{$key['petugas']}}</td>
                        <td class="f-size-table td" style="text-align: left;width:10px;">{{$key['nama']}}</td>
                        @foreach($key['points'] as $po)
                            <td class="f-size-table-header td" style="text-align: center;width:120px;"> {{$po['point']}} </td>
                        @endforeach   
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</html>