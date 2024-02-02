{{--   footer     --}}
<?php 
 $lang = app()->getLocale();
 $coll = $lang.'_address';
?>
<div class="bg-dark">
    <div class="row p-3">
        <div class="col-md-3">
            <p class="h4 text-light">{{__('string.address')}}</p>

            <p class="text-light">
                @if(!empty($footer_content))
               
                {{$footer_content->$coll}} <br>
                <b>{{__('string.cin')}}</b>: {{$footer_content->cin_no}} <br>
                <b>{{__('string.phone_no')}}</b>:{{$footer_content->phone_no}} <br>
                <b>{{__('string.fax')}}</b>: {{$footer_content->fax_no}}<br>
                <b>{{__('string.email')}}</b>: {{$footer_content->email_id}}
                @endif
            </p>
        </div>
        <div class="col-md-3 text-center">
            <p class="h4 text-light">{{__('string.quick_links')}}</p>
            <ul class="text-light pl-0 footer-menu padding-left-force-0">
                <li>{{__('string.about')}}</li>
                <!-- <li>{{__('string.apex_authority')}}</li> -->
                <li>{{__('string.products')}}</li>
                <li>{{__('string.manufacture')}}</li>
                <!-- <li>{{__('string.product_units')}}</li> -->
                <!-- <li>{{__('string.vigilance')}}</li> -->
                <li>{{__('string.contact_us')}}</li>
                <!-- <li>{{__('string.downloads')}}</li> -->
                <!-- <li>{{__('string.career')}}</li> -->
            </ul>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12 footer-img">
                    
                    <div class="row text-center mt-3">
                        @php
                        $quicklinks = footerLinks();
                        @endphp
                   @foreach($quicklinks as $qu)
                        <div class="col-md-4">
                            <a href="{{$qu->url}}">
                            <img src="{{asset($qu->logo_image) }}" alt="" class="w-100 img-fluid">
                            </a>
                        </div>
                        @endforeach                      
                      
                  
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<footer class="d-flex flex-wrap justify-content-between align-items-center border-top bg-dark ">
    <div class="row p-3">
        <div class="col-md-12 mb-0 text-white text-center fs-14">Copyright &copy; - All Rights Reserved - Official Website of Yantra India Limited</div>
        <div class="col-md-12 mb-0 text-white text-center fs-14 mY-2">Note: Content on this website is published and managed by Yantra India Limited</div>
        <div class="clearfix"></div>
        <div class="my-1"></div>
        <div class="col-md-3 text-center fs-14"><p class="text-white">Website Last Updated On : {{getlastauditentrytime()}}</p></div>
        <div class="col-md-3 text-center fs-14"><p class="text-white">Unique Visitor Count : {{uniqueipscount()}} </p></div>
        <div class="col-md-3 text-center fs-14"><p class="text-white">Your IP Address :{{session('user_ip')}} 	</p></div>
        <div class="col-md-3 text-center fs-14"><p class="text-white">Last Visited On : {{getlastauditentrytime()}}</p></div>


    </div>

</footer>
{{--   Endfooter     --}}