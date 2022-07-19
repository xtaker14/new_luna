

<div class="card p-1" data-aos="fade-left" data-aos-delay="0" style="height: 100%;"> 

	<div class="card-body" style="height: 100%; background: #2a88ed; border-radius:4px;">

    

    <div class="d-md-flex mb-2" style="padding-top: 0px !important; padding-bottom: 2px !important;"> 

      <div class="d-block" style="width: 100%;">

        <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    

        <h3 style="padding-bottom:5px;margin:0px;color:#fff;" class="border-bottom">Change Password</h3>

      </div>

    </div>



    <form action="<?= site_url('go_change_pwd')?>" method="post" class="form_blue_input_group">

      <div class="row">

        <div class="col-12"> 

          <div class="form-group d-block border p-2" style="border: 2px solid black !important; background: #fff;">

            <p><b>TIPS : </b> Don't share your account information to other user.</p>

          </div>

        </div>

      </div>



      <div class="row">

        <div class="col-md-6">

          <div class="form-group">

            <div class="input-group">

                <div class="input-group-prepend">

                  <div class="input-group-text">

                    <i class="fas fa-lock"></i>

                  </div>

                </div>

              <input class="form-control" type="password" name="old_password" placeholder="Current Password" minlength="6" maxlength="16"  required>

            </div>      

          </div>



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



        <div class="col-md-6 border-left">

          <div class="form-group">

            <div class="input-group">

                <div class="input-group-prepend">

                  <div class="input-group-text">

                    <i class="fas fa-lock"></i>

                  </div>

                </div>

              <input class="form-control" type="password" name="new_password" placeholder="New password" minlength="6" maxlength="16"  required>

            </div>     

          </div>



          <div class="form-group">

            <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">

            <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">

            <button type="submit" class="btn-one">

              <b style="color: #fff;">CHANGE</b>

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

})

</script>

