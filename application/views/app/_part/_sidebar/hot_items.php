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
          <button style="width:50%;" data-itemid="'.$id.'" class="view_detail btn btn-sm btn-hover color-red"><b>Buy</b><i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i></button>
        </div>
      </div>
  ';

}
?>

<div data-aos="fade-right" data-aos-delay="200" id="srv_hot_items" class="card shadow-sm mb-3" style="margin-top: 30px;" align="center">
  <div class="card-body">
    <!-- <h4 class="p-2 text-muted"><b><i class="fab fa-gripfire text-danger mr-2"></i>HOT ITEMS<i class="fab fa-gripfire text-danger ml-2"></i></b></h4> -->
    <div class="box_header_title">
      <span></span>
      <span></span> 
      <div class="content_header_title">
        <h2><i class="fab fa-gripfire text-danger mr-2"></i>HOT ITEMS<i class="fab fa-gripfire text-danger ml-2"></i></h2> 
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

