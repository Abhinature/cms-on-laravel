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

<div class="row">
    <div class="col-sm-12">
        <div class="card mb-4 p-3">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <h6>List of Unit's</h6>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-primary float-end" href="{{route('add-unit')}}">Add Unit</a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@include('delete_request');
@endsection

@push('script')
{{ $dataTable->scripts() }}
@endpush 