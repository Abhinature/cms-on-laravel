@extends('layouts.admin.app')

@section('content')
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
    
    <div class="card mb-4">
		<div class="card-body">
            <form action="{{ route('translation.save') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Slug</label>
                    <input type="text" name="slug" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">English</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                @foreach($language as $key => $val)
                    @if( $val->title != "English" ) 
                    <div class="form-group">
                        <label for="">Hindi</label>
                        <input type="text" name="name_{{$val->id}}" id="" class="form-control">
                    </div>
                    @endif
                @endforeach

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection