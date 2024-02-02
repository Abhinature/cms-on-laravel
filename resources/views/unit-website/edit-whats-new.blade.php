
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update What New</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" enctype="multipart/form-data" action="' . route('update-what-new') . '">
        
        <div class="modal-body">

            <div class="form-group">
            <label>Date</label>
            @csrf
            <input type="hidden" name="new_hid" value="{{Crypt::encrypt($dataaa->id)}}"/>
            <input type="date" value="{{$dataaa->news_date ?? ''}}" class="form-control" name="title" />
            </div>
            <div class="form-group">
            <label>File</label>
            <input type="file" class="form-control" name="news_file" />
            <input type="hidden"  value="{{$dataaa->news_file ?? ''}}" name="update_image"/>
            </div>
            
            <div class="form-group">
            <label>English Description</label>
            <textarea class="form-control" name="en_descriptionWhtsnew"> {{$dataaa->en_description ?? ''}}</textarea>
            
        </div>

        <div class="form-group">
        <label>Hindi Description</label>
        <textarea class="form-control" name="hi_descriptionWhtsnew">{{$dataaa->hi_description ?? ''}}</textarea>
        
        </div>
                            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>

@push('script')
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> 
<script> 
CKEDITOR.replace="en_descriptionWhtsnew";
</script>
@endpush