
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Award</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" enctype="multipart/form-data" action="' . route('update-award') . '">
        
        <div class="modal-body">

            <div class="form-group">
            <label>Title</label>
            <input type="hidden" name="_token" value="' . csrf_token() . '" />
            <input type="hidden" name="award_hid" value="' . Crypt::encrypt($dataaa->id) . '"/>
            <input type="text" value="' . $dataaa->title . '" class="form-control" name="title" />
            </div>
            <div class="form-group">
            <label>File</label>
            <input type="file" class="form-control" name="image" />
            <input type="hidden"  value="' . $dataaa->image . '" name="update_image"/>
            </div>
            
            <div class="form-group">
            <label>English Description</label>
            <textarea class="form-control" name="en_descriptionAward">' . $dataaa->en_description . '</textarea>
            
        </div>
        <div class="form-group">
            <label>Hindi Description</label>
            <textarea class="form-control" name="hi_descriptionAward">' . $dataaa->hi_description . '</textarea>
            
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
<script>CKEDITOR.replace("en_descriptionAward");CKEDITOR.replace("hi_descriptionAward");</script>
@endpush