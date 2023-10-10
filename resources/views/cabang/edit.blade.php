<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('cabang.update',$cabang->id)}}" id="create-form" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form">
                    <label>Nama Cabang</label>
                    <input type="text" required class="form-control" autocomplete="off" value="{{$cabang->kode_cabang}}" name="kode_cabang" placeholder="Silahkan masukkan kode cabang">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form">
                    <label>Nama Cabang</label>
                    <input type="text" required class="form-control" autocomplete="off" value="{{$cabang->nama_cabang}}" name="nama_cabang" placeholder="Silahkan masukkan nama cabang">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form">
                    <label>Nama Cabang</label>
                    <textarea  required class="form-control" autocomplete="off" name="alamat" placeholder="Silahkan masukkan alamat">{!!$cabang->nama_cabang!!}</textarea>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
    <button type="submit" form="create-form" class="btn btn-primary-custom">Simpan</button>    
</div>