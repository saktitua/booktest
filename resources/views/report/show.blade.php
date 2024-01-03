<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Report</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-3">
            <div class="form-group">
                <label for="">Cabang</label>
                <input type="text" class="form-control" disabled value="{{$temp->nama_cabang}}">
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">
                <label for="">Nama Petugas</label>
                <input type="text" class="form-control" disabled value="{{$temp->nama_petugas}}">
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">
                <label for="">Nama Nasabah</label>
                <input type="text" class="form-control" disabled value="{{$temp->nama_nasabah}}">
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="text" class="form-control" disabled value="{{date("m/d/Y",strtotime($temp->created_at))}}">
            </div>
        </div>
    </div>
    <table class="table" id="table_detail">
        <thead>
            <tr>
                <th>Pertanyaan</th>
                <th>Point</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $total = 0;
            @endphp
            @foreach($detailreport as $key =>$die)
            <tr>
                <td>{{$die->question}}</td>
                <td>{{$die->point}}</td>
            </tr>
           @php 
            $total += $die->point;
           @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th>{{$total}}</th>
            </tr>
        </tfoot>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>    
</div>