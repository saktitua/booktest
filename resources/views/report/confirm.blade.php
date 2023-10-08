<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('approval.update',$pengguna->id)}}" id="create-form" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" required class="form-control" autocomplete="off" value="{{$pengguna->name}}" disabled>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Nik</label>
                    <input type="text" required class="form-control" autocomplete="off" value="{{$pengguna->nik}}"  disabled>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" required class="form-control" autocomplete="off" value="{{$pengguna->email}}" disabled>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" required class="form-control" autocomplete="off" value="{{$pengguna->username}}" disabled>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Nomor Hp</label>
                    <input type="text" required class="form-control" autocomplete="off" value="{{$pengguna->phone_number}}" disabled>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="role">
                        <option value="Aktif">{{"Aktif"}}</option>
                        <option value="Tidak Aktif">{{"Tidak Aktif"}}</option>
                    </select>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="submit" form="create-form" name="submit" value="Rejected" class="btn btn-secondary" >Reject</button>
    <button type="submit" form="create-form" name="submit" value="Approved" class="btn btn-primary-custom">Accept</button>    
</div>