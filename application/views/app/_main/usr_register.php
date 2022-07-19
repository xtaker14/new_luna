<div class="card p-1" data-aos="fade-left" data-aos-delay="0" style="height: 100%;"> 
	<div class="card-body" style="height: 100%; background: #2a88ed; border-radius:4px;">
    
    <div class="d-md-flex mb-2" style="padding-top: 0px !important; padding-bottom: 2px !important;"> 
      <div class="d-block" style="width: 100%;">
        <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
        <h3 style="padding-bottom:5px;margin:0px;color:#fff;" class="border-bottom">Register</h3>
      </div>
    </div>

    <form id="reg_form" action="<?= site_url('go_register')?>" method="post" accept-charset="utf-8" >
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

          <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:10px;"> 

          <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                  </div>
                </div>
              <input class="form-control" type="" name="pin" pattern="[0-9]{6}" placeholder="PIN Code" minlength="6" maxlength="6" required>
            </div>
            <small style="color: #f1a6a6; text-shadow: 2px 2px 4px #464343;"><b>*6 digits number only, for buy item mall</b></small>     
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

          <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:10px;"> 

          <div class="form-group" align="left">
            <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">
            <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
            <!-- <button type="submit" class="btn-one btn-darker"> -->
            <button type="submit" class="btn-one ">
              REGIS<b>TER</b>
            </button>
          </div>
          
        </div>
		  </div>
    </form>
    
	</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){ 
    f_main.setInputFilter($("input[name=pin]"), function(value) {
      return /^\d*$/.test(value) && (value === "" || $.trim(value).length <= 6); 
    });

    $('html').removeClass('no-js');
  });
</script>