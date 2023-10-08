<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('roles.store')}}" id="create-form" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form">
                    <label>Kode</label>
                    <input type="text" required class="form-control" autocomplete="off" name="kode" placeholder="Silahkan masukkan kode">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form">
                    <label>Nama</label>
                    <input type="text" required class="form-control" autocomplete="off" name="nama" placeholder="Silahkan masukkan nama">
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