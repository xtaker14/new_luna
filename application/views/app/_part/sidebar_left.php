<?php  
$upload_path = "assets/frontpage/img/web_config";
$logo_img = CDN_IMG.($upload_path.'/'.$config_web['logo_img']);
$favico = CDN_IMG.($upload_path.'/'.$config_web['favico_img']);
?> 

<div class="d-block">
	<div class="main_left_section">
		<div class="text-center mb-2 p-0 main_child_left_section" data-aos="fade-left">
			
			<div class="parent_img_fly_city" style="">
				<img src="<?= CDN_IMG.('assets/frontpage/img/fly_city.png'); ?>" style="margin-top: -25px;margin-right: -30px;" />
			</div>
			<div style="position: relative;z-index:1;">
				<img src="<?= $logo_img; ?>" class="img-fluid image_logo" data-no-retina />
			</div>
			
			<!-- <a class="dwn-btn btn btn-primary btn-block btn-lg" href="<?= base_url('p/download-page') ?>"><b><i class="fas fa-cloud-download-alt mr-1"></i> Clients Download</b></a> -->
			<!-- <rs-module-wrap data-source="gallery" style="padding:0;">
				<rs-module id="rev_main_logo" style="" data-version="6.2.8">
					<rs-slides>
						<rs-slide data-key="rs-8" data-title="Slide" data-thumb="#" data-anim="ei:d;eo:d;s:d;r:0;t:fade;sl:d;" data-p1="1">
							<img src="#" data-bg="f:100% 100%;" data-parallax="off" class="rev-slidebg" data-no-retina>	
						</rs-slide> 
					</rs-slides>
					<rs-static-layers> 
						<rs-layer  
							class="rs-pxl-1 rs-layer-static"
							data-type="image"
							data-xy="x:c;y:m;yo:0,0,0,-80px;"
							data-text="w:normal;"
							/*data-dim="w:662px,490px,460px,260px;h:205px,152px,142px,81px;"*/
							data-basealign="slide"
							data-rsp_o="off"
							data-rsp_bd="off"
							data-onslides="s:1;"
							data-frame_0="rX:70deg;oZ:-50;" 
							/*data-frame_1="oZ:-20;e:power2.in;st:710;sp:600;sR:710;"*/
							data-frame_999="o:0;st:w;sR:7260;"
							style="z-index:10;"
							>
								<a href="<?= base_url(); ?>">
									<img src="<?= $logo_img; ?>" class="img-fluid image_logo" data-no-retina />
								</a>
						</rs-layer> 
					</rs-static-layers>
				</rs-module> 
			</rs-module-wrap> -->

			
			<div class="card_side">
				<!-- <div class="face_side face_side1">
					<div class="content">
						<h3>DOWNLOAD</h3>
					</div>
				</div> -->
				<div class="card_side_img">
					<a href="<?= base_url('p/download-page') ?>">
						<span>DOWNLOAD</span>
						<img class="img_play_out" src="<?= CDN_IMG.('assets/frontpage/img/nav/blue_button.png'); ?>" alt="">
						<img class="img_play_in" src="<?= CDN_IMG.('assets/frontpage/img/nav/blue_button_active.png'); ?>" alt="">
					</a>
				</div>
				<div class="face_side face_side1" onclick="window.location.href='<?= base_url('register') ?>';">
					<div class="content">
						<!-- <i class="fab fa-windows"></i> -->
						<h3>REGISTER</h3>
					</div>
				</div> 
			</div>

			<!-- <script type="text/javascript"> 
				$(document).ready(function(){
					setREVStartSize({
						c: 'rev_main_logo',
						rl: [1240, 991, 980, 950, 700],
						el: [900, 900, 910, 850, 610],
						// gw: [1300, 1100, 600, 300],
						gh: [900, 900, 910, 850, 610],
						type: 'standard',
						justify: '',
						layout: false,
						offsetContainer: '',
						offset: '',
						mh: "0"
					});

					var revapi7,
					tpj;
					jQuery(function () {
						tpj = jQuery;
						revapi7 = tpj("#rev_main_logo")
						if (revapi7 == undefined || revapi7.revolution == undefined) {
							revslider_showDoubleJqueryError("rev_main_logo");
						} else {
							revapi7.revolution({
								// sliderLayout: "fullscreen",
								// perspectiveType: "local",
								visibilityLevels: "1240, 991, 980, 950, 700",
								responsiveLevels: "1240, 991, 980, 950, 700",
								editorheight: "900, 900, 910, 850, 610",
								// gridwidth: "1300, 1100, 600, 300",
								gridheight: "900, 900, 910, 850, 610",
								progressBar: {
									disableProgressBar: true
								}, 
								parallax: {
									levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 20],
									type: "3D",
									origo: "slidercenter",
									disable_onmobile: true,
									ddd_bgfreeze: true,
									ddd_z_correction: 10
								},
								// fallbacks: {
								// 	allowHTML5AutoPlayOnAndroid:true
								// }, 
							});
						}
					});
				});
			</script> -->
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

<!-- <script type="text/javascript">
$(document).ready(function(){
	$('html').removeClass('no-js');
	$.getJSON(baseURL+"api/homepage", function(r){
		$("#srv_status .p_online").html(r.srv.p_online);
		$("#srv_status .account_reg").html(r.srv.account_reg);
		$("#srv_status .char_count").html(r.srv.char_count);


		$.each(r.level_rank, function (key, val) {
			$("table.table_global_level_rank tbody").append(
				'<tr><td>'+val.no+
					'</td><td>'+val.job+
					'</td><td>'+val.name+
					'</td><td>'+val.lvl+
					'</td><td>'+val.exp+
				'</td></tr>'
			);
		});
		$("table.table_global_level_rank tbody td span.pointer").tooltip();
		
		$("img").css({
			visibility: 'visible',
		});
	});

	$(document).on('click','#btn_userpanel',function(){
		$('#mod_userpanel').modal('show');
	});

	$(document).on('click','#go_logout',function(){
		window.location.href = baseURL+ "go_logout";
	});
});
</script> -->