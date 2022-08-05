<!-- <script src="https://publisher.linkvertise.com/cdn/linkvertise.js"></script><script>linkvertise(475139, {whitelist: ["new_luna.local.com/checkin/"], blacklist: []});</script> -->

<?php
$routes_api = $GLOBALS['ROUTES-API']; 
?>

<div class="card p-1" data-aos="fade-left" data-aos-delay="0" style="height: 100%;"> 
	<div class="card-body" style="height: 100%; background: #2a88ed; border-radius:4px;">
    <div class="d-md-flex mb-2" style="padding-top: 0px !important; padding-bottom: 2px !important;"> 
      <div class="d-block" style="width: 100%;">
        <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
        <h3 style="padding-bottom:5px;margin:0px;color:#fff;" class="border-bottom">Daily Check In</h3>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"></h3>
      </div>
      <div class="panel-body">
        <h4 style="text-align:center;color:rgb(56, 218, 11);">
          <!-- Checked in <span style="color:#ff5555;"><?= $checkin_day; ?></span> day(s) this month -->
          <?php 
            if($checkin_counter == 3 && $check_exist_daily_checkin && $available_checkin){
              echo "Checked in 0 times on day ".($checkin_day+1);
            } else {
              echo "Checked in $checkin_counter times on day $checkin_day";
            }
          ?> 
        </h4>

        <?php if($check_exist_daily_checkin): ?>
          <div style="text-align: center;">
            <?php if($available_checkin): ?>
              <?php $this->load->view("app/_part/button_border.php",array(
                'part_bb_txt'=> 'CHECK<b>IN</b> NOW',
                'part_bb_element'=> 'a',
                'part_bb_type'=> '',
                'part_bb_href'=> site_url($routes_api['checkin_now']['encrypt']),
                'part_bb_class'=>'btn-three', 
                'part_bb_t_id'=>'btn_checkin_now', 
                'part_bb_t_name'=>'', 
                'part_bb_style'=> 'display:block; width:40%; margin: auto;',
              )); ?>
            <?php else: ?>
              <span style="color:#790d0d;">
                <!-- You checked in for today, wait until <i class="fas fa-history"></i> <?= $available_checkin_date; ?> to check in again -->
                Wait until <i class="fas fa-history"></i> <?= $available_checkin_date; ?> to check in again
              </span>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="hr_daily_checkin">
          <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/hr.png'); ?>">
        </div>

        <div>
          <h4 style="text-align:center;color:rgb(197, 237, 186);">
            CheckIn Card in <?= getListMonth($config_web['daily_checkin_month']).' '.$config_web['daily_checkin_year']; ?>
          </h4>
        </div>
        <?php if(count($daily_checkin_items) > 0): ?>
          <div class="parent_daily_checkin"> 
            <?php for($i=0; $i<29; $i++): ?>
            <?php 
              $key = $daily_checkin_items[$i];
              $tooltip = '';
              $tooltip .= $key['name'];
              if(!empty($key['description'])){
                $tooltip .= '<br><br>Description : '.$key['description'];
              }
            ?>
              <?php if(!empty($key['name']) && $key['is_claimed'] == 'yes'): ?>
                <div class="child_daily_checkin child_daily_checkin_active" role="button" title="" data-toggle="tooltip" data-placement="top" data-original-title="<?= $tooltip; ?>" data-html="true">
                  <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/bg_daily_card_dot.png'); ?>" class="child_img_active_daily_checkin">  
                  <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/items/'.$key["img"]); ?>" alt="" class="child_img_daily_checkin">
                  <span class="child_text_daily_checkin_1">x<?= $key["qty"]; ?></span>
                  <span class="child_text_daily_checkin_2">Day <?= $key["checkin_day"]; ?></span>
                </div> 
              <?php else: ?>
                <div class="child_daily_checkin" role="button" title="" data-toggle="tooltip" data-placement="top" data-original-title="<?= $tooltip; ?>" data-html="true"> 
                  <?php if(!empty($key['name'])): ?>
                    <img src="<?= CDN_IMG.('assets/frontpage/img/daily_checkin/items/'.$key["img"]); ?>" alt="" class="child_img_daily_checkin">
                    <span class="child_text_daily_checkin_1">x<?= $key["qty"]; ?></span>
                    <span class="child_text_daily_checkin_2">Day <?= $key["checkin_day"]; ?></span>
                  <?php else: ?>
                    <span class="child_text_daily_checkin_1">-</span>
                    <span class="child_text_daily_checkin_2">--Empty--</span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            <?php endfor; ?> 
          </div>
        <?php else: ?> 
          <h4 style="color:#fff; text-align: center;">-- Empty --</h4>
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
    justify-content: center;
    align-items: center;
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
	  box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.4) !important;
    background-image: url("<?= CDN_IMG.('assets/frontpage/img/daily_checkin/bg_daily_card.png'); ?>");

	  /* display: flex !important; */
  }
  .child_daily_checkin_active{
    background-image: url("<?= CDN_IMG.('assets/frontpage/img/daily_checkin/bg_daily_card_active.png'); ?>");
    /* margin-left: auto; */
    /* margin-right: auto; */
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
  });

  // checkInNow();
  // function checkInNow(){
  //   $.ajax({
  //     url: '<?= base_url(); ?>api/checkin_now',
  //     data : {
  //       [xepo_secure_name] : xepo_secure_value,
  //     },
  //     type : "POST",
  //     dataType : "json",
  //     success: function(data) {
  //       xepo_secure_name = data.xepo_name;
  //       xepo_secure_value = data.xepo_value;
  //       if(data.result===true){
  //         swal("Success",
  //           "Successfully Checkin",
  //           "success",
  //         {
  //           buttons: { 
  //             // button_1: {text:'No', className:'btn-black'},
  //             button_1: "OK", 
  //           },
  //         })
  //         .then((value) => {
  //           switch (value) {
  //             default: 
  //               window.location.reload();
  //               break;
  //             }
  //         });
  //       }else{
  //         swal("Error:",
  //           data.result,
  //           "warning",
  //         {
  //           buttons: {  
  //             button_1: "OK", 
  //           },
  //         })
  //         .then((value) => {
  //           switch (value) {
  //             default:  
  //               break;
  //             }
  //         });
  //       }
  //     }
  //   });
  // }
  
  // $(document).on('click','#send_pin',function(){
  //   $(this).hide();
  //   $("#send_group").append('<i class="fas fa-sync fa-spin mr-1"></i>Please wait');
  // });
  $('html').removeClass('no-js');
})
</script>