@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">CMD Message</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / CMD Message</li>
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
            <a class="btn btn-primary" href="{{url()->previous()}}">Back</a>
            </div>
            </div>
        <div class="col-sm-12">
            
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <!-- <h6>Message</h6> -->
                </div>
                <div class="card-body px-1 pt-0 pb-2">
                    <form method="POST" enctype="multipart/form-data" action="{{route('save-cmd-message')}}">
                        @csrf
                        <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Message (English)</label>
                        <textarea required name="en_description" class="form-control"></textarea>
                      </div>  
                      <div class="form-group">
                        <label>Message (Hindi)</label>
                        <textarea  name="hi_description" class="form-control"></textarea>
                      </div> 
                            <input type="submit" class="btn btn-success"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace('en_description');
   CKEDITOR.replace('hi_description');
</script>

@endsection

