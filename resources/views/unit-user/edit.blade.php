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
                    <li class="breadcrumb-item active">Dashboard / Edit Unit User</li>
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
            <a class="btn btn-primary" href="{{route('add-unit-user')}}">Edit Unit User</a>
            </div>
            </div>
        <div class="col-sm-12">
            
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Unit User</h6>
                </div>
                <div class="card-body px-1 pt-0 pb-2">
                <form method="POST" autocomplete="off" action="{{route('updateunituser')}}">                    
                        @csrf
                        <input type="hidden" value="{{Crypt::encrypt($data->id)}}" name="hid"/>
                      <div class="form-group">
                        <label>Select Unit</label>
                        <select class="form-control" required name="unit_id">
                            <option value="">---Select Unit---</option>
                            @foreach($unit as $u)
                            <option <?php echo ($data->unit_id == $u->id)?'selected':''; ?> value="{{$u->id}}">{{$u->unit_name}}</option>
                            @endforeach
                        </select>
                      </div>  
                      <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" required name="user_type">
                            <option value="">---Select Role---</option>
                            <option <?php echo ($data->user_type == '3')?'selected':''; ?> value="3">Admin</option>
                            <option <?php echo ($data->user_type == '9')?'selected':''; ?> value="9">Super Admin</option>                         
                        </select>
                      </div>  
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" value="{{$data->email}}" required name="email" class="form-control"/>
                      </div>  
                      <div class="form-group" style="display:none;">
                        <label>Password</label>
                        <input type="password" value="{{$data->password}}"  required name="password" class="form-control"/>
                      </div>  
                            <input type="submit" class="btn btn-success"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>








    @endsection