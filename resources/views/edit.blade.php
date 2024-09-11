<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Books</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('dashboard.update',$edit->id)}}" id="update-form" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Name *</label>
                    <input type="text"  class="form-control" autocomplete="off" name="name" value="{{$edit->name}}" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label>Years * </label>
                    <input type="number"  class="form-control"  name="years" placeholder="years" value="{{$edit->years}}" required>
                </div>
                <div class="form-group">
                    <label>Slug *</label>
                    <input type="text"  class="form-control"  name="slug" placeholder="Slug" value="{{$edit->slug}}" required>
                </div>
                <div class="form-group">
                    <label>Author *</label>
                    <input type="text"  class="form-control"  name="author" placeholder="Author" value="{{$edit->author}}" required>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" form="update-form" class="btn btn-primary-custom">Update</button>    
</div>