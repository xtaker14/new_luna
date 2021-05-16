
<?php $this->load->view("app/_main/_media/header.php"); ?>
<style>
    .gallery {
        margin-top: 10px;
        -moz-column-gap: 0;
        column-gap: 0;
    }
    @media (min-width: 320px) { 
        .gallery .gallery-image img{
            height: 220px !important;
        }
    }
    @media (min-width: 611px) {
        .gallery {
            -moz-column-count: 1;
            column-count: 1;
        }
        .gallery .gallery-image img{
            height: 290px !important;
        }
    }
    @media (min-width: 821px) {
        .gallery {
            -moz-column-count: 2;
            column-count: 2;
        }
        .gallery .gallery-image img{
            height: 220px !important;
        }
    }
    @media (min-width: 951px) {
        .gallery {
            -moz-column-count: 1;
            column-count: 1;
        }
        .gallery .gallery-image img{
            height: 260px !important;
        }
    }
    @media (min-width: 990px) {
        .gallery {
            -moz-column-count: 2;
            column-count: 2;
        }
    }
</style>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<div data-aos="fade-left" data-aos-delay="200" class="card" style="margin-top: 30px;">

	<div class="card-body"> 
        <div class="box_header_title" style="">
			<span></span>
			<span></span> 
			<div class="content_header_title">
				<h2> 
				    MEDIA<i class="far fa-images ml-2" data-fa-transform="rotate-30"></i>
				</h2> 
			</div>
		</div>

        <section id="tabs" class="project-tab">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-media-ss-tab" data-toggle="tab" href="#tbl_media_ss_table" role="tab" aria-controls="nav-media-ss" aria-selected="true">SCREEN SHOOTS</a>
                            <a class="nav-item nav-link" id="nav-media-w-tab" data-toggle="tab" href="#tbl_media_w_table" role="tab" aria-controls="nav-media-w" aria-selected="false">WALLPAPERS</a>
                        </div>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tbl_media_ss_table" role="tabpanel" aria-labelledby="nav-media-ss-tab">
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
                        <div class="tab-pane fade" id="tbl_media_w_table" role="tabpanel" aria-labelledby="nav-media-w-tab">
                            <?php if(count($w_media)>0): ?>
                                <article class="gallery">
                                    <?php 
                                    $show_delay = 50;
                                    foreach($w_media as $key): 
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
                </div>
            </div>
        </section>
	</div>
</div> 
    
<?php $this->load->view("app/_main/_media/footer.php"); ?>
