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
    background-image: url('<?= base_url('assets/frontpage/img/shop/NEW.png') ?>');
}
.featured-hot {
    background-image: url('<?= base_url('assets/frontpage/img/shop/HOT.png') ?>');
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
}
</style>

<div id="menu_cover" class="card shadow-sm mb-4" data-aos="fade-left" data-aos-delay="300">
	<?php $this->load->view("app/_main/_shop/menu.php");?>
</div>  

<div id="im_list" class="form-row" align="center" data-aos="fade-left" data-aos-delay="400">
</div> 

<script type="text/javascript">
$(document).ready(function(){
	get_list(6);
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
			$("img").css({
				visibility: 'visible',
			});
		});
	}
})
</script>