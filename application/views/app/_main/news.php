<div class="card">
	  <div class="d-md-flex p-8">
	    <img class="float-left mr-2" src="<?= base_url('assets/frontpage/img/notice/news-thumb.png') ?>" style="width: 60px;height: 60px;">      
	    <div class="d-block">
	      <h3 class="text-warning border-bottom"><?= $data['title'] ?></h3>
	      <small><i><?= $data['category'] ?>, <?= $data['date'] ?></i></small>
	    </div>
	  </div>
	 <img class="card-img mb-2" src="<?= base_url($data['img']) ?>">
	<div class="card-body">
		<?= $data['content'] ?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('html').removeClass('no-js');
})
</script>