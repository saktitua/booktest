<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
    <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{route('dashboard.destroy',$show->id)}}" id="destroy-form" method="POST">
        @csrf
        @method('DELETE')
        <span>Are you sure delete this book <span style="color:navy;">{{$show->name}} </span> ?</span>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    <button type="submit" form="destroy-form" class="btn btn-primary-custom">Delete</button>    
</div>