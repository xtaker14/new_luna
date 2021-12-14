<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white"><h5><b>Edit Item Mall Piece</b></h5></div>
		<div class="card-body">
		<div class="form-group border my-3 p-2"> 
        	<label for="name"><b>Piece Search :</b></label>
            <input type="text" class="form-control form-control-lg" placeholder="search item and select" name="search_bin" id="search_bin" value="<?= $get_piece['bin_code']; ?>">
	    </div>
        <?php $this->load->helper("form"); ?>
        <form id="form_im_piece" method="POST" action="<?php print_r(site_url('adm/go_update_im_piece/'.$get_piece['id'])) ?>" enctype="multipart/form-data">
	        <div class="form-group"> 
	        	<label for="name">Piece name :</label>
	            <input type="text" class="form-control" placeholder="Item name" name="name" id="name" value="<?= $get_piece['name']; ?>">
	        </div>
	        <div class="form-group"> 
	        	<label for="item_source">Item source :</label>
	            <input type="text" class="form-control" placeholder="item source" name="item_source" id="item_source" value="<?= $get_piece['bin_code']; ?>">
	        </div>
	        <div class="form-group"> 
	        	<label for="item_opt">Item Option :</label>
	            <input type="text" class="form-control" placeholder="item effect options" name="item_opt" id="item_source" value="<?= $get_piece['piece_opt']; ?>">
	        </div>
			<div class="form-group">
				<label for="userfile" ><b>Image : </b></label>
				<input type="file" id="userfile" name="userfile"  />
                <div>
                    <br>
                    <img style="max-width:100%;" id="img_item" src="<?= base_url().$get_piece['img']; ?>" alt="- - No Image - -">
                    <br>
                </div>
			</div>
			<div class="form-group">
	        	<label for="item_source">Star price :</label>
	        	<div class="input-group">
	        		<div class="input-group-prepend">
			          <div class="input-group-text">
						<i class="fas fa-gem text-primary" data-fa-transform="rotate-30"></i>
			          </div>
			        </div>
				    <input type="text" class="form-control" placeholder="point" name="point" id="point" value="<?= $get_piece['price']; ?>">
			    </div>	 
	        </div>
			<input type="hidden" name="itemid" value="<?=$im_id;?>" />
	        <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
	</div>
</div>
<?php $this->load->view('admin/_main/new_im_piece/modal_search_bin.php'); ?>
<script type="text/javascript">
$(function() {
    document.getElementById("userfile").onchange = evt => {
        const [file] = document.getElementById("userfile").files;

        if (file) {
            document.getElementById("img_item").src = URL.createObjectURL(file);
        }
    }
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
    });
})
</script>