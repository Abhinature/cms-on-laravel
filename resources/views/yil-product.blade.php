@extends('frontend')
@section('content')
<div class="bg-white">
    <div class="back-box w-100 p-4" style="height:200px;background-image:url({{asset('front_assets/images/careers.png')}});background-size:cover;background-repeat:no-repeat;">
        <h1 class="p-4 text-white ">Products</h1>
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
            <div class="col-md-3 " style="border-right:2px black;padding:0px;">

                <ul style="list-style:none;">
                    @foreach($unit as $u)
                    <li class='pt-4'><img src="{{asset($u->unit_logo)}}" style="max-width:30px;" /><span style="margin-left:10px"><?php


                                                                                                                                    $lang = app()->getLocale();
                                                                                                                                    $column = $lang . "_unit_name";
                                                                                                                                    echo $u->$column;

                                                                                                                                    ?></span></li>
                    @endforeach
                </ul>

            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach($unit as $u)
                    @php $d = App\Http\Controllers\Common::getunitproductbyid($u->id); @endphp
                    @if($d['count'] !=0)
                    <div class="col-md-12 text-center">
                        <h1 style="color:#01395e;text-shadow: -3px 2px #800000;" class="mt-4 {{$u->product_name}}">{{$u->en_unit_name??''}}</h1>
                    </div>
                    @foreach($d['unitproduct'] as $pu)
                    <div class="col-md-4" id="{{$pu->product_name}}">
                        <div class="card">
                            <div class="card-header text-center">{{$pu->product_name}}</div>
                            <div class="card-body">
                                <img src="{{asset($pu->product_image)}}" style="max-width:250px" />
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>

@endsection