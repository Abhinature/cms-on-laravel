@extends('unit_frontend')
@section('content')



{{--  Our products      --}}
<div class="bg-white">
    <div class="row mx-auto">
        <div class="col-md-12 background-grey-heading text-center h4 py-3">
            {{__('string.manufacturing')}}
        </div>
        <div class="clearfix"></div>
       
          
                @foreach ($products as $item)
                    
                <div class="col-md-4 p-4">
                        <div class="card text-center">
                            <div class="card-header">
                                {{$item->title ??''}}
                            </div>
                            <div class="card-body">
                        
                                <img src="{{asset($item->image)}}" style="max-width:150px;"/>
                            
                            </div>
                            <div class="card-footer">
                                {!!$item->description ??''!!}
                            </div>
                        </div>
                        </div>
                @endforeach
      
   
</div>
</div>

{{-- End Our products  --}}

@endsection