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
            <th>No</th>
            <th>Cabang</th>
            <th>Jenis Layanan</th>
            <th>Nama Petugas</th>
            <th>Nama Nasabah</th>
            <th>Kritik dan Saran</th>
            <th>Tanggal</th>
            <th>Total Point Dari Semua Pertanyaan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($temp as $key => $die)
        @php 
        $totalpoint = App\Models\DetailReport::where('report_id',$die->id)->sum('point');
        @endphp
        <tr>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$key + 1}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->nama_cabang!!}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->jenis_layanan!!}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->nama_petugas!!}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->nama_nasabah!!}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$die->reason}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{date('m/d/Y',strtotime($die->created_at)); }}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$totalpoint }}</td>
        </tr>
        @endforeach
    </tbody>
</table>