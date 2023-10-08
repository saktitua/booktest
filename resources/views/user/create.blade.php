<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('pengguna.store')}}" id="create-form" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" required class="form-control" autocomplete="off" name="name" placeholder="Nama User">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" required class="form-control" autocomplete="off" name="username" placeholder="Username">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" required class="form-control" autocomplete="off" name="email" placeholder="Email">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" id="role">
                        <option value="" selected>Pilih Role</option>
                        @foreach($role as $idx)
                        <option value="{{$idx->name}}">{{$idx->name}}</option>
                        @endforeach
                    </select>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" required class="form-control" autocomplete="off" name="password" placeholder="Password">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Nik</label>
                    <input type="number" required class="form-control" autocomplete="off" name="nik" placeholder="Nik">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" required class="form-control" autocomplete="off" name="phone_number" placeholder="Phone Number">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Cabang</label>
                    <select name="cabang_id" class="form-control" id="role">
                        <option value="" selected>Pilih Cabang</option>
                        @foreach($cabang as $idx)
                        <option value="{{$idx->id}}">{{$idx->nama_cabang}}</option>
                        @endforeach
                    </select>
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