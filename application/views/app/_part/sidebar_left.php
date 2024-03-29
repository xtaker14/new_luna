<?php  
$upload_path = "assets/frontpage/img/web_config";
$logo_img = CDN_IMG.($upload_path.'/'.$config_web['logo_img']);
$favico = CDN_IMG.($upload_path.'/'.$config_web['favico_img']);
?> 

<div class="d-block">
	<div class="main_left_section">
		<div class="text-center mb-2 p-0 main_child_left_section" data-aos="fade-left">
			
			<div class="parent_main_logo_download" style="position: relative; min-height: 290px;">
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

				<?php if(empty($usr_session)): ?>
					<div class="face_side face_side1" style="display: none;" onclick="window.location.href='<?= base_url('register') ?>';">
						<div class="content">
							<!-- <i class="fab fa-windows"></i> -->
							<h3>REGISTER</h3>
						</div>
					</div> 
				<?php endif; ?>
			</div>
		</div>
		
		<?php
		$user_panel = "user_menu";

		if(!empty($usr_session)){
			$user_panel = "user_info";	
		}

		if(!($php_name == 'usr_login' && empty($usr_session))){
			$this->load->view("app/_part/_sidebar/".$user_panel.".php");
		}
		$this->load->view("app/_part/_sidebar/hot_items.php");
 
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