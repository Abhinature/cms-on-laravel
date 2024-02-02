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
        <h1 class="m-0">Tender</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard / Tender</li>
        </ol>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
{!!displayAlert()!!}
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
      <h6>Tender</h6>
    </div>
    <div class="card-body">
      <div class="tab" id="myTab">
        <button class="tablinks" onclick="openCity(event, 'America')">Tender</button>

      </div>

      <!-- Tab content -->

      <div id="America" class="tabcontent">
        <h3>Tender</h3>
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
                          <!-- <th>
                            Category
                          </th> -->
                          <th>
                            Title
                          </th>
                          <th>
                            File
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Type
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

                        @if($tender_count > 0)
                        @php $a = 0; @endphp
                        @foreach($tender as $wp)
                        <tr>
                          <td>{{$a = $a+1}}</td>
                          <td>{{$wp->en_title ??'' }} ({{$wp->hi_title ??'' }})</td>
                          <td>{{$wp->file ??''}}</td>
                          <td>
                            @if($wp->status =='0' || $wp->status =='12')
                            Created
                            @elseif($wp->status =='1' || $wp->status =='13')
                            Approved
                            @elseif($wp->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($wp->status == '3' || $wp->status =='11')
                            Submitted For Review
                            @elseif($wp->status =='4')
                            <span class="rejected">Rejected</span>
                            @endif
                          </td>
                          <td>
                            @if($wp->status =='12' || $wp->status =='11' || $wp->status =='13')
                            Deletion
                            @elseif($wp->type == '1')
                            Modification
                            @elseif($wp->type == '2')
                            Deletion
                            @else
                            Creation
                            @endif
                          </td>
                          <td>{{$wp->remarks}}</td>
                          <td>
                            @if(AUTH::user()->user_type =='3')
                            @if($wp->status == '1')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary edittendermodal">Another Request</button>
                            @elseif($wp->status == '2')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wp->id),'tab'=>Crypt::encrypt('tender')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary edittendermodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'tender'])}}">Delete</a>
                            @elseif($wp->status =='12')
                            <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($wp->id),'tab'=>Crypt::encrypt('tender_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary edittendermodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'tender'])}}">Delete</a>
                            @elseif($wp->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wp->id),'tab'=>Crypt::encrypt('tender')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary edittendermodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'tender'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($wp->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$wp->publish_time}}</span>
                            <button type="button" rel_id="{{$wp->id}}" rel="tender" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="tender" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                            @elseif($wp->status =='2')
                            Submitted For Review : {{$wp->remarks ??''}}
                            @elseif($wp->status =='4')
                            <span class="rejected">Rejected</span>
                            @elseif($wp->status =='11' || $wp->type =='2' )
                            <button type="button" rel_id="{{$wp->id}}" rel="delete_request_tender"  class="btn btn-success delete_request">Approve</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="tender" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="tender" class="btn btn-danger review">Review</button>
                            @else
                            <button type="button" rel_id="{{$wp->id}}" rel="tender" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="tender" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="tender" class="btn btn-danger review">Review</button>
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
            <input class="form-control" name="hi_title" type="text">
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
        <h5 class="modal-title" id="exampleModalLabel">Add Tender</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-tender')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Title (English)</label>
            <input type="text" placeholder="Enter Title" class="form-control" name="en_title" />
          </div>
          <div class="form-group">
            <label>Title (Hindi)</label>
            <input type="text" placeholder="Enter Title" class="form-control" name="hi_title" />
          </div>
          <div class="form-group">
            <label>File</label>
            <input type="file" class="form-control" name="report" />
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
<!---------------------------------------------------------Reject Modal----------------------------------------------------------->
<div class="modal fade" id="rejectcontent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Enter OTP</label>
            <input type="hidden" name="rel" class="rejectrelation" />
            <input type="hidden" name="relid" class="rejectrelid" />
            <input type="text" required placeholder="Enter OTP" class="form-control rejectotpval" name="otp" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary savereject">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------------------------End Reject Modal--------------------------------------------------------->

<!-- delete request modal  -->
<div class="modal fade" id="delete_request_content" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="">
      <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Publish AT</label>
            <input type="datetime-local" class="dateTimePicker form-control publish_timeD" name="date-time" />
            <input type="hidden" name="rel" class="relationD" />
            <input type="hidden" name="relid" class="relidD" />
          </div>
          <div class="form-group">
            <label>Enter OTP</label>
            <input type="text" required placeholder="Enter OTP" class="form-control otpvalD" name="otp" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary delete_request_save">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!------------------------------------------------------------Change Approval Modal----------------------------------------------->
<div class="modal fade" id="approvecontentchangesch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Approval Schedule</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Publish AT</label>
            <input type="datetime-local" class="dateTimePicker form-control change_publish_time" name="date-time" />
            <input type="hidden" name="rel" class="change_relation" />
            <input type="hidden" name="relid" class="change_relid" />
          </div>
          <div class="form-group">
            <label>Enter OTP</label>
            <input type="text" required placeholder="Enter OTP" class="form-control change_otpval" name="otp" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary saveapprovalchange">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------------------------------End Approval Schedule--------------------------------------------->

<!---------------------------------------------------------Cancel Approval Modal----------------------------------------------------------->
<div class="modal fade" id="approvalcancelcontent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel Approval</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Remarks</label>
            <textarea class="form-control cancel_remarks" required name="remarks"></textarea>
            <input type="hidden" name="rel" class="cancel_relation" />
            <input type="hidden" name="relid" class="cancel_relid" />
          </div>
          <div class="form-group">
            <label>Enter OTP</label>
            <input type="text" required placeholder="Enter OTP" class="form-control cancel_otpval" name="otp" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary cancelapprovalcontent">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------------------------------------------------------End CancelAprroval Modal-----------------------------

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




  $('body').on('click', '.edittendermodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-tender')}}" + '/' + pro_id,
      success: function(data) {
        if (data.status == 200) {

          $('.editmodalbyajax').html(data.html);
        }
        $('.editmodalbyajax').modal('show');
        // CKEDITOR.replace('edit_manu_description');
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
@include('changeaprandreview');
@endsection