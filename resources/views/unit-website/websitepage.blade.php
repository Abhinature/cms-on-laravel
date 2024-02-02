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
      <!-- <h6>Add @if(AUTH::user()->unit_id == '0') Home Page @else Website Content @endif</h6> -->
      <!-- <h6 style ="float:right;">@if(AUTH::user()->user_type == '9') SuperAdmin @else Admin @endif</h6> -->
    </div>
    <div class="card-body">
      <div class="tab" id="myTab">
        @if($active =='website_slider_images')
        <button class="tablinks <?php echo ($active =='website_slider_images')?'active':'';?>" onclick="openCity(event, 'America')">Slider Images</button>
        @endif
        @if($active =='unit_websites')
        <button class="tablinks <?php echo ($active =='unit_websites')?'active':'';?>" onclick="openCity(event, 'London')">About</button>
        @endif
        @if($active =='product')
        <button class="tablinks<?php echo ($active =='product')?'active':'';?>" onclick="openCity(event, 'Paris')">Products</button>
        @endif
        @if(Auth::user()->unit_id =='0')
       
        @if($active =='milestones')
        <button class="tablinks <?php echo ($active =='milestones')?'active':'';?>" onclick="openCity(event, 'Tokyo')">Milestone</button>
        @endif
        <button class="tablinks <?php echo ($active =='media_releases')?'active':'';?>" onclick="openCity(event, 'Tokyo')">Media Release</button>
        <button class="tablinks <?php echo ($active =='whats_news')?'active':'';?>" onclick="openCity(event, 'Tokyo')">What's New</button>
        <button class="tablinks <?php echo ($active =='awards')?'active':'';?>" onclick="openCity(event, 'Tokyo')"> Awards & Achievements</button>
        <!-- <button class="tablinks <?php echo ($active =='manu')?'active':'';?>" onclick="openCity(event, 'Tokyo')"> Vigilance</button> -->

       
        @endif
        
            @if(Auth::user()->unit_id !='0')
            @if($active =='manu')
             <button class="tablinks <?php echo ($active =='manu')?'active':'';?>" onclick="openCity(event, 'Tokyo')">Manufacturing Facility</button>
            @endif
            @endif
            @if($active =='unit_website_contact')
        <button class="tablinks <?php echo ($active =='unit_website_contact')?'active':'';?>" onclick="openCity(event, 'India')">Contact Details</button>
        @endif
      </div>

      <!-- Tab content -->
      <div id="London" class="tabcontent">
        <h4>Website About Content</h4>
       {{--<form method="POST" action="{{route('save-unit-website')}}" enctype="multipart/form-data">
          @foreach($websitedata as $websiteda)
        <div class="row">
            <div class="col-md-12">
              <label>Website Title</label>
              @csrf
              <input type="text" value="{{$websiteda->website_title ??''}}" name="website_title" required class="form-control" />
            </div>
            <div class="col-md-12">
              <label>Sub Title</label>
              <input type="text" value="{{$websiteda->website_sub_title ?? ''}}" name="website_sub_title" required class="form-control" />
            </div>

            <div class="row">
              <div class="col-md-12">
                <label>About Description</label>
                <textarea name="about_description" required class="form-control">{{$websiteda->about_description ??''}} </textarea>
              </div>
            </div>
            <div class="col-md-12">
              <label>Website Logo</label>
              <input type="file" name='website_logo' class="form-control" required />
              <input type="hidden" name="update_website_logo" value="{{$websiteda->website_logo}}" />
            </div>
            @if(($websiteda->website_logo !='')&&($websiteda>website_logo !='null'))
            <div style="float:center;">
              <img style="max-width:200px;float:center;" src="{{$websiteda->website_logo}}" />
            </div>
            @endif
            @endforeach
            <!-- 
            <div class="col-md-12">
              <label>Website Slider Images</label>
              <input type="file" multiple name="slider_images[]" class="form-control" />              
              <sub>Select Upto 5 Images using CTRL.</sub>
            </div> -->
          </div>
          
        </form>--}}
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
                        @if($wb->status =='0')
                        Created
                        @elseif($wb->status =='1')
                        Approved
                        @elseif($wb->status =='2')
                        Sent By Super Admin To Review.
                        @elseif($wb->status == '3')
                        Submitted For Review
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
                        <button rel="{{$wb->id}}" type="button" class="btn btn-primary editaboutmodal">Edit</button>
                        {{--<a class="btn btn-danger" href="{{route('del-slider-image',['id' => $wb->id])}}">Delete</a> --}}
                        @elseif($wb->status == '0')
                        <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wb->id),'tab'=>Crypt::encrypt('about')])}}" class="btn btn-success">Submit For Review</a>
                        <button rel="{{$wb->id}}" type="button" class="btn btn-primary editaboutmodal">Edit</button>
                        @endif
                        @elseif(AUTH::user()->user_type=='9')
                        @if($wb->status =='1')
                        <span class="mt-2 p-2 bg-white text-dark">Approved {{$wb->publish_time}}</span>
                        <button type="button" rel_id="{{$wb->id}}" rel="about" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$wb->id}}" rel="about" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                        @elseif($wb->status =='2')
                        Submitted For Review : {{$wb->remarks ??''}}
                        @else
                        <button type="button" rel_id="{{$wb->id}}" rel="about" class="btn btn-success approve">Approve</button>                        
                        <button type="button" rel_id="{{$wb->id}}" rel="about" class="btn btn-success reject">Reject</button>
                        <button type="button" rel_id="{{$wb->id}}" rel="about" class="btn btn-danger review">Review</button>
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

      
      <div id="Paris" class="tabcontent">
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
                            Status
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
                          <td>{{$wp->product_name}}</td>
                          <td><img src="{{$wp->product_image}}" style="max-width:80px"></td>
                          <td>{!!$wp->product_specification!!}</td>
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
                          <td>
                          
                        @if(AUTH::user()->user_type =='3')
                        @if($wp->status == '1')
                        <button rel="{{$wp->id}}" type="button" class="btn btn-primary editproductmodal">Another Request</button>
                        @elseif($wp->status == '2')
                        <button rel="{{$wp->id}}" type="button" class="btn btn-primary editproductmodal">Edit</button>
                        
                        @elseif($wp->status == '0')
                        <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wp->id),'tab'=>Crypt::encrypt('unit_product')])}}" class="btn btn-success">Submit For Review</a>
                        <button rel="{{$wp->id}}" type="button" class="btn btn-primary editproductmodal">Edit</button>
                        @endif
                        @elseif(AUTH::user()->user_type=='9')
                        @if($wp->status =='1')
                        <span class="mt-2 p-2 bg-white text-dark">Approved</span>
                        <button type="button" rel_id="{{$wp->id}}" rel="unit_product" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="unit_product" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                        @elseif($wp->status =='2')
                        Submitted For Review 
                        @else
                        <button type="button" rel_id="{{$wp->id}}" rel="unit_product" class="btn btn-success approve">Approve</button>
                        <button type="button" rel_id="{{$wp->id}}" rel="unit_product" class="btn btn-success reject">Reject</button>
                        <button type="button" rel_id="{{$wp->id}}" rel="unit_product" class="btn btn-danger review">Review</button>
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
          </div>
  
     

      <div id="Tokyo" class="tabcontent">
        <h3>Manufacturing Facility</h3>
        <form>
          <div class="row mt-2 p-1">
          @if(AUTH::user()->user_type != '9')
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
                          <th>
                            Status
                          </th>
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
                          <td>
                        @if($mn->status =='0')
                        Created
                        @elseif($mn->status =='1')
                        Approved
                        @elseif($mn->status =='2')
                        Sent By Super Admin To Review.
                        @elseif($mn->status == '3')
                        Submitted For Review
                        @endif
                          </td>
                          <td>  
                             
                        @if(AUTH::user()->user_type =='3')
                        @if($mn->status == '1')
                        <button rel="{{$mn->id}}" type="button" class="btn btn-primary editmanumodal">Another Request</button>
                        @elseif($mn->status == '2')
                        <button rel="{{$mn->id}}" type="button" class="btn btn-primary editmanumodal">Edit</button>
                        
                        @elseif($mn->status == '0')
                        <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($mn->id),'tab'=>Crypt::encrypt('manu_facility')])}}" class="btn btn-success">Submit For Review</a>
                        <button rel="{{$mn->id}}" type="button" class="btn btn-primary editmanumodal">Edit</button>
                        @endif
                        @elseif(AUTH::user()->user_type=='9')
                        @if($mn->status =='1')
                        <span class="mt-2 p-2 bg-white text-dark">Approved</span>
                        <button type="button" rel_id="{{$mn->id}}" rel="manu_facility" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$mn->id}}" rel="manu_facility" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                        @elseif($mn->status =='2')
                        Submitted For Review 
                        @else
                        <button type="button" rel_id="{{$mn->id}}" rel="manu_facility" class="btn btn-success approve">Approve</button>
                        <button type="button" rel_id="{{$mn->id}}" rel="manu_facility" class="btn btn-success reject">Reject</button>
                        <button type="button" rel_id="{{$mn->id}}" rel="manu_facility" class="btn btn-danger review">Review</button>
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
      </div>
      <div id="India" class="tabcontent">
        <h3>Contact Details</h3>
        {{--<form action="{{route('save-unit-contact')}}" method="POST">
          @csrf
          @foreach($contactdetails  as $contactdetail)
          <div class="row">
            <div class="col-md-12">
              <label>Address</label>
              <textarea class="form-control" name="address">{{$contactdetail->address ??''}}</textarea>
            </div>
            <div class="col-md-12">
              <label>Phone Number</label>
              <input class="form-control" value="{{$contactdetail->phone_no}}" name="phone_no" type="text">

            </div>
            <div class="col-md-12">
              <label>Fax Number</label>
              <input class="form-control" value="{{$contactdetail->fax_no}}" name="fax_no" type="text">
            </div>
            <div class="col-md-12">
              <label>Email Id</label>
              <input type="email" name="email_id" value="{{$contactdetail->email_id}}" class="form-control" name="email">
            </div>
            <div class="col-md-12">
              <label>Map Link</label>
              <textarea class="form-control" name="map_link">{{$contactdetail->map_link}}</textarea>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-right mt-1">
              <div style="float:right">
                <input type="submit" class="btn btn-success" name="submit">
              </div>
            </div>
          </div>
          @endforeach
        </form>--}}

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
                          Address
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
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      @php $a = 0; @endphp
                      @foreach($contactdetails as $wc)
                      <tr>
                        <td>{{$a = $a+1}}</td>
                        <td>{{$wc->address ??''}}</td>
                        <td>{{$wc->phone_no ??''}}</td>
                        <td>{{$wc->fax_no ??''}}</td>
                        <td>{{$wc->email_id ??''}}</td>
                        <td>{{$wc->map_link ??''}}</td>
                        <td>
                          @if($wc->status =='0')
                          Created
                          @elseif($wc->status =='1')
                          Approved
                          @elseif($wc->status =='2')
                          Sent By Super Admin To Review.
                          @elseif($wc->status == '3')
                          Submitted For Review
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
                          <button rel="{{$wc->id}}" type="button" class="btn btn-primary editcontactmodal">Edit</button>
                          {{--<a class="btn btn-danger" href="{{route('del-slider-image',['id' => $wc->id])}}">Delete</a> --}}
                          @elseif($wc->status == '0')
                          <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wc->id),'tab'=>Crypt::encrypt('contact')])}}" class="btn btn-success">Submit For Review</a>
                          <button rel="{{$wc->id}}" type="button" class="btn btn-primary editcontactmodal">Edit</button>
                          @endif
                          @elseif(AUTH::user()->user_type=='9')
                          @if($wc->status =='1')
                          <span class="mt-2 p-2 bg-white text-dark">Approved {{$wc->publish_time}}</span>
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$wc->id}}" rel="contact" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                          @elseif($wc->status =='2')
                          Submitted For Review : {{$wc->remarks ??''}}
                          @else
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="btn btn-success approve">Approve</button>
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="btn btn-success reject">Reject</button>                          
                          <button type="button" rel_id="{{$wc->id}}" rel="contact" class="btn btn-danger review">Review</button>
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
      <div id="America" class="tabcontent">
        <h3>Slider Images</h3>
        <form>
          <div class="row mt-2 p-1">
          @if(AUTH::user()->user_type != '9')
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
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @php $c = 0; @endphp
                        @if($slider_count > 0)
                        @foreach($slider_images_all as $si)
                        <tr>

                        
                          <td>{{$c = $c+1}}</td>
                          <td>{{$si->sequence}}</td>
                          <td><img src="{{$si->slider_image}}" style="max-width:80px"/></td>
                          <td>
                            @if($si->status =='0')
                            Created
                            @elseif($si->status =='1')
                            Approved
                            @elseif($si->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($si->status == '3')
                            Submitted For Review
                            @endif
                          </td>


<td>
                            @if(AUTH::user()->user_type =='3')
                            @if($si->status =='1')
                            <button rel="{{$si->id}}" type="button" class="btn btn-primary editimage">Another Request</button>
                            @elseif($si->status == '2')
                            <button rel="{{$si->id}}" live="{{$si->live_table_id}}" type="button" class="btn btn-primary editimage">Edit</button>
                            {{--<a class="btn btn-danger" href="{{route('del-slider-image',['id' => $si->id])}}">Delete</a> --}}
                            @elseif($si->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($si->id),'tab'=>Crypt::encrypt('slider_image')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$si->id}}" live="{{$si->live_table_id}}" type="button" class="btn btn-primary editimage">Edit</button>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($si->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$si->publish_time}}</span>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>
                            @elseif($si->status =='2')
                            Submitted For Review : {{$si->remarks ??''}}
                            @else
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="btn btn-success reject">Reject</button>
                            <button type="button" rel_id="{{$si->id}}" rel="slider_image" class="btn btn-danger review">Review</button>
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
            <label>Address</label><span>*</span>
            <textarea class="form-control" required name="address"></textarea>
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
            <input class="form-control"  name="fax_no" type="text">
          </div>
          <div class="form-group">
          <label>Email Id</label>
            <input type="email" name="email_id"  class="form-control" name="email">
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
            <input type="file" multiple class="form-control" name="slider_image[]" />
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
<!-------------------------------------------------Edit Modal--------------------------------------------------------------->
<div class="modal fade editmodalbyajax" id="exampleEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>
                                    <!-- Approve modal -->
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
<!------------------------------------------------------------------------------------------------------------------->
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
        <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
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

  $('body').on('click', '.editaboutmodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-unit-about')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
        CKEDITOR.replace('edit_manu_description');
        CKEDITOR.replace('edit_en_about_description');
        CKEDITOR.replace('edit_hi_about_description');
       

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
  $('body').on('click', '.editcontactmodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-unit-contact')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
        CKEDITOR.replace('edit_manu_description');
      }
    });
  });

  $('body').on('click', '.editimage', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      url: "{{ url('edit-slide-image')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
        CKEDITOR.replace('edit_manu_description');
      }
    });
  });
  CKEDITOR.replace('manu_description');
  CKEDITOR.replace('product_specification');
  CKEDITOR.replace('en_about_description');
  CKEDITOR.replace('hi_about_description');
  
 
</script>
<script>
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});

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
  $('body').on('click','.saveapprovalchange',function(){
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

  $('body').on('click','.cancelapprovalcontent',function(){
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
  $('body').on('click','.changeapprovesch',function(){
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

  $('body').on('click','.cancelapproval',function(){
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
</script>
@include('delete_request');
@endsection