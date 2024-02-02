@extends('unit_frontend')
@section('content')
<?php
$lang = app()->getLocale();
?>
<div class="bg-white">
    <div class="back-box w-100 p-4" style="height:200px;background-image:url({{asset('front_assets/images/careers.png')}});background-size:cover;background-repeat:no-repeat;">
        <h1 class="p-4 text-white ">@if($lang== "hi") {{$unit_item->hi_unit_name}} @else {{$unit_item->en_unit_name}} - Contact Details @endif</h1>
    </div>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <?php
                    $lang = app()->getLocale();
                    ?>

                    <div class="card-body">
                    <h5>@if($lang== "hi") {{$unit_item->hi_unit_name}} @else {{$unit_item->en_unit_name}}  @endif</h5>
                        <p> <?php $column = $lang . "_address";
                            echo $footer_content->$column; ?></p>
                        <p>CIN : {{$footer_content->cin_no ??''}}</p>
                    </div>
                    <div class="card-body">
                        <h5>Email IDs:</h5>
                        <p>{{$footer_content->email_id ??''}}</p>
                    </div>
                    <div class="card-body">
                        <h5>Fax Number:</h5>
                        <p>{{$footer_content->fax_no ??''}}</p>
                    </div>
                    <div class="card-body">
                        <h5>Phone Number's:</h5>
                        <p>{{$footer_content->phone_no ??''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                {!!$footer_content->map_link ??""!!}

            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
</div>
@endsection