<!DOCTYPE html>
<html lang="en">

<head>
    <title>Yantra India Limited</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('front_assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('front_assets/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <style>
        .owl-carousel .item img {
            width: 100%;
        }
        .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    width: 100%;
    padding-right: 0px; 
    padding-left:  0px; 
    margin-right:  0px; 
 margin-left:  0px; 
}
    </style>
</head>

<body>
	<div class="container-fluid">
        @include('front.unit_header')
        @yield('content')
        @include('front.unit_footer')
	</div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{asset('front_assets/js/bootstrap.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> --}}

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.carousel').carousel({
                interval: 2000
            })

            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    }
                }
            })

            $('.slick-slider').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 3,
                arrows: false,
                dots: false,
                vertical: true,
                verticalSwiping: true,
                autoplay: true,
            });
        });
    </script>
</body>
</html>
