<?php

$a = "";

foreach ($hot_items as $key => $val) {
  $id = $val['itemid'];
  $img = $val['itemimage'];
  $name = $val['itemname'];

  $active = "";
  if($key==0){
    $active = "active";
  }

  $a .= '
      <div class="carousel-item '.$active.'">
        <div class="d-block" style="max-width: 150px;max-height: 150px;overflow: hidden;">
          <img class="rounded mx-auto d-block" style="width:160px;height:auto;" src="'.CDN_IMG.$img.'" alt="flora festival">
        </div>
        <div class="d-block">
          <div class="d-block" style="height:50px;"><small class="text-primary">'.$name.'</small></div>
          <button style="width:50%; margin-bottom:7px;" data-itemid="'.$id.'" class="view_detail btn-one color-red">
            Buy
          </button>
        </div>
      </div>
  ';

}
?>

<div data-aos="fade-right" data-aos-delay="200" id="srv_hot_items" class="card shadow-sm mb-2" style="" align="center">
  <div class="card-body">
    <div class="d-md-flex p-2" style="padding-top: 0px !important; padding-bottom: 7px !important;"> 
			<div class="d-block" style="width: 100%;">
				<h3 style="padding-bottom:5px;margin:0px;" class="text-primary border-bottom">
				  <img class="mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 40px; height: 35px; margin-top:-15px;margin-left:-10px;">    
					<b>BEST ITEMS</b>
				</h3>
			</div>
		</div>

    <div id="carouselExampleIndicators" class="carousel slide" align="center" data-ride="carousel">
        <div class="carousel-inner">
          <?= $a ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <i class="fas fa-angle-left text-primary fa-2x"></i>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <i class="fas fa-angle-right text-primary fa-2x"></i>
          <span class="sr-only">Next</span>
        </a>
    </div>    
  </div>
</div>

