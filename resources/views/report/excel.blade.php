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
            @foreach($question as $die)
            <th>{{$die->question}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($temp as $key => $die)
        @php 
        $detailReport = App\Models\DetailReport::join('question','report_detail.question','=','question.question')->where('report_id',$die->id)->get();
        @endphp
        <tr>
            <td class="f-size-table" style="text-align: center;height:30px;">@if(date('m/d/Y',strtotime($die->created_at)) <1) {{date('m/d/Y',strtotime($die->created_at))}} @endif</td>
            <td class="f-size-table" style="text-align: left;width:40px;">{!!$die->nama_cabang!!}</td>
            <td class="f-size-table" style="text-align: left;width:40px;">{!!$die->reason!!}</td>
            <td class="f-size-table" style="text-align: left;width:40px;">{!!$die->jenis_layanan!!}</td>
            <td class="f-size-table" style="text-align: left;height:30px;">{!!$die->nama_petugas!!}</td>
            <td class="f-size-table" style="text-align: left;height:30px;">{!!$die->nama_nasabah!!}</td>
            @foreach($detailReport as $dies)
            <td class="f-size-table" style="text-align: right;width:40px;">{{$dies->point}}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>