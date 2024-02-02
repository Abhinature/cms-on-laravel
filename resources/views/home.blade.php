@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        
        <form action="{{ route('home') }}" class="form-inline" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Unit Name</label>
                        <select name="created_by" id="" class="form-control">
                            @foreach( $dropdownOpt as $key => $val )
                                <option value="{{ $key }}" {{ (Auth::user()->unit_id == $key) ? 'selected' : 'disabled' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Start Date</label>
                        <input type="date" class="form-control" name="start_date" value="{{ $startDate }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">End Date</label>
                        <input type="date" class="form-control" name="end_date" value="{{ $endDate }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary search_btn_margin">Search</button>
                    <a href="{{ route('home') }}" class="btn btn-danger search_btn_margin">Reset</a>
                </div>

            </div>
        </form>
        

        
        <div class="row">
            <div class="col-lg-6 col-md-3 col-6">
                <div class="small-box bg-info p-3">
                    <div class="inner">
                        <h3>{{ $totalCount ?? 0 }}</h3>
                        <p>All</p>
                    </div>
                    <a href="#" class="small-box-footer invisible">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-6 col-md-3 col-6">
                <div class="small-box bg-warning p-3">
                    <div class="inner">
                        <h3>{{ $pendingCount ?? 0 }}</h3>
                        <p>Pending</p>
                    </div>
                    <a href="{{ route('dashboard.pending') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="mt-3"></div>
            <div class="col-lg-6 col-md-3 col-6">
                <div class="small-box bg-success p-3">
                    <div class="inner">
                        <h3>{{ $approveCount ?? 0 }}</h3>
                        <p>Approved</p>
                    </div>
                    <a href="{{ route('dashboard.approve') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-6 col-md-3 col-6">
                <div class="small-box bg-danger p-3 text-white">
                    <div class="inner">
                        <h3 class="text-white">{{ $rejectCount ?? 0 }}</h3>
                        <p>Rejected</p>
                    </div>
                    <a href="{{ route('dashboard.reject') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <hr class="border-top mt-3">
        <div class="row">
            <div class="col-md-12">
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
    
</section>


@endsection
@push('script')
<script src="{{ asset('front_assets/js/chart.min.js') }}"></script>
{!! $chart->script() !!}
@endpush