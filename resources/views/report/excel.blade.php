<style>
.f-bold{
    font-weight:bold;
    font-stretch: normal;
    text-align: center;
    
}
</style>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Cabang</th>
            <th>Kritik dan Saran</th>
            <th>Jenis Layanan</th>
            <th>Petugas</th>
            <th>Nasabah</th>
            @foreach($report['questions'] as $die)
                <th style="width:400px;">{{$die['question']}}</th>
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
                <td class="f-size-table-header td" style="text-align: center;width:320px;"> {{$key['point']}} </td>
            @endforeach  
        </tr>
        @endforeach
    </tbody>
</table>