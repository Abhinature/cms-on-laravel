<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0  fixed-start  " id="sidenav-main" style="background-color:#0c96cb;">
  {{-- border-radius-xl my-3 ms-3 --}}
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0 bg-white text-danger" href="{{ route('home') }}" target="_blank">
      @if(Auth::user()->unit_id =='0')
      <img src="{{asset('images/YIL LOGO.png')}}" style="min-height:50px;" class="navbar-brand-img h-100 bg-white" alt="main_logo">
      <span class="ms-1 font-weight-bold">
        Yantra India Limited
      </span>
      @else
      @php $lg = getUnitLogo(Auth::user()->unit_id); @endphp
      <img src="{{asset($lg)}}" style="min-height:50px;" class="navbar-brand-img h-100 bg-white" alt="main_logo">
      <span class="font-weight-bold" style="font-size:12px;">
        @php
        $u = getUnitName(Auth::user()->unit_id);
        @endphp
        {{$u->en_unit_name}}
      </span>
      @endif
    </a>
  </div>
  <hr class="horizontal dark mt-2">
  <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav sidebar-menu">
      <li class="nav-item active-li">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link  d-inline" href="{{url('home')}}">
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      @if(!in_array(Auth::user()->user_type,['11','13','15']))
      @if(in_array(Auth::user()->user_type,['9','3']))
      @if(Auth::user()->unit_id == '0')
      <li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('units')}}">
          <span class="nav-link-text ms-1">Units</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-user d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('users')}}">
          <span class="nav-link-text ms-1">Users</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('quicklinks')}}">
          <span class="nav-link-text ms-1">Quick Links</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-language d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('translation.index')}}">
          <span class="nav-link-text ms-1">Translation</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-file d-inline"></i>
        <a class="nav-link d-inline" href="{{route('page.index')}}">
          <span class="nav-link-text ms-1">Custom Page</span>
        </a>
      </li>
      @endif
      {{-- <li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('cmd-message')}}">
      <span class="nav-link-text ms-1">CMD Message</span>
      </a>
      </li> --}}
      @if(in_array(Auth::user()->user_type,['3']) && Auth::user()->unit_id =='0')
      {{--<li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('dynamic-pages')}}">
      <span class="nav-link-text ms-1">Add Pages</span>
      </a>
      </li>--}}

      @endif
      
     {{-- <li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('dynamic-pages-review')}}">
          <span class="nav-link-text ms-1">Pages For Review</span>
        </a>
      </li>--}} @if(in_array(Auth::user()->user_type,['9']) && Auth::user()->unit_id =='0')
     
      @endif
      @endif



      {{--<li class="nav-item">
        <i class="fa fa-home d-inline"></i>
        <a class="nav-link d-inline" href="{{route('unit-website')}}">
          <span class="nav-link-text ms-1">
            Home Page
          </span>
        </a>
      </li>--}}
      <li class="nav-item">
        <i class="fa fa-picture-o d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('website_slider_images')])}}">
          <span class="nav-link-text ms-1">Slider Image</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-file-text d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('unit_websites')])}}">
          <span class="nav-link-text ms-1">About Us</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-address-book d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('unit_website_contact')])}}">
          <span class="nav-link-text ms-1">Contact Us</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-product-hunt d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('product')])}}">
          <span class="nav-link-text ms-1">Product</span>
        </a>
      </li>
      @if(Auth::user()->unit_id =='0')
      <li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('cmd_msg')])}}">
      <span class="nav-link-text ms-1">CMD Message</span>
      </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-medium d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('media_releases')])}}">
          <span class="nav-link-text ms-1">Media Release</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-newspaper-o d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('whats_news')])}}">
          <span class="nav-link-text ms-1">What's New</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-trophy d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('award_achievements')])}}">
          <span class="nav-link-text ms-1">Awards & Achievements</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-road d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('milestones')])}}">
          <span class="nav-link-text ms-1">Milestone</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-users d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('whois')])}}">
          <span class="nav-link-text ms-1">Who's who</span>
        </a>
      </li>
      @endif
      
      @if(Auth::user()->unit_id !='0')
      
      <li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('unit-website',[Crypt::encrypt('manu')])}}">
          <span class="nav-link-text ms-1">Manufacture Facility</span>
        </a>
      </li>
      
    
      @endif
      <li class="nav-item">
        <i class="fa fa-check-circle  d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('rti')}}">
          <span class="nav-link-text ms-1">RTI</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-gavel d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('tender')}}">
          <span class="nav-link-text ms-1">Tender</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-tasks d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('career')}}">
          <span class="nav-link-text ms-1">Careers</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-download d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('download')}}">
          <span class="nav-link-text ms-1">Downloads</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('library')}}">
          <span class="nav-link-text ms-1">E-Library</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-file d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('admin-reports')}}">
          <span class="nav-link-text ms-1">Reports</span>
        </a>
      </li>
      @else
      <li class="nav-item">
        <i class="fa fa-file d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('admin-reports')}}">
          <span class="nav-link-text ms-1">Reports</span>
        </a>
      </li>
      {{--<li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('view-admin-reports')}}">
      <span class="nav-link-text ms-1">View Admin Reports</span>
      </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('budget')}}">
          <span class="nav-link-text ms-1">Finance Reports</span>
        </a>
      </li>
      <li class="nav-item">
        <i class="fa fa-info-circle d-inline" aria-hidden="true"></i>
        <a class="nav-link d-inline" href="{{route('view-budget')}}">
          <span class="nav-link-text ms-1">View Finance Reports</span>
        </a>
      </li>--}}
      @endif
      <li class="nav-item">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        <form action="{{url('logout')}}" method="POST" id="logout-form" class="d-inline">
          @csrf
          <a href="{{route('unit-website')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

            <span class="nav-link-text ms-1">
              @auth
              Logout
              @endauth
            </span>
          </a>
        </form>
      </li>




    </ul>
  </div>
</aside>