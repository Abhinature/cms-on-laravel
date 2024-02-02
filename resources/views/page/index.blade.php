@extends('layouts.admin.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Custom Page</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Custom Page</li>
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
        
        
        
        {!!displayAlert()!!}
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-stripped">
                        <a href="{{route('page.add')}}" class="btn btn-primary float-end mt-3 d-block mr-3">Add Custom page</a>
                        {!! $dataTable->table() !!}
                    </table>
                </div>
                
                @include('backend_component.history-modal')
                
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
{{ $dataTable->scripts() }}
@endpush 
