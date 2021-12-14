<div data-aos="fade-left" data-aos-delay="200" class="card d-none d-md-block shadow-sm mb-2" >
  <div class="d-md-flex p-2">
    <img class="float-left mr-2" src="<?= base_url('assets/frontpage/img/notice/news-thumb.png') ?>" style="width: 60px;height: 60px;">      
    <div class="d-block">
      <h3 class="text-primary border-bottom"><?= $news[0]['title'] ?></h3>
      <small><i><?= $news[0]['category'] ?>, <?= $news[0]['date'] ?></i></small>
    </div>
  </div>
  <img class="img-fluid w-100 mb-2" src="<?php print_r(CDN_IMG.$news[0]['img']) ?>">
  <div class="card-body">    
    <?= $news[0]['content'] ?>
    <br>
    <div style="text-align:right;">
      <small style="">
        <a style="color:#007bff;" href="<?= base_url('news/'.$news[0]['url']); ?>" target="__BLANK">
            MORE&nbsp;<i class="fas fa-arrow-right"></i>
        </a>
      </small>
    </div>
  </div>
</div>  

<section class="tabs project-tab hot_news_tab mb-4">
    <div class="row">
        <div class="col-md-12">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-news-tab" data-toggle="tab" href="#tbl_news_table" role="tab" aria-controls="nav-news" aria-selected="true">NEWS</a>
                    <a class="nav-item nav-link" id="nav-events-tab" data-toggle="tab" href="#tbl_events_table" role="tab" aria-controls="nav-events" aria-selected="false">EVENTS</a>
                    <a class="nav-item nav-link" id="nav-serverinfo-tab" data-toggle="tab" href="#tbl_serverinfo_table" role="tab" aria-controls="nav-serverinfo" aria-selected="false">SERVER INFO</a>
                    <a class="nav-item nav-link" id="nav-itemmall-tab" data-toggle="tab" href="#tbl_itemmall_table" role="tab" aria-controls="nav-itemmall" aria-selected="false">ITEM MALL</a>
                </div>
            </nav>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tbl_news_table" role="tabpanel" aria-labelledby="nav-news-tab">
                    <?php if(count($news)==0): ?>
                        <!-- <h4 style="color:#ff5555;text-align:center;">- - Coming Soon - -</h4> -->
                        <h4 style="color:#007bff;text-align:center;">- - Coming Soon - -</h4>
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
                                            <h5 class="" style="color:#000;text-align: left;">
                                            <?= $val['title']; ?>
                                            </h5>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 0px; width: 100%; margin-top:auto;align-items:baseline;">
                                        <div class="col-md-7" style="text-align:left;">
                                            <span style="color:#007bff;">
                                                <!-- <?= $val['category'].', '.$val['date']; ?> -->
                                                <?= $val['date']; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-5" style="text-align: right;">
                                            <small>
                                                <a style="color:#007bff;" href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                                    MORE&nbsp;<i class="fas fa-arrow-right"></i>
                                                </a>
                                            </small> 
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            <?php if(count($news)>1): ?>
                                <hr style="border:1px dashed #61551E;width:100%;max-width:100%;background-color:transparent;margin:2px;">
                            <?php endif; ?>
                        <?php endif;
                        endforeach;
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="tbl_events_table" role="tabpanel" aria-labelledby="nav-events-tab" style="padding-top: 10px;">
                    <?php if(count($news_event)==0): ?>
                        <h4 style="color:#007bff;text-align:center;">- - Coming Soon - -</h4>
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
                                            <h5 class="" style="color:#000;text-align: left;">
                                            <?= $val['title']; ?>
                                            </h5>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 0px; width: 100%; margin-top:auto;align-items:baseline;">
                                        <div class="col-md-7" style="text-align:left;">
                                            <span style="color:#007bff;">
                                                <!-- <?= $val['category'].', '.$val['date']; ?> -->
                                                <?= $val['date']; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-5" style="text-align: right;">
                                            <small>
                                                <a style="color:#007bff;" href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                                    MORE&nbsp;<i class="fas fa-arrow-right"></i>
                                                </a>
                                            </small> 
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            <?php if(count($news_event)>1): ?>
                                <hr style="border:1px dashed #61551E;width:100%;max-width:100%;background-color:transparent;margin:2px;">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="tbl_serverinfo_table" role="tabpanel" aria-labelledby="nav-serverinfo-tab" style="padding-top: 10px;">
                    <?php if(count($news_server_info)==0): ?>
                        <h4 style="color:#007bff;text-align:center;">- - Coming Soon - -</h4>
                    <?php endif; ?>
                    <div class="row" style="margin: 0px;">
                        <?php foreach ($news_server_info as $key => $val) : ?>
                            <div class="col-md-12 mb-2" style="padding: 0px;padding-top: 7px;">
                            <div class="row" style="margin: 0px;">
                                <div class="col-md-3" style="padding: 0px;padding-left: 5px;">
                                    <img src="<?= $val['img']; ?>" style="width: 100%;max-height:150px;" alt="<?= $val['title']; ?>">
                                </div>
                                <div class="col-md-9" style="display:flex;flex-wrap:wrap;padding: 0px;">
                                    <div class="row" style="margin: 0px; width: 100%;">
                                        <div class="col-md-12">
                                        <a href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                            <h5 class="" style="color:#000;text-align: left;">
                                            <?= $val['title']; ?>
                                            </h5>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 0px; width: 100%; margin-top:auto;align-items:baseline;">
                                        <div class="col-md-7" style="text-align:left;">
                                            <span style="color:#007bff;">
                                                <!-- <?= $val['category'].', '.$val['date']; ?> -->
                                                <?= $val['date']; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-5" style="text-align: right;">
                                            <small>
                                                <a style="color:#007bff;" href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                                    MORE&nbsp;<i class="fas fa-arrow-right"></i>
                                                </a>
                                            </small> 
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            <?php if(count($news_server_info)>1): ?>
                                <hr style="border:1px dashed #61551E;width:100%;max-width:100%;background-color:transparent;margin:2px;">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="tbl_itemmall_table" role="tabpanel" aria-labelledby="nav-itemmall-tab" style="padding-top: 10px;">
                    <?php if(count($news_item_mall)==0): ?>
                        <h4 style="color:#007bff;text-align:center;">- - Coming Soon - -</h4>
                    <?php endif; ?>
                    <div class="row" style="margin: 0px;">
                        <?php foreach ($news_item_mall as $key => $val) : ?>
                            <div class="col-md-12 mb-2" style="padding: 0px;padding-top: 7px;">
                            <div class="row" style="margin: 0px;">
                                <div class="col-md-3" style="padding: 0px;padding-left: 5px;">
                                    <img src="<?= $val['img']; ?>" style="width: 100%;max-height:150px;" alt="<?= $val['title']; ?>">
                                </div>
                                <div class="col-md-9" style="display:flex;flex-wrap:wrap;padding: 0px;">
                                    <div class="row" style="margin: 0px; width: 100%;">
                                        <div class="col-md-12">
                                        <a href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                            <h5 class="" style="color:#000;text-align: left;">
                                            <?= $val['title']; ?>
                                            </h5>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 0px; width: 100%; margin-top:auto;align-items:baseline;">
                                        <div class="col-md-7" style="text-align:left;">
                                            <span style="color:#007bff;">
                                                <!-- <?= $val['category'].', '.$val['date']; ?> -->
                                                <?= $val['date']; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-5" style="text-align: right;">
                                            <small>
                                                <a style="color:#007bff;" href="<?= base_url('news/'.$val['url']); ?>" target="__BLANK">
                                                    MORE&nbsp;<i class="fas fa-arrow-right"></i>
                                                </a>
                                            </small> 
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            <?php if(count($news_item_mall)>1): ?>
                                <hr style="border:1px dashed #61551E;width:100%;max-width:100%;background-color:transparent;margin:2px;">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
