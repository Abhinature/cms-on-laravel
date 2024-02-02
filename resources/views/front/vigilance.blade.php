@extends('frontend')
@section('content')
             <?php
                $lang = app()->getLocale();
                ?>
<div class="bg-white">
    <div class="back-box w-100 p-4" style="height:200px;background-image:url({{asset('front_assets/images/careers.png')}});background-size:cover;background-repeat:no-repeat;">
    @if($lang == "en")<h1 class="p-4 text-white ">Vigilance</h1> @else <h1 class="p-4 text-white ">जागरूकता</h1> @endif
    </div>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="border:0px;">
                    <div class="card-header text-center" style="background-color: rgb(150 255 255 / 33%);">
                       @if($lang == "en")<h4>YANTRA INDIA VIGILANCE BULLETIN </h4> 
                @else <h4>यंत्र इंडिया सतर्कता बुलेटिन अंक 01</h4>@endif
                    </div>
                </div>
            </div>          
        </div>
        @if(!empty($data))
            @foreach($data as $dt)
            <div class="row mt-2">
            <div class="col-md-4">
                <div class="card" style="border:0px;">
                    <div class="card-body text-center">
                        <img src="{{asset($dt->image)}}"  style="max-width:150px;"/>
                    </div>
                </div>
            </div>    
            <div class="col-md-8" style="background-image: linear-gradient(to right, rgba(255,0,0,0), rgb(128 0 0));;">
                <!-- <div class="card" style="border:0px;"> -->
                    <!-- <div class="card-body"> -->

                        <h4><?php


                        $lang = app()->getLocale();
                        $column = $lang . "_department";
                        echo $dt->$column;

                        ?></h4>
                        <h5><?php
                         $column = $lang . "_designation";
                         echo $dt->$column;
                        ?></h5>
                        <h6><?php
                         $column = $lang . "_name";
                         echo $dt->$column;
                        ?>
                        </h6>
                        <h6>@if($lang == "hi")ई-मेल पता :{{$dt->email}} @else Email : {{$dt->email}} @endif</h6>
                        <h6>@if($lang == "hi")दूर्भाष क्र. :{{$dt->phone_no}} @else Phone :{{$dt->phone_no}} @endif</h6>
                    <!-- </div> -->
                <!-- </div> -->
            </div>       
        </div>
    
       
            @endforeach
        @endif
      
    </div>
</div>
@endsection