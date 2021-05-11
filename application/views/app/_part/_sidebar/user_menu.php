<div data-aos="fade-right" id="srv_form_login" class="card mb-3 parent_form_login" style="margin-top: 30px;">
  <div class="card-body shadow-sm">     
    <!-- <h4 class="text-muted"><b></b></h4> -->
    <div class="box_header_title">
      <span></span>
      <span></span> 
      <div class="content_header_title">
        <h2><img src="<?= base_url('assets/frontpage/img/icon/natsu.png'); ?>" width="30">&nbsp;FORM LOGIN</h2> 
      </div>
    </div>
    <!-- <a href="<?= base_url('login') ?>" class="btn btn-dark btn-block mb-3"><i class="fas fa-sign-in-alt mr-2"></i>LOGIN</a>
    <a href="<?= base_url('register') ?>" class="btn btn-danger btn-block mb-4"><i class="fas fa-registered mr-2"></i>REGISTER</a> -->

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
      <!-- <button type="submit" class="btn btn-danger"><i class="fas fa-check mr-2"></i>Submit</button> -->
      <button style="margin-bottom: 10px;" class="btn-hover btn color-blue" type="submit">LOGIN</button>
      <a href="<?= base_url('register') ?>" class="btn btn-hover color-red" type="button">REGISTER</a>
    </form>
  </div>
</div>