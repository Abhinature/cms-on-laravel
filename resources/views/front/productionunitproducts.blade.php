@extends('unit_frontend')
@section('content')



{{-- Our products      --}}
<div class="bg-white">
    <div class="row mx-auto">
        <div class="col-md-12 background-grey-heading text-center h4 py-3">
            {{__('string.our_products')}}
        </div>
        <div class="clearfix"></div>


        @foreach ($products as $item)

        <div class="col-md-4 p-4">
            <div class="card text-center">
                <div class="card-header">
                    {{$item->product_name ??''}}
                </div>
                <div class="card-body">

                    <img src="{{asset($item->product_image)}}" />

                </div>
                <div class="card-footer">
                    {!!$item->product_specification ??''!!}
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
{{-- End Our products  --}}

@endsection