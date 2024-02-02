            
            <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Media Release</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            
              <form method="POST" enctype="multipart/form-data" action="{{route('update-media-release')}}">

             @csrf

             @if($dataaa->live_table_id !=0 && $dataaa->status != 0 &&  $dataaa->status != 12 && $dataaa->status != 13)
                <div class="form-group">
                <label>Request For</label><br>
                &nbsp;&nbsp;&nbsp; 
                <input type="radio" class="request_for_delete" rel_id="{{$dataaa->id}}" rel_name="media" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
                <input type="radio" class="request_for_delete" name="request_for" rel_id="{{$dataaa->id}}" rel_name="media"  value="1" />Modify
              </div>
              @endif
              <div class="hide_on_delete_check">

               <div class="modal-body">
              
                  <div class="form-group">
                    <label>En TItle</label>
                    
                    <input type="hidden" name="media_hid" value="{{Crypt::encrypt($dataaa->id)}}"/>
                    <input type="text" value="{{$dataaa->en_title}}" class="form-control" name="en_title" />
                  </div>
                  <div class="form-group">
                  <label>Hi TItle</label>
                  <input type="text" value="{{$dataaa->hi_title}}" class="form-control" name="hi_title" />
                </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" />
                    <input type="hidden"  value="{{$dataaa->image}}" name="update_image"/>
                  </div>
                  <div class="slider-image">
                    <img style="max-width:200px" src="{{$dataaa->image}}"/>
                  </div> 
                  <div class="form-group">
                    <label>Date-Time</label>
                    <input type="datetime-local" class="form-control" value="{{$dataaa->date_time}}" name="date_time" />                    
                  </div>
                  <div class="form-group">
                  <label>Release File</label>
                  <input type="file" class="form-control" name="release_file" />
                  <input type="hidden"  value="{{$dataaa->file}}" name="update_file"/>
                  <a class="btn btn-primary mt-1" target="_blank" href="{{$dataaa->file}}">Previously Uploaded File</a>
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