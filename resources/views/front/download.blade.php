@extends('frontend')
@section('content')
<?php
$lang = app()->getLocale();
?>
<div class="bg-white">
    <div class="back-box w-100 p-4" style="height:200px;background-image:url({{asset('front_assets/images/careers.png')}});background-size:cover;background-repeat:no-repeat;">
        <h1 class="p-4 text-white "> @if($lang == 'en')Downloads @else
            डाउनलोड @endif</h1>
    </div>
    <div class="container-fluid p-4">
        <h4 class="mb-4 heading-border">{{__('downloads')}}</h4>
        <div class="table-responsive">
            <table class="table thead-green table-bordered">
                <thead class="">
                    <tr>
                        <th>{{__('Sr. No.')}}</th>
                        <th>{{__('Category')}}</th>
                        <th>{{__('Subject')}}</th>
                        <th>{{__('File')}}</th>
                        <th>{{__('Uploaded By')}}</th>
                        <!-- <th>{{__('Phone Number')}}</th> -->
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($data) && count($data) > 0)
                    @php $a =0;
                    $cat = $lang.'_category';
                    $sub = $lang.'_subject';
                    @endphp
                    @foreach($data as $dt)
                    <tr>
                        <td>{{$a = $a+1}}</td>
                        <td>{{$dt->$cat ??''}}</td>
                        <td>{{$dt->$sub??''}}</td>
                        <td><a href="{{$dt->document ??''}}" target="_blank" class="btn btn-primary">View</a></td>
                        <td>
                            @if($dt->unit_id == '0')
                            Yantra Limited India (यंत्र इंडिया लिमिटेड)
                            @else
                            @php
                            $a = getUnitName($dt->unit_id);
                            @endphp
                            {{$a->en_unit_name}} ({{$a->hi_unit_name}})
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection