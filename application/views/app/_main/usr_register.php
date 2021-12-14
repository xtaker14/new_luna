<div class="card" data-aos="fade-left" data-aos-delay="0" style="margin-top: 30px;">
	<div class="card-header bg-white" align="center">
    <div class="box_header_title">
      <span></span>
      <span></span> 
      <div class="content_header_title">
        <h2><img src="<?= base_url('assets/frontpage/img/icon/natsu.png'); ?>" width="30">User Register</h2> 
      </div>
    </div>
	</div>

	<div class="card-body">
		<div class="row">
		<div class="col-md-6 mb-2 mb-sm-0">
          <h5><b><u>Account Register</u></b></h5>
          <form id="reg_form" action="<?= site_url('go_register')?>" method="post" accept-charset="utf-8" >
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-user-circle"></i>
                    </div>
                  </div>
                <input class="form-control" type="text" name="user_id" placeholder="Username" minlength="4" maxlength="16" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-envelope"></i>
                    </div>
                  </div>
                <input class="form-control" type="email" name="id_email" placeholder="Email" maxlength="50"  required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </div>
                  </div>
                <input class="form-control" type="password" name="password" placeholder="Password" minlength="6" maxlength="16" required>
              </div>      
            </div>
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </div>
                  </div>
                <input class="form-control" type="password" name="c_password" placeholder="Comfirm Password" minlength="6" maxlength="16" required>
              </div>      
            </div>
            <hr>
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </div>
                  </div>
                <input class="form-control" type="" name="pin" pattern="[0-9]{6}" placeholder="Pin code" minlength="6" maxlength="6" required>
              </div>
              <small><b>* 6 digits number only, for buy item mall</b></small>     
            </div>
            <div class="form-group" align="left">
            	<input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">
              <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
              <button type="submit" class="btn-hover btn color-blue mr-1"><i class="fas fa-check mr-2"></i>Submit</button>
            </div>
          </form>
        </div>
        <div class="col-md-6 border-left mb-2 mb-sm-0" align="left">
          <h5><b><u>Privacy Police</u></b></h5>
          <ul class="mb-3 list_none">
            <li class="p-1">
              <i class="fas fa-check-circle text-success"></i>
              <small><span>All of data is only for Game Reqruitment.</span></small>
            </li>
            <li class="p-1">
              <i class="fas fa-check-circle text-success"></i>
              <small><span>We never use your data for our personal goals.</span></small>
            </li>
            <li class="p-1">
              <i class="fas fa-check-circle text-success"></i>
              <small><span>Your email and password is keep secret.</span></small>
            </li>
            <li class="p-1">
              <i class="fas fa-check-circle text-success"></i>
              <small><span>You are accept all of our term and condition.</span></small>
            </li>
          </ul>
          <div class="d-block border p-2">
            <p><b>TIPS : </b> Don't share your account information to other user.</p>
          </div>
        </div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('html').removeClass('no-js');
})
</script>