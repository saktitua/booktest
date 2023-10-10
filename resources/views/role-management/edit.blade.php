<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Akses Role Management</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('roles-management.update',$roles->id)}}" id="create-form" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Akses role</label>
                    <input type="text" required class="form-control" value="{{$roles->name}}" disabled autocomplete="off" name="kode" placeholder="Silahkan masukkan kode">
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Fitur</label>
                    <div class="kt-checkbox-list">
                        <label class="kt-checkbox">
                            <input type="checkbox" class="checkall"> Check All
                            <span></span>
                        </label>
                        @foreach($permission as $die)
                            @php 
                              $rolehaspermission = DB::table('role_has_permissions')->where('permission_id',$die->id)->where('role_id',$roles->id)->first();
                            @endphp
                            @if($die->name == 'Menu Admin')
                            <label class="kt-checkbox">
                                <input type="checkbox" value="{{$die->name}}" @if(isset($rolehaspermission->permission_id)) {{"checked"}} @endif name="checkboxArray[]"> {{$die->name}}
                                <span></span>
                            </label>
                            @endif
                            <div class="kt-checkbox-list ml-5 mt-3">
                                @if($die->name === 'Role Maintenance' || $die->name ==='Role Management' || $die->name ==='Cabang' || $die->name ==='Create User' || $die->name ==='Create User Approval' || $die->name ==='Print Report'  || $die->name ==='Ganti Password Admin'  || $die->name ==='Audit Trails')
                                <label class="kt-checkbox">
                                    <input type="checkbox" value="{{$die->name}}" @if(isset($rolehaspermission->permission_id)) {{"checked"}} @endif name="checkboxArray[]"> {{$die->name}}
                                    <span></span>
                                </label>
                                @endif
                            </div>
                            @if($die->name == 'Menu User')
                            <label class="kt-checkbox">
                                <input type="checkbox"  value="{{$die->name}}" @if(isset($rolehaspermission->permission_id)) {{"checked"}} @endif  name="checkboxArray[]"> {{$die->name}}
                                <span></span>
                            </label>
                            @endif
                            <div class="kt-checkbox-list ml-5 mt-3">
                                @if($die->name === 'Edit Action' || $die->name ==='Print QR' || $die->name ==='Ganti Password User')
                                <label class="kt-checkbox">
                                    <input type="checkbox" value="{{$die->name}}" @if(isset($rolehaspermission->permission_id)) {{"checked"}} @endif  name="checkboxArray[]"> {{$die->name}}
                                    <span></span>
                                </label>
                                @endif
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
    <button type="submit" form="create-form" class="btn btn-primary-custom">Simpan</button>    
</div>