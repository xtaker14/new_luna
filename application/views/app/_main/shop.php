<style type="text/css">
.im_imgcover{
	margin:0 auto;
	height: 150px;
	width: 150px;		
	overflow:hidden;
}
.featured-item {
    width: 44px;
    height: 44px;
    background: center no-repeat;
        background-image: none;
    position: absolute;
    top: 0;
    left: 0;
}
.featured-new {
    background-image: url('<?= CDN_IMG.('assets/frontpage/img/shop/NEW.png') ?>');
}
.featured-hot {
    background-image: url('<?= CDN_IMG.('assets/frontpage/img/shop/HOT.png') ?>');
}

@media screen and (min-width: 768px) {
	.im_card{
		transition: transform .4s;
	}
	.im_card:hover {
	  transform: scale(1.1);
	}
}
.opt-box {
    font-size: 13px;
    color: #33ff33;
    background-color: rgb(0,0,0,0.7);
    -webkit-border-radius: 4px;
    border-radius: 4px;
    margin: auto;
	text-align: left;
	height: 100%;
}
.im_card .im_imgcover{
	display: flex !important;
}
.im_card .im_imgcover img.card-img{
	margin-top:auto;
	margin-bottom:auto;
	color:gray;
}

.link_hot_items{
    transition: all 0.2s ease-in-out;
}
.link_hot_items:hover{
	opacity: 0.7;
}
</style>

<div class="card p-1" style="height: 100%;" data-aos="fade-left" data-aos-delay="200">
	<div class="card-body" style="height: 100%; background: #2a88ed; border-radius:4px;">

	<?php if(empty($open_to)): ?>
		<?php  

		$total_hot_items = count($shop_hot_items);
		$start_count = 1;
		$end_count = $total_hot_items;

		$show_res_hot_items_count = "Showing " . $start_count . " - " . $end_count . " of " . $total_hot_items . " Results";

		?>
		<div class="row">
			<div class="col-md-12" style="margin-top:15px;">
				<h3 class="title-bg" style="display: flex;justify-content: space-between;align-items: baseline; color: #fff;">
					<div>Hot Items</div>
					<div style="font-size: 16px;" id="show_count_hot_items">
						<?= $show_res_hot_items_count; ?>
					</div>
				</h3>
			</div>
		</div> 

		<div class="row">
			<div class="col-md-12">
				<div class="parent_hot_items">
					<?= implode('', $shop_hot_items); ?>
				</div>
			</div>

			<div class="col-md-12">
				<div style="display:flex; align-items:center; justify-content: end;">
					<a href="<?= base_url('shop/hot-items'); ?>" class="link_hot_items" style="font-size: 14px; color: #fff;">
						<b>
							View All <i class="fas fa-angle-right" style="padding-top:2px;"></i>
						</b>
					</a>
				</div>
			</div>
		</div> 

		<hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:5px;margin-bottom:5px;"> 
		<!-- --------------------------------------------------------------------------------- -->

		<div id="menu_cover" class="card shadow-sm mb-4" data-aos="fade-left" data-aos-delay="300" style="background: #fffde8; margin-top: 15px;">
			<?php $this->load->view("app/_main/_shop/menu.php");?>
		</div>  

		<div id="im_list" class="form-row" align="center" data-aos="fade-left" data-aos-delay="400">
		</div>

	<?php elseif($open_to == 'hot-items'): ?>
		<?php  

		$total_hot_items = count($shop_hot_items);
		$start_count = 1;
		$end_count = $total_hot_items;

		$show_res_hot_items_count = "Showing " . $end_count . " - " . $end_count . " of " . $total_hot_items . " Results";

		?>

		<div class="row">
			<div class="col-md-12" style="margin-top:15px;">
				<h3 class="title-bg" style="display: flex;justify-content: space-between;align-items: baseline; color: #fff;">
					<div>Hot Items</div>
					<div style="font-size: 16px;" id="show_count_hot_items">
						<?= $show_res_hot_items_count; ?>
					</div>
				</h3>
			</div>
		</div> 

		<div class="row">
			<div class="col-md-12">
				<div class="row parent_im_list">
					<?= implode('', $shop_hot_items); ?>
				</div>
			</div>

			<div class="col-md-12">
				<div style="display:flex; align-items:center; justify-content: start;">
					<a href="<?= base_url('shop'); ?>" class="link_hot_items" style="font-size: 14px; color: #fff;">
						<b>
							<i class="fas fa-angle-left" style="padding-top:2px;"></i> Back
						</b>
					</a>
				</div>
			</div>
		</div> 
	<?php else: ?>

	<?php endif ?>

	</div>
</div> 

<script type="text/javascript">
$(document).ready(function(){
	if($('.parent_hot_items').length>0){
		
		var slick_show = 4;
		var slick_to_scroll = 4;

		$('.parent_hot_items').slick({
			arrows: false,
			slidesToShow: slick_show,
			slidesToScroll: slick_to_scroll,
			autoplay: true,
			autoplaySpeed: 3000,
			infinite: true,
			responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					}
				}
			]
		});

		$('.parent_hot_items').on('afterChange', function(event, slick, currentSlide, nextSlide){
			//currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
			let slic_from = (currentSlide ? currentSlide : 0) + 1;
			let slic_to = (slic_from + (slick_show-1));
			if(slic_to > slick.slideCount){
				slic_to = slick.slideCount;
			}

			$('#show_count_hot_items').html("Showing " + slic_from + " - " + slic_to + " of " + slick.slideCount);
		});
	}
	
	get_list(<?= $im_category[0]['id']; ?>);
	$('html').removeClass('no-js');
	$(document).on('click','.cat_icon',function(){
		$(".cat_icon").removeClass("active");
		$(this).addClass("active");
		//var cat = $(this).data("category");
		var id = $(this).data("id");
		get_list(id);
	});

	function get_list(id){
		$("#im_list").hide();
		$.getJSON(baseURL+"im_list/"+id, function(r){
			$("#im_list").html(r.result).show('fast');

			var ww = $(window).width(); 
			if( ww < 768){
				$('body,html').animate({
					scrollTop: $("#menu_cover").offset().top - 20
				}, 500);
			}

			console.clear();
			$(".im_card .im_imgcover img.card-img").each(function(idx,key){
				let t = $(this);
				const c_img = new Image();

				c_img.onload = function() {
					// console.log(this.width + 'x' + this.height);
					if(this.width < 200 && this.height < 260){
						t.parents('.im_imgcover').removeClass('d-block');
						t.parents('.im_imgcover').css({
							'display': 'flex',
							'justify-content': 'center',
							'align-items': 'center',
						});
						t.css({
							'width': 'initial',
						});
					}
				}
				c_img.src = t.attr('src');
			});
			$("img").css({
				visibility: 'visible',
			});

		});
	}
})
</script>