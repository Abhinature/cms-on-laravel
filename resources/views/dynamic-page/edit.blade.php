@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Page</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Edit Page</li>
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
            <a class="btn btn-primary" href="{{url()->previous();}}">Back</a>
            </div>
            </div>
        <div class="col-sm-12">
            
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Page</h6>
                </div>
                <div class="card-body px-1 pt-0 pb-2">
                <form method="POST" action="{{route('updatepage')}}">
            <div class="card-body px-1 pt-0 pb-2">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        @csrf
                        <div class="form-group">
                            <label>Enter Page Title</label>
                            <input type="text" value="{{$data->page_title}}" required name="page_title" class="form-control" />
                        </div>
                    </div>
                 
                    <input type="hidden" value="{{Crypt::encrypt($data->id)}}" name="hid"/>
                    <div class="col-sm-12 col-md-6">
                      
                        <div class="form-group">
                            <label>Enter Page Slug</label>
                            <input type="text" value="{{$data->slug}}" required name="slug" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                       
                        <div class="form-group">
                            <label>Parent Page</label>
                           <select class="form-control" name="parent_page">
                            <option value="">----Select Parent Page----</option>
                            @foreach($unit as $u)
                            <option <?php echo ($data->parent_page == $u->id)?'selected':'' ?> value="{{$u->id}}">{{$u->page_title}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      
                        <div class="form-group">
                            <label>Enter Meta Title</label>
                            <input type="text" value="{{$data->meta_title}}"  name="meta_title" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        
                        <div class="form-group">
                            <label>Enter Meta Keyword</label>
                            <input type="text" value="{{$data->meta_keyword}}"  name="meta_keyword" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                       
                        <div class="form-group">
                            <label>Enter Meta Description</label>
                            <input type="text" value="{{$data->meta_description}}"  name="meta_description" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                       
                        <div class="form-group">
                            <label>Enter Page Description</label>
                            <textarea required name="description" class="form-control">
                            {{$data->description}}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                       
                   </div>
                   <div class="col-sm-12 col-md-4">
                       
                    </div>
                    <div class="col-sm-12 col-md-4 float-right">   
                        <div style="float:right">                    
                    <input type="submit" class="btn btn-success" />
                        </div>
                    </div>
                    
                </div>
        </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace('description');
</script>





    @endsection