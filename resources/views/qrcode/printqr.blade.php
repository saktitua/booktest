<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Qr Code : <span style="color:blue;">{{$pengguna->name }} - {{$pengguna->role}}<span></h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
        <div class="row">
            <div class="col-lg-12 text-center">
               @if($pengguna->generate !== null)
                {!! QrCode::size(300)->generate(env('DEV_URL').$pengguna->generate) !!}
                @else 
                    {{"Tidak ada barcode"}}
                @endif
            </div>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
    <button type="button" form="create-form" class="btn btn-primary-custom">Cetak</button>    
</div>