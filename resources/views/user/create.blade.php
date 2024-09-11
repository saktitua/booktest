<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('pengguna.store')}}" id="create-form" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Nama *</label>
                    <input type="text"  class="form-control" autocomplete="off" name="name" placeholder="Nama User" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Username * </label>
                    <input type="text"  class="form-control"  name="username" placeholder="Username" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="text"  class="form-control"  name="email" placeholder="Email" onclick="this.value=''" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Role * </label>
                    <select name="role" class="form-control" id="role" required>
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
                    <label>Password *</label>
                    <input type="password"  class="form-control" autocomplete="off" name="password" placeholder="Password"  required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Nik *</label>
                    <input type="number"  class="form-control" autocomplete="off" name="nik" placeholder="Nik" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Phone Number * </label>
                    <input type="number"  class="form-control" autocomplete="off" name="phone_number" placeholder="Phone Number" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Cabang * </label>
                    <select name="cabang_id" class="form-control" id="cabang_id" required>
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