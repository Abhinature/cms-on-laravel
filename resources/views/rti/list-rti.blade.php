@extends('layouts.admin.app')

@section('content')
<style>
  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #0c96cb5c;
  }

  .bgcard {
    background-color: #0c96cb45;
  }

  /* Style the buttons that are used to open the tab content */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">RTI</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard / RTI</li>
        </ol>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-sm-12">
      <div style="float:right">
        <!-- <a class="btn btn-primary" href="{{route('add-page')}}">Add Page</a> -->
      </div>
    </div>
  </div>
  <div class="card mb-4">
    <div class="card-header pb-0">
      <h6>RTI</h6>
    </div>
    <div class="card-body">
      <div class="tab" id="myTab">
        <button class="tablinks" onclick="openCity(event, 'America')">PIOs Under RTI Act</button>
        <button class="tablinks" onclick="openCity(event, 'London')">Mandatory Disclosures</button>

      </div>

      <!-- Tab content -->

      <div id="America" class="tabcontent">
        <h3>PIOs Under RTI Act</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='9')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary addmorebtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead class="text-center">
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Name Of Officer
                          </th>
                          <th>
                            Designation
                          </th>
                          <th>
                            Responsibility Assigned
                          </th>
                          <th>
                            Email Address
                          </th>
                          <th>
                            Phone No.
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Remarks
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">

                        @if($product_count > 0)
                        @php $a = 0; @endphp
                        @foreach($website_products as $wp)
                        <tr>
                          <td>{{$a = $a+1}}</td>
                          <td>{{$wp->name_of_officer}}</td>
                          <td>{{$wp->designation}}</td>
                          <td>{{$wp->responsibility_assigned}}</td>
                          <td>{{$wp->email_address}}</td>
                          <td>{{$wp->phone_no}}</td>
                          <td>
                            @if($wp->status =='0')
                            Created
                            @elseif($wp->status =='1')
                            Approved
                            @elseif($wp->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($wp->status == '3')
                            Submitted For Review
                            @endif
                          </td>
                          <td>{{$wp->remarks}}</td>
                          <td>
                            @if(AUTH::user()->user_type =='3')
                            @if($wp->status == '1')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editpoirtimodal">Another Request</button>
                            @elseif($wp->status == '2')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editpoirtimodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'poirti'])}}">Delete</a> 
                            @elseif($wp->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wp->id),'tab'=>Crypt::encrypt('poirti')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editpoirtimodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'poirti'])}}">Delete</a> 
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($wp->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$wp->publish_time}}</span>
                            @elseif($wp->status =='2')
                            Submitted For Review : {{$wp->remarks ??''}}
                            @else
                            <button type="button" rel_id="{{$wp->id}}" rel="poirti" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="poirti" class="btn btn-danger review">Review</button>
                            @endif
                            @endif
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>

                    </table>
                  </div>


                </div>
              </div>

            </div>
          </div>

        </form>
      </div>

      <div id="London" class="tabcontent">
        <h4>Mandatory Disclosures</h4>

        <div class="row mt-2 p-1">
          @if(AUTH::user()->user_type !='9')
          <div class="col-md-12">
            <div style="float:right">
              <button type="button" data-bs-toggle="modal" data-bs-target="#exampleContact" class="btn btn-primary addmorebtn">Add More</button>
            </div>
          </div>
          @endif
          <div class="col-md-12">
            <div class="card bgcard p-2">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-stripped">
                    <thead class="text-center">
                      <tr>
                        <th>S.No</th>
                        <th>
                          Title (English)
                        </th>
                        <th>
                          Title (Hindi)
                        </th>
                        <th>
                          File
                        </th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      @php $a = 0; @endphp
                      @foreach($mandatory as $i)
                      <tr>
                        <td>{{$a=$a+1}}</td>
                        <td>{{$i->en_title}}</td>
                        <td>{{$i->hi_title}}</td>
                        <td><a target="_blank" href="{{asset($i->attachment)}}">Views</a></td>
                        <td>
                            @if($i->status =='0')
                            Created
                            @elseif($i->status =='1')
                            Approved
                            @elseif($i->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($i->status == '3')
                            Submitted For Review
                            @endif
                          </td>
                          <td>{{$i->remarks}}</td>
                          <td>
                            
                            @if(AUTH::user()->user_type =='3')
                            @if($i->status == '1')
                            <button rel="{{$i->id}}" type="button" class="btn btn-primary editmandatorymodal">Another Request</button>
                            @elseif($i->status == '2')
                            <button rel="{{$i->id}}" type="button" class="btn btn-primary editmandatorymodal">Edit</button>
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $i->id,'rel'=>'mandatory'])}}">Delete</a> 
                            @elseif($i->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($i->id),'tab'=>Crypt::encrypt('mandatory')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$i->id}}" type="button" class="btn btn-primary editmandatorymodal">Edit</button>
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $i->id,'rel'=>'mandatory'])}}">Delete</a> 
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($i->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$i->publish_time}}</span>
                            @elseif($i->status =='2')
                            Submitted For Review : {{$i->remarks ??''}}
                            @elseif($i->status =='3')
                            <button type="button" rel_id="{{$i->id}}" rel="mandatory" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$i->id}}" rel="mandatory" class="btn btn-danger review">Review</button>
                            @endif
                            @endif
                          </td>
                      </tr>
                      @endforeach
                    </tbody>

                  </table>
                </div>


              </div>
            </div>

          </div>

        </div>
      </div>



      <!----------------------------------------->

    </div>
  </div>
</div>
</div>
<!-----------------------------------------MODALS---------------------------------------------->

<!-------------------------------------------Contact------------------------------------------------->
<div class="modal fade" id="exampleContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('save-mandatory-disclosure')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Title (In English)</label><span>*</span>
            <input class="form-control" required name="en_title" type="text">
          </div>
          <div class="form-group">
            <label>Title (In Hindi)</label><span>*</span>
            <input class="form-control"  name="hi_title" type="text">
          </div>
          <div class="form-group">
            <label>File (Disclosure)</label>
            <input class="form-control" required name="disclosure" type="file">
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------------End Contact------------------------------------------------->
<!--------------------------------------What News-------------------------------------------------->
<div class="modal fade" id="examplewhat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">What's New</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-what-new')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Date</label>
            <input type="date" class="form-control" name="news_date">
          </div>
          <div class="form-group">
            <label>File</label>
            <input type="file" class="form-control" name="new_file">
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--------------------------------------Media-------------------------------------------------->
<div class="modal fade" id="examplemedia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Media Release</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-media-release')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" />
          </div>
          <div class="form-group">
            <label>Thumbnail Image</label>
            <input type="file" class="form-control" name="image" />
          </div>
          <div class="form-group">
            <label>File</label>
            <input type="file" class="form-control" name="release_file">
          </div>
          <div class="form-group">
            <label>Date Time</label>
            <input type="datetime-local" class="form-control" name="date_time">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--------------------------------------Products-------------------------------------------------->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PIO's Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-rti-pio')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Officer Name</label>
            <input type="text" placeholder="Enter Officer Name" class="form-control" name="officer_name" />
          </div>
          <div class="form-group">
            <label>Designation</label>
            <input type="text" placeholder="Enter Designation" class="form-control" name="designation" />
          </div>
          <div class="form-group">
            <label>Responsibility Assigned</label>
            <input type="text" placeholder="Enter Responsibility Assigned" class="form-control" name="responsibility_assigned" />
          </div>
          <div class="form-group">
            <label>Email Address</label>
            <input type="text" placeholder="Enter Email Address" class="form-control" name="email_address" />
          </div>
          <div class="form-group">
            <label>Phone No.</label>
            <input type="text" placeholder="Enter Phone No." class="form-control" name="phone_no" />
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------end Products-------------------------------------------------->

<!--------------------------------------Manufacturing Facility-------------------------------------------------->
<div class="modal fade" id="exampleManu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manufacturing Facility</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-manufacturing-facility')}}">
        @csrf
        <div class="modal-body">

          <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="manu_title" />
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="manu_image" />
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="manu_description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------End Manufacturing Facility-------------------------------------------------->

<!-------------------------------------------------MILE STONE------------------------------------------------------->
<div class="modal fade" id="examplemilestone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Milestone</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-milestone')}}">
        @csrf
        <div class="modal-body">

          <div class="form-group">
            <label>Year</label>
            <select name="year" required class="form-control">
              <option value="">---Select Year---</option>

              <?php
              for ($year = date('Y'); $year >= 1980; $year--) {
                echo '<option value="' . $year . '">' . $year . '</option>';
              } ?>
            </select>
            <!-- <input type="Year" id="miledate" class="form-control" name="manu_title" /> -->
          </div>
          <div class="form-group">
            <label>Milestone</label>
            <input type="text" class="form-control" name="milestone" />
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---------------------------------------------------End Mile Stone-------------------------------------------------->
<!--------------------------------------Slider Images-------------------------------------------------->
<div class="modal fade" id="exampleSlide" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Website Slider Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-slider-image')}}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Image</label>
            <input type="file" required class="form-control" name="slider_image[]" />
          </div>
          <div class="form-group">
            <label>Sequence</label>
            <input type="number" min='1' required class="form-control" name="sequence" />
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------End Manufacturing Facility-------------------------------------------------->
<!--------------------------------------Award & Achievements-------------------------------------------------->
<div class="modal fade" id="exampleaward" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Award's & Achievements</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-award')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" />
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="image" />
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--------------------------------------Products-------------------------------------------------->
<!--------------------------------------Who's Who-------------------------------------------------->
<div class="modal fade" id="examplewhois" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Who's Who</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-who')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" />
          </div>
          <div class="form-group">
            <label>Department</label>
            <input type="text" class="form-control" name="department" />
          </div>
          <div class="form-group">
            <label>Designation</label>
            <input type="text" class="form-control" name="designation" />
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="image" />
          </div>
          <div class="form-group">
            <label>Phone No.</label>
            <input type="text" class="form-control" name="phone_no" />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" />
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------------------Edit Modal--------------------------------------------------------------->
<div class="modal fade editmodalbyajax" id="exampleEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>
<!--------------------------------------------------------Approve Modal----------------------------------------------------------->
<div class="modal fade" id="approvecontent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approval</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Publish AT</label>
            <input type="datetime-local" class="dateTimePicker form-control publish_time" name="date-time" />
            <input type="hidden" name="rel" class="relation" />
            <input type="hidden" name="relid" class="relid" />
          </div>
          <div class="form-group">
            <label>Enter OTP</label>
            <input type="text" required placeholder="Enter OTP" class="form-control otpval" name="otp" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary saveapproval">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------Review Modal------------------------------------------------------------>
<div class="modal fade" id="reviewcontent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Review Content</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Remarks</label>
            <textarea class="form-control remarks" required name="remarks"></textarea>
            <input type="hidden" name="rel" class="review_relation" />
            <input type="hidden" name="relid" class="review_relid" />
          </div>
          <div class="form-group">
            <label>Enter OTP</label>
            <input type="text" required placeholder="Enter OTP" class="form-control reviewotpval" name="otp" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary savereview">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> -->
<!-- <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.4.3/js/tempus-dominus.js" integrity="sha512-+czcA0uweh7fUHWI4Yvixi92esLt0Y5TCZ8OitvNyMQ/9Kd1Baha34VKOztXwUgV++aUbgr9sxxniE2dwvNQ6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.4.3/css/tempus-dominus.min.css" integrity="sha512-wO+rVZhTyJgwKxVY279cD/TZTlW2m0IJQXzoOHfj2w//md58T3jc8ZWHb+HEm8CspcCNnaJVFPyRAGd/Y4ScfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript">
  //


  //
  function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }


  $('body').on('click', '.approve', function() {
    var rel = $(this).attr('rel');
    var type_id = $(this).attr('rel_id')
    swal({
      title: "Are you sure,You want to approve the Content?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, archive it!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: 'Post',
          url: "{{url('sendotp')}}",
          data: {
            rel: rel,
            type_id: type_id,
            _token: "{{csrf_token()}}"
          },
          success: function(xa) {
            if (xa.success == true) {
              $('.relation').val(rel);
              $('.relid').val(type_id);
              $("#approvecontent").modal('show');
            }
          }
        });
      }
    });
  });

  $('body').on('click', '.review', function() {
    var rel = $(this).attr('rel');
    var type_id = $(this).attr('rel_id')
    swal({
      title: "Are you sure,You want to submit content for review ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, archive it!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: 'Post',
          url: "{{url('sendotp')}}",
          data: {
            rel: rel,
            type_id: type_id,
            _token: "{{csrf_token()}}"
          },
          success: function(xa) {
            if (xa.success == true) {
              $('.review_relation').val(rel);
              $('.review_relid').val(type_id);
              $("#reviewcontent").modal('show');
            }
          }
        });
      }
    });

  });

  $('body').on('click', '.saveapproval', function() {
    var publish_time = $('.publish_time').val();
    var relation = $('.relation').val();
    var relid = $('.relid').val();
    var otpval = $('.otpval').val();
    $.ajax({
      type: 'Post',
      url: "{{url('save-approval')}}",
      data: {
        publish_time: publish_time,
        relation: relation,
        relid: relid,
        otpval: otpval,
        _token: "{{csrf_token()}}"
      },
      success: function(xa) {
        // alert(xa.success);
        if (xa.success == true) {
          $("#approvecontent").modal('hide');
          swal({
            title: "Content Approved And Applied For Publish!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          }).then((willDelete) => {
            if (willDelete) {
              location.reload();
            }
          });

        } else if (xa.success == false) {
          $("#approvecontent").modal('hide');
          swal({
            title: xa.msg,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          });

        }
      }
    });

  });

  $('body').on('click', '.savereview', function() {
    var publish_time = $('.remarks').val();
    var relation = $('.review_relation').val();
    var relid = $('.review_relid').val();
    var otpval = $('.reviewotpval').val();
    $.ajax({
      type: 'Post',
      url: "{{url('save-review')}}",
      data: {
        publish_time: publish_time,
        relation: relation,
        relid: relid,
        otpval: otpval,
        _token: "{{csrf_token()}}"
      },
      success: function(xa) {
        // alert(xa.success);
        if (xa.success == true) {
          $("#reviewcontent").modal('hide');
          swal({
            title: "Content Submitted For Review!!",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          }).then((willDelete) => {
            if (willDelete) {
              location.reload();
            }
          });
        } else if (xa.success == false) {
          $("#reviewcontent").modal('hide');
          swal({
            title: xa.msg,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          });

        }
      }
    });

  });


  $('body').on('click', '.editpoirtimodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-poi-rti')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
        // CKEDITOR.replace('edit_manu_description');
      }
    });

  });




  $('body').on('click', '.editmandatorymodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      url: "{{ url('edit-mandatory')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
      }
    });
  });
  

</script>
<script>
  $(document).ready(function() {
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
      localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
      $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
  });
</script>
@include('delete_request');
@endsection