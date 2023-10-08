<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('pengguna.update',$pengguna->id)}}" id="create-form" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" required class="form-control" autocomplete="off" value="{{$pengguna->name}}" name="name" placeholder="Nama User">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" required class="form-control" autocomplete="off" value="{{$pengguna->username}}" name="username" placeholder="Username">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" required class="form-control" autocomplete="off" value="{{$pengguna->email}}" name="email" placeholder="Email">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" id="role">
                        @foreach($role as $idx)
                        <option value="{{$idx->name}}" @if($pengguna->role  == $idx->name) {{"selected"}} @endif>{{$idx->name}}</option>
                        @endforeach
                    </select>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Password">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Nik</label>
                    <input type="number" required class="form-control" autocomplete="off" name="nik" value="{{$pengguna->nik}}" placeholder="Nik">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" required class="form-control" autocomplete="off" name="phone_number" value="{{$pengguna->phone_number}}" placeholder="Phone Number">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Cabang</label>
                    <select name="cabang_id" class="form-control" id="role">
                        @foreach($cabang as $idx)
                        <option value="{{$idx->id}}" @if($pengguna->cabang_id  == $idx->id) {{"selected"}} @endif>{{$idx->nama_cabang}}</option>
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