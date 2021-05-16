
<?php $this->load->view("app/_main/_media/header.php"); ?>
<style>
  .gallery {
    /* margin-top: 10px; */
    -moz-column-gap: 0;
    column-gap: 0;
  }
  @media (min-width: 480px) {
    .gallery {
      -moz-column-count: 1;
      column-count: 1;
    }
  }
  @media (min-width: 768px) {
    .gallery {
      -moz-column-count: 2;
      column-count: 2;
    }
  }
</style>
<div data-aos="fade-left" data-aos-delay="400" class="card d-none d-md-block shadow-sm mb-2">
  <div class="d-md-flex p-2">
    <img class="float-left mr-2" src="<?= base_url(); ?>assets/frontpage/img/notice/news-thumb.png" style="width: 60px; height: 60px; visibility: visible;">      
    <div class="d-block" style="display:flex !important; justify-content: space-between; width:100%;">
      <div>
        <h3 class="text-primary border-bottom">Media</h3>
        <small><i>Screen Shoot</i></small>
      </div>
      <div>
        <a href="<?= base_url(); ?>media" class="text-primary" style="font-size: 17px; display:flex; align-items:center;">
          <span>More</span><i style="margin-left:3px; font-size: 17px; margin-top:2px;" class="fa fa-angle-right"></i><i style="font-size: 17px; margin-top:2px;" class="fa fa-angle-right"></i>
        </a>
      </div>
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
          <a  class="gallery-link" href="<?= base_url(); ?>assets/frontpage/img/media/<?= $key['img']; ?>">
            <figure class="gallery-image" style="padding:3px;">
              <img style="height: 220px; width:100%;" src="<?= base_url(); ?>assets/frontpage/img/media/<?= $key['img']; ?>">
              <figcaption><?= $key['name']; ?></figcaption>
            </figure>
          </a>
        <?php endforeach; ?>
      </article>
    <?php else: ?>
      <h3 style="text-align:center;">-- Empty --</h3>
    <?php endif; ?>
  </div>

</div>
<?php $this->load->view("app/_main/_media/footer.php"); ?>
