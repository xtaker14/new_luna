
<div class="card p-1" data-aos="fade-left" data-aos-delay="0" style="height: 100%;"> 
	<div class="card-body" style="height: 100%; background: #2a88ed; border-radius:4px;">
    
    <div class="d-md-flex mb-2" style="padding-top: 0px !important; padding-bottom: 2px !important;"> 
      <div class="d-block" style="width: 100%;">
        <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
        <h3 style="padding-bottom:5px;margin:0px;color:#fff;" class="border-bottom">Request Change PIN</h3>
      </div>
    </div>

    <div class="d-block border p-2 mb-3" style="color: #fff;">
      <label><b>Note :</b></label>
      <ul>
        <li>Make sure you can access your email.</li>
        <li>Click 'Request PIN'.</li>
        <li>Check Your email on inbox or spam folder.</li>
        <li>Click the url on email.</li>
      </ul>
    </div>

    <form action="<?= site_url('go_pin_req')?>" method="post">
      <div id="send_group" class="form-group" align="center">
        <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">
        <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
        <button id="send_pin" type="submit" class="btn-three w-50"><b style="color: #fff;">Request PIN</b></button>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('html').removeClass('no-js');

  $(document).on('click','#send_pin',function(){
    $(this).hide();
    $("#send_group").append('<i class="fas fa-sync fa-spin mr-1"></i>Please wait');
  })
})
</script>