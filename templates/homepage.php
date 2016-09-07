<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hollywood Terraces</title>

    <link href="css/bootstrap.php" rel="stylesheet">
	<link href="styles/style.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/scroll.js"></script>
	    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">
  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">

<div id="home"></div>                 
    <div class="container-fluid" >
	<div class="row">
		<div class="col-md-12">
        
        <!-- menu -->
			<nav id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" href="#home"><img src="images/logo.png" alt="Image Thumbnail" height="31px" width="80px"/></a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right" style="padding-right:65px">
					
						<li>
							<a href="#home">Home</a>
						</li>
						<li>
							<a href="#gallery">Gallery</a>
						</li>
                        <li>
							<a href="#news">News</a>
						</li>
                        <li>
							<a href="#about">About Us</a>
						</li>
                        <li>
							<a href="#3d">3D Tour</a>
						</li>
                        <li>
							<a href="#contact">Contact Us</a>
						</li>
                        <li>
							<a href="https://docs.google.com/forms/d/1-MbagV3-1S3NrxGt4jiv4E9rtAuZp-pdTdkfCucEcy0/viewform?embedded=true#start=embed" class="fancybox fancybox.iframe">Survey Form</a>
						</li>



					</ul>
				</div>
				
			</nav>
		</div>
	</div>
    

	<div id="home"></div>
    <!-- home -->

	
	<?php include "homeindex.php" ?>

    
     <!-- gallery -->
     <?php require( "gallery.php" );?> 
   
   
    
    <!-- news -->
    <?php require( "callnews.php" );?> 
     

    <!-- about -->
    <?php require( "homeabout.php" );?>    
   
      
    <!-- 3d -->
    <?php require("call3d.php");?>  
    

    <!-- contact -->
    <?php contactus() ;?>    


</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	
  </body>
</html>