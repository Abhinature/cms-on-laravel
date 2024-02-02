@extends('frontend')
@section('content')
<div class="bg-white">
    <img src="{{ asset('front_assets/images/inneer-banner.png') }}" alt="" class="w-100">
    <div class="container-fluid p-4">
        
        <h4 class="mb-4 heading-border">{{__('Mandatory Disclosures')}}</h4>
        
        <div class="table-responsive">
            <table class="table thead-green table-bordered">
                <thead class="">
                    <tr>
                        <th>{{__('Sr. No.')}}</th>
                        <th>{{__('Disclosure Document')}}</th>
                        <th>{{__('Uploaded On')}}</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($data) && count($data) > 0)
                    @php $a =0; @endphp
                    @foreach($data as $dt)
                    <tr>
                        <td>{{$a = $a+1}}</td>
                        <td>
                            @php
                            $lang = app()->getLocale();;
                            $column = $lang.'_title'
                            @endphp
                            {{$dt->$column}}
                        </td>
                        <td>{{$dt->created_at}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection