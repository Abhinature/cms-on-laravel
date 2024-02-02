@extends('frontend')
@section('content')


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
        <style>
            .scroll {
    max-height: 350px;
    overflow-y: auto;
}
        </style>

        <div class="col-lg-4 col-md-4 mb-3 ">
            <div class="card shadow card-fixed-height ">
                <div class="card-header card-header-heading fw-bold">
                    {{__('string.milestones')}}
                </div>
                <div class="card-body scroll">
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