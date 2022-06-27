<div data-aos="fade-left" id="srv_form_login" class="card mb-2 parent_form_login" style="margin-top: -5px;">
  <div class="card-body shadow-sm">     
    <!-- <h4 class="text-muted"><b></b></h4> -->
    <!-- <a href="<?= base_url('login') ?>" class="btn btn-dark btn-block mb-3"><i class="fas fa-sign-in-alt mr-2"></i>LOGIN</a>
    <a href="<?= base_url('register') ?>" class="btn btn-danger btn-block mb-4"><i class="fas fa-registered mr-2"></i>REGISTER</a> -->

    <form action="<?= site_url('go_login')?>" method="post">
      <div class="row">
        <div class="col-8" style="padding-right: 0px;">
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
          <div class="">
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
        <div class="col-4">
          <!-- <button style="margin-bottom: 10px; height: 100%;" class="btn-hover btn color-blue" type="submit">
            LOGIN
          </button> -->
          <button class='btn-one' type="submit">LOG<b>IN</b></button>
        </div>
      </div>
      <div class="row">
        <div class="col-12"> 
          <a href=""><i><small>Forgot Password?</small></i></a>
        </div>
      </div>
      <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">
      <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
      <!-- <button type="submit" class="btn btn-danger"><i class="fas fa-check mr-2"></i>Submit</button> -->
    </form>
  </div>
</div>