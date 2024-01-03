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
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->nama_petugas!!}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->nama_nasabah!!}</td>
            @foreach($detailReport as $dies)
            <td class="f-size-table" style="text-align: left;width:40px;">{{$dies->point}}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>