<div class="card" style="margin-top: 30px;" data-aos="fade-left" data-aos-delay="400"> 
  <div class="card-header bg-white">
		<div class="box_header_title" style="">
			<span></span>
			<span></span> 
			<div class="content_header_title">
				<h2> 
          <img src="<?= base_url('assets/frontpage/img/icon/natsu.png'); ?>" width="30">Change Password
				</h2> 
			</div>
		</div>
  </div>

	<div class="card-body">
    <div class="row">
      <div class="col-md-12 my-4">
        <form action="<?= site_url('go_change_pwd')?>" method="post">
          <div class="form-group">
            <label for="pin">Old Password :</label>
            <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
              <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
              <input class="form-control" type="password" name="old_password" placeholder="old password" minlength="6" maxlength="16"  required>
            </div>      
          </div>
          <div class="form-group">
            <label for="pin">New Password :</label>
            <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
              <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
              <input class="form-control" type="password" name="new_password" placeholder="new password" minlength="6" maxlength="16"  required>
            </div>      
          </div>
          <hr>
          <div class="form-group">
            <label for="pin">PIN Code :</label>
            <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                  </div>
                </div>
              <input class="form-control" type="" name="pin" pattern="[0-9]{6}" placeholder="pin" minlength="6" maxlength="6" required>
            </div>
            <small><i>* for security risk</i></small>     
          </div>
          <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">
          <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
          <button type="submit" class="btn-hover btn color-blue"><i class="fas fa-check mr-2"></i>Submit</button>
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
