<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white"><h5><b>Edit Article</b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="form_article" method="POST" action="<?php print_r(site_url('adm/go_edit_article')) ?>" enctype="multipart/form-data">
	        <div class="form-group"> 
	        	<label for="content" >Title: </label>
	            <input type="text" class="form-control" placeholder="Article title" name="title" id="title" value="<?= $article['title'] ?>">
	        </div>
			<div class="form-group">
				<label for="content" >Content: </label>
				<textarea type="text" class="summernote form-control required" rows="6" placeholder="content" id="content" name="content"><?= $article['content'] ?></textarea>
			</div>
			<input type="hidden" name="article_id" value="<?= $this->uri->segment(3); ?>">
	        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.summernote').summernote({height: 400});
})
</script>