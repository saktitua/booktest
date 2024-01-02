<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Hapus Pertanyaan</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('question.destroy',$questions->id)}}" id="create-form" method="POST">
        @csrf
        @method("DELETE")
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Apakah Anda ingin menghapus Pertanyaan {{$questions->question}} ?</label>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
    <button type="submit" form="create-form" class="btn btn-primary-custom">Delete</button>    
</div>