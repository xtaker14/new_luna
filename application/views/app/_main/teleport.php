<?php
$list = '';
foreach ($data as $key => $val) {
	$list .= '<option value="'.$val['CHARACTER_IDX'].'">'.$val['CHARACTER_NAME'].'</option>';
}
 ?>
<div class="card" style="margin-top: 30px;">
	<div class="card-header bg-white"> 
		<div class="box_header_title" style="">
			<span></span>
			<span></span> 
			<div class="content_header_title">
				<h2> 
				Character Teleport
				</h2> 
			</div>
		</div>

		<small class="text-secondary"><i>Easy way to change maps if you got stuck on game.</i></small>
	</div>
	<div class="card-body">
		<?php if(!empty($data)){ ?>
			<form id="teleport_form" action="<?= site_url('go_teleport')?>" method="post" accept-charset="utf-8" >
				<div class="form-group">
					<label for="a">Select Character :</label>
					<select class="form-control form-control-lg" id="a" name="a" required>
						<?= $list ?>
					</select>
				</div>
				<div class="form-group">
					<label for="b">Select Map :</label>
					<select class="form-control form-control-lg" id="b" name="b" required>
						<option value="19">Gate of Alker</option>
						<option value="20">Alker Harbor</option>
					</select>
				</div>
				<div class="form-group" align="left">
					<input type="hidden" name="<?=$xepo_secure['name'];?>" value="<?=$xepo_secure['hash'];?>" />
					<input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
					<button type="submit" class="btn btn-primary my-3"><i class="fas fa-running mr-2"></i>Go Teleport</button>
				</div>
			</form>
			<div class="d-block p-2 border" align="center">
				<label><b>NOTE : </b>Please logout the game before using this service.</label>
			</div>
		<?php }else{ ?>
			<div class="d-block p-2 border" align="center">
				<h4 class="text-danger"><b>You don't have any character.</b></h4>
			</div>
		<?php } ?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('html').removeClass('no-js');
})
</script>