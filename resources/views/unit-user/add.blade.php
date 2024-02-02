@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Unit Users</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Unit User</li>
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
            <a class="btn btn-primary" href="{{route('add-unit-user')}}">Add Unit User</a>
            </div>
            </div>
        <div class="col-sm-12">
            
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Add Unit User</h6>
                </div>
                <div class="card-body px-1 pt-0 pb-2">
                    <form method="POST" autocomplete="off" action="{{route('insertunituser')}}">
                        @csrf
                      <div class="form-group">
                        <label>Select Unit</label>
                        <select class="form-control" required name="unit_id">
                            <option value="">---Select Unit---</option>
                            @foreach($unit as $u)
                            <option value="0">Yantra India Limited (यंत्र इंडिया लिमिटेड)</option>
                            <option value="{{$u->id}}">{{$u->en_unit_name ??''}}  ({{$u->hi_unit_name ??''}})</option>
                            @endforeach
                        </select>
                      </div>  
                      <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" required name="user_type">
                            <option value="">---Select Role---</option>
                            <option value="3">Admin</option>
                            <option value="9">Super Admin</option>     
                            <option value="11">Admin Reports</option>
                            <option value="13">Finance Reports</option> 
                            <option value="15">Top Management</option>                     
                        </select>
                      </div>  
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" required name="email" class="form-control"/>
                      </div>                        
                            <input type="submit" name="submit" class="btn btn-success"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>








    @endsection