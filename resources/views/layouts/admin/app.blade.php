<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="{{asset('front_assets/css/backend-custom.css')}}">
  <link rel="icon" href="{{ asset('front_assets/images/favicon/favicon.ico') }}" type="image/x-icon">
  <!-- <script type="text/javascript" src="{{asset('text-editor/ckeditor.js')}}"></script> -->
</head>

<body class="g-sidenav-show  bg-gray-100">
<div class="loading d-none"></div>
@include('layouts.admin.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
     <!-- Navbar -->
     @include('layouts.admin.header')
            <!-- /.navbar -->
    <div class="container-fluid py-4">
     @if(AUTH::user()->unit_id == 1 && AUTH::user()->user_type == 3)<p>ADMIN- Ordnance Factory Ambajhari</p>
     @elseif(AUTH::user()->unit_id == 1 && AUTH::user()->user_type == 9) <p>SUPERADMIN- Ordnance Factory Ambajhari</p>
     @endif
    @yield('content')
               
    
    </div>
      <footer class="footer pt-3  ">
        
      </footer>
    </div>
  </main>
  
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>


  {{-- <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('/assets/plugins/datatables/buttons.print.min.js') }}"></script>
  <script src="{{ asset('/assets/plugins/datatables/buttons.html5.min.js') }}"></script> --}}


  <!-- <script  src="{{asset('text-editor/ckeditor.js')}}"></script> -->
  <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
  {{-- @vite('resources/js/app.js') --}}
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }	
  </script>
  @stack('script')
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7')}}"></script>
  <script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on('click', '.hisoty_btn', function(){
			
			var url = $(this).data('url');
			var id = $(this).data('id');
			
			$.ajax({
				type:"GET",
				url: url,
				data: {
					"_id" : id,
				},
				success: function(success) {
					if( success.status == 200 )
					{
						$("#historyModal").modal('show');
						$("#history_logger").html('');
						$("#history_logger").html(success.msg);
					}
				},
				error: function(error) {

				},
				complete: function() {

				}
			});
		});
	}) ;

	function showLoader() {
		$('.loading').removeClass("d-none");
	}
	function hideLoader() {
		$('.loading').addClass("d-none");
	}
  </script>
</body>

</html>