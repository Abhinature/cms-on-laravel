@extends('frontend')
@section('content')
<div class="bg-white">
    <div class="back-box w-100 p-4" style="height:200px;background-image:url({{asset('front_assets/images/careers.png')}});background-size:cover;background-repeat:no-repeat;">
        <h1 class="p-4 text-white ">Whois Who</h1>
    </div>
    <!-- <img src="{{ asset('front_assets/images/careers.png') }}" alt="" class="w-100"> -->
    <style>
        span.whoisdetails {
            font-family: merry-weateher;
            color: #01385c;
        }
        /* .card{
            border-radius: 40px;
        } */
    </style>
    <div class="container-fluid p-4">
        <div class="row">
            @foreach($data as $pu)
            <div class="col-md-4 p-4" style="max-width:300px;">
                <div class="card text-center">
                    <a href="#">
                        <div class="card-header">
                            <h6><span class="whoisdetails">Department </span>:<span class="whoisdetails"> {{$pu->department ??''}} </span></h6>
                            <h6><span class="whoisdetails">Designation</span> :<span class="whoisdetails"> {{$pu->designation ??''}} </span></h6>
                        </div>
                        <div class="card-body">
                            <img style="max-width:200px;" src="{{asset($pu->image)}}">
                        </div>
                        <div class="card-footer float-left">

                            <h6> <span class="whoisdetails">Name</span> :<span class="whoisdetails"> {{$pu->name ??''}} </span></h6>
                            <h6><span class="whoisdetails">Email</span> :<span class="whoisdetails"> {{$pu->email ??'' }} </span></h6>
                            <h6><span class="whoisdetails">Phone No.</span> :<span class="whoisdetails"> {{$pu->phone_no ??''}}</span></h6>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection