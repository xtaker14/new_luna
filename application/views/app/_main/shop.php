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
</style>

<div class="card p-1" style="height: 100%;" data-aos="fade-left" data-aos-delay="200">
	<div class="card-body" style="height: 100%; background: #2a88ed; border-radius:4px;">
		<div id="menu_cover" class="card shadow-sm mb-4" data-aos="fade-left" data-aos-delay="300" style="background: #fffde8;">
			<?php $this->load->view("app/_main/_shop/menu.php");?>
		</div>  

		<div id="im_list" class="form-row" align="center" data-aos="fade-left" data-aos-delay="400">
		</div>
	</div>
</div> 

<script type="text/javascript">
$(document).ready(function(){
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