@extends('frontend')
@section('content')
<div class="bg-white">
    <div class="back-box w-100 p-4" style="height:200px;background-image:url({{asset('front_assets/images/careers.png')}});background-size:cover;background-repeat:no-repeat;">
   
    <?php

$lang = app()->getLocale();
?>
    @if($lang == 'en')
    <h1 class="p-4 text-white">Production Units</h1>
    @else
    <h1 class="p-4 text-white">उत्पादन इकाइयों की सूची</h1>
    @endif
    
    </div>
    <!-- <img src="{{ asset('front_assets/images/careers.png') }}" alt="" class="w-100"> -->
    <div class="container-fluid p-4">
        <div class="row text-center">
            @foreach($production_units as $pu)
                <div class="col-md-4 col-lg-4 p-4">
                     <div class="card text-center">
                        <a href="{{route('production-unit-page',['id' => Crypt::encrypt($pu->id)])}}">
                     <div class="card-header" style="min-height:150px">
                        <img style="max-width:100px;" src="{{asset($pu->unit_logo)}}">
                     </div>
                     <div class="card-body">
                        @php
                        $col = app()->getLocale();
                        $l = $col.'_unit_name';
                        @endphp
                     <h6>{{$pu->$l }}</h6>
                     </div>
                        </a>
                     </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection