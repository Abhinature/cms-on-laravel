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

  .unselectable {
    background-color: #E3F2DB;
    text-shadow: 2px 2px 5px #CAD6D1;
    cursor: not-allowed;
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
        <h1 class="m-0">@if(AUTH::user()->unit_id == '0') Home Page @else Website Content @endif</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard / @if(AUTH::user()->unit_id == '0') Home Page @else Website Content @endif</li>
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
      <h6></h6>
    </div>
    <div class="card-body">
      <div class="tab" id="myTab">
        @if($active == 'website_slider_images')
        <button class="tablinks <?php echo ($active == 'website_slider_images') ? 'active' : ''; ?>" onclick="openCity(event, 'America')">Slider Images</button>
        @endif
        @if($active == 'cmd_msg')
        <button class="tablinks <?php echo ($active == 'cmd_msg') ? 'active' : ''; ?>" onclick="openCity(event, 'cmd_msg')">CMD Message</button>
        @endif
        @if($active == 'media_releases')
        <button class="tablinks <?php echo ($active == 'media_releases') ? 'active' : ''; ?>" onclick="openCity(event, 'Media')">Media Release</button>
        @endif
        @if($active == 'whats_news')
        <button class="tablinks <?php echo ($active == 'whats_news') ? 'active' : ''; ?>" onclick="openCity(event, 'What')">What's New</button>
        @endif
        

        @if(Auth::user()->unit_id =='0')
        
        @if($active == 'award_achievements')
        <button class="tablinks <?php echo ($active == 'award_achievements') ? 'active' : ''; ?>" onclick="openCity(event, 'Award')"> Awards & Achievements</button>
        @endif
        @if($active == 'milestones')
        <button class="tablinks <?php echo ($active == 'milestones') ? 'active' : ''; ?>" onclick="openCity(event, 'milestone')">Milestone</button>
        @endif
        <!-- <button class="tablinks <?php echo ($active == 'manu') ? 'active' : ''; ?>" onclick="openCity(event, 'Tokyo')"> Vigilance</button> -->
        @endif
       
        @if($active == 'unit_websites')
        <button class="tablinks <?php echo ($active == 'unit_websites') ? 'active' : ''; ?>" onclick="openCity(event, 'London')">About</button>
        @endif
        @if(Auth::user()->unit_id =='0' && Auth::user()->user_type =='9')
        
        @if($active == 'product')
        <button class="tablinks<?php echo ($active == 'product') ? 'active' : ''; ?>" onclick="openCity(event, 'Paris')">Products</button>
        @endif
        
        @endif
        
        @if($active == 'whois')
        <button class="tablinks <?php echo ($active == 'whois') ? 'active' : ''; ?>" onclick="openCity(event, 'Whois')">Who's Who</button>
        @endif
        
        @if(Auth::user()->unit_id !='0')
       
        @if($active == 'manu')
        <button class="tablinks <?php echo ($active == 'manu') ? 'active' : ''; ?>" onclick="openCity(event, 'Tokyo')">Manufacturing Facility</button>
        @endif
      
        @endif
        
        @if($active == 'unit_website_contact')
        <button class="tablinks <?php echo ($active == 'unit_website_contact') ? 'active' : ''; ?>" onclick="openCity(event, 'India')">Contact Details</button>
        @endif

      </div>

      <!-- Tab content -->
      <div id="London" class="tabcontent" style="<?php echo ($active == 'unit_websites') ? 'display:block' : ''; ?>">
        <h4>Website About Content</h4>

        @if(AUTH::user()->user_type !='9')
        <div class="row col-md-12">
          <div style="float:right">
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleWebsite" class="btn btn-primary addmorebtn">Add More</button>
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
                        English Title
                      </th>
                      <th>
                        Hindi Title
                      </th>
                      <th>
                        English Sub Title
                      </th>
                      <th>
                        Hindi Sub Title
                      </th>
                      <th>
                        Logo
                      </th>
                      <th>
                        English Description
                      </th>
                      <th>
                        Hindi Description
                      </th>
                      <th>Status</th>
                      <th>Type</th>
                      <th>Remarks</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">

                    @if($product_count > 0)
                    @php $a = 0; @endphp
                    @foreach($websitedata as $wb)
                    <tr>
                      <td>{{$a = $a+1}}</td>
                      <td>{{$wb->website_en_title ??''}}</td>
                      <td>{{$wb->website_hi_title ??''}}</td>
                      <td>{{$wb->website_en_sub_title ??''}}</td>
                      <td>{{$wb->website_hi_sub_title ??''}}</td>
                      <td>
                        @if($wb->website_logo =='')
                        @else
                        <img src="{{$wb->website_logo ??''}}" style="max-width:80px">
                        @endif
                      </td>
                      <td>{!!$wb->about_en_description!!}</td>
                      <td>{!!$wb->about_hi_description!!}</td>
                      <td>
                      @if($wb->status =='0' || $wb->status =='12')
                            Created
                            @elseif($wb->status =='1' || $wb->status =='13')
                            Approved
                            @elseif($wb->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($wb->status == '3' || $wb->status =='11')
                            Submitted For Review
                            @elseif($wb->status =='4')
                            <span class="rejected">Rejected</span>
                            @endif
                          </td>
                          <td>
                            @if($wb->status =='12' || $wb->status =='11' || $wb->status =='13')
                            Deletion
                            @elseif($wb->type == '1')
                            Modification
                            @endif
                          </td>
                      <td>
                        {{$wb->remarks ??''}}
                      </td>
                      <td>
                        @if(AUTH::user()->user_type =='3')
                        @if($wb->status == '1')
                        <button rel="{{$wb->id}}" type="button" class="btn btn-primary editaboutmodal">Another Request</button>
                        @elseif($wb->status == '2')
                        <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wb->id),'tab'=>Crypt::encrypt('about')])}}" class="btn btn-success">Submit For Review</a>
                        <button rel="{{$wb->id}}" type="button" class="btn btn-primary editaboutmodal">Edit</button>
                        <a class="btn btn-danger" href="{{route('del-content',['id' => $wb->id,'rel'=>'about'])}}">Delete</a>
                        @elseif($wb->status =='12')
                        <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($wb->id),'tab'=>Crypt::encrypt('about_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                        <button rel="{{$wb->id}}" live="{{$wb->live_table_id}}" type="button" class="btn btn-primary editaboutmodal">Edit</button> |
                        <a class="btn btn-danger" href="{{route('del-content',['id' => $wb->id,'rel'=>'about'])}}">Delete</a>
                        @elseif($wb->status == '0')
                        <a href="{{route('front.about-preview',['id' => Crypt::encrypt($wb->id) ,'unit_id' => Crypt::encrypt(AUTH::user()->unit_id)])}}" class="btn btn-dark" target="_blank">Preview </a>
                        <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wb->id),'tab'=>Crypt::encrypt('about')])}}" class="btn btn-success">Submit For Review</a>
                        <button rel="{{$wb->id}}" type="button" class="btn btn-primary editaboutmodal">Edit</button> |
                        <a class="btn btn-danger" href="{{route('del-content',['id' => $wb->id,'rel'=>'about'])}}">Delete</a>
                        @endif
                        @elseif(AUTH::user()->user_type=='9')
                        @if($wb->status =='1')
                        <span class="mt-2 p-2 bg-white text-dark">Approved {{$wb->publish_time}}</span>
                        @elseif($wb->status =='2')
                        Submitted For Review : {{$wb->remarks ??''}}
                        @elseif($wb->status =='4')
                        <span class="rejected">Rejected</span>
                        @elseif($wb->status =='11')
                        <button type="button" rel_id="{{$wb->id}}" rel="delete_request_about" data-live_table_id="{{$wb->live_table_id}}" class="btn btn-success delete_request">Approve</button>
                        <button type="button" rel_id="{{$wb->id}}" rel="about" class="btn btn-danger reject">Reject</button>
                        <button type="button" rel_id="{{$wb->id}}" rel="about" class="btn btn-warning review">Review</button>
                        @else
                        <button type="button" rel_id="{{$wb->id}}" rel="about" class="btn btn-success approve">Approve</button>
                        <button type="button" rel_id="{{$wb->id}}" rel="about" class="btn btn-danger reject">Reject</button>
                        <button type="button" rel_id="{{$wb->id}}" rel="about" class="btn btn-danger review">Review</button>
                        @endif
                        @endif
                        <button type="button" class="hisoty_btn" data-id="{{ Crypt::encryptString($wb->id) }}" data-url="{{ route('getWebsiteAboutHistory') }}">
                          <i class="fas fa-info"></i>
                        </button>
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

      <div id="Paris" class="tabcontent" style="<?php echo ($active == 'product') ? 'display: block;' : '' ?>">
        <h3>Products</h3>
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
                            Product Name
                          </th>
                          <th>
                            Product Image
                          </th>
                          <th>
                            Product Specification
                          </th>
                          <th>
                            View In Slider ?
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">

                        @if($product_count > 0)
                        @php $a = 0; @endphp
                        @foreach($website_products as $wp)
                        <tr>
                          <td>{{$a = $a+1}}</td>
                          <td>{{$wp->product_name}}</td>
                          <td><img src="{{$wp->product_image}}" style="max-width:80px"></td>
                          <td>{!!$wp->product_specification!!}</td>
                          <td>
                            <input type="radio" <?php echo ($wp->show_in_slider == '1') ? 'checked' : ''; ?> rel="{{$wp->id}}" class="slide_product" name="slide_product{{$a}}" value="1">Yes
                            <input type="radio" <?php echo ($wp->show_in_slider == '0') ? 'checked' : ''; ?> rel="{{$wp->id}}" class="slide_product" name="slide_product{{$a}}" value="0">No


                            <!-- <button rel="{{$wp->id}}" type="button" class="btn btn-primary editproductmodal">Edit</button> -->
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
      <div id="milestone" class="tabcontent" style="<?php echo ($active == 'milestones') ? 'display: block;' : '' ?>">
        <h3>Milestone</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='9')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#examplemilestone" class="btn btn-primary addmoremanubtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead>
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Year
                          </th>
                          <th>
                            English Milestone
                          </th>
                          <th>
                            Hindi Milestone
                          </th>
                          <th>Status</th>
                          <th>Type</th>
                          <th>Remarks</th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        @php $b = 0; @endphp
                        @foreach($website_milestone as $mstn)
                        <tr>
                          <td>{{$b = $b+1}}</td>
                          <td>{{$mstn->year}}</td>
                          <td>{{$mstn->en_milestone}}</td>
                          <td>{{$mstn->hi_milestone}}</td>
                   

                          {{--<td>
                            @if(Auth::user()->user_type =='3')
                            <button rel="{{$mstn->id}}" type="button" class="btn btn-primary editmilemodal">Edit</button> |
                          <a class="btn btn-danger" href="{{route('del-content',['id' => $mstn->id,'rel'=>'milestone'])}}">Delete</a>
                          @elseif(AUTH::user()->user_type=='9')
                          @if($mstn->status =='1')
                          <span class="mt-2 p-2 bg-white text-dark">Approved {{$mstn->publish_time}}</span>
                          @elseif($mstn->status =='2')

                          Submitted For Review : {{$mstn->remarks ??''}}
                          @else
                          <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="btn btn-success approve">Approve</button>
                          <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="btn btn-danger reject">Reject</button>
                          <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="btn btn-danger review">Review</button>
                          @endif
                          @endif
                          </td>--}}

                          <td>
                          @if($mstn->status =='0' || $mstn->status =='12')
                            Created
                            @elseif($mstn->status =='1' || $mstn->status =='13')
                            Approved
                            @elseif($mstn->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($mstn->status == '3' || $mstn->status =='11')
                            Submitted For Review
                            @elseif($mstn->status =='4')
                            <span class="rejected">Rejected</span>
                            @endif
                          </td>
                          <td>
                            @if($mstn->status =='12' || $mstn->status =='11' || $mstn->status =='13')
                            Deletion
                            @elseif($mstn->type == '1')
                            Modification
                            @endif
                          </td>
                          <td>{{$mstn->remarks}}</td>
                          <td>
                            @if(AUTH::user()->user_type =='3')
                            @if($mstn->status == '1')
                            <button rel="{{$mstn->id}}" type="button" class="btn btn-primary editmilemodal">Another Request</button>
                            @elseif($mstn->status == '2')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($mstn->id),'tab'=>Crypt::encrypt('milestone')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$mstn->id}}" type="button" class="btn btn-primary editmilemodal">Edit</button>
                            {{--<a class="btn btn-danger" href="{{route('del-slider-image',['id' => $mstn->id])}}">Delete</a> --}}
                            @elseif($mstn->status =='12')
                            <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($mstn->id),'tab'=>Crypt::encrypt('milestone_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$mstn->id}}" live="{{$mstn->live_table_id}}" type="button" class="btn btn-primary editmilemodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $mstn->id,'rel'=>'milestone'])}}">Delete</a>
                            @elseif($mstn->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($mstn->id),'tab'=>Crypt::encrypt('milestone')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$mstn->id}}" type="button" class="btn btn-primary editmilemodal">Edit</button>
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $mstn->id,'rel'=>'milestone'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($mstn->status =='1')
                            <span class="mt-3 p-2 bg-white text-dark">Approved {{$mstn->publish_time}}</span>
                            <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>



                            @elseif($mstn->status =='2')
                            Submitted For Review : {{$mstn->remarks ??''}}
                            @elseif($mstn->status =='4')
                            <span class="rejected">Rejected</span>
                            @elseif($mstn->status =='11')
                            <button type="button" rel_id="{{$mstn->id}}" rel="delete_request_milestone" data-live_table_id="{{$mstn->live_table_id}}" class="btn btn-success delete_request">Approve</button>
                            <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="btn btn-warning review">Review</button>
                            @else
                            <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$mstn->id}}" rel="milestone" class="btn btn-danger review">Review</button>
                            @endif
                            @endif
                            <button type="button" class="hisoty_btn" data-id="{{ Crypt::encryptString($mstn->id) }}" data-url="{{ route('getMilestoneHistory') }}">
                              <i class="fas fa-info"></i>
                            </button>
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
          <div class="col-md-12">
            <div style="float:right">
              <a href="{{route('preview-milestone')}}" class="btn btn-dark mt-3" target="_blank">Preview</a>

            </div>
          </div>
      </div>
      <div id="Media" class="tabcontent" style="<?php echo ($active == 'media_releases') ? 'display: block;' : '' ?>">
        <h3>Media Release </h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='9')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#examplemedia" class="btn btn-primary addmoremanubtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead>
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Image
                          </th>
                          <th>
                            En Title
                          </th>
                          <th>
                            Hi Title
                          </th>
                          <th>
                            Date-Time
                          </th>
                          <th>
                            File
                          </th>
                          <th>Status</th>
                          <th>Type</th>
                          <th>Remarks</th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        @php $b = 0; @endphp
                        @foreach($website_media as $mdn)


                        <tr>
                          <td>{{$b = $b+1}}</td>
                          <td><img src="{{$mdn->image}}" style="max-width:80px" /></td>
                          <td>{{$mdn->en_title}}</td>
                          <td>{{$mdn->hi_title}}</td>
                          <td>{{$mdn->date_time}}</td>
                          <td><a class="btn btn-primary" target="_blank" href="{{$mdn->file}}">View</a></td>
                          <!-- <td><button rel="{{$mdn->id}}" type="button" class="btn btn-primary editmediamodal">Edit</button></td> -->
                          {{--<td>
                            @if(Auth::user()->user_type =='3')

                           
                            <button rel="{{$mdn->id}}" type="button" class="btn btn-primary editmediamodal">Edit</button>
                          @elseif(AUTH::user()->user_type=='9')
                          @if($mdn->status =='1')
                          <span class="mt-2 p-2 bg-white text-dark">Approved {{$mdn->publish_time}}</span>
                          @elseif($mdn->status =='0')
                          <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($mstn->id),'tab'=>Crypt::encrypt('media')])}}" class="btn btn-success">Submit For Review</a>
                          @elseif($mdn->status =='2')
                          Submitted For Review : {{$mdn->remarks ??''}}
                          @elseif($mdn->status =='4')
                          <span class="rejected">Rejected</span>
                          @else
                          <button type="button" rel_id="{{$mdn->id}}" rel="media" class="btn btn-success approve">Approve</button>
                          <button type="button" rel_id="{{$mdn->id}}" rel="media" class="btn btn-danger reject">Reject</button>
                          <button type="button" rel_id="{{$mdn->id}}" rel="media" class="btn btn-danger review">Review</button>
                          @endif
                          @endif
                          </td>--}}
                          <td>
                            @if($mdn->status =='0' || $mdn->status =='12')
                            Created
                            @elseif($mdn->status =='1' || $mdn->status =='13')
                            Approved
                            @elseif($mdn->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($mdn->status == '3' || $mdn->status =='11')
                            Submitted For Review
                            @elseif($mdn->status =='4')
                            <span class="rejected">Rejected</span>
                            @endif
                          </td>
                          <td>
                            @if($mdn->status =='12' || $mdn->status =='11' || $mdn->status =='13')
                            Deletion
                            @elseif($mdn->type == '1')
                            Modification
                            @endif
                          </td>
                          <td>{{$mdn->remarks}}</td>
                          <td>
                            @if(AUTH::user()->user_type =='3')
                            @if($mdn->status =='1')
                            <button rel="{{$mdn->id}}" type="button" class="btn btn-primary editmediamodal">Another Request</button>
                            @elseif($mdn->status =='12')
                            <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($mdn->id),'tab'=>Crypt::encrypt('media_release_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$mdn->id}}" live="{{$mdn->live_table_id}}" type="button" class="btn btn-primary editmediamodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $mdn->id,'rel'=>'media'])}}">Delete</a>
                            @elseif($mdn->status == '2')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($mdn->id),'tab'=>Crypt::encrypt('media')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$mdn->id}}" type="button" class="btn btn-primary editmediamodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $mdn->id,'rel'=>'media'])}}">Delete</a>
                            @elseif($mdn->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($mdn->id),'tab'=>Crypt::encrypt('media')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$mdn->id}}" type="button" class="btn btn-primary editmediamodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $mdn->id,'rel'=>'media'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($mdn->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$mdn->publish_time}}</span>
                            <button type="button" rel_id="{{$mdn->id}}" rel="media" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$mdn->id}}" rel="media" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                            @elseif($mdn->status =='2')
                            Submitted For Review : {{$mdn->remarks ??''}}
                            @elseif($mdn->status =='4')
                            <span class="rejected">Rejected</span>
                            @elseif($mdn->status =='11')
                            <button type="button" rel_id="{{$mdn->id}}" rel="delete_request_media" data-live_table_id="{{$mdn->live_table_id}}" class="btn btn-success delete_request">Approve</button>
                            <button type="button" rel_id="{{$mdn->id}}" rel="media" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$mdn->id}}" rel="media" class="btn btn-warning review">Review</button>
                            @else
                            <button type="button" rel_id="{{$mdn->id}}" rel="media" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$mdn->id}}" rel="media" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$mdn->id}}" rel="media" class="btn btn-warning review">Review</button>
                            @endif
                            @endif
                            <button type="button" class="hisoty_btn" data-id="{{ Crypt::encryptString($mdn->id) }}" data-url="{{ route('getMediaRealseHistory') }}">
                              <i class="fas fa-info"></i>
                            </button>
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
          <div class="col-md-12">
            <div style="float:right">

              <a href="{{route('preview-media')}}" class="btn btn-dark mt-2" target="_blank">Preview </a>
            </div>
          </div>
      </div>
      <div id="What" class="tabcontent" style="<?php echo ($active == 'whats_news') ? 'display: block;' : '' ?>">
        <h3>What's New </h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='9')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#examplewhat" class="btn btn-primary addmoremanubtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-condensed table-hover table-stripped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Date
                          </th>
                          <th>
                            En Desription
                          </th>

                          <th>
                            Hi Desription
                          </th>
                          <th>
                            File
                          </th>
                          <th>Status</th>
                          <th>Type</th>
                          <th>Remarks</th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        @php $b = 0; @endphp
                        @foreach($website_new as $wnew)


                        <tr>
                          <td>{{$b = $b+1}}</td>
                          <td>{{$wnew->news_date}}</td>
                          <td>{!!$wnew->en_description!!}</td>
                          <td>{!!$wnew->hi_description!!}</td>
                          <td>
                            @if($wnew->news_file !='')
                            <a target="_blank" class="btn btn-primary" href="{{$wnew->news_file}}">View</a>
                            @else

                            @endif
                          </td>

                          <td>
                            @if($wnew->status =='0' || $wnew->status =='12')
                            Created
                            @elseif($wnew->status =='1' || $wnew->status =='13')
                            Approved
                            @elseif($wnew->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($wnew->status == '3' || $wnew->status =='11')
                            Submitted For Review
                            @elseif($wnew->status =='4')
                            <span class="rejected">Rejected</span>
                            @elseif($wnew->status =='10')
                            <span class="rejected">Deleted</span>
                            @endif
                          </td>
                          <td>
                            @if($wnew->status =='12' || $wnew->status =='11' || $wnew->status =='13')
                            Deletion
                            @elseif($wnew->type == '1')
                            Modification
                            @endif
                          </td>
                          <td>{{$wnew->remarks}}</td>
                          <td>
                            @if(AUTH::user()->user_type =='3')
                            @if($wnew->status == '1'|| $wnew->status =='13')
                            <button rel="{{$wnew->id}}" type="button" class="btn btn-primary editnewmodal">Another Request</button>
                            @elseif($wnew->status == '12')
                            <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($wnew->id),'tab'=>Crypt::encrypt('new_request_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wnew->id}}" type="button" class="btn btn-primary editnewmodal">Edit</button>
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wnew->id,'rel'=>'new'])}}">Delete</a>
                            @elseif($wnew->status == '2')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wnew->id),'tab'=>Crypt::encrypt('new')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wnew->id}}" type="button" class="btn btn-primary editnewmodal">Edit</button>
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wnew->id,'rel'=>'new'])}}">Delete</a>
                            @elseif($wnew->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wnew->id),'tab'=>Crypt::encrypt('new')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wnew->id}}" type="button" class="btn btn-primary editnewmodal">Edit</button>
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wnew->id,'rel'=>'new'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($wnew->status =='1' || $wnew->status =='13')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$wnew->publish_time}}</span>
                            <button type="button" rel_id="{{$wnew->id}}" rel="news" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$wnew->id}}" rel="news" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                            @elseif($wnew->status =='2')
                            Submitted For Review : {{$wnew->remarks ??''}}
                            @elseif($wnew->status =='4')
                            <span class="rejected">Rejected</span>
                            @elseif($wnew->status =='11')
                            <button type="button" rel_id="{{$wnew->id}}" rel="delete_request_new" data-live_table_id="{{$wnew->live_table_id}}" class="btn btn-success delete_request">Approve</button>
                            <button type="button" rel_id="{{$wnew->id}}" rel="news" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$wnew->id}}" rel="news" class="btn btn-warning review">Review</button>
                            @else
                            <button type="button" rel_id="{{$wnew->id}}" rel="news" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$wnew->id}}" rel="news" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$wnew->id}}" rel="news" class="btn btn-danger review">Review</button>
                            @endif
                            @endif
                            <button type="button" class="hisoty_btn" data-id="{{ Crypt::encryptString($wnew->id) }}" data-url="{{ route('getWhatsNewHistory') }}">
                              <i class="fas fa-info"></i>
                            </button>
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
          <div class="col-md-12">
            <div style="float:right">

              <a href="{{route('preview-whatsnew')}}" class="btn btn-dark mt-2" target="_blank">Preview </a>
            </div>
          </div>
      </div>
      <div id="Award" class="tabcontent" style="<?php echo ($active == 'award_achievements') ? 'display: block;' : '' ?>">
        <h3>Awards & Achievements</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='9')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleaward" class="btn btn-primary addmoremanubtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead>
                        <tr>
                          <th>
                            S.NO
                          </th>

                          <th>
                            Title
                          </th>
                          <th>
                            En Desription
                          </th>
                          <th>
                            Hi Desription
                          </th>
                          <th>
                            File
                          </th>
                          <th>Status</th>
                          <th>Type</th>
                          <th>Remarks</th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        @php $b = 0; @endphp
                        @foreach($website_award as $awa)

                        <tr>
                          <td>{{$b = $b+1}}</td>
                          <td>{{$awa->title}}</td>
                          <td>{!!$awa->en_description!!}</td>
                          <td>{!!$awa->hi_description!!}</td>
                          <td>
                            @if($awa->image !='')
                            <img src="{{$awa->image}}" style="max-width:80px">
                            @else

                            @endif
                          </td>
                          <td>
                            @if($awa->status =='0' || $awa->status =='12')
                            Created
                            @elseif($awa->status =='1' || $awa->status =='13')
                            Approved
                            @elseif($awa->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($awa->status == '3' || $awa->status =='11')
                            Submitted For Review
                            @elseif($awa->status =='4')
                            <span class="rejected">Rejected</span>
                            @elseif($awa->status =='10')
                            <span class="rejected">Deleted</span>
                            @endif
                          </td>
                          <td>
                            @if($awa->status =='12' || $awa->status =='11' || $awa->status =='13')
                            Deletion 
                            @elseif($awa->type == '1')
                            Modification
                            @endif
                          </td>
                          <td>{{$awa->remarks}}</td>
                          <td>
                            @if(AUTH::user()->user_type =='3')
                            @if($awa->status=='1')
                            <button rel="{{$awa->id}}" type="button" class="btn btn-primary editnewaward">Another Request</button>
                            @elseif($awa->status == '2')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($awa->id),'tab'=>Crypt::encrypt('award')])}}" class="btn btn-success">Submit For Review</a> |
                            <button rel="{{$awa->id}}" type="button" class="btn btn-primary editnewaward">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $awa->id,'rel'=>'award'])}}">Delete</a>
                            @elseif($awa->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($awa->id),'tab'=>Crypt::encrypt('award')])}}" class="btn btn-success">Submit For Review</a> |
                            <button rel="{{$awa->id}}" type="button" class="btn btn-primary editnewaward">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $awa->id,'rel'=>'award'])}}">Delete</a>
                            @elseif($awa->status == '12')
                            <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($awa->id),'tab'=>Crypt::encrypt('award_request_for_delete')])}}" class="btn btn-success">Submit For Review</a> |
                            <button rel="{{$awa->id}}" type="button" class="btn btn-primary editnewaward">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $awa->id,'rel'=>'award'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($awa->status =='1' || $awa->status =='10')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$awa->publish_time}}</span>
                            <button type="button" rel_id="{{$awa->id}}" rel="award" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$awa->id}}" rel="award" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                            @elseif($awa->status =='2')
                            Submitted For Review : {{$awa->remarks ??''}}
                            @elseif($awa->status =='4')
                            <span class="rejected">Rejected</span>
                            @elseif($awa->status =='11')
                            <button type="button" rel_id="{{$awa->id}}" rel="award_for_delete" class="btn btn-success delete_request">Approve</button>
                            <button type="button" rel_id="{{$awa->id}}" rel="award" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$awa->id}}" rel="award" class="btn btn-warning review">Review</button>
                            @else
                            <button type="button" rel_id="{{$awa->id}}" rel="award" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$awa->id}}" rel="award" class="btn btn-danger reject">Reject</button>
                            <button type="button" rel_id="{{$awa->id}}" rel="award" class="btn btn-warning review">Review</button>
                            @endif
                            @endif
                            <button type="button" class="hisoty_btn" data-id="{{ Crypt::encryptString($awa->id) }}" data-url="{{ route('getAwardAchievementHistory') }}">
                              <i class="fas fa-info"></i>
                            </button>
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
          <div class="col-md-12">
            <div style="float:right">

              <a href="{{route('preview-award')}}" class="btn btn-dark mt-2" target="_blank">Preview </a>
            </div>
          </div>
      </div>
      <div id="Whois" class="tabcontent" style="<?php echo ($active == 'whois') ? 'display: block;' : '' ?>">
        <h3>Who's Who</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='9')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#examplewhois" class="btn btn-primary addmoremanubtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead>
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Department(English)
                          </th>
                          <th>
                            Department(Hindi)
                          </th>
                          <th>
                            Designation(English)
                          </th>
                          <th>
                            Designation(Hindi)
                          </th>
                          <th>
                            Name(English)
                          </th>
                          <th>
                            Name(Hindi)
                          </th>
                          <th>
                            Contact No.
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Image
                          </th>
                          <th>Status</th>
                          <th>Type</th>
                          <th>
                            Remarks
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        @php $b = 0; @endphp
                        @foreach($website_whois as $whos)
                        <tr>
                          <td>{{$b = $b+1}}</td>
                          <td>{{$whos->en_department}}</td>
                          <td>{{$whos->hi_department}}</td>
                          <td>{{$whos->en_designation}}</td>
                          <td>{{$whos->hi_designation}}</td>
                          <td>{{$whos->en_name}}</td>
                          <td>{{$whos->hi_name}}</td>
                          <td>{{$whos->phone_no}}</td>
                          <td>{{$whos->email}}</td>
                          <td>
                            @if($whos->image !='')
                            <img src="{{$whos->image}}" style="max-width:80px">
                            @else

                            @endif
                          </td>
                          <!-- <td><button rel="{{$whos->id}}" type="button" class="btn btn-primary editwho">Edit</button></td> -->

                          <td>
                          @if($whos->status =='0' || $whos->status =='12')
                            Created
                            @elseif($whos->status =='1' || $whos->status =='13')
                            Approved
                            @elseif($whos->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($whos->status == '3' || $whos->status =='11')
                            Submitted For Review
                            @elseif($whos->status =='4')
                            <span class="rejected">Rejected</span>
                            @endif
                          </td>
                          <td>
                            @if($whos->status =='12' || $whos->status =='11' || $whos->status =='13')
                            Deletion
                            @elseif($whos->type == '1')
                            Modification
                            @endif
                          </td>
                          <td>{{$whos->remarks}}</td>
                          <td>
                            @if(AUTH::user()->user_type =='3')
                            @if($whos->status =='1')
                            <button rel="{{$whos->id}}" type="button" class="btn btn-primary editwho">Another Request</button>
                            @elseif($whos->status == '2')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($whos->id),'tab'=>Crypt::encrypt('whois')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$whos->id}}" type="button" class="btn btn-primary editwho">Edit</button>
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $whos->id,'rel'=>'whois'])}}">Delete</a>
                            @elseif($whos->status =='12')
                            <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($whos->id),'tab'=>Crypt::encrypt('whois_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$whos->id}}" live="{{$whos->live_table_id}}" type="button" class="btn btn-primary editwho">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $whos->id,'rel'=>'whois'])}}">Delete</a>
                            @elseif($whos->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($whos->id),'tab'=>Crypt::encrypt('whois')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$whos->id}}" type="button" class="btn btn-primary editwho">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $whos->id,'rel'=>'whois'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($whos->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$whos->publish_time}}</span>
                            <button type="button" rel_id="{{$whos->id}}" rel="who" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$whos->id}}" rel="who" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                            @elseif($whos->status =='2')
                            Submitted For Review : {{$whos->remarks ??''}}
                            @elseif($whos->status =='4')
                            <span class="rejected">Rejected</span>
                            @elseif($whos->status =='11')
                            <button type="button" rel_id="{{$whos->id}}" rel="delete_request_whos" data-live_table_id="{{$whos->live_table_id}}" class="btn btn-success delete_request">Approve</button>
                            <button type="button" rel_id="{{$whos->id}}" rel="who" class="btn btn-success reject">Reject</button>
                            <button type="button" rel_id="{{$whos->id}}" rel="who" class="btn btn-danger review">Review</button>
                            @else
                            <button type="button" rel_id="{{$whos->id}}" rel="who" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$whos->id}}" rel="who" class="btn btn-success reject">Reject</button>
                            <button type="button" rel_id="{{$whos->id}}" rel="who" class="btn btn-danger review">Review</button>
                            @endif
                            @endif
                            <button type="button" class="hisoty_btn" data-id="{{ Crypt::encryptString($whos->id) }}" data-url="{{ route('getWhosWhoHistory') }}">
                              <i class="fas fa-info"></i>
                            </button>
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
      <div id="Tokyo" class="tabcontent">
        <h3>Manufacturing Facility</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='9')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleManu" class="btn btn-primary addmoremanubtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead>
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Title
                          </th>
                          <th>
                            Image
                          </th>
                          <th>
                            Description
                          </th>
                          <!-- <th>
                            Remard
                          </th> -->
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($facility_count >0)
                        @php $b = 0; @endphp
                        @foreach($website_manufacturing_facility as $mn)
                        <tr>
                          <td>{{$b = $b+1}}</td>
                          <td>{{$mn->title}}</td>
                          <td><img src="{{$mn->image}}" style="max-width:80px;"></td>
                          <td>{!!$mn->description!!}</td>
                          <td><button rel="{{$mn->id}}" type="button" class="btn btn-primary editmanumodal">Edit</button></td>
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
      </div>
      <div id="India" class="tabcontent" style="<?php echo ($active == 'unit_website_contact') ? 'display: block;' : '' ?>">
        <h3>Contact Details</h3>

        <div class="row">
          @if(AUTH::user()->user_type !='9')
          <div class="row col-md-12">
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
                          Address(English)
                        </th>
                        <th>
                          Address(Hindi)
                        </th>
                        <th>
                          Phone Number
                        </th>
                        <th>
                          Fax Number
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Map Link
                        </th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      @php $a = 0; @endphp
                      @foreach($contactdetails as $wc)
                      <tr>
                        <td>{{$a = $a+1}}</td>
                        <td>{{$wc->en_address ??''}}</td>
                        <td>{{$wc->hi_address ??''}}</td>
                        <td>{{$wc->phone_no ??''}}</td>
                        <td>{{$wc->fax_no ??''}}</td>
                        <td>{{$wc->email_id ??''}}</td>
                        <td>{{$wc->map_link ??''}}</td>
                        <td>
                        @if($wc->status =='0' || $wc->status =='12')
                            Created
                            @elseif($wc->status =='1' || $wc->status =='13')
                            Approved
                            @elseif($wc->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($wc->status == '3' || $wc->status =='11')
                            Submitted For Review
                            @elseif($wc->status =='4')
                            <span class="rejected">Rejected</span>
                            @endif
                          </td>
                          <td>
                            @if($wc->status =='12' || $wc->status =='11' || $wc->status =='13')
                            Deletion
                            @elseif($wc->type == '1')
                            Modification
                            @endif
                          </td>
                        <td>
                          {{$wc->remarks ??''}}
                        </td>
                        <td>
                          @if(AUTH::user()->user_type =='3')
                          @if($wc->status == '1')
                          <button rel="{{$wc->id}}" type="button" class="btn btn-primary editcontactmodal">Another Request</button>
                          @elseif($wc->status == '2')
                          <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wc->id),'tab'=>Crypt::encrypt('contact')])}}" class="btn btn-success">Submit For Review</a>
                          <button rel="{{$wc->id}}" type="button" class="btn btn-primary editcontactmodal">Edit</button> |
                          <a class="btn btn-danger" href="{{route('del-content',['id' => $wc->id,'rel'=>'contact'])}}">Delete</a>
                          @elseif($wc->status =='12')
                            <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($wc->id),'tab'=>Crypt::encrypt('contact_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wc->id}}" live="{{$wc->live_table_id}}" type="button" class="btn btn-primary editcontactmodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wc->id,'rel'=>'contact'])}}">Delete</a>
                          @elseif($wc->status == '0')
                          <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wc->id),'tab'=>Crypt::encrypt('contact')])}}" class="btn btn-success">Submit For Review</a>
                          <button rel="{{$wc->id}}" type="button" class="btn btn-primary editcontactmodal">Edit</button> |
                          <a class="btn btn-danger" href="{{route('del-content',['id' => $wc->id,'rel'=>'contact'])}}">Delete</a>
                          @endif
                          @elseif(AUTH::user()->user_type=='9')
                          @if($wc->status =='1')
                          <span class="mt-2 p-2 bg-white text-dark">Approved {{$wc->publish_time}}</span>
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                          @elseif($wc->status =='2')
                          Submitted For Review : {{$wc->remarks ??''}}
                          @elseif($wc->status =='4')
                          <span class="rejected">Rejected</span>

                         @elseif($wc->status =='11')
                          <button type="button" rel_id="{{$wc->id}}" rel="delete_request_contact" data-live_table_id="{{$wc->live_table_id}}" class="btn btn-success delete_request">Approve</button>
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="btn btn-success reject">Reject</button>
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="btn btn-danger review">Review</button>
                          @else
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="btn btn-success approve">Approve</button>
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="btn btn-success reject">Reject</button>
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="btn btn-danger review">Review</button>
                          @endif
                          @endif
                          <button type="button" class="hisoty_btn" data-id="{{ Crypt::encryptString($wc->id) }}" data-url="{{ route('getContactDetailHistory') }}">
                            <i class="fas fa-info"></i>
                          </button>
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
      <div id="America" class="tabcontent" style="<?php echo ($active == 'website_slider_images') ? 'display: block;' : '' ?>">
        <h3>Slider Images</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type!='9')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleSlide" class="btn btn-primary addmorebtn">Add More</button>
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
                          <th>Sequence</th>
                          <th>
                            Image
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Type
                          </th>
                          <th>Remarks</th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        <?php $mytime = Carbon\Carbon::now();
                        $current = $mytime->toDateTimeString();
                        ?>
                        @php $c = 0; @endphp
                        @if($slider_count > 0)
                        @foreach($slider_images_all as $si)

                        <tr>
                          <td>{{$c = $c+1}}</td>
                          <td>{{$si->sequence ??''}}</td>
                          <td><img src="{{$si->slider_image}}" style="max-width:80px" /></td>
                          <td>
                            @if($si->status =='0' || $si->status =='12')
                            Created
                            @elseif($si->status =='1' || $si->status =='13')
                            Approved
                            @elseif($si->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($si->status == '3' || $si->status =='11')
                            Submitted For Review
                            @elseif($si->status =='4')
                            <span class="rejected">Rejected</span>
                            @endif
                          </td>
                          <td>
                            @if($si->status =='12' || $si->status =='11' || $si->status =='13')
                            Deletion
                            @elseif($si->type == '1')
                            Modification
                            @endif
                          </td>
                          <td>{{$si->remarks}}</td>
                          <td>
                            @if(AUTH::user()->user_type =='3')
                            @if($si->status =='1')
                            <button rel="{{$si->id}}" type="button" class="btn btn-primary editimage">Another Request</button>

                            @elseif($si->status =='12')
                            <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($si->id),'tab'=>Crypt::encrypt('slider_image_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$si->id}}" live="{{$si->live_table_id}}" type="button" class="btn btn-primary editimage">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $si->id,'rel'=>'slider_image'])}}">Delete</a>
                            @elseif($si->status == '2')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($si->id),'tab'=>Crypt::encrypt('slider_image')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$si->id}}" live="{{$si->live_table_id}}" type="button" class="btn btn-primary editimage">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $si->id,'rel'=>'slider_image'])}}">Delete</a>
                            @elseif($si->status == '0')

                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($si->id),'tab'=>Crypt::encrypt('slider_image')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$si->id}}" live="{{$si->live_table_id}}" type="button" class="btn btn-primary editimage">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $si->id,'rel'=>'slider_image'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($si->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$si->publish_time}}</span>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                            @elseif($si->status =='2')
                            Submitted For Review : {{$si->remarks ??''}}
                            @elseif($si->status =='4')
                            <span class="rejected">Rejected</span>
                            @elseif($si->status =='11')
                            <button type="button" rel_id="{{$si->id}}" rel="delete_request_slider" data-live_table_id="{{$si->live_table_id}}" class="btn btn-danger delete_request">Approve</button>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="btn btn-success reject">Reject</button>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="btn btn-danger review">Review</button>
                            @else
                            <a href="{{route('preview-slider-image',['id' => $si->id])}}" class="btn btn-dark">Preview</a>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="btn btn-success reject">Reject</button>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="btn btn-danger review">Review</button>
                            @endif
                            @endif
                          </td>
                          <td>
                            <button type="button" class="hisoty_btn" data-id="{{ Crypt::encryptString($si->id) }}" data-url="{{ route('getSliderImageHistory') }}">
                              <i class="fas fa-info"></i>
                            </button>
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
            <div class="col-md-12">
              <div style="float:right">

                <a href="{{route('preview-slider-image')}}" class="btn btn-dark mt-2" target="_blank">Preview </a>
              </div>
            </div>
          </div>

        </form>
      </div>
      <!----------------------------------------->

      <div id="cmd_msg" class="tabcontent" style="<?php echo ($active == 'cmd_msg') ? 'display: block;' : '' ?>">
        <div class="col-md-12">
          <div class="d-inline">
            <h3>CMD Message</h3>
          </div>
          <div class="d-inline">
            <a class="btn btn-primary float-right" href="{{route('add-cmd-message')}}">Add CMD Message</a>
          </div>

          <div class="card bgcard p-2">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-responsive table-striped datatable">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Image</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Type</th>
                      <th>Remarks</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $a = 0; @endphp
                    @foreach($data as $dt)
                    <tr>
                      <td>{{$a = $a+1}}</td>
                      <td>@if($dt->image !='')
                        <img src="{{asset($dt->image)}}" style="max-width:80px" />
                        @endif
                      </td>
                      <td>{!!$dt->en_description!!} ({!!$dt->hi_description!!})</td>
                      <td>
                            @if($dt->status =='0' || $dt->status =='12')
                            Created
                            @elseif($dt->status =='1' || $dt->status =='13')
                            Approved
                            @elseif($dt->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($dt->status == '3' || $dt->status =='11')
                            Submitted For Review
                            @elseif($dt->status =='4')
                            <span class="rejected">Rejected</span>
                            @endif
                          </td>
                          <td>
                            @if($dt->status =='12' || $dt->status =='11' || $dt->status =='13')
                            Deletion
                            @elseif($dt->type == '1')
                            Modification
                            @elseif($dt->type == '2')
                            Deletion
                            @endif
                          </td>
                      <td>{{$dt->remarks}}</td>
                      <td>
                        @if(AUTH::user()->user_type =='3')
                        @if($dt->status == '1')
                        <a href="{{route('edit-cmd-message',['id' => Crypt::encrypt($dt->id)])}}" type="button" class="btn btn-primary">Another Request</a>
                        @elseif($dt->status == '2')
                        <a href="{{route('edit-cmd-message',['id' => Crypt::encrypt($dt->id)])}}" type="button" class="btn btn-primary">Edit</a>
                        <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($dt->id),'tab'=>Crypt::encrypt('cmd_message')])}}" class="btn btn-success">Submit For Review</a>
                        <a class="btn btn-danger" href="{{route('del-content',['id' => $dt->id,'rel'=>'cmd_message'])}}">Delete</a>
                        @elseif($dt->status == '12')
                        <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($dt->id),'tab'=>Crypt::encrypt('cmd_message_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                        <a href="{{route('edit-cmd-message',['id' => Crypt::encrypt($dt->id)])}}" type="button" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{route('del-content',['id' => $dt->id,'rel'=>'cmdmessage'])}}">Delete</a>
                        @elseif($dt->status == '0')
                        <a href="{{route('cmd-preview',['id' => Crypt::encrypt($dt->id)])}}" class="btn btn-success">Preview</a>
                        <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($dt->id),'tab'=>Crypt::encrypt('cmd_message')])}}" class="btn btn-success">Submit For Review</a>

                        <a href="{{route('edit-cmd-message',['id' => Crypt::encrypt($dt->id)])}}" type="button" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{route('del-content',['id' => $dt->id,'rel'=>'cmd_message'])}}">Delete</a>
                        @endif
                        @elseif(AUTH::user()->user_type=='9')
                        @if($dt->status =='1')
                        <span class="mt-2 p-2 bg-white text-dark">Approved {{$dt->publish_time}}</span>
                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>

                        @elseif($dt->status =='2')
                        Submitted For Review : {{$dt->remarks ??''}}]

                        @elseif($dt->status =='11' || $dt->type =='2')
                        <button type="button" rel_id="{{$dt->id}}" rel="delete_request_cmdmessage" data-live_table_id="{{$dt->live_table_id}}" class="btn btn-success delete_request">Approve</button>
                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-danger reject">Reject</button>
                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-danger review">Review</button>
                        @else
                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-success approve">Approve</button>
                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-danger reject">Reject</button>
                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-danger review">Review</button>
                        @endif
                        @endif
                        <button type="button" class="hisoty_btn" data-id="{{ Crypt::encryptString($dt->id) }}" data-url="{{ route('getCmdMsgHistory') }}">
                          <i class="fas fa-info"></i>
                        </button>
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
  </div>
</div>
</div>
<!-----------------------------------------MODALS---------------------------------------------->
<!-------------------------------------------About------------------------------------------------->
<div class="modal fade" id="exampleWebsite" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Website About Content</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('save-unit-website')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>English Title</label><span>*</span>
            <input type="text" required class="form-control" name="en_title">
          </div>
          <div class="form-group">
            <label>Hindi Title</label><span>*</span>
            <input type="text" required class="form-control" name="hi_title">
          </div>
          <div class="form-group">
            <label>English Sub Title</label>
            <input type="text" class="form-control" name="en_sub_title">
          </div>
          <div class="form-group">
            <label>Hindi Sub Title</label>
            <input type="text" class="form-control" name="hi_sub_title">
          </div>
          <div class="form-group">
            <label>English Description</label><span>*</span>
            <textarea class="form-control" required name="en_about_description"></textarea>
          </div>
          <div class="form-group">
            <label>Hindi Description</label><span>*</span>
            <textarea class="form-control" required name="hi_about_description"></textarea>
          </div>
          <div class="form-group">
            <label>Logo</label>
            <input type="file" class="form-control" class="form-control" name="website_logo">
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
<!-------------------------------------------End About------------------------------------------------->
<!-------------------------------------------Contact------------------------------------------------->
<div class="modal fade" id="exampleContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('save-unit-contact')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Address(English)</label><span>*</span>
            <textarea class="form-control" required name="en_address"></textarea>
          </div>
          <div class="form-group">
            <label>Address(Hindi)</label><span>*</span>
            <textarea class="form-control" required name="hi_address"></textarea>
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input class="form-control" required name="phone_no" type="text">
          </div>
          <div class="form-group">
            <label>CIN Number</label>
            <input class="form-control" required name="cin_no" type="text">
          </div>
          <div class="form-group">
            <label>Fax Number</label>
            <input class="form-control" name="fax_no" type="text">
          </div>
          <div class="form-group">
            <label>Email Id</label>
            <input type="email" name="email_id" class="form-control" name="email">
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
            <label>English Description</label>
            <textarea class="form-control" name="en_description"></textarea>
          </div>
          <div class="form-group">
            <label>Hindi Description</label>
            <textarea class="form-control" name="hi_description"></textarea>
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
            <label>English Title</label>
            <input type="text" class="form-control" name="en_title" />
          </div>
          <div class="form-group">
            <label>Hindi Title</label>
            <input type="text" class="form-control" name="hi_title" />
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
        <h5 class="modal-title" id="exampleModalLabel">Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-unit-product')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" name="product_name" />
          </div>
          <div class="form-group">
            <label>Product Image</label>
            <input type="file" class="form-control" name="product_image" />
          </div>
          <div class="form-group">
            <label>Product Specification</label>
            <textarea class="form-control" name="product_specification"></textarea>
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
            <label>English Milestone</label>
            <input type="text" class="form-control" name="en_milestone" />
          </div>
          <div class="form-group">
            <label>Hindi Milestone</label>
            <input type="text" class="form-control" name="hi_milestone" />
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
            <label>English Description</label>
            <textarea class="form-control en_desc" name="en_descriptionAward"></textarea>
          </div>
          <div class="form-group">
            <label>Hindi Description</label>
            <textarea class="form-control hi_desc" name="hi_descriptionAward"></textarea>
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
            <label>Category</label>
            <select required class="form-control" name="category">
              <option value="">--Select Category--</option>
              <option value="IEM">IEM</option>
              <option value="Vigilance">Vigilance</option>
              <option value="Directory">Directory</option>
            </select>
            <label>Name(English)</label>
            <input type="text" required class="form-control" name="en_name" />
            <label>Name(Hindi)</label>
            <input type="text" required class="form-control" name="hi_name" />
          </div>
          <div class="form-group">
            <label>Department(English)</label>
            <input type="text" required class="form-control" name="en_department" />
          </div>
          <div class="form-group">
            <label>Department(Hindi)</label>
            <input type="text" required class="form-control" name="hi_department" />
          </div>
          <div class="form-group">
            <label>Designation(English)</label>
            <input type="text" required class="form-control" name="en_designation" />
          </div>
          <div class="form-group">
            <label>Designation(Hindi)</label>
            <input type="text" required class="form-control" name="hi_designation" />
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="image" />
          </div>
          <div class="form-group">
            <label>Phone No.</label>
            <input type="text" required class="form-control" name="phone_no" />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" required class="form-control" name="email" />
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
<!-------------------------------------------------------End Reject Modal--------------------------------------------------------->

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
            <input type="datetime-local" class="dateTimePicker form-control delete_request_publish_time" name="date-time" />
            <input type="hidden" name="live_table_id" class="delete_request_live_table_id" />
            <input type="hidden" name="rel" class="delete_request_relation" />
            <input type="hidden" name="relid" class="delete_request_relid" />
          </div>
          <div class="form-group">
            <label>Enter OTP</label>
            <input type="text" required placeholder="Enter OTP" class="form-control delete_request_otpval" name="otp" />
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
@include('backend_component.history-modal')
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

  $('body').on('click', '.reject', function() {
    var rel = $(this).attr('rel');
    var type_id = $(this).attr('rel_id')
    swal({
      title: "Are you sure,You want to reject the Content?",
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
              $('.rejectrelation').val(rel);
              $('.rejectrelid').val(type_id);
              $("#rejectcontent").modal('show');
            }
          }
        });
      }
    });
  });

  $('body').on('click', '.savereject', function() {
    var relation = $('.rejectrelation').val();
    var relid = $('.rejectrelid').val();
    var otpval = $('.rejectotpval').val();
    $.ajax({
      type: 'Post',
      url: "{{url('save-reject')}}",
      data: {
        relation: relation,
        relid: relid,
        otpval: otpval,
        _token: "{{csrf_token()}}"
      },
      success: function(xa) {
        // alert(xa.success);
        if (xa.success == true) {
          $("#rejectcontent").modal('hide');
          swal({
            title: "Content Rejected!!",
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
          $("#rejectcontent").modal('hide');
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
            title: "Content Approved !!",
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

  $('body').on('click', '.saveapprovalchange', function() {
    var publish_time = $('.change_publish_time').val();
    var relation = $('.change_relation').val();
    var relid = $('.change_relid').val();
    var otpval = $('.change_otpval').val();
    $.ajax({
      type: 'Post',
      url: "{{url('save-change-approval')}}",
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
          $("#approvecontentchangesch").modal('hide');
          swal({
            title: "Content Approved !!",
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
          $("#approvecontentchangesch").modal('hide');
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

  $('body').on('click', '.cancelapprovalcontent', function() {
    var publish_time = $('.cancel_remarks').val();
    var relation = $('.cancel_relation').val();
    var relid = $('.cancel_relid').val();
    var otpval = $('.cancel_otpval').val();
    $.ajax({
      type: 'Post',
      url: "{{url('cancel-approval')}}",
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
  $('body').on('click', '.changeapprovesch', function() {
    var rel = $(this).attr('rel');
    var type_id = $(this).attr('rel_id')
    swal({
      title: "Are you sure,You want to change date & time?",
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
              $('.change_relation').val(rel);
              $('.change_relid').val(type_id);
              $("#approvecontentchangesch").modal('show');
            }
          }
        });
      }
    });
  });

  $('body').on('click', '.cancelapproval', function() {
    var rel = $(this).attr('rel');
    var type_id = $(this).attr('rel_id')
    swal({
      title: "Are you sure,You want to cancel Approval?",
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
              $('.cancel_relation').val(rel);
              $('.cancel_relid').val(type_id);
              $("#approvalcancelcontent").modal('show');
            }
          }
        });
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



  $('body').on('click', '.editproductmodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-unit-product')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
        CKEDITOR.replace('edit_product_specification');
        CKEDITOR.replace('edit_manu_description');
      }
    });
  });

  $('body').on('click', '.editaboutmodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-unit-about')}}" + '/' + pro_id,
      success: function(data) {
        if (data.status == 200) {

            $('.editmodalbyajax').html(data.html);
            } 
        $('.editmodalbyajax').modal('show');
        CKEDITOR.replace('edit_manu_description');
        CKEDITOR.replace('edit_en_about_description');
        CKEDITOR.replace('edit_hi_about_description');
      }
    });
  });

  $('body').on('click', '.editcontactmodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-unit-contact')}}" + '/' + pro_id,
      success: function(data) {
                if (data.status == 200) {

              $('.editmodalbyajax').html(data.html);
              } 
        $('.editmodalbyajax').modal('show');
        CKEDITOR.replace('edit_manu_description');
      }
    });
  });


  $('body').on('click', '.editmanumodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      url: "{{ url('edit-unit-manu')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
        CKEDITOR.replace('edit_manu_description');
      }
    });
  });
  $('body').on('click', '.editmilemodal', function() {
    var pro_id = $(this).attr('rel');

    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-milestone')}}" + '/' + pro_id,
      success: function(data) {
        // alert(data);
           if (data.status == 200) {

            $('.editmodalbyajax').html(data.html);
           }

        $('.editmodalbyajax').modal('show');

      }
    });
  });
  $('body').on('click', '.editmediamodal', function() {
    var pro_id = $(this).attr('rel');

    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-media')}}" + '/' + pro_id,
      success: function(data) {
        if (data.status == 200) {

          $('.editmodalbyajax').html(data.html);
        }

        $('.editmodalbyajax').modal('show');

      }
    });
  });
  $('body').on('click', '.editnewmodal', function() {
    var pro_id = $(this).attr('rel');

    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-what-new')}}" + '/' + pro_id,
      success: function(data) {

        if (data.status == 200) {

          $('.editmodalbyajax').html(data.html);
        }
        $('.editmodalbyajax').modal('show');
        CKEDITOR.replace('en_descriptionWhtsnew');
        CKEDITOR.replace('hi_descriptionWhtsnew');

      }
    });
  });

  $('body').on('click', '.editimage', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      url: "{{ url('edit-slide-image')}}" + '/' + pro_id,
      success: function(data) {
        if (data.status == 200) {

          $('.editmodalbyajax').html(data.html);
        }

        $('.editmodalbyajax').modal('show');
        // CKEDITOR.replace('edit_manu_description');
      }
    });
  });
  $('body').on('click', '.editnewaward', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      url: "{{ url('edit-award')}}" + '/' + pro_id,
      success: function(data) {
        if (data.status == 200) {

          $('.editmodalbyajax').html(data.html);
          
          }
       
        $('.editmodalbyajax').modal('show');
        CKEDITOR.replace('en_descriptionAwardedit');
        CKEDITOR.replace('hi_descriptionAwardedit');
      }
    });
  });
  $('body').on('click', '.editwho', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      url: "{{ url('edit-who')}}" + '/' + pro_id,
      success: function(data) {
                  if (data.status == 200) {

          $('.editmodalbyajax').html(data.html);

          }
        $('.editmodalbyajax').modal('show');
      }
    });
  });



  $('body').on('change', '.slide_product', function() {
    var pro_id = $(this).attr('rel');
    var vl = $(this).val();
    $.ajax({
      type: 'Post',
      url: "{{url('approve-slide-image')}}",
      data: {
        id: pro_id,
        val: vl,
        _token: "{{csrf_token()}}"
      }

    });
  });

  CKEDITOR.replace('en_about_description');
  CKEDITOR.replace('hi_about_description');
  CKEDITOR.replace('en_description');
  CKEDITOR.replace('hi_description');
  CKEDITOR.replace('en_descriptionAward');
  CKEDITOR.replace('hi_descriptionAward');
  CKEDITOR.replace('product_specification');
  CKEDITOR.replace('edit_product_specification');
  CKEDITOR.replace('manu_description');
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