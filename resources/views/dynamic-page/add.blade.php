@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Page</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Page</li>
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
                <a class="btn btn-primary" href="{{route('add-page')}}">Add Page</a>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Add Page</h6>
        </div>
        <form method="POST" action="{{route('insertpage')}}">
            <div class="card-body px-1 pt-0 pb-2">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        @csrf
                        <div class="form-group">
                            <label>Enter Page Title</label>
                            <input type="text" required name="page_title" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      
                        <div class="form-group">
                            <label>Enter Page Slug</label>
                            <input type="text" required name="slug" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                       
                        <div class="form-group">
                            <label>Parent Page</label>
                           <select class="form-control" name="parent_page">
                            <option value="">----Select Parent Page----</option>
                            @foreach($unit as $u)
                            <option value="{{$u->id}}">{{$u->page_title}}</option>
                            @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      
                        <div class="form-group">
                            <label>Enter Meta Title</label>
                            <input type="text"  name="meta_title" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        
                        <div class="form-group">
                            <label>Enter Meta Keyword</label>
                            <input type="text"  name="meta_keyword" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                       
                        <div class="form-group">
                            <label>Enter Meta Description</label>
                            <input type="text"  name="meta_description" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                       
                        <div class="form-group">
                            <label>Enter Page Description</label>
                            <textarea required name="description" class="form-control">

                            </textarea>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12 col-md-6">
                       
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">-----Select Status----</option>
                                <option value="1">Publish</option>
                                <option value="0">Not Publish</option>
                            </select>
                        </div>
                    </div> -->



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






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace('description');
</script>

@endsection