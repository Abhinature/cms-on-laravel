<!DOCTYPE html>
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
        <div class="row p-2" style="background-image: url(images/first_row_light.jpg); background-repeat: repeat">
            <div class="col-sm-6">
                <form id="frmsearch" method="post" action="search.php" onSubmit="return validateform()">
                    <div style="float: left">
                        <input type="text" id="txtsearch" name="txtsearch" value="" placeholder="What are you looking for" style="width: 200px; font-family: Calibri; height: 25px; color: #29468c; font-weight: Bold; background-color: White; border: none">
                    </div>
                    <div style="float: left">
                        <img src="images/search.png" style="background: #29468c; width: 25px; border-radius: 2px; cursor: pointer;" title="Search Within Website" onClick="submitform()">
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <div style="float:right;">
                    <a href="https://twitter.com/YantraIndiaLtd" target="_blank"><img src="images/twitter.png" height="25px" title="Tweeter" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
                    <a href=""><img src="images/facebook.png" height="25px" title="Facebook" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
                    <a href=""><img src="images/instagram.png" height="25px" title="Instagram" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
                    <a href="https://www.youtube.com/watch?v=tlj4l2XD90o"><img src="images/youtube.png" height="25px" title="YouTube" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
                    <a href=""><img src="images/linkedin.png" height="25px" title="LinkedIn" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
                    <a href="{{route('login')}}"><img src="images/login.png" height="25px" title="Sign In" style="filter:drop-shadow(0px 0px 2px Black);"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="background-image: url(images/Background_Light.jpg); background-repeat: repeat">
        <div class="container pt-1 pb-1">
            <div class="row">
                <div class="col-md-4 text-left">
                    <a href="logo.php"><img src="images/YIL Logo.png" alt="Yantra India Limited Logo" height="120px" title="Watch The Logo Reveal Video"></a>
                </div>
                <div class="col-md-4 text-center">
                    <a href="logo.php"><img src="images/YIL Logo Text Light.png" alt="Yantra India Limited Logo" height="120px" title="Watch The Logo Reveal Video"></a>
                </div>
                <div class="col-md-4">
                    <div style="float:right">
                        <img src="images/emblem.png" alt="Yantra India Limited Logo" height="100px"><img src="images/logo.png" alt="Azadi ka amrit mahotsav" height="100px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="background-image: url(images/Nav_Background_Light.jpg); background-repeat: repeat">
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
    <div class="container-fluid pt-3" style="background-image: url(images/Background_Light.jpg); background-repeat: repeat">
        <div class="container mt-5 mb-5 pb-4">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <img src="{{asset('images/India Map.jpg')}}" />
                </div>
                <div class="col-sm-12 col-md-4 mt-3 mb-5">
                    <div style="background:#0a558c;color:LightSkyBlue;" class="card mb-2">
                        <h4 class="text-center">
                            Yantra India Limited
                        </h4>
                    </div>
                    <?php $production_units = App\Http\Controllers\Admin\UnitController::getallactiveunits(); ?>


                    <div class="card text-center">

                        <div style="background:#3898ca;" class="card-header  mb-2 text-white">
                            <h5>List of Production Units</h5>
                        </div>

                        <div class="card-body">
                            <ul>
                                @foreach($production_units as $pu)
                                <a style="text-decoration:none;" href="{{route('production-unit-page',['id'=> Crypt::encrypt($pu->id)])}}">
                                    <li class="mt-3">
                                        <h6>{{$pu->unit_name}}</h6>
                                    </li>
                                </a>
                                @endforeach
                            </ul>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="container-fluid" style="background-image: url(images/footer_details.jpg); background-repeat: repeat">
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
                        Phone No.: 07104-246845 Fax: 07104-246681<br>
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