<div class="card">
  <div class="card-header bg-white" align="center">
    <h4 class="text-secondary"><b><img src="<?= base_url('assets/frontpage/img/icon/natsu.png'); ?>" width="40" height="40">User Login</b></h4>
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