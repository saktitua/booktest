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
                <th style="width:400px;">{{$die->question}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($temp as $key => $die)
        @php 
            $point = App\Models\DetailReport::select('point')->whereBetween('report_detail.date',[date('Y-m-d',strtotime($from)),date('Y-m-d',strtotime($to))])->where('report_id',$die->id)->get();
        @endphp
        <tr>
            <td class="f-size-table" style="text-align: center;height:30px;">@if(date('m/d/Y',strtotime($die->created_at)) <1) {{date('m/d/Y',strtotime($die->created_at))}} @endif</td>
            <td class="f-size-table" style="text-align: left;width:40px;">{!!$die->nama_cabang!!}</td>
            <td class="f-size-table" style="text-align: left;width:40px;">{!!$die->reason!!}</td>
            <td class="f-size-table" style="text-align: left;width:40px;">{!!$die->jenis_layanan!!}</td>
            <td class="f-size-table" style="text-align: left;height:30px;">{!!$die->nama_petugas!!}</td>
            <td class="f-size-table" style="text-align: left;height:30px;">{!!$die->nama_nasabah!!}</td>
            @for ($i = 0; $i < count($question); $i++)
                @if(isset($point[$i])) 
                    <td style="width:400px;">{{$point[$i]->point}}</td>
                @else
                    <td style="width:400px;"></td>
                @endif
            @endfor
        </tr>
        @endforeach
    </tbody>
</table>