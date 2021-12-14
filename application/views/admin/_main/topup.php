<?php
$list = '';
$arr = array(20 => '(20p) - Rp 10.000', 115 => '(115p) - Rp 50.000', 235 => '(235p) - Rp 100.000', 1200 => '(1200p) - Rp 500.000', 2500 => '(2500p) - Rp 1.000.000');
foreach ($arr as $key => $val) {
	$list .= '<option value="'.$key.'">'.$val.'</option>';
}
 ?>
<div class="col-md-10 offset-md-1">
	<div class="card mb-3">
		<div class="card-header bg-white"><h5><b>Send Point</b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="topup_form" method="POST" action="<?php print_r(site_url('adm/go_topup')) ?>">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group"> 
						<label for="username">
							Username 
						</label>
						<input type="text" class="form-control" placeholder="Username" name="username" id="username">
					</div>

					<div class="" style="margin-bottom:15px;">
						<label for="item_source">Type :</label>
						<div class="input-group"> 
							<select class="form-control" id="top_up_type" name="top_up_type" required>
								<option value="list">Point List</option>
								<option value="specific">Specific Point</option>
							</select>
						</div>	 
					</div>

					<div class="parent_list_point" style="margin-bottom:15px;">
						<label for="item_source">Diamond :</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i class="fas fa-gem text-primary" data-fa-transform="rotate-30"></i>
								</div>
							</div>
							<select class="form-control" id="point" name="point" required>
								<?= $list ?>
							</select>
						</div>	 
					</div>

					<div class="parent_specific_point" style="margin-bottom:15px; display:none;"> 
						<label for="item_source">Specific:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i class="fas fa-gem text-primary" data-fa-transform="rotate-30"></i>
								</div>
							</div>
							<input type="text" class="form-control" placeholder="Point" name="costume_point" id="costume_point">
						</div>
					</div>

				</div>
				<div class="col-md-6"> 
					<table class="table" id="res_new_username">
						<thead>
							<tr>
								<th colspan="2">
									List Multiple Username&nbsp;
									<button id="btn_add_username" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
								</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>  
				</div> 
				<div class="col-md-12" style="margin-bottom:15px;">
					<label for="item_source">Catatan (Optional) :</label>
					<div class="input-group"> 
						<textarea name="description" rows="4" class="form-control"></textarea> 
					</div>	 
				</div> 
				<div class="col-md-12">
					<input type="hidden" name="<?=$xepo_secure['name'];?>" value="<?=$xepo_secure['hash'];?>" />
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div> 
        </form>
      </div>
	</div>
</div>
<script type="text/javascript">
function addEventNewUsername(){
	$(".btn_remove_username").off('click');
	$(".btn_remove_username").click(function(){
		$(this).parents('tr').remove();
	});

	if ($(".input_new_username").hasClass('ui-autocomplete')) {
		$(".input_new_username").autocomplete("destroy");
	}
	$(".input_new_username").autocomplete({
	    source: function (request, response) {
            $.ajax({
                url: baseURL+"adm/usr_search/",
                method: "POST",
                data: {
                	username: request.term,                	
                },
                success: function(data) {
		            response($.map(data, function (value, key) {
		                return {
		                    label: value.id_loginid,
		                    value: value.id_loginid,
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
}
$(document).ready(function(){
	$("#btn_add_username").click(function(){
		let res_new_username = $("#res_new_username tbody");
		res_new_username.append(`
			<tr>
				<td style="width:100%;"><input type="text" class="form-control input_new_username" placeholder="Username" name="new_username[]"></td>
				<td style=""><button type="button" class="btn_remove_username btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
			</tr>
		`);
		addEventNewUsername();
	});
	$("#top_up_type").change(function(){
		let t = $(this);
		let parent_list_point = $(".parent_list_point");
		let parent_specific_point = $(".parent_specific_point");

		if(t.val() == 'list'){
			parent_specific_point.hide();
			parent_specific_point.find('#costume_point').val('');
			parent_list_point.find('#point').find('option').eq(0).prop('selected',true);
			parent_list_point.find('#point').find('option').eq(0).attr('selected',true);
			parent_list_point.show();
		}else{
			parent_list_point.hide();
			parent_specific_point.find('#costume_point').val('');
			parent_list_point.find('#point').find('option').eq(0).prop('selected',true);
			parent_list_point.find('#point').find('option').eq(0).attr('selected',true);
			parent_specific_point.show();
		}
	});
	$('#point').change(function(){
		$("#costume_point").val('');  
	})
	$("#username").autocomplete({
	    source: function (request, response) {
            $.ajax({
                url: baseURL+"adm/usr_search/",
                method: "POST",
                data: {
                	username: request.term,                	
                },
                success: function(data) {
		            response($.map(data, function (value, key) {
		                return {
		                    label: value.id_loginid,
		                    value: value.id_loginid,
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
    })
})
</script>