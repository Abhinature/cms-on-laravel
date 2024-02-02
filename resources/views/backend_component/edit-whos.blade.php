
          
          
                <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Whois who</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <form method="POST" enctype="multipart/form-data" action="{{route('update-who')}}">
              @csrf
              
              @if($dataaa->live_table_id !=0 && $dataaa->status != 0 &&  $dataaa->status != 12 && $dataaa->status != 13)
              <div class="form-group">
                <label>Request For</label><br>
                &nbsp;&nbsp;&nbsp; 
                <input type="radio" class="request_for_delete" rel_id="{{$dataaa->id}}" rel_name="whois" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
                <input type="radio" class="request_for_delete" name="request_for" rel_id="{{$dataaa->id}}" rel_name="whois"  value="1" />Modify
              </div>
            @endif
               <div class="modal-body">
               <div class="hide_on_delete_check">
               <div class="form-group">
               <label>Category</label>
               <select required class="form-control" name="category">
                 <option  value="">--Select Category--</option>
                 <option  value="@if($dataaa->category  == 'IEM') selected @endif">IEM</option>
                 <option  value="@if($dataaa->category  == 'Vigilance') selected @endif">Vigilance</option>
                 <option  value="@if($dataaa->category  == 'Directory') selected @endif">Directory</option>
               </select>
               </div>
                  <div class="form-group">
                    <label>Name(English)</label>
                
                    <input type="hidden" name="who_hid" value="{{Crypt::encrypt($dataaa->id)}}"/>
                    <input type="text" value="{{$dataaa->en_name}}" class="form-control" name="en_editname" />
                  </div>
                  <div class="form-group">
                  <label>Name(Hindi)</label>
                  <input type="text" value="{{$dataaa->hi_name}}" class="form-control" name="hi_editname" />
                </div>
                  <div class="form-group">
                  <label>Department(English)</label>
                  <input type="text" name="en_editdepartment" class="form-control" value="{{$dataaa->en_department}}"/>
                  </div>
                  <div class="form-group">
                  <label>Department(Hindi)</label>
                  <input type="text" name="hi_editdepartment" class="form-control" value="{{$dataaa->hi_department}}"/>
                  </div>
                  <div class="form-group">
                  <label>Designation(English)</label>
                  <input type="text" name="en_editdesignation" class="form-control" value="{{$dataaa->en_designation}}"/>
                  </div>
                  <div class="form-group">
                  <label>Designation(Hindi)</label>
                  <input type="text" name="hi_editdesignation" class="form-control" value="{{$dataaa->hi_designation}}"/>
                  </div>
                  <div class="form-group">
                  <label>Contact No.</label>
                  <input type="text" name="phone_no" class="form-control" value="{{$dataaa->phone_no}}"/>
                  </div>
                  <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control" value="{{$dataaa->email}}"/>
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" />
                    <input type="hidden"  value="{{$dataaa->image}}" name="update_image"/>
                  </div>
                  <div class="slider-image">
                    <img style="max-width:200px" src=" {{$dataaa->image }}"/>
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