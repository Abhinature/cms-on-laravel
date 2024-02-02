@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Units</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Unit</li>
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
            <a class="btn btn-primary" href="{{route('add-unit')}}">Edit Unit</a>
            </div>
            </div>
        <div class="col-sm-12">
            
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Unit</h6>
                </div>
                <div class="card-body px-1 pt-0 pb-2">
                    <form method="POST" action="{{route('updateunit')}}">
                        @csrf
                      <div class="form-group">
                        <label>Enter Unit Name</label>
                        <input type="hidden" value="{{Crypt::encrypt($data->id)}}" name="hid"/>
                        <input type="text" value="{{$data->unit_name}}" required name="unit_name" class="form-control"/>
                      </div>  
                            <input type="submit" class="btn btn-success"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>








    @endsection