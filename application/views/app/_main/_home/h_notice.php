<div data-aos="fade-left" data-aos-delay="200" class="card d-none d-md-block shadow-sm mb-2" >
    <div class="d-md-flex p-2" style="padding-top: 15px !important; padding-bottom: 2px !important;"> 
        <div class="d-block" style="width: 100%;">
            <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
            <h3 style="padding-bottom:5px;margin:0px;" class="text-primary border-bottom">NEWS AND UPDATES</h3>
        </div>
    </div>

    <div class="d-md-flex" style="position: relative;">
        <img class="img-fluid w-100 mb-2" style="margin-bottom: 0px !important;" src="<?php print_r(CDN_IMG.$news[0]['img']) ?>">
        <div class="d-block" style="position: absolute; bottom: 0px; margin-bottom: 0px; padding: 5px; width: 100%; background: rgb(0, 123, 255, 0.8);">
            <h3 style="color: #fff !important;" class="text-primary border-bottom"><?= $news[0]['title'] ?></h3>
            <small style="color: #fff;"><i><?= $news[0]['category'] ?>, <?= $news[0]['date'] ?></i></small>
        </div>
    </div>
    
    <div class="card-body">    
        <?= $news[0]['content'] ?>
        <br>
        <div style="text-align:right;">
            <small style="">
                <a style="color:#007bff;" href="<?= base_url('news/'.$news[0]['url']); ?>" target="__BLANK">
                    Read More&nbsp;<i style="margin-bottom: -1px;" class="fa fa-angle-right"></i>
                </a>
            </small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-7" style="padding-right: 0px;"> 
        <section class="tabs project-tab hot_news_tab" data-aos="fade-right" data-aos-delay="300" style="height: 100%;">
            <div class="card shadow-sm p-1" style="height: 100%;">
                <div style="background: #2a88ed; border-radius: 4px; height: 100%;">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-news-tab" data-toggle="tab" href="#tbl_news_table" role="tab" aria-controls="nav-news" aria-selected="true">
                                <img class="" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 30px;height: 30px;margin-top:-7px;">    
                                NEWS
                            </a>
                            <a class="nav-item nav-link" id="nav-events-tab" data-toggle="tab" href="#tbl_events_table" role="tab" aria-controls="nav-events" aria-selected="false">
                                <img class="" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 30px;height: 30px;margin-top:-7px;">    
                                EVENTS
                            </a> 
                        </div>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tbl_news_table" role="tabpanel" aria-labelledby="nav-news-tab">
                            <?php if(count($news)==0): ?> 
                                <h4 style="color:#0b2eb6;text-align:center;">--Coming Soon--</h4>
                            <?php endif; ?>
                            <div class="row" style="margin: 0px;">
                                <?php  
                                foreach ($news as $key => $val) :
                                if($key>0) : ?>
                                    <div class="col-md-12 mb-2" style="padding: 0px;padding-top: 7px;">
                                        <div class="row" style="margin: 0px;">
                                            <!-- <img class="mini-notice rounded-circle" src="<?= $val['img']; ?>" alt="<?= $val['title']; ?>" style="margin:auto;"> -->
                                            <div class="col-md-3" style="padding: 0px;padding-left: 5px;">
                                                <img src="<?= $val['img']; ?>" style="width: 100%;max-height:150px;" alt="<?= $val['title']; ?>">
                                            </div>
                                            <div class="col-md-9" style="display:flex;flex-wrap:wrap;padding: 0px;">
                                                <div class="row" style="margin: 0px; width: 100%;">
                                                    <div class="col-md-12">
                                                        <a href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                                            <h5 class="" style="color:#fff;text-align: left;">
                                                                <b><?= $val['title']; ?></b>
                                                            </h5>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin: 0px; width: 100%; margin-top:auto;align-items:baseline;">
                                                    <div class="col-md-7" style="text-align:left;">
                                                        <span style="color:#000;">
                                                            <!-- <?= $val['category'].', '.$val['date']; ?> -->
                                                            <?= $val['date']; ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-5" style="text-align: right;">
                                                        <small>
                                                            <a style="color:#0b2eb6;" href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                                                Read More&nbsp;<i style="margin-bottom: -1px;" class="fa fa-angle-right"></i>
                                                            </a>
                                                        </small> 
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <?php if(count($news)>1): ?>
                                        <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin:2px;">
                                    <?php endif; ?>
                                <?php endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tbl_events_table" role="tabpanel" aria-labelledby="nav-events-tab" style="padding-top: 10px;">
                            <?php if(count($news_event)==0): ?>
                                <h4 style="color:#0b2eb6;text-align:center;">--Coming Soon--</h4>
                            <?php endif; ?>
                            <div class="row" style="margin: 0px;">
                                <?php foreach ($news_event as $key => $val) : ?>
                                    <div class="col-md-12 mb-2" style="padding: 0px;padding-top: 7px;">
                                        <div class="row" style="margin: 0px;">
                                            <div class="col-md-3" style="padding: 0px;padding-left: 5px;">
                                                <img src="<?= $val['img']; ?>" style="width: 100%;max-height:150px;" alt="<?= $val['title']; ?>">
                                            </div>
                                            <div class="col-md-9" style="display:flex;flex-wrap:wrap;padding: 0px;">
                                                <div class="row" style="margin: 0px; width: 100%;">
                                                    <div class="col-md-12">
                                                    <a href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                                        <h5 class="" style="color:#fff;text-align: left;">
                                                        <?= $val['title']; ?>
                                                        </h5>
                                                    </a>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin: 0px; width: 100%; margin-top:auto;align-items:baseline;">
                                                    <div class="col-md-7" style="text-align:left;">
                                                        <span style="color:#000;">
                                                            <!-- <?= $val['category'].', '.$val['date']; ?> -->
                                                            <?= $val['date']; ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-5" style="text-align: right;">
                                                        <small>
                                                            <a style="color:#0b2eb6;" href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                                                MORE&nbsp;<i class="fas fa-arrow-right"></i>
                                                            </a>
                                                        </small> 
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <?php if(count($news_event)>1): ?>
                                        <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin:2px;">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </section>  
    </div>
    
    <div class="col-5" style="">
        <?php 
			$this->load->view("app/_part/_sidebar/server_stat.php");
        ?>
    </div>
</div> 
