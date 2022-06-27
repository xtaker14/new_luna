<?php
$list = '';
foreach ($data as $key => $val) {
	$list .= '<option value="'.$val['CHARACTER_IDX'].'">'.$val['CHARACTER_NAME'].'</option>';
}
 ?>


<div class="card p-1" data-aos="fade-left" data-aos-delay="0" style="height: 100%;"> 
	<div class="card-body" style="height: 100%; background: #2a88ed; border-radius:4px;">
    
		<div class="d-md-flex mb-2" style="padding-top: 0px !important; padding-bottom: 2px !important;"> 
			<div class="d-block" style="width: 100%;">
				<img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
				<h3 style="padding-bottom:5px;margin:0px;color:#fff;" class="border-bottom">Change MAP</h3>
			</div> 
		</div>

		<div class="row">
			<div class="col-12"> 
				<div class="form-group d-block border p-2" style="border: 2px solid black !important; background: #fff;">
				<p>Easy way to change maps if you got stuck on game.</p>
				</div>
			</div>

			<?php if(!empty($data)) : ?>
				<div class="col-12"> 
					<div class="form-group d-block border p-2" style="border: 2px solid black !important; background: #fff;">
					<p><b>NOTE : </b>Please logout the game before using this service.</p>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<?php if(!empty($data)) : ?>
			<form id="teleport_form" action="<?= site_url('go_teleport')?>" method="post" accept-charset="utf-8" class="form_blue_input_group">
				<div class="form-group">
					<label for="a" style="color: #fff;">Characters :</label>
					<select class="form-control form-control" id="a" name="a" required>
						<?= $list ?>
					</select>
				</div>
				<div class="form-group">
					<label for="b" style="color: #fff;">Map :</label>
					<select class="form-control form-control" id="b" name="b" required>
						<option value="19">Gate of Alker</option>
						<option value="20">Alker Harbor</option>
					</select>
				</div>
				<div class="form-group" align="left">
					<input type="hidden" name="<?=$xepo_secure['name'];?>" value="<?=$xepo_secure['hash'];?>" />
					<input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
					<button type="submit" class="btn-one">
						<b style="color: #fff;">TELEPORT</b>
					</button> 
				</div>
			</form>
		<?php else: ?>
			<div class="d-block p-2 border" align="center">
				<h5 class="" style="color: #f1a6a6; text-shadow: 2px 2px 4px #464343;"><b>You don't have any character.</b></h5>
			</div>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('html').removeClass('no-js');
})
</script>