
  
         <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Update Download </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   <br>  
                           
               </div>
           
               <form method="POST" enctype="multipart/form-data" action="{{route('update-download')}}">
               @csrf

               @if($dataaa->live_table_id !=0 && $dataaa->status != 0 &&  $dataaa->status != 12 && $dataaa->status != 13)
                <div class="form-group">
                <label>Request For</label><br>
                &nbsp;&nbsp;&nbsp
                <input type="radio" class="request_for_delete" rel_id="{{ $dataaa->id}}" rel_name="download" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
                <input type="radio" class="request_for_delete" name="request_for" rel_id="{{$dataaa->id}} " rel_name="download"  value="1" />Modify
              </div>
              @endif
                <div class="modal-body ">
               
                  <div class="hide_on_delete_check">
                
            
                   <div class="form-group">
                     <label>Category (English)</label>
                     
                    
                     <input type="hidden" name="download_hid" value="{{$dataaa->id }}"/>
                     <input type="text" value=" {{$dataaa->en_category}}" class="form-control" name="en_category" />
                   </div>
                   <div class="form-group">
                   <label>Category (Hindi)</label>
                   <input type="text" value="{{$dataaa->hi_category}} " class="form-control" name="hi_category" />
                 </div>     
                 <div class="form-group">
                   <label>Subject (English)</label>
                   <input type="text" value="{{ $dataaa->en_subject}}" class="form-control" name="en_subject" />
                 </div>   
                 <div class="form-group">
                   <label>Subject (Hindi)</label>
                   <input type="text" value="{{$dataaa->hi_subject}}" class="form-control" name="hi_subject" />
                 </div>   
                 <div class="form-group">
                   <label>Document</label>
                   <input type="file" name="disclosure" class="form-control"/>
                   <input type="hidden" value="{{ $dataaa->document}} " class="form-control" name="update_attachment" />
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