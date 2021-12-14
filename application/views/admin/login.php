<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_part/head.php") ?>
	<?php $this->load->view("admin/_part/css.php") ?>
	<?php $this->load->view("admin/_part/head_js.php") ?>
</head>
<body>
	<div class="container-fluid py-4 " style="min-height: calc(100vh - 56px);">
	    <div class="row">
	        <div class="col-md-4 offset-md-4" align="center">
				<?php $this->load->view("admin/_part/session_flash.php") ?>
			</div>
			<div class="col-md-4 offset-md-4" align="center">
				<h6 ><b>Admin Login</b></a></h6>
				<p class="pb-4"><i>Silahkan login terlebih dahulu</i></p>
				<div class="card" align="left">
					<div class="card-body">
					  <form action="<?php print_r(site_url('adm/glogin'))?>" method="post">
					    <div class="form-group has-feedback">
					       <input type="email" class="form-control required" placeholder="Email" name="email" required />
					       <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					    </div>
					    <div class="form-group has-feedback">
					       <input type="password" class="form-control required" placeholder="Password" name="password" required />
					       <span class="glyphicon glyphicon-lock form-control-feedback"></span>
					    </div>
					    <input type="submit" class="btn btn-primary btn-flat" value="Sign In" />
					    <!--<a href="<?php //print_r(site_url('adm/forgotpass'))?>" > Forgot Password ?</a>-->
					  </form>
					 </div>
				</div>
			</div>
	    </div>
	</div>
	<?php $this->load->view("admin/_part/footer.php") ?>
	<?php $this->load->view("admin/_part/footer_js.php") ?>
</body>
</html>