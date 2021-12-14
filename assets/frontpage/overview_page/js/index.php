<?php
$b_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$exp_script_name = explode('/',substr($_SERVER['SCRIPT_NAME'],1));
$b_url .= '/'.str_replace(basename($_SERVER['SCRIPT_NAME']),"", reset($exp_script_name)).'/';
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>404 Not Found</title>
	<meta name="description" content="">
	<meta name="viewport" content="widtd=device-widtd, initial-scale=1">
	<!-- Place favicon.ico in tde root directory -->
	<link rel="shortcut icon" type="image/x-icon" href="<?= $b_url; ?>assets/corporate/user/images/MAINICON.ico">    
	<!-- bootstrap v3.3.6 css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/bootstrap.min.css">
	<!-- font-awesome css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/font-awesome.min.css">
	<!-- animate css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/animate.css">
	<!-- Main Menu css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/rsmenu-main.css">
	<!-- rsmenu transitions css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/rsmenu-transitions.css">
	<!-- hover-min css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/hover-min.css">
	  <!-- magnific-popup css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/magnific-popup.css">
	<!-- owl.carousel css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/owl.carousel.css">
	<!-- Slick css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/slick.css">
	<!-- style css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/style.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="<?= $b_url; ?>assets/corporate/user/css/responsive.css">
</head>
<body class="home-two" style="background: #ba8515;">
	<!--Preloader start here-->
	<div id="preloader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>  
	<div class="rs-error" style="display: flex;/*height: 100%;*/justify-content: center;align-items: center;position: fixed;width: 100%;">
		<div class="container">
			<div class="error-image">
				<img src="<?= $b_url; ?>assets/corporate/user/images/breadcrumbs/error.jpg" alt="">
			</div>
		</div>
	</div> 

	<!-- all js here -->
	<!-- jquery latest version -->
	<script src="<?= $b_url; ?>assets/corporate/user/js/jquery.min.js"></script> 
	 <!-- jquery-ui js -->
	<script src="<?= $b_url; ?>assets/corporate/user/js/jquery-ui.min.js"></script>
	<!-- bootstrap js -->
	<script src="<?= $b_url; ?>assets/corporate/user/js/bootstrap.min.js"></script> 
	<!-- wow js -->
	<script src="<?= $b_url; ?>assets/corporate/user/js/wow.min.js"></script>  
	<!-- main js -->
	<script src="<?= $b_url; ?>assets/corporate/user/js/main.js"></script>
</body> 
</html>