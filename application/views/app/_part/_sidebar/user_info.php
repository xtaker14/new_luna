<?php
	$user_email = substr($id_email,0,3);
	$user_email .= "****";
	$user_email .= substr($id_email,strpos($id_email, "@"));
?>
<div class="card mb-3" style="margin-top: 30px;">
	<div class="card-body shadow-sm">
		<div class="box_header_title">
			<span></span>
			<span></span> 
			<div class="content_header_title">
				<h2><img src="<?= base_url('assets/frontpage/img/icon/baby.png'); ?>" width="30">&nbsp;Member Panel</h2> 
			</div>
		</div>
		<table class="table mb-4" style="width: 100%">
			<tbody>
				<tr>
			        <td>Name<span class="float-sm-right">:</span></td>
			        <td><?= $id_loginid ?></td>
			    </tr>
			    <tr>
			        <td>Email<span class="float-sm-right">:</span></td>
			        <td><?= $user_email ?></td>
			    </tr>
			    <tr>
			        <td>Balance<span class="float-sm-right">:</span></td>
			        <td>
						<label title="<?= 'Balance : '.number_format($star_point,0,'','.'); ?>" class="text-primary">
							<span class="star_point">
								<?= number_format($star_point,0,'','.'); ?>
							</span><i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i>
						</label>
					</td>
			    </tr>
			</tbody>
		</table>
		<div class="d-flex">
			<button id="btn_userpanel" type="button" class="btn-hover btn color-blue w-50 m-1"><i class="fas fa-user-cog mx-2"></i>User Panel</button>
			<button id="go_logout" type="button" class="btn-hover btn color-red w-50 m-1"><i class="fas fa-sign-out-alt"></i>LOGOUT</button>
		</div>		
	</div>
</div>

<script> 
	$(document).ready(function(){
		$.ajax({
			type : "POST",
			dataType : "json",
			data : {},
			url : baseURL+"api/refresh_point",
			success:function(res){
				// console.log(res);
				$('.star_point').text(f_main.numberFormatAlias(res.result));
				$(".star_point").parent().attr('title','Balance : '+f_main.formatNumber(res.result,'.'));
			}
		});
	});
</script>
