<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Update Slider Image</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> <br>
    </div>
    <form method="POST" enctype="multipart/form-data" action="{{route('update-slider-image')}}">

      @csrf


      @if($dataaa->live_table_id !=0 && $dataaa->status != 0 &&  $dataaa->status != 12 && $dataaa->status != 13)
      <div class="form-group">
        <label>Request For</label><br>
        &nbsp;&nbsp;&nbsp;
        <input type="radio" class="request_for_delete" rel_id="{{$dataaa->id}}" rel_name="slider_image" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
        <input type="radio" class="request_for_delete" name="request_for" rel_id="{{$dataaa->id}}" rel_name="modify" value="1" />Modify
      </div>
      @endif
      <div class="modal-body">
        <div class="hide_on_delete_check">
          <div class="form-group">
            <label>Sequence</label>
          
            <input type="hidden" name="slide_hid" value="{{$dataaa->id}}" />
            <input type="text" value="{{$dataaa->sequence}}" class="form-control" name="sequence" />
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="slide_image" />
            <input type="hidden" value="{{$dataaa->slider_image}}" name="update_slide_image" />
          </div>
          <div class="slider-image">
            <img style="max-width:200px" src="{{$dataaa->slider_image}}" />
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