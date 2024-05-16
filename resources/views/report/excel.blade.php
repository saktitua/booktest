<style>
.f-bold{
    font-weight:bold;
    font-stretch: normal;
    text-align: center;
    
}
</style>
@if(isset($cabang))
    <table class="inline-p">
        <tr>
            <td class="f-bold">Cabang</td><td>{{$cabang->nama_cabang}}</td>
        </tr>
        <tr>
            <td class="f-bold">Tanggal</td><td>{{date('d M Y',strtotime($from))}} s/d {{date('d M Y',strtotime($to))}} </td>
        </tr>
    </table>
    @else 
    <table class="inline-p">
        <tr>
            <td class="f-bold">Cabang</td><td style="text-align: left">{{"Semua Cabang"}}</td>
        </tr>
        <tr>
            <td class="f-bold">Tanggal</td><td >{{date('d M Y',strtotime($from))}} s/d {{date('d M Y',strtotime($to))}} </td>
        </tr>
    </table>
@endif
<table>
    <thead>
        <tr>
            <th class="f-bold">Tanggal</th>
            <th class="f-bold">Cabang</th>
            <th class="f-bold">Kritik dan Saran</th>
            <th class="f-bold">Jenis Layanan</th>
            <th class="f-bold">Petugas</th>
            <th class="f-bold">Nasabah</th>
            @foreach($report['question'] as $die)
                <th style="width:400px;">{{$die['question']}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($report['nasabah'] as $k => $p)
            @foreach($p as $s => $key)
            <tr>
                <td>{{date('d M Y',strtotime($key['tanggal']))}}</td>
                <td>{{$key['cabang']}}</td>
                <td>{{$key['kritik_saran']}}</td>
                <td>{{$key['jenis_layanan']}}</td>
                <td>{{$key['petugas']}}</td>
                <td>{{$key['nama']}}</td>
                @foreach($key['points'] as $po)
                    <td class="f-size-table-header td" style="text-align: center;width:320px;"> {{$po['point']}} </td>
                @endforeach   
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>