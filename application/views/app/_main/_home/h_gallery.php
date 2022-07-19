
<?php $this->load->view("app/_main/_media/header.php"); ?>
<style>
  .gallery {
    /* margin-top: 10px; */
    -moz-column-gap: 0;
    column-gap: 0;
    /* display: flex; */
  }
  @media (min-width: 480px) {
    .gallery {
      -moz-column-count: 3;
      column-count: 3;
    }
  }
  @media (min-width: 768px) {
    .gallery {
      -moz-column-count: 4;
      column-count: 4;
    }
  }
</style>
<div data-aos="fade-left" data-aos-delay="400" class="card d-none d-md-block shadow-sm mb-2">
  <div class="d-md-flex p-2" style="padding-top: 15px !important; padding-bottom: 2px !important;"> 
    <div class="d-block" style="width: 100%;">
        <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
        <h3 style="padding-bottom:5px;margin:0px;" class="text-primary border-bottom">Media</h3>
    </div>
  </div> 
  <div class="card-body" style="padding:10px;"> 

    <?php if(count($s_media)>0): ?>
      <article class="gallery">
        <?php 
        $show_delay = 50;
        foreach($s_media as $key): 
            $show_delay += 50;
        ?>
          <div>
            <a  class="gallery-link" href="<?= base_url(); ?>assets/frontpage/img/media/<?= $key['img']; ?>">
              <figure class="gallery-image" style="padding: 3px;">
                <img style="height: 150px; width:100%;" src="<?= base_url(); ?>assets/frontpage/img/media/<?= $key['img']; ?>">
                <!-- <figcaption><?= $key['name']; ?></figcaption> -->
                <div style="position: absolute; display: block; width: calc(100% - 5px); background: rgb(0, 123, 255, 0.8); padding: 10px; bottom: 0px; color: #fff; margin-bottom: 3px;">
                  <?= $key['name']; ?>
                </div>
              </figure>
            </a>
          </div>
        <?php endforeach; ?>
      </article>
      <div style="margin-top: 5px;border-top: 1px solid #dee2e6 !important;padding-top: 5px;">
        <a href="<?= base_url(); ?>media" class="text-primary" style="font-size: 14px; display:flex; align-items:center; justify-content: end;">
          Read More&nbsp;<i style="margin-bottom: -1px;" class="fa fa-angle-right"></i>
        </a>
      </div>
    <?php else: ?>
      <h3 style="text-align:center;">-- Empty --</h3>
    <?php endif; ?>
  </div>

</div>
<?php $this->load->view("app/_main/_media/footer.php"); ?>
