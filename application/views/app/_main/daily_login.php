<div class="card" style="margin-top: 30px;" data-aos="fade-left" data-aos-delay="400">
  <div class="card-header bg-white">
    <div class="box_header_title" style="">
      <span></span>
      <span></span>
      <div class="content_header_title">
        <h2>
          Daily Check-In 
          <!-- <i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i> -->
        </h2>
      </div>
    </div> 
  </div>


  <div class="card-body">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"></h3>
      </div>
      <div class="panel-body">
        <h4 style="text-align:center;color:rgb(0, 123, 255);">
          Checked in <span style="color:#ff5555;"><?= $checkin_day; ?></span> day(s) this month
        </h4>
        <?php if($count_daily_checkin_item > 0): ?>
          <div style="text-align: center;">
            <?php if($available_checkin): ?>
              <!-- <button class="btn btn-primary btn-sm" id="btn_checkin_now">CHECK-IN NOW</button> -->
              <?php $this->load->view("app/_part/button_border.php",array(
                'part_bb_txt'=> 'CHECK-IN NOW',
                'part_bb_element'=> 'button',
                'part_bb_type'=> 'button',
                'part_bb_class'=>'btn-hover color-blue btn-sm', 
                'part_bb_t_id'=>'btn_checkin_now', 
                'part_bb_t_name'=>'', 
                'part_bb_style'=> 'width:40%;',
              )); ?>
            <?php else: ?>
              <span style="color:red;">
                You checked in for today, wait until <i class="fas fa-history"></i> <?= $available_checkin_date; ?> to check in again
              </span>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <div class="hr_daily_checkin">
          <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/hr.png'); ?>">
        </div>
        <?php if($count_daily_checkin_item > 0): ?>
          <div class="parent_daily_checkin"> 
            <?php foreach($daily_checkin_items as $key): ?>
            <?php 
              $tooltip = '';
              $tooltip .= $key['name'];
              if(!empty($key['description'])){
                $tooltip .= '<br><br>Description : '.$key['description'];
              }
            ?>
              <?php if($key['checkin_day'] <= $checkin_day): ?>
                <div class="child_daily_checkin child_daily_checkin_active" role="button" title="" data-toggle="tooltip" data-placement="top" data-original-title="<?= $tooltip; ?>" data-html="true">
                  <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/bg_daily_card_dot.png'); ?>" class="child_img_active_daily_checkin"> 
                  <!-- <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/items/'.$key["img"]); ?>" alt="-- No Image --" class="child_img_daily_checkin"> -->
                  <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/items/'.$key["img"]); ?>" alt="" class="child_img_daily_checkin">
                  <span class="child_text_daily_checkin_1">x<?= $key["qty"]; ?></span>
                  <span class="child_text_daily_checkin_2">Day <?= $key["checkin_day"]; ?></span>
                </div> 
              <?php else: ?>
                <div class="child_daily_checkin" role="button" title="" data-toggle="tooltip" data-placement="top" data-original-title="<?= $tooltip; ?>" data-html="true">
                  <!-- <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/items/'.$key["img"]); ?>" alt="-- No Image --" class="child_img_daily_checkin"> -->
                  <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/items/'.$key["img"]); ?>" alt="" class="child_img_daily_checkin">
                  <span class="child_text_daily_checkin_1">x<?= $key["qty"]; ?></span>
                  <span class="child_text_daily_checkin_2">Day <?= $key["checkin_day"]; ?></span>
                </div>
              <?php endif; ?>
            <?php endforeach; ?> 
          </div>
        <?php else: ?> 
          <h4 style="text-align: center;">-- Empty --</h4>
        <?php endif; ?> 
      </div>
    </div> 
  </div>
</div>  

<style>
  .hr_daily_checkin img{
    width:100%;
    margin-bottom:25px;
    margin-top:15px;
    margin-left:10px;
  }
  .parent_daily_checkin{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    justify-content: start;
  }
  .child_daily_checkin{
    /* width: 1.36rem;
    height: 2.05rem; */
    width: 7.36rem;
    height: 11.05rem;
    position: relative;
    background-size: 100% 100%;
    cursor: pointer;
    /* margin:auto; */
    margin-bottom: .82rem;
    margin-left: .35rem;
    margin-right: .35rem;
    background-image: url("<?= CDN_IMG.('assets/frontpage/img/daily_checkin/bg_daily_card.png'); ?>");

	  /* display: flex !important; */
  }
  .child_daily_checkin_active{
    background-image: url("<?= CDN_IMG.('assets/frontpage/img/daily_checkin/bg_daily_card_active.png'); ?>");
  }
  .child_img_active_daily_checkin{
    position: absolute;
    width: 1.32rem;
    height: 1.32rem;
    right: -.42rem;
    top: -.42rem;
    z-index: 10;
  }
  .child_img_daily_checkin{
    position: absolute;
    max-width: 5.5rem;
    /* height: 8.2rem; */
    left: 50%;
    -webkit-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
    top: .82rem;

    /* margin-top:auto;
    margin-bottom:auto;
    color:gray; */
  } 

  .child_text_daily_checkin_1{
    position: absolute;
    font-size: 1rem;
    color: #fff;
    width: 100%;
    text-align: center;
    left: 0;
    bottom: 2.1rem;
  }
  .child_text_daily_checkin_2{
    font-size: 1.1rem;
    color: #8f7d62;
    position: absolute;
    text-align: center;
    width: 100%;
    bottom: .1rem;
    left: 0;
  }
</style>

<script type="text/javascript">
$(document).ready(function(){
  let xepo_secure_name = "<?=$xepo_secure['name'];?>";
  let xepo_secure_value ="<?=$xepo_secure['hash'];?>";

  $("#btn_checkin_now").click(function(){
    $.ajax({
      url: '<?= base_url(); ?>api/checkin_now',
      data : {
        [xepo_secure_name] : xepo_secure_value,
      },
      type : "POST",
      dataType : "json",
      success: function(data) {
        xepo_secure_name = data.xepo_name;
        xepo_secure_value = data.xepo_value;
        if(data.result===true){
          swal("Success",
            "Successfully Checkin",
            "success",
          {
            buttons: { 
              // button_1: {text:'No', className:'btn-black'},
              button_1: "OK", 
            },
          })
          .then((value) => {
            switch (value) {
              default: 
                window.location.reload();
                break;
              }
          });
        }else{
          swal("Error:",
            data.result,
            "warning",
          {
            buttons: {  
              button_1: "OK", 
            },
          })
          .then((value) => {
            switch (value) {
              default:  
                break;
              }
          });
        }
      }
    });
  });
  
  // $(document).on('click','#send_pin',function(){
  //   $(this).hide();
  //   $("#send_group").append('<i class="fas fa-sync fa-spin mr-1"></i>Please wait');
  // });
  $('html').removeClass('no-js');
})
</script>