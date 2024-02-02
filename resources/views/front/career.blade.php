@extends('frontend')
@section('content')

      <?php
        $lang = app()->getLocale();
        ?>
<div class="bg-white">
<div class="back-box w-100 p-4" style="height:200px;background-image:url({{asset('front_assets/images/careers.png')}});background-size:cover;background-repeat:no-repeat;">
   <h1 class="p-4 text-white "> @if($lang == 'en') Career With Yantra India Limited @else 	
   यंत्र इंडिया लिमिटेड के साथ रोजगार के अवसर @endif</h1> 
    </div>
    <div class="container-fluid p-4">
        <div class="table-responsive">
            <table class="table thead-green table-bordered">
                <thead class="">
                    <tr>
                        <th class= "text-center">@if($lang == 'en'){{__('PUBLISH DATE')}} @else प्रकाशन तिथि @endif</th>
                        <th class= "text-center">@if($lang == 'en') {{__('SUBJECT')}} @else विषय @endif</th>
                        <th class= "text-center">@if($lang == 'en') {{__('VALIDITY FROM')}} @else वैधता आरंभ @endif</th>
                        <th class= "text-center">@if($lang == 'en') {{__('VALIDITY TILL')}} @else वैधता अंत @endif</th>
                        <th class= "text-center">@if($lang == 'en') {{__('UPLOADED BY')}} @else प्रकाशक @endif</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01-03-2023</td>
                        <td>Advertisement for Engagement of Trade Apprentice 2023</td>
                        <td>01-03-2023</td>
                        <td>30-03-2023</td>
                        <td>YIL</td>
                    </tr>
                    <tr>
                        <td>01-03-2023</td>
                        <td>Advertisement for Engagement of Trade Apprentice 2023</td>
                        <td>01-03-2023</td>
                        <td>30-03-2023</td>
                        <td>YIL</td>
                    </tr>
                    <tr>
                        <td>01-03-2023</td>
                        <td>Advertisement for Engagement of Trade Apprentice 2023</td>
                        <td>01-03-2023</td>
                        <td>30-03-2023</td>
                        <td>YIL</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection