<?php  
$upload_path = "assets/frontpage/img/web_config";
$logo_img = CDN_IMG.($upload_path.'/'.$config_web['logo_img']);
$favico = CDN_IMG.($upload_path.'/'.$config_web['favico_img']);
?> 

<style>
	
.card_side{
	z-index: 1;
	position: relative;
	margin-bottom: 20px;
	margin-top: -117px;
}
.card_side .face_side{
	width: 100%;
	height: 60px;
	transition:.4s; 
}

.card_side .card_side_img{
	position: relative;
	z-index: 1;
	margin-bottom: 15px;
}

.card_side .card_side_img a{
	position: relative;
	text-align: center;
	display: flex;
	justify-content:center;
	align-items:center; 
}

.card_side .card_side_img a img{
	/* transition: 1s; */
}
.card_side .card_side_img a .img_play_in,
.card_side .card_side_img a:hover .img_play_out{
	display: none;
	opacity: 0;
}
.card_side .card_side_img a .img_play_out, 
.card_side .card_side_img a:hover .img_play_in{
	display: block;
	opacity: 1;
}

.card_side .card_side_img a span{
	position: absolute;
	font-size: 18px;
	font-weight: bold;
	color: #ede9e9;
}
</style>

<div class="d-block">
	<div class="main_left_section">
		<div class="text-center mb-2 p-0 main_child_left_section" data-aos="fade-left">
			
			<div style="position: relative; min-height: 290px;">
				<div class="parent_img_fly_city" style="">
					<img src="<?= CDN_IMG.('assets/frontpage/img/fly_city.png'); ?>" style="margin-top: -25px;margin-right: -30px;" />
				</div>
				<div style="position: relative;z-index:1;">
					<img src="<?= $logo_img; ?>" class="img-fluid image_logo" data-no-retina />
				</div>
			</div>

			
			<div class="card_side">
				<div class="card_side_img">
					<a href="<?= base_url('p/download-page') ?>">
						<span>DOWNLOAD</span>
						<img class="img_play_out" src="<?= CDN_IMG.('assets/frontpage/img/nav/blue_button.png'); ?>" alt="">
						<img class="img_play_in" src="<?= CDN_IMG.('assets/frontpage/img/nav/blue_button_active.png'); ?>" alt="">
					</a>
				</div>
				<div class="face_side face_side1" style="display: none;" onclick="window.location.href='<?= base_url('register') ?>';">
					<div class="content">
						<!-- <i class="fab fa-windows"></i> -->
						<h3>REGISTER</h3>
					</div>
				</div> 
			</div>
		</div>
		
		<?php
		$user_panel = "user_menu";

		if(!empty($usr_session)){
			$user_panel = "user_info";	
		}

		$this->load->view("app/_part/_sidebar/".$user_panel.".php");
		$this->load->view("app/_part/_sidebar/hot_items.php");

		// if($php_name=='homepage'){		
		// 	$this->load->view("app/_part/_sidebar/server_stat.php");
		// }
		if($php_name !=='rank'){		
			$this->load->view("app/_part/_sidebar/rank.php");
		}
		?>
	</div>	
</div>

<script type="text/javascript">
	$('.img_play_out').ready(function(){
		$(".face_side.face_side1").css({
			'display' : 'flex',
		});
	});

	$(document).ready(function(){ 
		$('html').removeClass('no-js'); 
	});
</script>