<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4  shadow-none bg-green border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3" style="background-color:#0c96cb">
    <nav aria-label="breadcrumb">
      <!-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol> -->
      <h4 class="font-weight-bolder mb-0 text-white text-center">Content Management System</h4>
      {{--<i class="fa fa-user me-sm-1"></i>
      <span class="d-sm-inline text-white d-none">{{Auth::user()->email ??''}}</span>--}}
    </nav>
    <div class="collapse navbar-collapse mt-sm-0  me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center text-white">
       <i class="fa fa-user me-sm-1"></i>
        <span class="d-sm-inline d-none">{{Auth::user()->email ??''}}</span>

      </div> 
      <ul class="navbar-nav  justify-content-end">
        @if(\Auth::check())
        <li class="nav-item d-flex align-items-center">
          <form action="{{url('logout')}}" method="POST">
            @csrf
            <button type="submit" class="mt-3 btn btn-primary text-white p-2">
              <i class="fa fa-user me-sm-1"></i>
              <span class="d-sm-inline d-none">Logout</span></button>

          </form>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>