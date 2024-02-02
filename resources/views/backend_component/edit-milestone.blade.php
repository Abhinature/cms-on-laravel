
               
        
            <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Milestone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button><br>
              </div> 
              
              <form method="POST" enctype="multipart/form-data" action="{{route('update-milestone')}}">
              @csrf
              @if($dataaa->live_table_id !=0 && $dataaa->status != 0 &&  $dataaa->status != 12 && $dataaa->status != 13)
              <div class="form-group">
                <label>Request For</label><br>
                &nbsp;&nbsp;&nbsp; 
                <input type="radio" class="request_for_delete" rel_id="{{$dataaa->id}}" rel_name="milestone" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
                <input type="radio" class="request_for_delete" name="request_for" rel_id="{{$dataaa->id}}" rel_name="milestone"  value="1" />Modify
              </div>
              @endif
               <div class="modal-body">
               <div class="hide_on_delete_check">
                  <div class="form-group">
                  <label>Year</label>
                  <select name="edit_year"  required class="form-control">
                    <option value="">---Select Year---</option>';
            @for($year = date('Y') ; $year >= 1980; $year--) 
                @if ($year == $dataaa->year) 
                   <option selected value="{{$year}}">{{$year}}</option>
                @else 
                    <option  value="{{$year}}">{{$year}}</option>
                @endif
            @endfor
                </select>
                    
                    <input type="hidden" name="milestone_hid" value="{{Crypt::encrypt($dataaa->id)}}"/>
                  </div>
                 
                    <div class="form-group">
                     <input type="text" name="en_milestone" class="form-control" value="{{$dataaa->en_milestone}}">
                    </div>
                    <div class="form-group">
                     <input type="text" name="hi_milestone" class="form-control" value="{{$dataaa->hi_milestone}}">
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