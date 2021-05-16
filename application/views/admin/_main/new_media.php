<?php
    $id = '';
    $name = '';
    $type = '';
    $no_order = '0';
    $is_hidden = '';
    $img = '';
    if(!empty($get_media)){
        $id = $get_media['id'];
        $name = $get_media['name'];
        $type = $get_media['type'];
        $no_order = $get_media['no_order'];
        $is_hidden = $get_media['is_hidden'];
        $img = $get_media['img'];
    }
?>
<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white">
            <h5><b><?= empty($id) ? 'New Media' : 'Edit Media'; ?></b></h5>
        </div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="form_media" method="POST" action="<?php print_r(site_url('adm/go_make_media')) ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="form-group d-flex"> 
	        	<label class="mr-2"><b>Is Hidden? </b></label>
	            <input type="checkbox" id="is_hidden" <?= $is_hidden == 'no' ? '' : (empty($is_hidden) ? '' : 'checked'); ?> name="is_hidden" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-times'></i> No" data-onstyle="success" data-offstyle="danger" data-size="xs">
	        </div>

	        <div class="form-group"> 
	        	<label for="input_type">Type: </label>
				<select class="form-control mt-2" id="input_type" name="input_type" required>
					<option <?= $type === 'ss' ? 'selected' : ''; ?> value="ss">Screen Shoot</option>
					<option <?= $type === 'wallpaper' ? 'selected' : ''; ?> value="wallpaper">Wallpaper</option>
				</select>
	        </div>

	        <div class="form-group"> 
	        	<label for="content" >Title: </label>
	            <input type="text" class="form-control" placeholder="Media title" name="input_title" id="input_title" value="<?= $name; ?>">
	        </div>

	        <div class="form-group"> 
	        	<label for="content" >Number Order: </label>
	            <input type="number" class="form-control" placeholder="Number Order" name="input_order" id="input_order" value="<?= $no_order; ?>">
	        </div>
	        
	        <div class="form-group">
				<label for="input_image" >Image : </label>
				<input accept="image/*" type="file" id="input_image" name="input_image" onchange="document.getElementById('preview_img').src = window.URL.createObjectURL(this.files[0])"/>
                <hr>
                <img id="preview_img" style="width: 100%;" src="<?= !empty($get_media) ? base_url().'assets/frontpage/img/media/'.$img : ''; ?>" alt="-- Preview Image --">
			</div>
			<!-- <div class="form-group">
				<label for="content" >Content: </label>
				<textarea type="text" class="summernote form-control required" rows="6" placeholder="content" id="content" name="content"></textarea>
			</div> -->
	        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    let id = "<?= empty($id) ? '0' : $id; ?>";
	// $('.summernote').summernote({height: 250});
    $("#input_type").change(function(){
        let t = $(this);
        if(id == 0){
            $.ajax({
                url: baseURL+"adm/get_media_last_no_order",
                method: "POST",
                data: {
                    type: t.val().trim(),                	
                },
                success: function(data) {
                    $("#input_order").val(parseInt(data.no_order)+1);
                }
            });
        }
    }).change();
});
</script>