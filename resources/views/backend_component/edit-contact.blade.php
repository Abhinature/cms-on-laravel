<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Contact Detail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" enctype="multipart/form-data" action="{{route('update-website-contact')}}">
            @csrf

            @if($dataaa->live_table_id !=0 && $dataaa->status != 0 &&  $dataaa->status != 12 && $dataaa->status != 13)
            <div class="form-group">
                <label>Request For</label><br>
                &nbsp;&nbsp;&nbsp;
                <input type="radio" class="request_for_delete" rel_id="{{$dataaa->id}}" rel_name="contact" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
                <input type="radio" class="request_for_delete" name="request_for" rel_id="{{$dataaa->id}} " rel_name="contact" value="1" />Modify
            </div>
           @endif
            <div class="modal-body">
                <div class="hide_on_delete_check">
                    <div class="form-group">
                        <label>Address(English)</label>

                        <input type="hidden" name="contact_hid" value="{{$dataaa->id}} " />
                        <textarea class="form-control" name="en_editaddress">{{$dataaa->en_address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Address(Hindi)</label>
                        <textarea class="form-control" name="hi_editaddress">{{$dataaa->hi_address}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Phone No.</label>
                        <input type="text" name="phone_no" required class="form-control" value="{{ $dataaa->phone_no }} " />
                    </div>
                    <div class="form-group">
                        <label>CIN No.</label>
                        <input type="text" name="cin_no" required class="form-control" value="{{ $dataaa->cin_no}} " />
                    </div>
                    <div class="form-group">
                        <label>Fax No.</label>
                        <input type="text" name="fax_no" required class="form-control" value="{{$dataaa->fax_no}} " />
                    </div>
                    <div class="form-group">
                        <label>Email ID</label>
                        <input type="text" name="email_id" required class="form-control" value="{{ $dataaa->email_id}}" />
                    </div>

                    <div class="form-group">
                        <label>Map Link</label>
                        <textarea class="form-control" required name="map_link">{{ $dataaa->map_link}}</textarea>
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