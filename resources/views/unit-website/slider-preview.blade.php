@extends('frontend')
@section('content')

{{-- Carousel  --}}
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($sliderImagePreview as $key => $val)
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{$key}}" @class(['active'=> ($key == 0)]) aria-current="true" aria-label="Slide {{$key+1}}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($sliderImagePreview as $key => $val)
        <div @class(['carousel-item','active'=> ($key == 0)]) data-bs-interval="10000">
            <img src="{{ asset($val->slider_image) }}" class="d-block w-100" alt="...">
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
{{-- End Carousel  --}}

{{-- 3 column section --}}
<div class="bg-white">
    <div class="row p-2">
        <div class="col-lg-4 col-md-4 mb-3 ">
            <div class="card shadow card-fixed-height">
                <div class="card-header card-header-heading fw-bold">
                    {{__('string.cmd_message')}}
                </div>
                @if(!empty($cmd))
                <img src="{{asset($cmd->image)}}" class="card-img-top cmd-image-changes pt-3" alt="...">
                @endif
                <div class="card-body">
                    @if(!empty($cmd))
                    <p class="card-text card-text-justify">

                        {{--{{$cmd->descritionVal()}}--}}
                        <?php


                        $lang = app()->getLocale();
                        $column = $lang . "_description";
                        echo $cmd->$column;

                        ?>

                    </p>
                    @endif
                    <a href="#" class="">View More ...</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 mb-3 ">
            <div class="card shadow card-fixed-height">
                <div class="card-header card-header-heading fw-bold">
                    {{__('string.media_releases')}}
                </div>
                <div class="card-body">
                    @if( !empty($mediaRealse) && (count($mediaRealse) > 0) )
                    @foreach($mediaRealse as $key => $val)
                    <div class="list-group media-realse-list">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <img src="{{ asset($val->image) }}" style="height: 75px;">
                                <p class="ps-2">
                                    <small>

                                        <?php


                                        $lang = app()->getLocale();
                                        $column = $lang . "_title";
                                        echo $val->$column;

                                        ?>
                                        <!-- {{ ucfirst($val->title) }} -->
                                    </small>
                                    <br />
                                    <span class="published-date">{{ Carbon\Carbon::parse($val->created_at)->format('l') }}, {{ Carbon\Carbon::parse($val->created_at) }}</span>
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>


        <div class="col-lg-4 col-md-4 mb-3">
            <div class="card shadow card-fixed-height">
                <div class="card-header card-header-heading fw-bold">
                    {{__('string.whats_new')}}
                </div>
                <div class="card-body slick-slider">
                    @if( !empty($whatnew) && count($whatnew) > 0 )
                    @foreach($whatnew as $key => $val)

                    <div class="list-group media-realse-list">
                        <a href="#" class="list-group-item list-group-item-action mt-2">
                            <div class="d-flex w-100 justify-content-between">
                                <img src="{{ asset($val->news_file) }}" style="height: 75px;">
                                <p class="ps-2">
                                    <small>
                                        <?php

                                        $lang = app()->getLocale();
                                        $column = $lang . "_description";
                                        echo $val->$column;

                                        ?>
                                    </small><br />
                                    <span class="published-date">{{ Carbon\Carbon::parse($val->created_at)->format('l') }}, {{ Carbon\Carbon::parse($val->created_at) }}</span>
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
{{-- End 3 column section --}}

{{-- Our products      --}}
<div class="bg-white">
    <div class="row mx-auto">
        <div class="col-md-12 background-grey-heading text-center h4 py-3">
            {{__('string.our_products')}}
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 p-4">
            <div class="owl-carousel owl-theme">
                @foreach ($product as $item)

                @if(File::exists(public_path('/').$item->product_image))
                <div class="item">
                    <img src="{{ asset($item->product_image) }}" />
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- End Our products  --}}

{{-- 3 column section --}}
<div class="bg-white">
    <div class="row px-2">

        <div class="col-lg-4 col-md-4 mb-3 ">
            <div class="card shadow card-fixed-height">
                <div class="card-header card-header-heading fw-bold ">
                    {{__('string.awards_and_achievements')}}
                </div>
                <div class="card-body">
                    @if( !empty($award_achievement) && (count($award_achievement) > 0) )
                    @foreach($award_achievement as $key => $val)
                    <div class="list-group media-realse-list">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between mt-2">
                                <img src="{{ asset($val->image) }}" style="height: 75px;">
                                <p class="ps-2">
                                    <small> <?php

                                            $lang = app()->getLocale();
                                            $column = $lang . "_description";
                                            echo $val->$column; ?>

                                    </small><br />
                                    <span class="published-date">{{ Carbon\Carbon::parse($val->created_at)->format('l') }}, {{ Carbon\Carbon::parse($val->created_at) }}</span>
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>


        <div class="col-lg-4 col-md-4 mb-3 ">
            <div class="card shadow card-fixed-height">
                <div class="card-header card-header-heading fw-bold">
                    {{__('string.milestones')}}
                </div>
                <div class="card-body">
                    @if( !empty($milestone) && (count($milestone) > 0) )
                    @foreach($milestone as $key => $val)
                    <div class="list-group media-realse-list">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between mt-2">
                                <span class="year-circle">{{ $val->year }}</span>
                                <p class="ps-2">
                                    <small>
                                        <?php

                                        $lang = app()->getLocale();
                                        $column = $lang . "_milestone";
                                        echo $val->$column;
                                        ?>
                                    </small><br />
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 mb-3 ">
            <div class="card shadow card-fixed-height">
                <div class="card-header card-header-heading fw-bold">
                    {{__('string.photo_gallery')}}
                </div>
                <div class="card-body">
                    <div class="list-group media-realse-list">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <span class="year-circle">2020</span>
                                <p class="ps-2">
                                    <small>BDL pays Interim Dividend to Government FY 2022-23</small><br />
                                    <span class="published-date">Tue, 02/28/2023 - 04:18 PM</span>
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="list-group media-realse-list">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <span class="year-circle">2020</span>
                                <p class="ps-2">
                                    <small>BDL pays Interim Dividend to Government FY 2022-23</small><br />
                                    <span class="published-date">Tue, 02/28/2023 - 04:18 PM</span>
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="list-group media-realse-list">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <span class="year-circle">2020</span>
                                <p class="ps-2">
                                    <small>BDL pays Interim Dividend to Government FY 2022-23</small><br />
                                    <span class="published-date">Tue, 02/28/2023 - 04:18 PM</span>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End 3 column section --}}
@endsection