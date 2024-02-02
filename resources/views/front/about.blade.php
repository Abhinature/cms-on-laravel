@extends('frontend')
@section('content')
<div class="bg-white">
    <div class="back-box w-100 p-4" style="height:200px;background-image:url({{asset('front_assets/images/careers.png')}});background-size:cover;background-repeat:no-repeat;">
    <h1 class="p-4 text-white ">About Us</h1>
    </div>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="border:0px;">
                    <div class="card-header text-center">
                        <h4>Yantra India Limited Head Quaters</h4>
                        <h5> <?php
$lang = app()->getLocale();
$column = "website_".$lang."_title";
echo $about->$column;

?></h5>
                        <p><?php $column = "website_".$lang."_sub_title";
echo $about->$column;?></p>
                    </div>
                    <div class="card-body">
                    <?php $column = "about_".$lang."_description";
echo $about->$column;?>
                       
                    </div>
                    
                </div>
            </div>
          
        </div>
    </div>
</div>
@endsection