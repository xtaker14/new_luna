<!--JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha256-fzFFyH01cBVPYzl16KT40wqjhgPtq6FFUB6ckN2+GGw=" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<script type="text/javascript" src="<?= base_url('assets/frontpage/js/funct_main.js'); ?>"></script>

<!-- Jquery Datatable-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<!-- moment + daterangepicker-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<script src="https://momentjs.com/downloads/moment-timezone-with-data-1970-2030.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha256-zI6VVO07NPmVW11q3RQE42YbRmJIkkunrcQ9LEYxJsQ=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js" integrity="sha256-/YAntTqXy9V4LoXFkI5WPDl3ZwP/knn1BljmMJJ7QWc=" crossorigin="anonymous"></script>
<!--
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/bootstrap-select.min.js" integrity="sha256-FXzZGmaRFZngOjUKy3lWZJq/MflaMpffBbu3lPT0izE=" crossorigin="anonymous"></script>
-->
<script type="text/javascript" src="<?php print_r(base_url('assets/frontpage/js/luna.js')) ?>"></script>
<script type="text/javascript">
    const f_main = new Funct_main();
	function setREVStartSize(e) {

		//window.requestAnimationFrame(function() {				 
		window.RSIW = window.RSIW === undefined ? window.innerWidth : window.RSIW;
		window.RSIH = window.RSIH === undefined ? window.innerHeight : window.RSIH;
		try {
			var pw = document.getElementById(e.c).parentNode.offsetWidth,
				newh;
			pw = pw === 0 || isNaN(pw) ? window.RSIW : pw;
			e.tabw = e.tabw === undefined ? 0 : parseInt(e.tabw);
			e.thumbw = e.thumbw === undefined ? 0 : parseInt(e.thumbw);
			e.tabh = e.tabh === undefined ? 0 : parseInt(e.tabh);
			e.thumbh = e.thumbh === undefined ? 0 : parseInt(e.thumbh);
			e.tabhide = e.tabhide === undefined ? 0 : parseInt(e.tabhide);
			e.thumbhide = e.thumbhide === undefined ? 0 : parseInt(e.thumbhide);
			e.mh = e.mh === undefined || e.mh == "" || e.mh === "auto" ? 0 : parseInt(e.mh, 0);
			if (e.layout === "fullscreen" || e.l === "fullscreen")
				newh = Math.max(e.mh, window.RSIH);
			else {
				e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
				for (var i in e.rl)
					if (e.gw[i] === undefined || e.gw[i] === 0) e.gw[i] = e.gw[i - 1];
				e.gh = e.el === undefined || e.el === "" || (Array.isArray(e.el) && e.el.length == 0) ? e.gh : e.el;
				e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
				for (var i in e.rl)
					if (e.gh[i] === undefined || e.gh[i] === 0) e.gh[i] = e.gh[i - 1];

				var nl = new Array(e.rl.length),
					ix = 0,
					sl;
				e.tabw = e.tabhide >= pw ? 0 : e.tabw;
				e.thumbw = e.thumbhide >= pw ? 0 : e.thumbw;
				e.tabh = e.tabhide >= pw ? 0 : e.tabh;
				e.thumbh = e.thumbhide >= pw ? 0 : e.thumbh;
				for (var i in e.rl) nl[i] = e.rl[i] < window.RSIW ? 0 : e.rl[i];
				sl = nl[0];
				for (var i in nl)
					if (sl > nl[i] && nl[i] > 0) {
						sl = nl[i];
						ix = i;
					}
				var m = pw > (e.gw[ix] + e.tabw + e.thumbw) ? 1 : (pw - (e.tabw + e.thumbw)) / (e.gw[ix]);
				newh = (e.gh[ix] * m) + (e.tabh + e.thumbh);
			}
			if (window.rs_init_css === undefined) window.rs_init_css = document.head.appendChild(document.createElement("style"));
			document.getElementById(e.c).height = newh + "px";
			window.rs_init_css.innerHTML += "#" + e.c + "_wrapper { height: " + newh + "px }";
		} catch (e) {
			console.log("Failure at Presize of Slider:" + e)
		}
		//});
	};


	function revslider_showDoubleJqueryError(sliderID) {
		var err = "<div class='rs_error_message_box'>";
		err += "<div class='rs_error_message_oops'>Oops...</div>";
		err += "<div class='rs_error_message_content'>";
		err += "You have some jquery.js library include that comes after the Slider Revolution files js inclusion.<br>";
		err += "To fix this, you can:<br>    1. Set 'Module General Options' -> 'Advanced' -> 'jQuery & OutPut Filters' -> 'Put JS to Body' to on";
		err += "<br>    2. Find the double jQuery.js inclusion and remove it";
		err += "</div>";
		err += "</div>";
		var slider = document.getElementById(sliderID);
		slider.innerHTML = err;
		slider.style.display = "block";
	}

	var scroll_is_over = false;
	function scrollToShowDiscord(){
		$(window).off('scroll');
		$(window).bind('scroll', function(){
			let calc_1 = $(this).scrollTop() + $(this).innerHeight();
			let calc_2 = $('main')[0].scrollHeight - ($('main')[0].scrollHeight*0.03);

			if (!scroll_is_over && calc_1 >= calc_2) {
				scroll_is_over=true;
				$('.parent_discord').css({
					'bottom':'100px'
				});
			}
			if (calc_1 < calc_2){
				scroll_is_over=false;
				$('.parent_discord').css({
					'bottom':'15px'
				});
			}
		});
	}


	document.addEventListener('DOMContentLoaded', () =>
		requestAnimationFrame(updateTime)
	)

	function updateTime() {
		document.documentElement.style.setProperty('--timer-day', "'" + moment().tz("Asia/Bangkok").format("dd") + "'");
		document.documentElement.style.setProperty('--timer-hours', "'" + moment().tz("Asia/Bangkok").format("k") + "'");
		document.documentElement.style.setProperty('--timer-minutes', "'" + moment().tz("Asia/Bangkok").format("mm") + "'");
		document.documentElement.style.setProperty('--timer-seconds', "'" + moment().tz("Asia/Bangkok").format("ss") + "'");
		requestAnimationFrame(updateTime);
	}


	$(document).ready(function(){
		if($(".p_online").length>0 || $("table.table_global_level_rank tbody").length>0){
			$('html').removeClass('no-js');
			$.getJSON(baseURL+"api/homepage", function(r){ 
				$(".p_online").html(r.srv.p_online);
				// $(".account_reg").html(r.srv.account_reg);
				// $(".char_count").html(r.srv.char_count); 

				if($("table.table_global_level_rank tbody").length>0){
					$.each(r.level_rank, function (key, val) {
						$("table.table_global_level_rank tbody").append(
							'<tr>'+
								// '<td>'+val.no+'</td>'+
								'<td>'+val.job+'</td>'+
								'<td>'+val.name+'</td>'+
								'<td>'+val.lvl+'</td>'+
								// '<td>'+val.exp+'</td>'+
							'</tr>'
						);
					});
					$("table.table_global_level_rank tbody td span.pointer").tooltip();
				}
				
				$("img").css({
					visibility: 'visible',
				});
			});
		}

		if($("#btn_userpanel").length>0){
			$('#btn_userpanel').click(function(){
				$('#mod_userpanel').modal('show');
			});
		}

		if($("#btn_userpanel").length>0){
			$('#go_logout').click(function(){
				window.location.href = baseURL+ "go_logout";
			});
		}
		
		if($(".star_point").length>0){
			$.ajax({
				type : "POST",
				dataType : "json",
				data : {},
				url : baseURL+"api/refresh_point",
				success:function(res){
					let cash_point = res.result.cash_point;
					let silver_point = res.result.silver_point;
					// console.log(res);
					$(".star_point").text(f_main.numberFormatAlias(cash_point));
					$(".star_point").parent().attr('title','Diamond : '+f_main.formatNumber(cash_point,'.'));

					// $(".silver_point").text(f_main.numberFormatAlias(silver_point));
					// $(".silver_point").parent().attr('title','Balance : '+f_main.formatNumber(silver_point,'.'));
				}
			});
		}

		f_main.loading('timer',function(){
			$("img").css({
				visibility: 'visible',
			});
			AOS.init({
				once: true
			});
			setTimeout(function(){
				console.clear();
			},200);
		}, 1000);
		 
		$(".btn_open_discord").click(function(){
			let t = $(this);
			let frame = t.parents('.parent_discord').find('iframe');
			if(frame.is(':hidden')){
				frame.show('slow');
			}else{
				frame.hide('slow');
			}
		});

		var resize_is_over = false;
		$(window).on('resize', function() {
			let t = $(this);
			let val = 1415;

			if (!resize_is_over && t.width() <= val) {
				resize_is_over=true;
				scrollToShowDiscord();
			}
			if (t.width() > val){
				resize_is_over=false;
				$(window).off('scroll');
				$('.parent_discord').css({
					'bottom':'15px'
				});
			}
		});
		$(window).resize();

		$(document).on('click','.view_detail',function(){
			var id = $(this).data("itemid");
			//console.log(id);
			get_detail(id); 
		});
		function get_detail(id){
			$.getJSON(baseURL+"im_detail/"+id, function(r){
				$("#im_modal #item-title").html(r.title);
				$("#im_modal #item-desc").html(r.desc);
				$("#im_modal #item-img").attr("src",r.image);

				if(r.effect.length>0){
					$("#im_modal #item-effect").addClass("col-md-6");
					$("#im_modal #item-effect").html(r.effect);
				}else{
					$("#im_modal #item-effect").html('');
					$("#im_modal #item-effect").removeClass("col-md-6");
				}
				
				$("#im_modal #piece_list").html(r.piece_list);
				$("#im_modal #btn-imBuy").html(r.button);
				if(r.stat==true){
					grecaptcha_callback();
				}
				$("img").css({
					visibility: 'visible',
				});
				$("#im_modal").modal("show");
			});
		}

	});
</script>