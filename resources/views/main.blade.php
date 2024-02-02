<head>
	<meta name="description" content="Yantra India Limited">
	<meta name="keywords" content="header, home page, home, yantra india limited, yantra india">
	<meta name="author" content="Tanmay Bhattacharya">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
	<script language="javascript" type="application/javascript">
	</script>
</head>
<!doctype html>
<html>

<head>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-HMH0MJWNP9"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'G-HMH0MJWNP9');
	</script>
	<meta charset="utf-8">
	<meta name="description" content="Yantra India Limited Home Page">
	<meta name="keywords" content=", , ">
	<meta name="author" content="Tanmay Bhattacharya">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
	<meta name="google-site-verification" content="x-PBfRyV_o0M_NAhnfv0FlmJzF4hMcwt_jXp-P3h5E4" />
	<title>Yantra India Limited - Official Website</title>
	<link rel="stylesheet" href="stylesheet.css">
	<link rel=icon href="images/Yantra India Icon.png" type="image/png">
	<script>
		var slideIndex = 1;
		showSlides(slideIndex);

		// Next/previous controls
		function plusSlides(n) {
			showSlides(slideIndex += n);
		}

		// Thumbnail image controls
		function currentSlide(n) {
			showSlides(slideIndex = n);
		}

		function showSlides(n) {
			var i;
			var slides = document.getElementsByClassName("mySlides");
			var dots = document.getElementsByClassName("dot");
			if (n > slides.length) {
				slideIndex = 1
			}
			if (n < 1) {
				slideIndex = slides.length
			}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex - 1].style.display = "block";
			dots[slideIndex - 1].className += " active";
		}

		var slideIndex = 0;
		showSlides();

		function showSlides() {
			var i;
			var slides = document.getElementsByClassName("mySlides");
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			slideIndex++;
			if (slideIndex > slides.length) {
				slideIndex = 1;
			}
			slides[slideIndex - 1].style.display = "block";
			setTimeout(showSlides, 3000); // Change image every 3 seconds
		}

		function changesrc1active(e) {
			e.src = "images/Our Products Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc1inactive(e) {
			e.src = "images/Our Products Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrc2active(e) {
			e.src = "images/Production Sections Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc2inactive(e) {
			e.src = "images/Production Sections Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrc3active(e) {
			e.src = "images/Our Units Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc3inactive(e) {
			e.src = "images/Our Units Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrc4active(e) {
			e.src = "images/About Us Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc4inactive(e) {
			e.src = "images/About Us Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrc5active(e) {
			e.src = "images/R & D Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc5inactive(e) {
			e.src = "images/R & D Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrc6active(e) {
			e.src = "images/Sustainable Development Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc6inactive(e) {
			e.src = "images/Sustainable Development Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrc7active(e) {
			e.src = "images/Gallery Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc7inactive(e) {
			e.src = "images/Gallery Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrc8active(e) {
			e.src = "images/Phone Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc8inactive(e) {
			e.src = "images/Phone Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrc9active(e) {
			e.src = "images/RTI Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc9inactive(e) {
			e.src = "images/RTI Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrc10active(e) {
			e.src = "images/More Links Active.png";
			//e.style.boxShadow = "2px 2px 12px 2px Silver";
			e.style.position = "relative";
			e.style.top = "-5px";
		}

		function changesrc10inactive(e) {
			e.src = "images/More Links Inactive.png";
			//e.style.boxShadow = "2px 2px 8px 2px Silver";
			e.style.position = "relative";
			e.style.top = "0px";
		}

		function changesrctopactive() {
			document.getElementById("imgtop").src = "images/Top Arrow Active.png";
		}

		function changesrctopinactive(e) {
			document.getElementById("imgtop").src = "images/Top Arrow Inactive.png";
		}
	</script>
	<style>
		.navblock {
			//-webkit-filter: drop-shadow(5px 5px 5px #666666);
			//filter: drop-shadow(5px 5px 5px #666666);
		}
	</style>
</head>

<body style="margin: 0px; background-image: url(images/Background_Light.jpg); background-repeat: repeat" bgcolor="White">
	<!--<body style="margin: 0px" bgcolor="White">-->

	<!-- <body style="margin: 0px; background-image: image(images/)"> -->
		<button onclick="topFunction()" id="myBtn" title="Go to top" onMouseOver="changesrctopactive(this)" onMouseOut="changesrctopinactive(this)"><img id="imgtop" src="images/Top Arrow Inactive.png" width="20px"></button>
		<center>
			<header>
				<font face="Calibri" size="3">
					<table border="0" cellspacing="0" cellpadding="5" width="100%">
						<!--<tr bgcolor="LightSkyBlue">-->
						<tr style="background-image: url(images/first_row_light.jpg); background-repeat: repeat">
							<td width="5%"></td>
							<td width="10%">
								<form id="frmsearch" method="post" action="search.php" onSubmit="return validateform()">
									<div style="float: left">
										<input type="text" id="txtsearch" name="txtsearch" value="" placeholder="What are you looking for" style="width: 200px; font-family: Calibri; height: 25px; color: #29468c; font-weight: Bold; background-color: White; border: none">
									</div>
									<div style="float: left">
										<img src="images/search.png" style="background: #29468c; width: 25px; border-radius: 2px; cursor: pointer;" title="Search Within Website" onClick="submitform()">
									</div>
								</form>
							</td>
							<td>
								<!-- <a href="change_language.php?url={{url('/')}}" style="text-decoration: none; color: White; font-weight: 400" title="Switch Website to Hindi">Hindi Website</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="change_theme.php?url={{url('/')}}"><img src="images/Dark Mode.png" alt="theme" height="15px" title="Switch to Dark Mode"></a> -->
							</td>
							<td align="right" width="15%">
								<a href="https://twitter.com/YantraIndiaLtd" target="_blank"><img src="images/twitter.png" height="25px" title="Tweeter" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
								<a href=""><img src="images/facebook.png" height="25px" title="Facebook" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
								<a href=""><img src="images/instagram.png" height="25px" title="Instagram" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
								<a href="https://www.youtube.com/watch?v=tlj4l2XD90o"><img src="images/youtube.png" height="25px" title="YouTube" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
								<a href=""><img src="images/linkedin.png" height="25px" title="LinkedIn" style="filter:drop-shadow(0px 0px 2px Black);"></a>&nbsp;&nbsp;
								<a href="{{route('login')}}"><img src="images/login.png" height="25px" title="Sign In" style="filter:drop-shadow(0px 0px 2px Black);"></a>
							</td>
							<td width="5%"></td>
						</tr>
						<!--<tr bgcolor="White"><td width="5%"></td>-->
						<tr style="background-image: url(images/Background_Light.jpg); background-repeat: repeat">
							<td width="5%"></td>
							<td width="20%"><a href="logo.php"><img src="images/YIL Logo.png" alt="Yantra India Limited Logo" height="120px" title="Watch The Logo Reveal Video"></a></td>
							<td align="center"><a href="logo.php"><img src="images/YIL Logo Text Light.png" alt="Yantra India Limited Logo" height="120px" title="Watch The Logo Reveal Video"></a></td>
							<td align="right" width="20%"><img src="images/emblem.png" alt="Yantra India Limited Logo" height="100px"><img src="images/logo.png" alt="Azadi ka amrit mahotsav" height="100px"></td>
							<td width="5%"></td>
						</tr>
					</table>
					<table border="0" cellspacing="0" cellpadding="10" width="100%" style="background-image: url(images/Nav_Background_Light.jpg); background-repeat: repeat">
						<!--<tr bgcolor="#29468c"><td width="5%"></td>-->
						<tr>
							<td width="5%"></td>
							<td valign="center">
								<font face="Calibri" color="White" size="4"><a href="{{url('/')}}" style="text-decoration:none; color:White; font-family: Calibri; background-color: ; padding: 4px 4px; transition: 0.6 ease; border-radius: 4px; line-height: 1.6;">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline; border-bottom-width: 1px; border-bottom-style: solid"><strong>Home</strong></div>
									</a>
									<font color="White">&nbsp;|&nbsp;</font><a href="#" style="text-decoration:none; color:LightCyan; font-family: Calibri; line-height: 1.6">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline">About Us</div>
									</a>
									<font color="White">&nbsp;|&nbsp;</font><a href="#" style="text-decoration:none; color:LightCyan; font-family: Calibri; line-height: 1.6">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline">Apex Authority</div>
									</a>
									<font color="White">&nbsp;|&nbsp;</font><a href="#" style="text-decoration:none; color:LightCyan; font-family: Calibri; line-height: 1.6">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline">Products</div>
									</a>
									<font color="White">&nbsp;|&nbsp;</font><a href="{{route('production-units')}}" style="text-decoration:none; color:LightCyan; font-family: Calibri; line-height: 1.6">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline">Production Units</div>
									</a>
									<font color="White">&nbsp;|&nbsp;</font><a href="#" style="text-decoration:none; color:LightCyan; font-family: Calibri; line-height: 1.6">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline">RTI</div>
									</a>
									<font color="White">&nbsp;|&nbsp;</font><a href="#" style="text-decoration:none; color:LightCyan; font-family: Calibri; line-height: 1.6">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline">Vigilance</div>
									</a>
									<font color="White">&nbsp;|&nbsp;</font><a href="#" style="text-decoration:none; color:LightCyan; font-family: Calibri; line-height: 1.6">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline">Contact Us</div>
									</a>
									<font color="White">&nbsp;|&nbsp;</font><a href="#" style="text-decoration:none; color:LightCyan; font-family: Calibri; line-height: 1.6">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline">Downloads<sup>
												<font color="Red">&nbsp;&#9679;</font>
											</sup></div>
									</a>
									<font color="White">&nbsp;|&nbsp;</font><a href="#" style="text-decoration:none; color:LightCyan; font-family: Calibri; line-height: 1.6">
										<div class="nav" style="padding: 4px 6px; border: 8px; border-radius: 5px; display: inline">Career<sup>
												<font color="Red">&nbsp;&#9679;</font>
											</sup></div>
									</a>
								</font>
							</td>
							<td width="5%"></td>
						</tr>
					</table>
				</font>
			</header> <!-- Slideshow container -->
			<table border="0" cellspacing="10" cellpadding="2" width="100%">

				<tr>
					<th width="15%"></th>
					<th bgcolor="AliceBlue" style="border-radius: 10px; box-shadow: 0px 0px 4px Silver">
						<marquee width="100%" direction="left" style="background-color: AliceBlue; padding: 10px; align: center; font-family: Calibri; font-size: 15px; font-weight: 400; font-size: 16px; color: Maroon" onMouseOver="this.stop()" onMouseOut="this.start()"><strong>
								<font size="5">To apply online for Trade Apprenticeship please visit <a href="https://recruit-gov.com/Yantra2023" style="text-decoration:none; color: Blue"><u>https://recruit-gov.com/Yantra2023.</u></a></font>
							</strong></marquee>
					</th>
					<th width="15%"></th>
				</tr>
				<tr>
					<th width="15%"></th>
					<th bgcolor="AliceBlue" style="border-radius: 10px; box-shadow: 0px 0px 4px Silver">
						<marquee width="100%" direction="left" style="background-color: AliceBlue; padding: 10px; align: center; font-family: Calibri; font-size: 15px; font-weight: 400; font-size: 16px; color: Navy" onMouseOver="this.stop()" onMouseOut="this.start()"><strong>Invitation of bids for Shops and open land on lease for 5 years <a href="https://www.yantraindia.co.in/uploads/9_YIL_Document_2023-02-28.pdf" style="text-decoration:none; color: Blue"><u>Click Here for Details.</u></a></strong></marquee>
					</th>
					<th width="15%"></th>
				</tr>
				<tr>
					<th width="15%"></th>
					<th bgcolor="AliceBlue" style="border-radius: 10px; box-shadow: 0px 0px 4px Silver">
						<marquee width="100%" direction="left" style="background-color: AliceBlue; padding: 10px; align: center; font-family: Calibri; font-size: 15px; font-weight: 400; font-size: 16px; color: Navy" onMouseOver="this.stop()" onMouseOut="this.start()"><strong>Advertisement for Engagement of Trade Apprentice 2023 <a href="https://www.yantraindia.co.in/career/10_YIL_Career_Document_2023-03-01.pdf" style="text-decoration:none; color: Blue"><u>Click Here for Details.</u></a></strong></marquee>
					</th>
					<th width="15%"></th>
				</tr>
				<tr>
					<th width="15%"></th>
					<th>
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

					</th>
					<th width="15%"></th>
				</tr>
			</table>


			<table border="0" cellspacing="0" cellpadding="10" width="100%">
				<tr>
					<th width="12%"></th>
					<th width="11%"><a href="#"><img id="imgprod" class="navblock" onMouseOver="changesrc1active(this)" onMouseOut="changesrc1inactive(this)" src="images/Our Products Inactive.png" width="50%"></a></th>
					<th width="11%"><a href="#"><img id="imgfacility" class="navblock" onMouseOver="changesrc2active(this)" onMouseOut="changesrc2inactive(this)" src="images/Production Sections Inactive.png" width="50%"></a></th>
					<!--<th width="11%"><img id="imgunit" class="navblock" onMouseOver="changesrc3active(this)" onMouseOut="changesrc3inactive(this)" src="images/Our Units Inactive.png" width="60%"></th>-->
					<th width="11%"><a href="under_construction.php"><img id="imgrandd" class="navblock" onMouseOver="changesrc5active(this)" onMouseOut="changesrc5inactive(this)" src="images/R & D Inactive.png" width="50%"></a></th>
					<!--<th width="15%"></th>-->

					<th width="28%" rowspan="2" valign="top" style="padding-top: 30px; padding-bottom: 30px">
						<marquee behavior="" direction="up" height="390px" scrollamount="2" scrolldelay="25" onMouseOver="this.stop()" onMouseOut="this.start()">


							<div style="background-color: AliceBlue; padding: 10px; align: center; font-family: Calibri; font-size: 15px; font-weight: 400; font-size: 16px; color: Navy">
								<table border="0" cellspacing="0" cellpadding="5" width="100%">
									<tr>
										<th></th>
										<th align="Left">
											<font color="Navy">Invitation of bids for Shops and open land on lease for 5 years</font>
										</th>
									</tr>
									<tr>
										<th valign="top"><img src="images/Press Release.png" width="50px"></th>
										<td align="Left" valign="top">
											<hr width="60%" align="left" color="Navy">
											<p align="justify">
												<font color="MidnightBlue">&emsp;&emsp;Invitation of bids for Shops and open land on lease for 5 years <a href="https://www.yantraindia.co.in/uploads/9_YIL_Document_2023-02-28.pdf" style="text-decoration:none; color:Blue"><u>Click Here for Details.</u></a></font>
											</p>
										</td>
									</tr>
								</table>
							</div>
							<br>
							<div style="background-color: AliceBlue; padding: 10px; align: center; font-family: Calibri; font-size: 15px; font-weight: 400; font-size: 16px; color: Navy">
								<table border="0" cellspacing="0" cellpadding="5" width="100%">
									<tr>
										<th></th>
										<th align="Left">
											<font color="Navy">Advertisement for Engagement of Trade Apprentice 2023</font>
										</th>
									</tr>
									<tr>
										<th valign="top"><img src="images/vacancy.png" width="50px"></th>
										<td align="Left" valign="top">
											<hr width="60%" align="left" color="Navy">
											<p align="justify">
												<font color="MidnightBlue">&emsp;&emsp;Advertisement for Engagement of Trade Apprentice 2023 <a href="https://www.yantraindia.co.in/career/10_YIL_Career_Document_2023-03-01.pdf" style="text-decoration:none; color:Blue"><u>Click Here for Details.</u></a></font>
											</p>
										</td>
									</tr>
								</table>
							</div>
							<br>
							<div style="background-color: AliceBlue; padding: 10px; align: center; font-family: Calibri; font-size: 15px; font-weight: 400; font-size: 16px; color: Navy">
								<table border="0" cellspacing="0" cellpadding="5" width="100%">
									<tr>
										<th></th>
										<th align="Left">
											<font color="Navy">About Yantra India Limited</font>
										</th>
									</tr>
									<tr>
										<th valign="top"><img src="images/YIL.png" width="50px"></th>
										<td align="Left" valign="top">
											<hr width="60%" align="left" color="Navy"><a href="#" style="text-decoration:none; color: MidnightBlue">
												<p align="justify">
													<font color="MidnightBlue">Yantra India Limited has been incorporated as Government Company (wholly owned by Government of India) with Limited liability of shares under the Company's Act - 2013 with Registered and Corporate Office at Ordnance Factory Ambajhari, Amravati Road, Nagpur, Maharashtra, India - 440021. The Corporate Identity Number (CIN) of Yantra India Limited is U35303MH2021GOI365890. Yantra India Limited has commenced its business w.e.f 1st October, 2021.</font>
												</p>
											</a>
										</td>
									</tr>
								</table>
							</div>
						</marquee>
					</th>

					<th width="27%"></th>
				</tr>
				<!--<tr><td colspan="7">&nbsp;</td></tr>-->
				<tr>
					<th width="10%"></th>
					<th width="15%"><a href="#"><img id="imggallery" class="navblock" onMouseOver="changesrc7active(this)" onMouseOut="changesrc7inactive(this)" src="images/Gallery Inactive.png" width="50%"></a></th>
					<th width="15%"><a href="#"><img id="imgcontact" class="navblock" onMouseOver="changesrc8active(this)" onMouseOut="changesrc8inactive(this)" src="images/Phone Inactive.png" width="50%"></a></th>
					<th width="15%"><a href="#"><img id="imgrti" class="navblock" onMouseOver="changesrc9active(this)" onMouseOut="changesrc9inactive(this)" src="images/RTI Inactive.png" width="50%"></a></th>
					<!--<th width="15%"></th>-->
					<th width="10%"></th>
				</tr>
			</table>
			<table width="100%" cellpadding="10" cellspacing="0">
				<!--<tr bgcolor="AliceBlue"><th width="5%"></th>-->
				<tr style="background-image: url(images/marquee_background_light.jpg); background-repeat: repeat">
					<th width="5%"></th>
					<th align="center">
						<marquee behavior="scroll" onMouseOver="this.stop()" onMouseOut="this.start()">
							<img src="images/logo.png" height="60px">
							<img src="images/YIL LOGO.png" height="60px">
							<img src="images/ISO14001.png" height="60px">
							<img src="images/Make_In_India.png" height="60px">
							<img src="images/Quality.png" height="60px">
							<img src="images/Safety.png" height="60px">
							<img src="images/Mission Vision.png" height="60px">
							<img src="images/ECO.png" height="60px">
							<img src="images/Garbage.png" height="60px">
							<img src="images/swacch_bharat.png" height="60px">
						</marquee>
					</th>
					<th width="5%"></th>
				</tr>
			</table>
			<footer>
				<table border="0" cellspacing="0" cellpadding="10" width="100%" bgcolor="#212121">

					<tr style="background-image: url(images/footer_menu.jpg); background-repeat: repeat">
						<td width="5%"></td>
						<td align="center" colspan="6">
							<font face="Calibri" color="LightSkyBlue" size="3">
								<a href="{{url('/')}}" style="text-decoration:none; color:LightSkyBlue; font-family: Calibri">Home</a>&nbsp;|&nbsp;
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
							</font>
						</td>
						<td width="5%"></td>
					</tr>
				</table>

				<table border="0" cellspacing="0" cellpadding="10" width="100%" bgcolor="Black">

					<tr style="background-image: url(images/footer_details.jpg); background-repeat: repeat">
						<td width="5%"></td>
						<td align="center" colspan="3">
							<font face="Calibri" color="LightSkyBlue" size="3">
								Copyright &#169 2022 - All Rights Reserved - Official Website of Yantra India Limited<br>
								Yantra India Limited Head Quarter: Ordnance Factory Ambajhari, Amravati Road, Wadi, Nagpur-440021 (MS), India<br>
								CIN: U35303MH2021GOI365890<br>
								Note: Content on this website is published and managed by Yantra India Limited<br>
								For any query regarding this website, please contact the web information manager at<br>
								Phone No.: 07104-246845&nbsp;&nbsp;&nbsp;&nbsp;Fax: 07104-246681<br>
								E-mail ID: yil.hq@yantraindia.co.in<br>
								Website Maintained by Yantra India Limited<br>
								<!--<font color="#101010">-->Designed &amp; Developed By Information Technology Center At Ordnance Factory Ambarnath
						</td>
						<td width="5%"></td>
					</tr>
					</font>
				</table>
				<table border="0" cellspacing="0" cellpadding="10" width="100%" bgcolor="Black">
					<tr style="background-image: url(images/footer_details.jpg); background-repeat: repeat">
						<td width="5%"></td>
						<td width="20%">
							<font face="Calibri" color="LightSkyBlue" size="3">Website Last Updated On : </font>
							<font face="Calibri" color="AliceBlue" size="3">06-03-2023</font>
						</td>
						<td width="20%" align="center">
							<font face="Calibri" color="LightSkyBlue" size="3">Unique Visitor Count : </font>
							<font face="Calibri" color="AliceBlue" size="3">340,455</font>
						</td>
						<td width="20%" align="right">
							<font face="Calibri" color="LightSkyBlue" size="3">Your IP Address : </font>
							<font face="Calibri" color="AliceBlue" size="3">120.57.114.112</font>
						</td>
						<td width="20%" align="right">
							<font face="Calibri" color="LightSkyBlue" size="3">Last Visited On : </font>
							<font face="Calibri" color="AliceBlue" size="3">06-03-2023 09:54</font>
						</td>
						<td width="5%"></td>
					</tr>
				</table>
			</footer>
		</center>
		<script>
			var mybutton = document.getElementById("myBtn");

			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function() {
				scrollFunction()
			};

			function scrollFunction() {
				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
					mybutton.style.display = "block";
				} else {
					mybutton.style.display = "none";
				}
			}

			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			}

			var flg = 0;
			//var slideIndex = 1;
			var slideIndex = 1;
			showSlides(slideIndex);

			function plusSlides(n) {
				flg = 1;
				showSlides(slideIndex += n);
			}

			function currentSlide(n) {
				showSlides(slideIndex = n);
			}

			function showSlides(n) {
				if (flg == 0) {
					var i;
					var slides = document.getElementsByClassName("mySlides");


					for (i = 0; i < slides.length; i++) {
						slides[i].style.display = "none";
					}

					slides[slideIndex - 1].style.display = "block";

					slideIndex++;
					if (slideIndex > slides.length) {
						slideIndex = 1;
					}
					setTimeout(showSlides, 3000); // Change image every 3 seconds
				} else {
					var i;
					var slides = document.getElementsByClassName("mySlides");

					if (n > slides.length) {
						slideIndex = 1;
					}
					if (n < 1) {
						slideIndex = slides.length;
					}
					for (i = 0; i < slides.length; i++) {
						slides[i].style.display = "none";
					}
					slides[slideIndex - 1].style.display = "block";

					//slideIndex++;
					if (slideIndex > slides.length) {
						slideIndex = 1;
					}
					//setTimeout(showSlides, 3000); // Change image every 3 seconds	
				}
			}
		</script>
	</body>

</html>