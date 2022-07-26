<?php 
// header('Content-Type: text/html; charset=utf-8');
$upload_path = "assets/frontpage/img/web_config";
$logo_img = CDN_IMG.($upload_path.'/'.$config_web['logo_img']);
$favico = CDN_IMG.($upload_path.'/'.$config_web['favico_img']); 
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
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" type="image/x-icon" href="<?= $favico; ?>" />
	<meta name="Language" content="en" />
	<meta http-equiv="content-language" content="en" />
	<link rel="canonical" href="<?php print_r(current_url()); ?>"/>
	<title><?= SITE_NAME ?></title>
	<?php $this->load->view("app/_part/head-js.php") ?>
	<script data-ad-client="ca-pub-7600905645602632" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<?php $this->load->view("app/_part/css.php") ?>
</head>
<body>
	
	<div id="preloader">
		<div style="position: relative;"> 
			<div class="parent_img_fly_city loader_fly_city" style="z-index:-1;">
				<img src="<?= CDN_IMG.('assets/frontpage/img/fly_city.png'); ?>" style="margin-top: -120px; visibility: visible;" />
			</div>
			<h1 style="z-index:1;">  
				Loading
				<div class="dots ">
					<span class="dot z"></span><span class="dot f"></span><span class="dot s"></span><span class="dot t"><span class="dot l"></span></span>
				</div>
			</h1> 
		</div>
	</div>
	
	<main> 
		<div class="" style="display: flex;position:absolute;z-index:1000;width:100%;">
			<div class="left_main_navbar" style="margin:0; padding:0;"> 
			</div>
			<div class="col-md-12 right_main_navbar" style="margin:0; padding:0;">
				<?php $this->load->view("app/_part/navbar.php") ?>	
			</div>
		</div>
		
		<!-- <div class="container">  -->
		<div class="">
			<div class="col-md-12 parent_banner">
				<a href="<?= base_url(); ?>">
					<img src="<?= $logo_img; ?>" class="img-fluid image_logo_mobile" data-no-retina />
				</a>
			</div> 
		</div>
		
		<?php if($this->session->flashdata('success') || $this->session->flashdata('error')): ?>
			<?php $this->load->view("app/_part/sess_flash.php"); ?>
		<?php endif; ?>
	
		<div class="container main_content mb-4" style="margin-bottom: 100px !important;">
			<?php 
				$mb_main_content = 'mb-3';
				if($php_name == 'homepage'){
					$mb_main_content = 'mb-2';
				}
			?>

			<div class="row">
				<div class="col-md-8 <?= $mb_main_content; ?> parent_right_main_content" style="padding-top: 1rem;">
					<?php //$this->load->view("app/_part/navbar.php"); ?>
					<?php $this->load->view("app/_main/".$php_name.".php") ?>	
				</div>
				<div class="col-md-4 <?= $mb_main_content; ?> parent_left_main_content" style="padding-top: 1rem;"> 
					<?php $this->load->view("app/_part/sidebar_left.php") ?>
				</div>
			</div>

			<?php if($php_name == 'homepage') : ?>	
				<div class="row">
					<div class="col-md-12 mb-2">
						<?php $this->load->view("app/_main/_home/h_gallery.php"); ?>
					</div>
				</div> 
			<?php endif; ?>
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
		<!-- <div class="parent_discord">
			<iframe style="display: none;" src="<?= $config_web['widget_discord_link']; ?>" width="360" height="330" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
			<button class="btn_open_discord">
				<img src="<?= base_url('assets/frontpage/img/btn_discord.gif'); ?>" style="width: 110px; height: 35px;">
			</button>  
		</div> -->
	<?php endif; ?>

	<?php $this->load->view("app/_part/im_modal.php");?>
	<?php $this->load->view("app/_part/sticky.icon.php") ?>
	<?php $this->load->view("app/_part/footer.php") ?>
	<?php $this->load->view("app/_part/footer-js.php") ?>
	<!-- <?php $this->load->view("app/_part/css.php") ?> -->
</body>
</html>