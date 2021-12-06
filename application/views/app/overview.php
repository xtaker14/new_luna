<?php 
header('Content-Type: text/html; charset=utf-8');
 ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<style>	
		img{
			visibility: hidden;
		}
	</style>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content='#000000' name='theme-color'/>
	<meta content='#000000' name='msapplication-navbutton-color'/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/x-icon" href="<?php print_r(site_url('favicon.ico')) ?>" />
	<meta name="Language" content="en" />
	<meta http-equiv="content-language" content="en" />
	<link rel="canonical" href="<?php print_r(current_url()); ?>"/>
	<title><?= SITE_NAME ?></title>
	<?php $this->load->view("app/_part/head-js.php") ?>
	<script data-ad-client="ca-pub-7600905645602632" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<?php $this->load->view("app/_part/css.php") ?>
</head>
<body>
	<!-- <div class="cover_loading">
		<div class="fa-4x"><i class="fas fa-cog fa-spin text-white"></i></div>
		<div class="fa-2x"><i class="fas fa-cog fa-spin text-white"></i></div>
	</div> -->
	<div id="preloader">
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
	</div>
	
	<main>
		<!-- <div class="container">  -->
		<div class="">

			<!-- <div class="col-md-12" style="background-color: rgb(000000);">
				<img src="<?php print_r(base_url('assets/frontpage/img/top_banner.png')) ?>" class="img-fluid" />
			</div> -->
			<div class="col-md-12 parent_banner">
				<a href="<?= base_url(); ?>">
					<img src="<?= base_url('assets/frontpage/img/luna_logo3.png'); ?>" class="img-fluid image_logo_mobile" data-no-retina />
				</a>

				<img src="<?= base_url('assets/frontpage/img/characters.png'); ?>" class="img-fluid image_logo_char" data-aos="fade-down-left" />

				<div class="clouds">
					<img style="--i:1;" src="<?= base_url('assets/frontpage/img/clouds/cloud1.png'); ?>">
					<img style="--i:2;" src="<?= base_url('assets/frontpage/img/clouds/cloud2.png'); ?>">
					<img style="--i:3;" src="<?= base_url('assets/frontpage/img/clouds/cloud3.png'); ?>">
					<img style="--i:4;" src="<?= base_url('assets/frontpage/img/clouds/cloud4.png'); ?>">
					<img style="--i:5;" src="<?= base_url('assets/frontpage/img/clouds/cloud5.png'); ?>">
				</div>
			</div> 
		</div>
		<div class="d-block bg-blue-gradient parent_main_navbar" align="center">
			<div class="container" style="display: flex;position:relative">
				<div class="col-md-4 left_main_navbar" style="margin:0; padding:0;"> 
				</div>
				<div class="col-md-8 right_main_navbar" style="margin:0; padding:0;">
					<?php $this->load->view("app/_part/navbar.php") ?>	
				</div>			
				</div>
			</div>
		</div>
		
		<?php if($this->session->flashdata('success') || $this->session->flashdata('error')): ?>
			<!-- <div class="d-block" align="center"> -->
			<?php $this->load->view("app/_part/sess_flash.php"); ?>
			<!-- </div> -->
		<?php endif; ?>
	
		<div class="container main_content mb-4" >
			<div class="row">
				<div class="col-md-4 mb-2 pt-3 parent_left_main_content"> 
					<?php $this->load->view("app/_part/sidebar_left.php") ?>
				</div>
				<div class="col-md-8 mb-2 pt-3 parent_right_main_content">
					<!-- $this->load->view("app/_part/navbar.php") -->
					<?php $this->load->view("app/_main/".$php_name.".php") ?>	
				</div>			
				</div>
			</div>
		</div>
		<div class="bottom_background"></div>
	</main>

	<?php
		if(!empty($usr_session)){  
			$this->load->view("app/_part/_sidebar/modal_user_info.php");	
		}  
		$popup = $this->session->flashdata('popup');
		if($popup){
			$this->load->view("app/_main/_shop/shop_popup.php");
		}
		if($this->uri->segment(1)=='donate'){
			$this->load->view("app/_main/_donate/donate_popup.php");
		}
	?>  
	
	<?php if(!empty($config_web['widget_discord_link'])): ?>
		<div class="parent_discord">
			<iframe style="display: none;" src="<?= $config_web['widget_discord_link']; ?>" width="360" height="330" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
			<button class="btn_open_discord">
				<img src="<?= base_url('assets/frontpage/img/btn_discord.gif'); ?>" style="width: 110px; height: 35px;">
			</button>  
		</div>
	<?php endif; ?>

	<?php $this->load->view("app/_part/im_modal.php");?>
	<?php $this->load->view("app/_part/sticky.icon.php") ?>
	<?php $this->load->view("app/_part/footer.php") ?>
	<?php $this->load->view("app/_part/footer-js.php") ?>
	<!-- <?php $this->load->view("app/_part/css.php") ?> -->
</body>
</html>