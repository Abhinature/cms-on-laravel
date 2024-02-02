@extends('frontend')
@section('content')
        <?php
        $lang = app()->getLocale();
        ?>
<div class="bg-white">
    <div class="back-box w-100 p-4" style="height:200px;background-image:url({{asset('front_assets/images/careers.png')}});background-size:cover;background-repeat:no-repeat;">
   <h1 class="p-4 text-white "> @if($lang == 'en') Yantra India Limited - Contact Details @else 	
यंत्र इंडिया लिमिटेड - संपर्क जानकारी @endif</h1> 
    </div>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                                                <?php
                                $lang = app()->getLocale();
                                ?>

                    <div class="card-body">
                    <h5>@if($lang== "hi")यंत्र इंडिया लिमिटेड मुख्यालय : @else Yantra India Limited Head Quaters : @endif</h5>
                       
                        <p> <?php $column = $lang . "_address";
                        echo $data->$column;?></p>
                        <p>CIN : {{$data->cin_no ??''}}</p>
                    </div>
                    <div class="card-body">
                        <h5>Email IDs:</h5>
                        <p>{{$data->email_id ??''}}</p>
                    </div>
                    <div class="card-body">
                        <h5>Fax Number:</h5>
                        <p>{{$data->fax_no ??''}}</p>
                    </div>
                    <div class="card-body">
                        <h5>Phone Number's:</h5>
                        <p>{{$data->phone_no ??''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.374677331454!2d78.9714037153333!3d21.13748248943275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4eb39a70fc525%3A0xc4977355479d8d32!2sYantra%20India%20Limited%20HQ!5e0!3m2!1sen!2sin!4v1680781853232!5m2!1sen!2sin" width="950" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
</div>
@endsection