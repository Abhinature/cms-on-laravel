<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update What New</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
        <form method="POST" enctype="multipart/form-data" action="{{route('update-what-new')}}" id="whatsnew-update-data">
        @if($dataaa->live_table_id !=0 && $dataaa->status != 0 &&  $dataaa->status != 12 && $dataaa->status != 13)
            <div class="form-group">
                <label>Request For</label><br>
                &nbsp;&nbsp;&nbsp; 
                <input type="radio" class="request_for_delete" rel_id="{{$dataaa->id}}" rel_name="new" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
                <input type="radio" class="request_for_delete" name="request_for" rel_id="{{$dataaa->id}}" rel_name="new"  value="1" />Modify
            </div>
        @endif
        <div class="modal-body">
        <div class="hide_on_delete_check">
            <div class="form-group">
            <label>Date</label>
            @csrf
            <input type="hidden" name="new_hid" value="{{Crypt::encrypt($dataaa->id)}}"/>
            <input type="date" value="{{date('m/d/Y',strtotime($dataaa->news_date))}}" class="form-control" name="news_date" />
            </div>
            <div class="form-group">
            <label>File</label>
            <input type="file" class="form-control" name="news_file" />
            <input type="hidden"  value="{{$dataaa->news_file}}" name="update_image"/>
            </div>
            <div class="slider-image">
            <img style="max-width:200px" src="{{$dataaa->news_file}}"/>
            </div>
            <div class="form-group">
            <label>English Description</label>
            <textarea class="form-control" name="en_descriptionWhtsnew">{{$dataaa->en_description}}</textarea>
            
        </div>

        <div class="form-group">
        <label>Hindi Description</label>
        <textarea class="form-control" name="hi_descriptionWhtsnew">{{$dataaa->hi_description}}</textarea>
        
        </div>
                            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>