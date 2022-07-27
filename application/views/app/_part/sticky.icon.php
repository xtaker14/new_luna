
<style type="text/css">
	.list_mobile_menu{
		position:fixed;
		/* bottom:20px;
		right:20px; */
		z-index: 1111;
		top: 5px;
		left: 50% !important;
		transform: translateX(-50%);
		display:table-row;
	}
	.list_mobile_menu.open_mobile_menu{
		display: block !important;
	}
	.list_mobile_menu li{
		cursor: pointer;
		/* float: left; */
		display: table-cell;
		vertical-align: middle;
	}
	.list_mobile_menu .img_mobile_menu_left{
		-webkit-filter: drop-shadow(-5px 3px 4px rgba(0,0,0,0.4));
  		filter: drop-shadow(-5px 3px 4px rgba(0,0,0,0.4));
	}
	.list_mobile_menu .img_mobile_menu_right{
		-webkit-filter: drop-shadow(5px 3px 4px rgba(0,0,0,0.4));
  		filter: drop-shadow(5px 3px 4px rgba(0,0,0,0.4));
	}
	.list_mobile_menu .list_icon_menu{
		background: #3dc9ef !important;
		box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.3) !important;
		border: 1px solid aliceblue;
	}
	.list_mobile_menu .list_icon_menu,
	.list_mobile_menu .list_icon_menu a{
    	transition: all 0.3s ease-in-out;
	}
	.list_mobile_menu .list_icon_menu:hover,
	.list_mobile_menu .list_icon_menu:active{
		border-color: black !important;
		opacity: 0.8;
	}
	.list_mobile_menu .list_icon_menu:hover a,
	.list_mobile_menu .list_icon_menu:active a{
		color: black !important;
		opacity: 0.8;
	}

	#parent_menu_mobile{
		width:100%;
		position:fixed;
		z-index: 1112;
		top: 70px;
	}
	#parent_menu_mobile .col-4{
		padding-left: 5px;
		padding-right: 5px;
		padding-bottom: 5px;
	}
	#parent_menu_mobile .child_menu_mobile{
		text-align: center;
		padding: 5px;
		background-color: #3dc9ef !important;
		box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.3) !important;
		border: 1px solid aliceblue;
		color: white;
	}
	#parent_menu_mobile .child_menu_mobile a{
		display: block;
		color: #fff;
	}
	
	#parent_menu_mobile .child_menu_mobile,
	#parent_menu_mobile .child_menu_mobile a{
    	transition: all 0.3s ease-in-out;
	}
	#parent_menu_mobile .child_menu_mobile:hover,
	#parent_menu_mobile .child_menu_mobile:active{
		/* border-color: black; */
		opacity: 0.8;
	}
	#parent_menu_mobile .child_menu_mobile:hover a,
	#parent_menu_mobile .child_menu_mobile:active a{
		/* color: black; */
		opacity: 0.8;
	}
	#btn_open_mobile_menu{
		width: 36px;
		height: 35px;
		display: block;
		color: #fff;
	}

	@media (max-width: 360px) {
		#parent_menu_mobile .col-4{ 
			-ms-flex: 0 0 41.666667%;
			flex: 0 0 41.666667%;
			max-width: 41.666667%;
			margin-left: auto;
			margin-right: auto;
		}
	}
</style>

<ul class="list_none list_mobile_menu d-block d-md-none">
	<?php // if(!empty($usr_session)) : ?>
		<?php // if($this->uri->segment(2) !== 'donate') : ?>
			<!-- <li class="rounded-circle bg-primary text-center mt-2 p-2">
				<a class="text-white" href="<?= base_url('donate') ?>"><i class="fas fa-gem fa-2x"></i></a>
			</li> -->
		<?php // endif; ?>

		<?php // if($php_name !== 'shop') : ?>
			<!-- <li class="rounded-circle bg-danger text-center mt-2 p-2">
				<a class="text-white" href="<?= base_url('shop') ?>"><i class="fas fa-shopping-basket fa-2x"></i></a>
			</li> -->
		<?php // endif; ?>
	<?php // endif; ?>
			
	<?php //if($php_name !== 'homepage') : ?>
		<!-- <li class="rounded-circle bg-success text-center mt-2 p-2">
			<a class="text-white" href="<?= base_url() ?>"><i class="fas fa-home fa-2x"></i></a>
		</li> -->
	<?php //endif; ?>
	
	<li>
		<img class="img_mobile_menu_left" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;"> 
	</li>
	<li class="rounded-circle list_icon_menu text-center mt-2 p-2">
		<a id="btn_open_mobile_menu" class="" href="javascript:;">
			<i class="fas fa-home fa-2x"></i>
			<i class="fas fa-times fa-2x" style="display:none; margin-top:2px; margin-left:2px;"></i>
		</a>
	</li>
	<li>
		<img class="img_mobile_menu_right" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing_right.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;"> 
	</li>
</ul>

<div id="parent_menu_mobile" style="display:none;">
	<div class="row">
		<div class="col-4">
			<div class="child_menu_mobile">
				<a href="<?= base_url(''); ?>">
					<img class="nav-img" src="<?= CDN_IMG; ?>assets/frontpage/img/nav/slime.png" style="visibility: visible; margin-bottom: 5px;">
					HOME
				</a>
			</div>
		</div>
		<div class="col-4">
			<div class="child_menu_mobile">
				<a href="<?= base_url('shop'); ?>">
					<img class="nav-img" src="<?= CDN_IMG; ?>assets/frontpage/img/nav/slime.png" style="visibility: visible; margin-bottom: 5px;">
					SHOP
				</a>
			</div>
		</div>
		<div class="col-4">
			<div class="child_menu_mobile">
				<a href="<?= base_url('donate'); ?>">
					<img class="nav-img" src="<?= CDN_IMG; ?>assets/frontpage/img/nav/slime.png" style="visibility: visible; margin-bottom: 5px;">
					DONATE
				</a>
			</div>
		</div>
		<div class="col-4">
			<div class="child_menu_mobile">
				<a href="<?= base_url('rank'); ?>">
					<img class="nav-img" src="<?= CDN_IMG; ?>assets/frontpage/img/nav/slime.png" style="visibility: visible; margin-bottom: 5px;">
					RANK
				</a>
			</div>
		</div>
		<div class="col-4">
			<div class="child_menu_mobile">
				<a href="<?= base_url('p/help-contact'); ?>">
					<img class="nav-img" src="<?= CDN_IMG; ?>assets/frontpage/img/nav/slime.png" style="visibility: visible; margin-bottom: 5px;">
					HELP
				</a>
			</div>
		</div>
		<div class="col-4">
			<div class="child_menu_mobile">
				<a href="<?= base_url('p/terms-of-services'); ?>">
					<img class="nav-img" src="<?= CDN_IMG; ?>assets/frontpage/img/nav/slime.png" style="visibility: visible; margin-bottom: 5px;">
					T.O.S
				</a>
			</div>
		</div>
	</div>
	<div class="row">
		<?php if(empty($usr_session)) : ?>
			<div class="col-4" style="margin-left: auto;">
				<div class="child_menu_mobile">
					<a href="<?= base_url('login'); ?>">
						<img class="nav-img" src="<?= CDN_IMG; ?>assets/frontpage/img/nav/slime.png" style="visibility: visible; margin-bottom: 5px;">
						LOGIN
					</a>
				</div>
			</div>
			<div class="col-4" style="margin-right: auto;">
				<div class="child_menu_mobile">
					<a href="<?= base_url('register'); ?>">
						<img class="nav-img" src="<?= CDN_IMG; ?>assets/frontpage/img/nav/slime.png" style="visibility: visible; margin-bottom: 5px;">
						REGISTER
					</a>
				</div>
			</div>
		<?php else: ?>
			<div class="col-4" style="margin-left: auto; margin-right: auto;">
				<div class="child_menu_mobile" style="background-color: #bd3434 !important;">
					<a href="javascript:;" class="btn_logout" style="">
						<img class="nav-img" src="<?= CDN_IMG; ?>assets/frontpage/img/nav/slime.png" style="visibility: visible; margin-bottom: 5px;">
						LOGOUT
					</a>
				</div>
			</div>
		<?php endif; ?> 
	</div>
</div>

<script>
	$(document).ready(function(){
		$("#btn_open_mobile_menu").click(function(){
			let t = $(this);
			if(!t.find('svg.fa-home').is(':hidden')){
				$("#parent_menu_mobile").fadeIn('fast', function(){
					t.parents('.list_mobile_menu').addClass('open_mobile_menu'); 
					t.css({
						// 'color': '#c92424',
						'color': '#000',
					});
					t.parents('.list_icon_menu').css({
						// 'border-color': '#c92424',
						'border-color': '#000',
					});
					t.find('svg.fa-home').hide();
					t.find('svg.fa-times').show();
				});
			}else{
				$("#parent_menu_mobile").fadeOut('fast', function(){
					t.parents('.list_mobile_menu').removeClass('open_mobile_menu'); 
					t.css({
						'color': '#fff',
					});
					t.parents('.list_icon_menu').css({
						'border-color': '#fff',
					});
					t.find('svg.fa-times').hide();
					t.find('svg.fa-home').show();
				});
			}
		});
	});
</script>

