
                
        
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update About Us</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
       
              <form method="POST" enctype="multipart/form-data" action="{{route('update-website-about')}}">
              @csrf
              @if($dataaa->live_table_id !=0 && $dataaa->status != 0 &&  $dataaa->status != 12 && $dataaa->status != 13)
              <div class="form-group">
                <label>Request For</label><br>
                &nbsp;&nbsp;&nbsp; 
                <input type="radio" class="request_for_delete" rel_id="{{$dataaa->id}}" rel_name="about" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
                <input type="radio" class="request_for_delete" name="request_for" rel_id="{{$dataaa->id}}" rel_name="about"  value="1" />Modify
              </div>
              @endif

               <div class="modal-body">
               <div class="hide_on_delete_check">
                  <div class="form-group">
                    <label>English Title</label>                    
                    
                    <input type="hidden" name="about_hid" value="{{$dataaa->id}}"/>
                    <input type="text" value="{{$dataaa->website_en_title}}" class="form-control" name="en_edit_title" />
                  </div>
                  <div class="form-group">
                    <label>Sub Title</label>
                    <input type="text" name="web_subtitle" class="form-control" value="{{$dataaa->website_sub_title}}"/>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="edit_about_description" class="form-control" value="{{$dataaa->about_description}}"/>
                  </div>
                  <div class="form-group">
                    <label>Hindi Sub Title</label>
                    <input type="text" name="web_hi_subtitle" class="form-control" value="{{$dataaa->website_hi_sub_title}}"/>
                  </div>
                  <div class="form-group">
                  <label>English Description</label><span>*</span>
                  <textarea class="form-control" required name="edit_en_about_description">{{$dataaa->about_en_description}}</textarea>
                </div>
                <div class="form-group">
                  <label>Hindi Description</label><span>*</span>
                  <textarea class="form-control" required name="edit_hi_about_description"
                  >{{$dataaa->about_hi_description}}</textarea>
                </div>
                
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="website_logo" />
                    <input type="hidden"  value="{{$dataaa->website_logo}}" name="update_website_logo"/>
                  </div>
                  <div class="slider-image">
                    <img style="max-width:200px" src="{{$dataaa->website_logo}}"/>
                  </div>                   
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
                  </div>
              </form>
            </div>
          </div>';