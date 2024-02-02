<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('front_assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <script src="{{asset('front_assets/css/bootstrap.bundle.min.js')}}"></script>
</head>
<body>

<div class="container-fluid">
  <div class="row p-2" style="background-image: url({{asset('images/first_row_light.jpg')}}); background-repeat: repeat">
    <div class="col-sm-6">
    <form id="frmsearch" method="post" action="search.php" onSubmit="return validateform()">
		<div style="float: left">
		<input type="text" id="txtsearch" name="txtsearch" value="" placeholder="What are you looking for" style="width: 200px; font-family: Calibri; height: 25px; color: #29468c; font-weight: Bold; background-color: White; border: none">
		</div>
		<div style="float: left">
		<img src="{{asset('images/search.png')}}" style="background: #29468c; width: 25px; border-radius: 2px; cursor: pointer;" title="Search Within Website" onClick="submitform()">
		</div>
    </form>
    </div>
    <div class="col-sm-6">
        <div style="float:right;">
        <a href="https://twitter.com/YantraIndiaLtd" target="_blank"><img src="{{asset('images/twitter.png')}}" height="25px" title="Tweeter" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
         <a href=""><img src="{{asset('images/facebook.png')}}" height="25px" title="Facebook" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
		<a href=""><img src="{{asset('images/instagram.png')}}" height="25px" title="Instagram" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
		<a href="https://www.youtube.com/watch?v=tlj4l2XD90o"><img src="{{asset('images/youtube.png')}}" height="25px" title="YouTube" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
		<a href=""><img src="{{asset('images/linkedin.png')}}" height="25px" title="LinkedIn" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
		<a href="{{route('login')}}"><img src="{{asset('images/login.png')}}" height="25px" title="Sign In" style="filter:drop-shadow(0px 0px 2px Black);"></a>
        </div>
    </div>
  </div>
</div>
<div class="container-fluid" style="background-image: url({{asset('images/Background_Light.jpg')}}); background-repeat: repeat">
<div class="container pt-1 pb-1">
      <div class="row">		
    <div class="col-md-4 text-left">
    <a href="logo.php"><img src="{{asset('images/YIL Logo.png')}}" alt="Yantra India Limited Logo" height="120px" title="Watch The Logo Reveal Video"></a>
    </div>
    <div class="col-md-4 text-center">
    <a href="logo.php"><img src="{{asset('images/YIL Logo Text Light.png')}}" alt="Yantra India Limited Logo" height="120px" title="Watch The Logo Reveal Video"></a>
    </div>
    <div class="col-md-4">
        <div style="float:right">
    <img src="{{asset('images/emblem.png')}}" alt="Yantra India Limited Logo" height="100px"><img src="{{asset('images/logo.png')}}" alt="Azadi ka amrit mahotsav" height="100px">
</div>
</div>
  </div>
</div>
</div>
<div class="container-fluid" style="background-image: url({{asset('images/Nav_Background_Light.jpg')}}); background-repeat: repeat">
    <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                <a href="{{url('home')}}" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Home</a>&nbsp;|&nbsp;
		        <a href="#" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">About Us</a>&nbsp;|&nbsp;
		        <a href="#" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Apex Authority</a>&nbsp;|&nbsp;
		        <a href="#" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Products</a>&nbsp;|&nbsp;
		        <a href="{{route('production-units')}}" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Production Units</a>&nbsp;|&nbsp;
		        <a href="#" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">RTI</a>&nbsp;|&nbsp;
		        <a href="#" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Vigilance</a>&nbsp;|&nbsp;
		        <a href="#" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Contact Us</a>&nbsp;|&nbsp;
		        <a href="#" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Downloads</a>&nbsp;|&nbsp;
		        <a href="#" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Career</a>&nbsp;|&nbsp;
		        <a href="#" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Site Map</a>
                   
                </div>
            </div>
    </div>
</div>
<div class="container-fluid" style="background-image: url({{asset('images/Background_Light.jpg')}}); background-repeat: repeat">
    <div class="row">
        <div class="col-md-2">
            <ul style="list-style:none;">
                <li>About</li>
                <li>Product</li>
                <li>Manufacturing Facilities</li>
                <li>Contact Details</li>
            </ul>
        </div>
        <div class="col-md-8">
                <section class="about p-2 mt-2">
                            <h3 class="text-center">{{$website_about->website_title??''}}</h3>                            
                </section>
                <section class="slider p-2 mt-2">
                <div class="slideshow-container" style="width: 100%; border: 4px solid LightSteelBlue">



<div class="mySlides fade">
    <div class="numbertext">1 / 6</div>
    <img src="images/Slide2.jpg" style="width:100%">
    <div class="text">Azadi Ka Amrit Mahotsav</div>
</div>

<div class="mySlides fade">
    <div class="numbertext">2 / 6</div>
    <img src="images/Slide3.jpg" style="width:100%">
    <div class="text">Azadi Ka Amrit Mahotsav</div>
</div>

<div class="mySlides fade">
    <div class="numbertext">3 / 6</div>
    <img src="images/Slide4.jpg" style="width:100%">
    <div class="text">Strategic Equipments and Services For Indian Defence and Paramilitary Forces</div>
</div>

<div class="mySlides fade">
    <div class="numbertext">4 / 6</div>
    <img src="images/Slide5.jpg" style="width:100%">
    <div class="text">Enabling Colaboration Sanrachana For Self Reliance In Technology</div>
</div>

<div class="mySlides fade" style="width: 100%">
    <div class="numbertext">5 / 6</div>
    <img src="images/Slide1.jpg" style="width:100%">
    <div class="text" id="desctext">COVID-19 Appropriate Behaviour</div>
</div>

<div class="mySlides fade" style="width: 100%">
    <div class="numbertext">6 / 6</div>
    <img src="images/Slide6.jpg" style="width:100%">
    <div class="text" id="desctext">Yantra India Limited</div>
</div>
</div>                         
                </section>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>
<div class="container-fluid" style="background-image: url({{asset('images/footer_details.jpg')}}); background-repeat: repeat">
    <div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
            <p class="text-white text-center">
                Copyright © 2022 - All Rights Reserved - Official Website of Yantra India Limited<br>
Yantra India Limited Head Quarter: Ordnance Factory Ambajhari, Amravati Road, Wadi, Nagpur-440021 (MS), India<br>
CIN: U35303MH2021GOI365890<br>
Note: Content on this website is published and managed by Yantra India Limited
For any query regarding this website, please contact the web information manager at<br>
Phone No.: 07104-246845    Fax: 07104-246681<br>
E-mail ID: yil.hq@yantraindia.co.in<br>
Website Maintained by Yantra India Limited<br>
Designed & Developed By Information Technology Center At Ordnance Factory Ambarnath</p>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
</div>



</div>
</body>
</html>