<div class="card mb-3">
<div class="card-body shadow-sm">	  	
	<h4 class="text-secondary"><b><img src="<?= base_url('assets/frontpage/img/icon/natsu.png'); ?>" width="40" height="40">User Login</b></h4>
	<form action="<?= site_url('go_login')?>" method="post">
		<div class="form-group">
			<div class="input-group">
	        <div class="input-group-prepend">
	          <div class="input-group-text">
				<i class="fas fa-user-circle"></i>
	          </div>
	        </div>
				<input class="form-control" type="text" name="user_id" placeholder="user id" minlength="4" maxlength="16" required>
	    </div>
		</div>
		<div class="form-group">
			<div class="input-group">
	        <div class="input-group-prepend">
	          <div class="input-group-text">
				<i class="fas fa-shield-alt"></i>
	          </div>
	        </div>
				<input class="form-control" type="password" name="password" placeholder="password" minlength="6" maxlength="16"  required>
	    </div> 			
		</div>
		<div class="form-row">
			<div class="col-md-6 p-2">
				<button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt mr-2"></i>LOGIN</button>
			</div>
			<!--
			<div class="col-md-6 p-2">
				<a href="<?= //base_url('register') ?>" class="btn btn-danger btn-block"><i class="fas fa-registered mr-2"></i>REGISTER</a>
			</div>
		-->
		</div>
	</form>
</div>
</div>
