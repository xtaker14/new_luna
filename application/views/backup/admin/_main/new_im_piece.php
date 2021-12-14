<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white"><h5><b>New Item Mall Piece</b></h5></div>
		<div class="card-body">
		<div class="form-group border my-3 p-2"> 
        	<label for="name"><b>Piece Search :</b></label>
            <input type="text" class="form-control form-control-lg" placeholder="search item and select" name="search_bin" id="search_bin">
	    </div>
        <?php $this->load->helper("form"); ?>
        <form id="form_im_piece" method="POST" action="<?php print_r(site_url('adm/go_make_im_piece')) ?>" enctype="multipart/form-data">
	        <div class="form-group"> 
	        	<label for="name">Piece name :</label>
	            <input type="text" class="form-control" placeholder="Item name" name="name" id="name">
	        </div>
	        <div class="form-group"> 
	        	<label for="item_source">Item source :</label>
	            <input type="text" class="form-control" placeholder="item source" name="item_source" id="item_source">
	        </div>
	        <div class="form-group"> 
	        	<label for="item_opt">Item Option :</label>
	            <input type="text" class="form-control" placeholder="item effect options" name="item_opt" id="item_source">
	        </div>
			<div class="form-group">
				<label for="userfile" ><b>Image : </b></label>
				<input type="file" id="userfile" name="userfile" required />
			</div>
			<div class="form-group">
	        	<label for="item_source">Star price :</label>
	        	<div class="input-group">
	        		<div class="input-group-prepend">
			          <div class="input-group-text">
						<i class="fas fa-gem text-primary" data-fa-transform="rotate-30"></i>
			          </div>
			        </div>
				    <input type="text" class="form-control" placeholder="point" name="point" id="point">
			    </div>	 
	        </div>
			<input type="hidden" name="itemid" value="<?=$im_id;?>" />
	        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>
<?php $this->load->view('admin/_main/new_im_piece/modal_search_bin.php'); ?>
<script type="text/javascript">
$(function() {
	$("#search_bin").autocomplete({
	    source: function (request, response) {
            $.ajax({
                url: baseURL+"adm/bin_search/",
                method: "POST",
                data: {
                	text: request.term,                	
                },
                success: function(data) {
		            response($.map(data, function (value, key) {
		                return {
		                    label: value.bin_source+' - '+value.nama,
		                    value: value.bin_source+' - '+value.nama,
		                    name: value.nama,
		                    bin: value.bin_source,

		                };
		            }));
                }
            })
	    },
        select: function(event, ui) {
            var name = ui.item.name;
            var bin = ui.item.bin;
            $("#name").val(name);
            $("#item_source").val(bin);
        },
        minLength: 2,
        delay: 100,
    })
})
</script>