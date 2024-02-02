@extends('frontend')
@section('content')
<div class="bg-white">
    <div class="container p-4">
        
        {!! !empty($content->main_content) ? __(base64_decode($content->main_content)) : ''!!}
    </div>
</div>
@endsection