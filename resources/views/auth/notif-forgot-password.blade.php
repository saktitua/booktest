<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Lupa Password ?</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('cabang.store')}}" id="create-form" method="POST">
        @csrf
        <div class="form-group">
           <div style="font-size:1.5rem;">Silahkan menghubungi admin untuk reset password akun anda !</div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
</div>