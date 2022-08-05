<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
$upload_path = "assets/frontpage/img/daily_checkin/items";
$title_page = 'New Check-In Item';
$input_id = '';
$input_is_active = '';
$input_name = '';
$input_bin_code = '';
$input_qty = '1'; 
$input_checkin_month = date('m');
$input_checkin_year = date('Y');
$input_img = '';
$input_description = '';
if(isset($get_checkin)){
    $title_page = 'Edit Check-In Item';
    $input_id = $get_checkin['id'];
    $input_is_active = $get_checkin['is_active'];
    $input_name = $get_checkin['name'];
    $input_bin_code = $get_checkin['bin_code'];
    $input_qty = $get_checkin['qty']; 
    $input_checkin_month = $get_checkin['checkin_month'];
    $input_checkin_year = $get_checkin['checkin_year'];
    $input_img = $get_checkin['img'];
    $input_description = $get_checkin['description'];
}
?>
<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white"><h5><b><?= $title_page; ?></b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>

        <form id="form_file_checkin_item" method="POST" action="<?php print_r(site_url('adm/save_checkin_item')) ?>" enctype="multipart/form-data">

            <input type="hidden" name="input_id" id="input_id" value="<?= $input_id; ?>">

            <div class="row">
                <div class="col-md-6 form-group"> 
                    <label for="input_is_active"><?= ucwords('Is Active?'); ?></label>
                    <input type="checkbox" id="input_is_active" name="input_is_active" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-times'></i> No" data-onstyle="success" data-offstyle="danger" data-size="xs" <?= $input_is_active == 'no' ? '' : (empty($input_is_active) ? 'checked' : 'checked'); ?>>
                </div>
            </div>
	        <div class="row">
                <div class="col-md-6 form-group"> 
                    <label for="input_name"><?= ucwords('Item Name'); ?></label>
                    <input type="text" class="form-control" placeholder="<?= ucwords('Item Name'); ?>" name="input_name" id="input_name" value="<?= $input_name; ?>" required>
                </div> 
                <div class="col-md-6 form-group"> 
                    <label for="input_bin_code"><?= ucwords('Item Source'); ?></label>
                    <input type="text" class="form-control" placeholder="<?= ucwords('Item Source'); ?>" name="input_bin_code" id="input_bin_code" value="<?= $input_bin_code; ?>" required readonly>
                </div> 
            </div> 
	        <div class="row">
                <div class="col-md-6 form-group"> 
                    <label for="input_qty"><?= ucwords('Item Qty'); ?></label>
                    <input type="text" class="form-control" placeholder="<?= ucwords('Item Qty'); ?>" name="input_qty" id="input_qty" value="<?= $input_qty; ?>" required>
                </div> 
                <div class="col-md-6 form-group"> 
                    <label for="input_checkin_day"><?= ucwords('Checkin Day'); ?></label>
                    <input type="text" class="form-control" placeholder="<?= ucwords('Checkin Day'); ?>" name="input_checkin_day" id="input_checkin_day" value="<?= $get_last_checkin_day; ?>" required>
                </div> 
            </div> 
            <div class="row">
                <div class="col-md-6 form-group"> 
                    <label for="input_checkin_month"><?= ucwords('Checkin Month'); ?></label>
                    <select class="form-control" name="input_checkin_month" id="input_checkin_month">
                        <?php foreach(getListMonth() as $key => $val): ?>
                            <option class="" value="<?= $key; ?>" <?= $key == $input_checkin_month ? 'selected' : ''; ?>>
                                <?= $val; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div> 
                <div class="col-md-6 form-group"> 
                    <label for="input_checkin_year"><?= ucwords('Checkin Year'); ?></label>
                    <input type="text" class="form-control" placeholder="<?= ucwords('Checkin Year'); ?>" name="input_checkin_year" id="input_checkin_year" value="<?= $input_checkin_year; ?>" required>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 form-group">  
                    <label for="input_img" >
                        <small style="color:red;">(Max 200x260 Pixel)</small><br>
                        <?= ucwords('Item Image'); ?>
                    </label>
                    <input class="form-control" type="file" id="input_img" name="input_img" <?= empty($input_img) ? 'required' : ''; ?> /> 
                </div> 
            </div> 
            <div class="row">
                <div class="col-md-12 form-group">
                    <img style="max-width:100%;" id="show_img" src="<?= base_url().$upload_path.'/'.$input_img; ?>" alt="- - No Image - -">
                </div> 
            </div> 
	        <div class="row">
                <div class="col-md-12 form-group"> 
                    <label for="input_description"><?= ucwords('Item Description'); ?></label>
                    <textarea type="text" class="summernote form-control" rows="6" placeholder="<?= ucwords('Item Description'); ?>" id="input_description" name="input_description"><?= $input_description; ?></textarea>
                </div> 
            </div>
            
	        <button type="submit" id="btn_save_web_config" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){ 
    document.getElementById("input_img").onchange = evt => {
        const [file] = document.getElementById("input_img").files;

        if (file) {
            document.getElementById("show_img").src = URL.createObjectURL(file);
        }
    }
    f_main.setInputFilter($("#input_qty, #input_checkin_day"), function(value) {
        return /^-?\d*$/.test(value); 
    });
    $("#input_name").autocomplete({
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
            $("#input_name").val(name);
            $("#input_bin_code").val(bin);
        },
        minLength: 2,
        delay: 100,
    });

	$('.summernote').summernote({height: 250}); 
}); 
</script>