<?php
$cat_list = '';
foreach ($category as $val) {
	$cat_list .= '<option value="'.$val['id'].'">'.$val['categoryname'].'</option>';
}
 ?>
<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white"><h5><b>New Item Mall</b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="form_im" method="POST" action="<?php print_r(site_url('adm/go_make_im')) ?>" enctype="multipart/form-data">
	        <div class="form-group d-flex"> 
	        	<label class="mx-2 my-auto"><b>Status: </b></label>
	            <input type="checkbox" id="status" name="status" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Publish" data-off="<i class='fa fa-times'></i> Draft" data-onstyle="success" data-offstyle="danger" data-size="xs">
	        </div>
	        <div class="form-group"> 
	            <input type="text" class="form-control" placeholder="Item title" name="title" id="title">
	        </div>
	        <div class="form-row border m-1 p-2 pb-3 mb-4">
	        	<div class="col-md-6 my-2"> 
		        	<label for="itemtype" class="mx-2 my-auto"><b>category: </b></label>
					<select class="form-control mt-2" id="itemtype" name="itemtype" required>
						<?= $cat_list ?>
					</select>
		        </div>
	        	<div class="col-md-12 my-2"> 
					<label class="mx-2 my-auto" for="discount" ><b>Discount: </b></label>
	            	<input type="checkbox" id="discount" name="discount" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-times'></i> No" data-onstyle="success" data-offstyle="danger" data-size="xs" checked>
		        </div>
		        <div class="col-md-12 my-2"> 
					<label class="mx-2 my-auto" for="seal" ><b>Item Seal: </b></label>
	            	<input type="checkbox" id="seal" name="seal" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-times'></i> No" data-onstyle="success" data-offstyle="danger" data-size="xs">
		        </div>

		        <div class="col-md-12 my-2"> 
					<label class="mx-2 my-auto" for="set" ><b>Item set: </b></label>
	            	<input type="checkbox" id="set" name="set" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-times'></i> No" data-onstyle="success" data-offstyle="danger" data-size="xs">
		        </div>
	        </div>
			<div class="form-group">
				<label for="userfile" ><b>Image : </b></label>
				<input type="file" id="userfile" name="userfile" required/>
			</div>
			<div class="form-group">
				<label for="description" ><b>Item Description: </b></label>
				<textarea type="text" class="summernote form-control required" rows="6" placeholder="description" id="description" name="description"></textarea>
			</div>
			<div class="form-group">
				<label for="set_option" ><b>Set options: </b></label>
				<textarea type="text" class="summernote form-control required" rows="6" placeholder="item set option" id="set_option" name="set_option"></textarea>
			</div>
	        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#title").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: baseURL+"adm/bin_search/",
                method: "POST",
                data: {
                	text: request.term,                	
                },
                success: function(data) {
		            response($.map(data, function (value, key) {
		                return {
		                    label: value.nama,
		                    value: value.nama,
		                };
		            }));
                }
            })
        },
        select: function(event, ui) {
            var value = ui.item.value;
            console.log(value);
        },
        minLength: 2,
        delay: 100,
    });
	$('.summernote').summernote({height: 250});
})
</script>