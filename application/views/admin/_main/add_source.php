<div class="col-md-12">
	<div class="card">
		<div class="card-header bg-white"><h5><b>Add Item source</b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="form_im" method="POST" action="<?php print_r(site_url('adm/go_add_source')) ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label for="description" ><b>Item SOurce: </b></label>
				<textarea type="text" class="form-control required" rows="10" placeholder="source text" id="source" name="source"></textarea>
			</div>
	        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>