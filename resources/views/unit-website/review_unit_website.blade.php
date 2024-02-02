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
        <h1 class="m-0">Website Content</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard / Website Content</li>
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
      <h6> Website Content</h6>
    </div>
    <div class="card-body">
      <div class="tab" id="myTab">
        <button class="tablinks" onclick="openCity(event, 'London')">About</button>
        <!-- <button class="tablinks" onclick="openCity(event, 'Paris')">Products</button> -->
        <!-- <button class="tablinks" onclick="openCity(event, 'Tokyo')">Manufacturing Facility</button> -->
        <button class="tablinks" onclick="openCity(event, 'India')">Contact Details</button>
        <!-- <button class="tablinks" onclick="openCity(event, 'America')">Slider Images</button> -->
      </div>

      <!-- Tab content -->
      <div id="London" class="tabcontent">
        <h4>Website About Content</h4>
      
          <div class="row">
            <div class="col-md-12">
              <label>Website Title</label>
              @csrf
              <input type="text" readonly value="{{$websitedata->website_title ??''}}" name="website_title" required class="form-control" />
            </div>
            <div class="col-md-12">
              <label>Sub Title</label>
              <input type="text" readonly value="{{$websitedata->website_sub_title ?? ''}}" name="website_sub_title" required class="form-control" />
            </div>

            <div class="row">
              <div class="col-md-12">
                <label>About Description</label>
                <textarea name="about_description" readonly required class="form-control">{{$websitedata->about_description ??''}} </textarea>
              </div>
            </div>
            <div class="col-md-12">
              <label>Website Logo</label>
              <!-- <input type="file" name='website_logo' class="form-control" required /> -->
              <!-- <input type="hidden" name="update_website_logo" value="{{$websitedata->website_logo}}" /> -->
            </div>
            @if(($websitedata->website_logo !='')&&($websitedata->website_logo !='null'))
            <div style="float:center;">
              <img style="max-width:200px;float:center;" src="{{$websitedata->website_logo}}" />
            </div>
            @endif
            <!-- 
            <div class="col-md-12">
              <label>Website Slider Images</label>
              <input type="file" multiple name="slider_images[]" class="form-control" />              
              <sub>Select Upto 5 Images using CTRL.</sub>
            </div> -->
          </div>
          <div class="row text-right">
            <div class="col-md-12 mt-1">
              <div style="float:right">
                <input type="button" class="btn btn-success mt-1 float-right" name="submit" value="Approve">
                <input type="button" class="btn btn-danger mt-1 float-right" name="submit" value="Reject">
              </div>
            </div>
          </div>
        

      </div>

      <div id="India" class="tabcontent">
        <h3>Contact Details</h3>
        
          <div class="row">
            <div class="col-md-12">
              <label>Address</label>
              <textarea class="form-control" readonly name="address">{{$contactdetails->address ??''}}</textarea>
            </div>
            <div class="col-md-12">
              <label>Phone Number</label>
              <input class="form-control" readonly value="{{$contactdetails->phone_no}}" name="phone_no" type="text">

            </div>
            <div class="col-md-12">
              <label>Fax Number</label>
              <input class="form-control" readonly value="{{$contactdetails->fax_no}}" name="fax_no" type="text">
            </div>
            <div class="col-md-12">
              <label>Email Id</label>
              <input type="email" readonly name="email_id" value="{{$contactdetails->email_id}}" class="form-control" name="email">
            </div>
            <div class="col-md-12">
              <label>Map Link</label>
              <textarea class="form-control" readonly name="map_link">{{$contactdetails->map_link}}</textarea>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-right mt-2">
              <div style="float:right">
                <input type="button" class="btn btn-success" Value="Approve" name="submit">
                <input type="button" class="btn btn-danger" Value="Reject" name="submit">
              </div>
            </div>
          </div>
      </div>
      <!----------------------------------------->
      <div id="America" class="tabcontent">
        <h3>Slider Images</h3>
        <form>
          <div class="row mt-2 p-1">

            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleSlide" class="btn btn-primary addmorebtn">Add More</button>
              </div>
            </div>
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
                          <td><img src="{{$si->slider_image}}" style="max-width:250px"/></td>
                          <td><button rel="{{$si->id}}" type="button" class="btn btn-primary editimage">Edit</button> | <a class="btn btn-danger" href="{{route('del-slider-image',['id' => $si->id])}}">Delete</a></td>
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

<!------------------------------------------------------------------------------------------------------------------->


<!-- <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> -->
<!-- <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

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
  CKEDITOR.replace('about_description');
  CKEDITOR.replace('product_specification');
  CKEDITOR.replace('edit_product_specification');
  CKEDITOR.replace('manu_description');
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
</script>
@endsection