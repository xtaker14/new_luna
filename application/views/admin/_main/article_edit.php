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
				<label for="userfile" >Image : </label>
				<input type="file" id="userfile" name="userfile" />
				<div>
                    <br>
                    <img style="max-width:100%;" id="img_item" src="<?= base_url().$article['img']; ?>" alt="- - No Image - -">
                    <br>
                </div>
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

<style>
	.note-editable { background-color: #2a88ed !important; }
</style>
<script type="text/javascript">
document.getElementById("userfile").onchange = evt => {
	const [file] = document.getElementById("userfile").files;

	if (file) {
		document.getElementById("img_item").src = URL.createObjectURL(file);
	}
}
$(document).ready(function(){
	$('.summernote').summernote({height: 400});
	// $('.summernote').summernote('foreColor', 'rgb(221, 134, 4)');
});
</script>