@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Edit CMD Message</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Edit CMD Message</li>
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
                    
                    <form method="POST" enctype="multipart/form-data" action="{{route('update-cmd-message')}}">
                        @csrf
                       
                       
                        @if($content->live_table_id !=0 && $content->status != 0 &&  $content->status != 12 && $content->status != 13)
                        <div class="form-group">
                        <label>Request For</label><br>
                        &nbsp;&nbsp;&nbsp; 
                        <input type="radio" class="request_for_delete" rel_id="{{$content->id}}" rel_name="cmd_message" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="request_for_delete" name="request_for" rel_id="{{$content->id}}" rel_name="cmd_message"  value="1" />Modify
                        </div>
                        @endif
                        
                        <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        <input type="hidden" name="update_image" value="{{$content->image ??''}}"/>

                        <input type="hidden" name="hid" value="{{$content->id}}"/>
                      </div>
                      <div class="form-group">
                        <label>Message (English)</label>
                        <textarea required name="en_description" class="form-control">{{$content->en_description ??''}}</textarea>
                      </div>  
                      <div class="form-group">
                        <label>Message (Hindi)</label>
                        <textarea  name="hi_description" class="form-control">{{$content->hi_description ??''}}</textarea>
                      </div> 
                            <input type="submit" class="btn btn-success"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.4.3/js/tempus-dominus.js" integrity="sha512-+czcA0uweh7fUHWI4Yvixi92esLt0Y5TCZ8OitvNyMQ/9Kd1Baha34VKOztXwUgV++aUbgr9sxxniE2dwvNQ6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.4.3/css/tempus-dominus.min.css" integrity="sha512-wO+rVZhTyJgwKxVY279cD/TZTlW2m0IJQXzoOHfj2w//md58T3jc8ZWHb+HEm8CspcCNnaJVFPyRAGd/Y4ScfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
   CKEDITOR.replace('en_description');
   CKEDITOR.replace('hi_description');
</script>
@include('delete_request');
@endsection