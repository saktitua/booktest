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
            <th>Bagaimana penampilan petugas yang melayani</th>
            <th>Bagaimana kecepatan petugas yang melayani</th>
            <th>Bagaimana kepuasan nasabah terhadap pelayanan kami </th>
            <th>Bagaimana kualitas penyambutan oleh security cabang kami</th>    
            <th>Bagaimana keramahan petugas yang melayani</th>
            <th>Bagaimana pengetahuan petugas yang melayani</th>
            <th>Bagaimana ruang banking hall</th>
            <th>Kritik dan Saran</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($temp as $key => $die)
        <tr>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$key + 1}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->nama_cabang!!}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->jenis_layanan!!}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->nama_petugas!!}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{!!$die->nama_nasabah!!}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$die->ques1}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$die->ques2}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$die->ques3}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$die->ques4}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$die->ques5}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$die->ques6}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$die->ques7}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{$die->reason}}</td>
            <td class="f-size-table" style="text-align: center;height:30px;">{{date('m/d/Y',strtotime($die->created_at)); }}</td>
        </tr>
        @endforeach
    </tbody>
</table>