<div class="card" style="margin-top: 30px;" data-aos="fade-left" data-aos-delay="400"> 

  <?php $this->load->view("app/_part/header_title.php",array(
    'part_ht_txt_large'=> 'Change Email',
    'part_ht_txt_small'=> '', 
    'part_ht_left_i'=> '',
    'part_ht_right_i'=> '',
    // 'part_ht_left_img'=> CDN_IMG.('assets/frontpage/img/doge.png'),
    // 'part_ht_right_img'=> CDN_IMG.('assets/frontpage/img/doge.png'),
    'part_ht_left_img'=> '',
    'part_ht_right_img'=> '',
    'part_ht_style_img'=> 'width:30px;',
    'part_ht_style_txt_large'=> 'font-size:20px;',
  )); ?>

	<div class="card-body">
    <div class="row">
      <div class="col-md-12 my-4">
        <form action="<?= site_url('go_change_email')?>" method="post"> 
          <div class="form-group">
            <label for="pin">New Email :</label>
            <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
              <input class="form-control" type="email" name="new_email" placeholder="New Email" minlength="6" required>
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
              <input class="form-control" type="" name="pin" pattern="[0-9]{6}" placeholder="PIN" minlength="6" maxlength="6" required>
            </div>
            <small><i>* for security risk</i></small>     
          </div>
          <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">
          <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
          
          <?php $this->load->view("app/_part/button_border.php",array(
            'part_bb_txt'=> '<i class="fas fa-check mr-2"></i>Submit',
            'part_bb_element'=> 'button',
            'part_bb_class'=> 'btn-hover color-blue',
            'part_bb_type'=> 'submit',
            'part_bb_style'=> 'width:100%;margin:0;letter-spacing:2px;',
          )); ?>
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
