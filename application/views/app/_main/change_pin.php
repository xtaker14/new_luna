<div class="card" data-aos="fade-left" data-aos-delay="400">
  <div class="card-header bg-white" align="center">
    <h4 class="text-secondary"><b><img src="<?= base_url('assets/frontpage/img/icon/natsu.png'); ?>" width="40" height="40">Change PIN</b></h4>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6 offset-md-3 my-4">
        <form action="<?= site_url('go_change_pin')?>" method="post">
          <div class="form-group">
            <label for="pin"> New PIN</label>
            <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                  </div>
                </div>
              <input class="form-control" type="" name="pin" pattern="[0-9]{6}" placeholder="new pin" minlength="6" maxlength="6" required>
            </div>
            <small><b>* 6 digits number only, for buy item mall</b></small>     
          </div>
          <div class="form-group">
            <label for="pin">Verify Login password :</label>
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
          <input type="hidden" id="rand_code" name="rand_code" value="<?= $rand_code ?>">
          <button type="submit" class="btn btn-primary"><i class="fas fa-check mr-2"></i>Submit</button>
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