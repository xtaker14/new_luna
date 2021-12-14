<?php
    $input_id = '';
    $input_currency = ''; 
    $input_value = ''; 
    $input_price = '';
    $input_description = '';
    $input_is_hidden = '';
    $input_items = '';
    
    if(!empty($get_dp)){
        $input_id = $get_dp['id'];
        $input_currency = $get_dp['currency']; 
        $input_value = $get_dp['value'];
        $input_items = json_decode($get_dp['items'], true);
        $input_price = $get_dp['price'];
        $input_description = $get_dp['description'];
        $input_is_hidden = $get_dp['is_hidden']; 
    }
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white">
            <h5><b><?= empty($input_id) ? 'New Donate Price' : 'Edit Donate Price'; ?></b></h5>
        </div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="form_donate_price" method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="input_id" value="<?= $input_id; ?>">
            <div class="form-group d-flex"> 
	        	<label class="mr-2"><b>Is Hidden? </b></label>
	            <input type="checkbox" id="is_hidden" <?= $input_is_hidden == 'no' ? '' : (empty($input_is_hidden) ? '' : 'checked'); ?> name="is_hidden" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-times'></i> No" data-onstyle="success" data-offstyle="danger" data-size="xs">
	        </div>

	        <div class="form-group"> 
	        	<label for="content">Point: </label>
	            <input type="text" class="form-control" placeholder="Input Point" name="input_value" id="input_value" value="<?= $input_value; ?>" required>
	        </div>

	        <div class="form-group"> 
	        	<label for="content">Price: </label>
	            <input type="text" class="form-control" placeholder="Input Price" name="input_price" id="input_price" value="<?= $input_price; ?>" required>
	        </div>

	        <div class="form-group"> 
	        	<label for="content">Description: </label>
	            <textarea name="input_description" id="input_description" rows="3" class="form-control" placeholder="Input Description"><?= $input_description; ?></textarea>
	        </div>

	        <div class="form-group"> 
	        	<label for="input_currency">Currency: </label>
				<select required class="form-control mt-2" id="input_currency" name="input_currency" required>
					<option <?= $input_currency === 'IDR' ? 'selected' : ''; ?> value="IDR">IDR</option>
					<option <?= $input_currency === 'USD' ? 'selected' : ''; ?> value="USD">USD</option>
				</select>
	        </div>
            
            <div class="form-group"> 
                <div class="form-group">
                    <table id="table_new_items" class="table table-bordered" style="margin-top: 10px;">
                        <thead>
                            <tr>
                                <th colspan="4" style="color:red;">
                                    New Items
                                </th>
                            </tr>
                            <tr>
                                <th><?= ucwords('Item Name'); ?></th>
                                <th><?= ucwords('Qty'); ?></th> 
                                <th><?= ucwords('Item Source'); ?></th> 
                                <th style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder="Search item and select" id="input_items_name" value="">
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="" id="input_items_qty" value="0">
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="" id="input_items_source" value="" readonly>
                                </td> 
                                <td>
                                    <button class="btn btn-outline-primary" type="button" id="btn_add_new_items">Add</button>
                                </td>
                            </tr>
                        </tbody>

                        <tbody class="res_new_items">
                            <?php if(!empty($input_items)): ?>
                            <?php foreach($input_items as $key => $val): ?>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control input_items_name" name="input_items_name[]" value="<?= $val['items_name']; ?>" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control input_items_qty" name="input_items_qty[]" value="<?= $val['items_qty']; ?>" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control input_items_source" name="input_items_source[]" value="<?= $val['items_source']; ?>" readonly>
                                    </td> 
                                    <td>
                                        <button class="btn btn-outline-danger btn_remove_items" type="button"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table> 
                </div>
            </div>
        </form>
	    <button type="button" id="save_donate_price" class="btn btn-primary">Submit</button>
      </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    let id = "<?= empty($input_id) ? '0' : $input_id; ?>";
	// $('.summernote').summernote({height: 250});
    removeItems();

    $("#save_donate_price").click(function(ev){
        let res_tr = $("#table_new_items tbody.res_new_items tr");
        let ar_json = [];
        let t_form = $("#form_donate_price");
        let post_data = f_main.objectifyForm(t_form.serializeArray());
        delete post_data['input_items_name[]'];
        delete post_data['input_items_qty[]'];
        delete post_data['input_items_source[]'];

        if(post_data['is_hidden'] == undefined){
            post_data['is_hidden'] = '';
        } 

        if(res_tr.length>0){
            $.each(res_tr, function(idx,key){
                let t = $(this);
                let input_items_name = t.find(".input_items_name").val().trim();
                let input_items_qty = t.find(".input_items_qty").val().trim();
                let input_items_source = t.find(".input_items_source").val().trim();

                ar_json[idx] = {
                    'items_name' : input_items_name,
                    'items_qty' : input_items_qty,
                    'items_source' : input_items_source,
                };
            }); 
            ar_json = Object.assign({}, ar_json); 
        }
        if(Object.keys(ar_json).length > 0){
            ar_json = JSON.stringify(ar_json);
        }else{
            ar_json = '';
        }  
        
        $.ajax({
            url: baseURL+"adm/go_make_donate_price", 
            method: "POST",
            data: {
                post_data : post_data,
                res_all_items : ar_json
            },
            success: function(data) { 
                if(data.result !== true){
                    swal("Warning",
                        data.result,
                        "warning",
                    {
                        buttons: { 
                            button_1: "OK", 
                        },
                    })
                    .then((value) => {
                        switch (value) {
                            default:
                                break;
                            }
                    });
                    return false;
                } else {
                    swal("Successfully",
                        "Saved",
                        "success",
                    {
                        buttons: { 
                            button_1: "OK", 
                        },
                    })
                    .then((value) => {
                        switch (value) {
                            default:
                                f_main.urlPlus('adm/new_donate_price');
                                break;
                            }
                    });
                } 
            }
        });

    });

    $("#btn_add_new_items").click(function(){
        let res = $("#table_new_items tbody.res_new_items");
        let input_items_name = $("#input_items_name").val().trim();
        let input_items_qty = $("#input_items_qty").val().trim();
        let input_items_source = $("#input_items_source").val().trim();

        if(input_items_name.length == 0){
            alert('Items Name cannot be empty');
            return false;
        }
        if(input_items_qty.length == 0){
            alert('Items Qty cannot be empty');
            return false;
        }
        if(input_items_source.length == 0){
            alert('Items Source cannot be empty');
            return false;
        }

        res.append(`
            <tr>
                <td>
                    <input type="text" class="form-control input_items_name" name="input_items_name[]" value="${input_items_name}" readonly>
                </td>
                <td>
                    <input type="text" class="form-control input_items_qty" name="input_items_qty[]" value="${input_items_qty}" readonly>
                </td>
                <td>
                    <input type="text" class="form-control input_items_source" name="input_items_source[]" value="${input_items_source}" readonly>
                </td> 
                <td>
                    <button class="btn btn-outline-danger btn_remove_items" type="button"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        `);
        $("#input_items_name").val('');
        $("#input_items_qty").val('0');
        $("#input_items_source").val('');
        removeItems();

    });
    $("#input_items_name").autocomplete({
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
		                    value: value.nama,
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
            $("#input_items_name").val(name);
            $("#input_items_source").val(bin);
        },
        minLength: 2,
        delay: 100,
    });

    function removeItems(){
        $(".btn_remove_items").off('click');
        $(".btn_remove_items").click(function(){
            let t = $(this);
            t.parents('tr').remove();
        });
    }
});
</script> 