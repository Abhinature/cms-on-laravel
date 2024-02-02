@extends('frontend')
@section('content')
<div class="bg-white">
    <img src="{{ asset('front_assets/images/rti-act.png')}}" alt="" class="w-100">
    <div class="container-fluid p-4">
        <h4 class="mb-4 heading-border">{{__('Right To Information')}}</h4>
        <div class="table-responsive">
            <table class="table thead-green table-bordered">
                <thead class="">
                    <tr>
                        <th>{{__('Sr. No.')}}</th>
                        <th>{{__('Name of the Officer')}}</th>
                        <th>{{__('Designation')}}</th>
                        <th>{{__('Responsibility Assigned')}}</th>
                        <th>{{__('Email Address')}}</th>
                        <th>{{__('Phone Number')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($data) && count($data) > 0)
                    @php $a =0; @endphp
                    @foreach($data as $dt)
                    <tr>
                        <td>{{$a = $a+1}}</td>
                        <td>{{$dt->name_of_officer ??''}}</td>
                        <td>{{$dt->designation ??''}}</td>
                        <td>{{$dt->responsibility_assigned ??''}}</td>
                        <td>{{$dt->email_address ??''}}</td>
                        <td>{{$dt->phone_no ??''}}</td>
                    </tr>                  
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection