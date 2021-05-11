<?php 
$list = '';
foreach ($news as $key => $val) {
  if($key>0){
    $list .='
    <div class="col-sm-4 mb-2">
      <div class="card rounded shadow-sm text-center py-3" style="height: 300px;">
      <a href="'.base_url('news/'.$val['url']).'">
        <img class="mini-notice rounded-circle" src="'.CDN_IMG.'assets/frontpage/img/notice/news-thumb.png" alt="'.$val['title'].'" style="margin:auto;">
      </a>
        <div class="card-body" style="max-height: 150px;">
          <a href="'.base_url('news/'.$val['url']).'"><h5 class="card-title text-danger">'.$val['title'].'</h5></a>
          <p class="card-text">'.$val['category'].', '.$val['date'].'</p>
        </div>
      </div>
    </div>
    ';
  }
}

 ?>
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
  </div>

</div>  

<div data-aos="fade-left" data-aos-delay="300" class="form-row">
  <?= $list ?>
</div>

