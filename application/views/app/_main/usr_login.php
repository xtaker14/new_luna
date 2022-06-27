<div class="card" data-aos="fade-left" data-aos-delay="0" style="margin-top: 30px;">
  <div class="d-md-flex p-2 mb-2" style="padding-top: 10px !important; padding-bottom: 2px !important;"> 
      <div class="d-block" style="width: 100%;">
          <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
          <h3 style="padding-bottom:5px;margin:0px;" class="text-primary border-bottom">Login</h3>
      </div>
  </div>

	<div class="card-body">
    <div class="row">
      <div class="col-md-6 offset-md-3 my-4">
        <form action="<?= site_url('go_login')?>" method="post">
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
              <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
              <input class="form-control" type="password" name="password" placeholder="Password" minlength="6" maxlength="16"  required>
            </div>      
          </div>
          <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">
          <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
          <button type="submit" class="btn btn-danger"><i class="fas fa-check mr-2"></i>Submit</button>
        </form>
      </div>
    </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('html').removeClass('no-js');
})
</script>