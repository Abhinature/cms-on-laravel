{{--   footer     --}}
<div class="bg-dark">
    <div class="row p-3">
        <div class="col-md-3">
            <p class="h4 text-light">{{__('string.corporate_office_address')}}</p>
            <p class="text-light">
                {{__('string.corporate_ofc_details')}} <br>
                <b>{{__('string.cin')}}</b>: U35303MH2021GOI365890 <br>
                <b>{{__('string.phone_no')}}</b>: 07104-246845 <br>
                <b>{{__('string.fax')}}</b>: 07104-246681 <br>
                <b>{{__('string.email')}}</b>: yil.hq@yantraindia.co.in
            </p>
        </div>
        <div class="col-md-3 text-center">
            <p class="h4 text-light">{{__('string.quick_links')}}</p>
            <ul class="text-light pl-0 footer-menu padding-left-force-0">
                <li><a class="text-white" href="{{route('front.about-yil')}}">{{__('string.about')}}</a></li>
                <li><a class="text-white" href="{{route('front.directory')}}">{{__('string.apex_authority')}}</a></li>
                <li><a class="text-white" href="{{route('front.yil-products')}}">{{__('string.products')}}</a></li>
                <li><a class="text-white" href="{{route('front.production-units')}}">{{__('string.production_units')}}</a></li>
                <li><a class="text-white" href="{{route('front.vigilance')}}">{{__('string.vigilance')}}</a></li>
                <li><a class="text-white" href="{{route('front.contact-details')}}">{{__('string.contact_us')}}</a></li>
                <li><a class="text-white" href="{{route('front.download')}}">{{__('string.downloads')}}</a></li>
                <li><a class="text-white" href="{{route('front.career')}}">{{__('string.career')}}</a></li>
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
                        <div class="col-md-3" style="border-radius:50px;" >
                        <div class="bg-white mt-1" style="max-width:200px;max-height:170px;min-height:103px;">
                            <a href="{{$qu->url}}">
                            <img src="{{asset($qu->logo_image) }}"  alt="" class="w-200 img-fluid" style="max-width:73%;height: auto;">
                            </a>
</div>
                        </div>
                        @endforeach                      
                      
                  
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
        <div class="col-md-3 text-center fs-14"><p class="text-white">Your IP Address : {{session('user_ip')}}</p></div>
        <div class="col-md-3 text-center fs-14"><p class="text-white">Last Visited On : 16-03-2023 14:12</p></div>


    </div>

</footer>

{{--   Endfooter     --}}