@extends('frontend')
@section('content')
<div class="bg-white">
    {{-- <h4 class="mb-4 heading-border"> --}}
    <div class="p-4 open-trader">
        <h4 class="heading-border mb-0 mt-4 mb-4">{{__('CLOSED TENDERS')}}</h4>
        <p>
            Details of Tenders and Contracts Finalized for the year 2022 (Month Wise). 
        </p>

        <div class="row mx-auto">
            <div class="col">
                <div class="circle-span">
                    <a href="javascript:void(0);">{{ __('Jan 2022')}}</a>
                </div>
            </div>
            <div class="col">
                <div class="circle-span">
                    <a href="javascript:void(0);">{{ __('Jan 2022')}}</a>
                </div>
            </div>
            <div class="col">
                <div class="circle-span">
                    <a href="javascript:void(0);">{{ __('Jan 2022')}}</a>
                </div>
            </div>
            <div class="col">
                <div class="circle-span">
                    <a href="javascript:void(0);">{{ __('Jan 2022')}}</a>
                </div>
            </div>
            <div class="col">
                <div class="circle-span">
                    <a href="javascript:void(0);">{{ __('Jan 2022')}}</a>
                </div>
            </div>
            <div class="col">
                <div class="circle-span">
                    <a href="javascript:void(0);">{{ __('Jan 2022')}}</a>
                </div>
            </div>
            <div class="col">
                <div class="circle-span">
                    <a href="javascript:void(0);">{{ __('Jan 2022')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection