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
        <h1 class="m-0">Products</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard / Product</li>
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
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>S.no</th>
              <th>Title</th>
              <th>Image</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php $a = 0; @endphp
            @foreach($manufacturing as $wp)
            <tr>
              <th>{{$a = $a+1;}}</th>
              <th>{{$wp->title}}</th>
              <th><img style="max-width:80px;" src="{{$wp->image}}"/></th>
              <th>{!!$wp->description!!}</th>
              <th>
                <a class="btn btn-success" href="#">Approve</a> | 
                <button class="btn btn-danger rejectproduct">Reject</button> |
                 <button class="btn btn-danger">Delete</button>
                
              </th>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
</div>



<!------------------------------------------------------------------------------------------------------------------->


<!-- <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> -->
<!-- <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

<script type="text/javascript">
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