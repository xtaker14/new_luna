
<div class="card" style="margin-top: 30px;"> 
  <div class="card-header bg-white">
		<div class="box_header_title" style="">
			<span></span>
			<span></span> 
			<div class="content_header_title">
				<h2> 
          <img src="<?= base_url('assets/frontpage/img/icon/natsu.png'); ?>" width="30">PIN Change Request
				</h2> 
			</div>
		</div>
  </div>

  <div class="card-body" >
    <form action="<?= site_url('go_pin_req')?>" method="post">
      <div id="send_group" class="form-group" align="center">
        <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">
        <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
        <button id="send_pin" type="submit" class="btn-hover btn color-blue w-50">Request PIN</button>
      </div>
    </form>
    <div class="d-block border p-2 mb-3">
      <label><b>Note :</b></label>
      <ul>
        <li>Make sure you can access your email.</li>
        <li>Click 'Request PIN'.</li>
        <li>Check Your email on inbox or spam folder.</li>
        <li>Click the url on email.</li>
      </ul>
    </div>
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