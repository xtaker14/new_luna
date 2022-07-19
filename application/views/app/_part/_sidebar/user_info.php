<?php

	$user_email = substr($id_email,0,3);

	$user_email .= "****";

	$user_email .= substr($id_email,strpos($id_email, "@"));

?>

<div class="card shadow-sm mb-2" data-aos="fade-right" data-aos-delay="200" >

	<div class="card-body"> 



    	<div class="d-md-flex p-2" style="padding-top: 0px !important; padding-bottom: 7px !important;"> 

			<div class="d-block" style="width: 100%;">

				<h3 style="padding-bottom:5px;margin:0px;text-align:center;" class="text-primary border-bottom">

				  <img class="mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 40px; height: 35px; margin-top:-15px;margin-left:-10px;">    

					<b>Acc Info</b>

				</h3>

			</div>

		</div>



		<table class="table table-striped table-sm mb-4" style="width: 100%; background: #2a88ed;">

			<tbody>

				<tr>

			        <td style="color: #fff;">Name<span class="float-sm-right">:</span></td>

			        <td style="color: #fff;"><?= $id_loginid ?></td>

			    </tr>

			    <tr>

			        <td style="color: #fff;">Email<span class="float-sm-right">:</span></td>

			        <td style="color: #fff;"><?= $user_email ?></td>

			    </tr>

			    <tr>

			        <td style="color: #fff;">Diamonds<span class="float-sm-right">:</span></td>

			        <td style="color: #fff;">

						<label title="<?= 'Diamonds : '.number_format($star_point,0,'','.'); ?>" class="">

							<span class="star_point">

								<?= number_format($star_point,0,'','.'); ?>

							</span><i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i>

						</label>

					</td>

			    </tr> 

				<?php if(!empty($user_login['referral_code'])): ?> 

					<tr>

						<td>Referral<span class="float-sm-right">:</span></td>

						<td>

							<a style="border-bottom: 1px solid #007bff;" target="_BLANK" href="<?= base_url('user'); ?>">

								<?= $user_login['referral_code']; ?>

							</a> 

						</td>

					</tr>

				<?php endif; ?>

			</tbody>

		</table>

		<div class="d-flex">

			<button id="btn_userpanel" type="button" class="btn-one btn-darker w-50 m-1">

				SERVICES

			</button>

			<button id="go_logout" type="button" class="btn-two w-50 m-1">

				LOGOUT

			</button>

		</div>		

	</div>

</div>



<script> 

	// $(document).ready(function(){

	// 	$.ajax({

	// 		type : "POST",

	// 		dataType : "json",

	// 		data : {},

	// 		url : baseURL+"api/refresh_point",

	// 		success:function(res){

	// 			let star_point = res.result.star_point;

	// 			let silver_point = res.result.silver_point;

	// 			// console.log(res);

	// 			$(".star_point").text(f_main.numberFormatAlias(star_point));

	// 			$(".star_point").parent().attr('title','Balance : '+f_main.formatNumber(star_point,'.'));



	// 			$(".silver_point").text(f_main.numberFormatAlias(silver_point));

	// 			$(".silver_point").parent().attr('title','Balance : '+f_main.formatNumber(silver_point,'.'));

	// 		}

	// 	});

	// });

</script>

