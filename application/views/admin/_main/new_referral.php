<?php
    $id = '';
    $is_deleted = '';
    $referral_code = '';
    $username = '';
    $silver_point = '0';
    if(!empty($get_referral)){
        $id = $get_referral['referral_code'];
        $is_deleted = $get_referral['is_deleted'];
        $referral_code = $get_referral['referral_code'];
        $username = $get_referral['username'];
        $silver_point = $get_referral['silver_point'];
    }
?>
<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white"><h5><b>
            <?= empty($id) ? 'New Refferal Code' : 'Edit Refferal Code'; ?>
        </b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="form_im" method="POST" action="<?php print_r(site_url('adm/go_make_refferal_code')) ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
	        <div class="form-group d-flex"> 
	        	<label class="mx-2 my-auto"><b>Active? </b></label>
	            <input type="checkbox" id="is_deleted" <?= $is_deleted == 'no' ? 'checked' : (empty($is_deleted) ? 'checked' : '') ; ?> name="is_deleted" data-toggle="toggle" data-on="<i class='fa fa-check'></i> On" data-off="<i class='fa fa-times'></i> Off" data-onstyle="success" data-offstyle="danger" data-size="xs">
	        </div>
	        <div class="form-group m-1"> 
	            <input type="text" class="form-control" placeholder="Referral Code" value="<?= $referral_code; ?>" name="referral_code" id="referral_code">
                <label for="referral_code">
                    <small><span style="color:red;">*</span> Referral code yang ada pada list tidak bisa di pakai lagi</small>
                </label>
	        </div>
	        <div class="form-row border m-1 p-2 pb-3 mb-4">
	        	<div class="col-md-6 my-2">
	                <input <?= !empty($id) ? 'readonly' : ''; ?> type="text" class="form-control" placeholder="Username" value="<?= $username; ?>" name="username" id="username">
                    <label for="username">
                        <small><span style="color:red;">*</span> Jika username yang anda cari tidak tertera dalam list yang di keluarkan maka kemungkinan username tersebut sudah mempunyai referral code</small>
                    </label>
		        </div> 
	        	<div class="col-md-6 my-2">
	                <input type="text" class="form-control" placeholder="Silver Point" value="<?= $silver_point; ?>" name="silver_point" id="silver_point">
                    <label for="silver_point">
                        <small><span style="color:red;">*</span> Defult Silver Point adalah 0</small>
                    </label>
		        </div> 
	        </div>
			 
	        <div class="form-group m-1"> 
                <button type="submit" class="btn btn-primary">Submit</button>
	        </div>
        </form>
      </div>
	</div>
</div>
<!-- <textarea type="text" class="summernote form-control required" rows="6" placeholder="item set option" id="set_option" name="set_option"></textarea> -->

<script type="text/javascript">
$(document).ready(function(){
	// $('.summernote').summernote({height: 250});
    $("#referral_code").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: baseURL+"adm/referral_code_search/",
                method: "POST",
                data: {
                	text: request.term,                	
                },
                success: function(data) {
		            response($.map(data, function (value, key) {
		                return {
		                    label: value.referral_code,
		                    value: value.referral_code,
		                };
		            }));
                }
            })
        },
        select: function(event, ui) {
            return false;
            // var value = ui.item.value;
            // console.log(value);
        },
        minLength: 2,
        delay: 100,
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li style='color:red;'></li>")
            .data("item.autocomplete", item)
            .append("<i style='top: 1px;padding:0;' class='far fa-window-close'></i> " + item.label)
            .appendTo(ul);
    };

    $("#username").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: baseURL+"adm/username_search/",
                method: "POST",
                data: {
                	text: request.term,                	
                },
                success: function(data) {
		            response($.map(data, function (value, key) {
		                return {
		                    label: value.username,
		                    value: value.username,
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

    f_main.setInputFilter($("input#silver_point"), function(value) {
        return /^\d*$/.test(value); 
    });
    console.clear();
})
</script>