<div class="card p-1" data-aos="fade-left" data-aos-delay="0" style="height: 100%;"> 
	<div class="card-body" style="height: 100%; background: #2a88ed; border-radius:4px;">
    <div class="d-md-flex mb-2" style="padding-top: 0px !important; padding-bottom: 2px !important;"> 
      <div class="d-block" style="width: 100%;">
        <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
        <h3 style="padding-bottom:5px;margin:0px;color:#fff;" class="border-bottom">Login</h3>
      </div>
    </div>
    
    <form class="form_blue_input_group" action="<?= site_url('go_login')?>" method="post">
      <div class="row">
        <div class="col-12"> 
          <div class="form-group d-block border p-2" style="border: 2px solid black !important; background: #fff;">
            <p><b>TIPS : </b> Don't share your account information to other user.</p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-2 mb-sm-0">
          <div class="form-group">
            <i class="fas fa-check-circle" style="color: #fff;"></i>
            <small style="color: #fff;"><b>All of data is only for Game Reqruitment.</b></small>
          </div>
          <div class="form-group">
            <i class="fas fa-check-circle" style="color: #fff;"></i>
            <small style="color: #fff;"><b>We never use your data for our personal goals.</b></small>
          </div>
          <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:10px;"> 
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-user"></i>
                </div>
              </div>
              <input class="form-control" type="text" name="user_id" placeholder="Username" minlength="4" maxlength="16" required>
            </div>      
          </div>
        </div>
        
        <div class="col-md-6 border-left mb-2 mb-sm-0" align="left">
          <div class="form-group">
            <i class="fas fa-check-circle" style="color: #fff;"></i>
            <small style="color: #fff;"><b>Your email and password is keep secret.</b></small>
          </div>
          <div class="form-group">
            <i class="fas fa-check-circle" style="color: #fff;"></i>
            <small style="color: #fff;"><b>You are accept all of our term and condition.</b></small>
          </div>
          <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:10px;"> 
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-lock"></i>
                </div>
              </div>
              <input class="form-control" type="password" name="password" placeholder="Password" minlength="6" maxlength="16"  required>
            </div>      
          </div>
        </div>
      </div> 
      
      <div class="row">
        <div class="col-md-12 mb-2 mb-sm-0">
          <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:10px;"> 
          <div class="form-group">
            <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">
            <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
            <button type="submit" class="btn-three">
              LOG<b>IN</b>
            </button>
          </div>
        </div>
      </div> 
    </form>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('html').removeClass('no-js');
})
</script>