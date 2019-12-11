<!doctype html>
<html lang="en" class="no-js">
<head>
	<title>Archives</title>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>main/css/bootstrap.min.css" media="screen">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>main/css/jquery.bxslider.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>main/css/font-awesome.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>main/css/magnific-popup.css" media="screen">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>main/css/owl.carousel.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>main/css/owl.theme.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>main/css/ticker-style.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>main/css/style.css" media="screen">
	<!--font awesome cdn-->
    <script src="https://use.fontawesome.com/93f67c57ef.js"></script>
	<!--gtoogle plus-->
	<script src="https://apis.google.com/js/platform.js" async defer></script>

</head>
<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=450682155318758";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<!-- Container -->
	<div id="container">

		<!-- Header
		    ================================================== -->
		<header class="clearfix">
			<!-- Bootstrap navbar -->
			<nav class="navbar navbar-default navbar-static-top" role="navigation">

				<!-- Top line -->
				<div class="top-line">
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<ul class="top-line-list">
									<li><span class="time-now"> <?php echo date("D,F j, Y");?></span></li>
									<li><a href="<?php echo base_url();?>AdminController" target="_blank">Log In</a></li>
									<li><a href="<?php echo base_url();?>MainController/contact">Contact</a></li>
								</ul>
							</div>	
							<div class="col-md-6">
								<ul class="social-icons">
								
									<li>
										<div class="fb-follow" data-href="https://www.facebook.com/dys.phrenia" data-layout="button_count" data-show-faces="true"></div>
									</li>
									
									<li>
										<div class="g-follow" data-annotation="bubble" data-height="24" data-href="//plus.google.com/+dysphrenia" data-rel="relationshipType"></div>
									</li>
									<li>
									<a class="twitter-follow-button"
									  href="https://twitter.com/Dysphrenia"
									  data-size="default" data-show-count="true" data-show-screen-name="false">
									Follow</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
										
									</li>
									
								</ul>
							</div>
							<div class="col-md-2">
							    <form method="get" action="<?php echo base_url();?>MainController/SearchArticle">
							        <div class="form-group">
							            <input type="text" class="form-control fa fa-search" name="search" onchange="this.form.submit();" placeholder="Type here to search" required>
							        </div>
							    </form>
							</div>
						</div>
					</div>
				</div>
				<!-- End Top line -->
				
				<!-- Logo & advertisement -->
				<div class="logo-advertisement">
					<div class="container">

						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>main/images/logo.png" alt=""></a>
						</div>

						<!--<div class="advertisement">
							<div class="desktop-advert">
								<span>Advertisement</span>
								<img src="upload/addsense/728x90-white.jpg" alt="">
							</div>
							<div class="tablet-advert">
								<span>Advertisement</span>
								<img src="upload/addsense/468x60-white.jpg" alt="">
							</div>
						</div>-->
					</div>
				</div>
				<!-- End Logo & advertisement -->
				<!-- navbar list container -->
				<div class="nav-list-container">
					<div class="container">
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-left">

								<li class="drop"><a class="home" href="<?php echo base_url();?>">Home</a></li>
								<li class="drop"><a class="home" href="<?php echo base_url();?>MainController/about">About us</a></li>

								<li><a class="world" href="<?php echo base_url();?>MainController/aboutjournal">About the journal </a></li>
								<li><a class="travel" href="<?php echo base_url();?>MainController/authorinstruction">Author Information </a></li>

								<li><a class="tech" href="<?php echo base_url();?>MainController/reviewer_guide">Reviewer Guide </a></li>
								
								<li><a class="fashion" href="<?php echo base_url();?>MainController/currentissue">Current Issue </a></li>

								<li><a class="fashion" href="<?php echo base_url();?>MainController/archives">Archives </a></li>

								<li class="drop"><a class="features" href="<?php echo base_url();?>MainController/articlesubmission">Article Submit</a></li>

							</ul>
							
						</div>
						<!-- /.navbar-collapse -->
					</div>
				</div>
				<!-- End navbar list container -->

			</nav>
			<!-- End Bootstrap navbar -->

		</header>
		<!-- End Header -->

		<!-- ticker-news-section
			================================================== -->
		<section class="ticker-news">

			<div class="container">
				<div class="ticker-news-box">
					<span class="breaking-news">News</span>
					<span class="new-news">New</span>
					<ul id="js-news">
						<?php foreach($News as $new){?>
						<li class="news-item"><span class="time-news"><?php echo $new["Date"];?></span> <a href="<?php echo $new["URL"];?>"><?php echo $new["Title"];?></a> <?php echo $new["Description"];?>     </li>
					<?php } ?>
					</ul>
				</div>
			</div>

		</section>
		<!-- End ticker-news-section -->

		<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">
			<div class="container">
				<div class="row">
				
				  
				  <!--right side starts-->
				
					<div class="col-sm-12">

						<!-- block content -->
						<div class="block-content">

							<!-- single-post box -->
							<div class="single-post-box">

								<div class="title-post">
									<h1>ARCHIVES </h1>
									
								</div>
								
								<?php foreach($Journal as $row){?>
								<div class="col-sm-12">
								
								   <div class="archiv">
								   
								       <div class="tocc">
									   
									       <div class="lru">
										   
										      <p><?php echo $row["JournalName"];?></p>
										   
										   </div>
										   
										    <div class="ddr">
											
											  <p> ISSN <?php echo $row["ISSNPrint"];?>  </p>
											  <p>ISSN <?php echo $row["ISSNOnline"];?> </p>
											
											</div>
									   
									   </div>
								   
								        <div class="achhh">
										
										    <table>
											<?php foreach($row["volumes"] as $vol){?>
											
											     <tr>
												 
												    <th>
													
													   <?php echo $vol["Year"];?> Vol <?php echo $vol["Volume"];?> 
													
													</th>
													<?php foreach($vol["issues"] as $issue){?>
													<th>
													
													  <div class="mkl">
													  
													   
													    <div class="left">
														
														   <img src="<?php echo base_url();?>admin/images/cover/<?php echo $issue["CoverPhoto"];?>" alt=""/>
														
														</div> 
														
														<div class="right">
														
														   <a href="<?php echo base_url();?>MainController/currentissue/<?php echo $issue["ID"];?>"><?php echo $issue["Month"];?> Issue <?php echo $issue["Issue"];?></a>
														
														</div>
													  
													  </div>
													  
													</th>
													<?php } ?>
													
													
												 
												 </tr>
											<?php } ?>
											
											</table>
										
										</div>
								     
								   </div>
								
								</div>
								<?php } ?>
								
								
							</div>
							<!-- End single-post box -->
							<div class="col-sm-12">
							
							   <div class="ftt-extt">
							   
							        <div class="knnm">
									
									    <img src="<?php echo base_url();?>main/images/img-6.jpg" alt=""/>
										<p>This work is licensed under a <a href="https://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License.</a></p>
									
									</div>
							   
							   </div>
							
							</div>

						</div>
						<!-- End block content -->

					</div>

					<!--right side ends-->

				</div>

			</div>
		</section>
		<!-- End block-wrapper-section -->

<!-- footer 
			================================================== -->
		<footer>
			<div class="container">
				
				<div class="footer-last-line">
					<div class="row">
						<div class="col-md-6">
							<p>&copy; COPYRIGHT 2017 -  Design & Developed By  <a href="http://24techsoft.com/" target="_blank">24TECHSOFT</a></p>
						</div>
						<div class="col-md-6">
							<nav class="footer-nav">
								<ul>
									<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- End footer -->

	</div>
	<!-- End Container -->
	
	<script type="text/javascript" src="<?php echo base_url();?>main/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/jquery.migrate.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/jquery.ticker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/jquery.imagesloaded.min.js"></script>
  	<script type="text/javascript" src="<?php echo base_url();?>main/js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/retina-1.1.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/plugins-scroll.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>main/js/script.js"></script>

</body>
</html>