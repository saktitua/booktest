<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Tambah Pertanyaan</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('question.store')}}" id="create-form" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Masukkan Pertanyaan</label>
                    <input type="text" required class="form-control" autocomplete="off" name="question" placeholder="Silahkan masukkan pertanyaan" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                {{-- <div class="form-group">
                    <label>Jenis jawaban</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="" selected>Pilih Type</option>
                        <option value="text">text</option>
                        <option value="radio">Radio</option>
                        <option value="textarea">Text Area</option>
                    </select>
                </div> --}}
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
    <button type="submit" form="create-form" class="btn btn-primary-custom">Simpan</button>    
</div>