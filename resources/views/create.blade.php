<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Create Book</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('dashboard.store')}}" id="create-form" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Name *</label>
                    <input type="text"  class="form-control" autocomplete="off" name="name" placeholder="Name" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Years * </label>
                    <input type="number"  class="form-control"  name="years" placeholder="years" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Slug *</label>
                    <input type="text"  class="form-control"  name="slug" placeholder="Slug" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
                <div class="form-group">
                    <label>Author *</label>
                    <input type="text"  class="form-control"  name="author" placeholder="Author" required>
                    <span class="form-text text-muted">silahkan di isi</span>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" form="create-form" class="btn btn-primary-custom">Create</button>    
</div>