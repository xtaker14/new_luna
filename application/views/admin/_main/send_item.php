<div class="col-md-10 offset-md-1">
	<div class="card mb-3">
		<div class="card-header bg-white"><h5><b>Send item</b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="send_item" method="POST" action="<?php print_r(site_url('adm/go_send_item')) ?>">
        	<div class="form-group">
				<label for="b">Item for :</label>
				<select class="form-control form-control-lg" id="type" name="type" required>
        			<option value="single">Single User</option>
        			<option value="all">ALL Users</option>
				</select>
			</div>
        	<div id="user_input" class="form-group"> 
	        	<label for="username">
					Username&nbsp;
					<button id="btn_add_username" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
				</label>
	            <input type="text" class="form-control" placeholder="Username" name="username" id="username">
				<table style="width: 100%;" id="res_new_username"></table>
	        </div>
	        <div id="parent_select_level" class="form-group" style="display: none;"> 
	        	<label for="select_level">Level Type :</label>
				<select class="form-control" id="select_level" name="select_level" required>
        			<option value="all">All Levels</option>
        			<option value="specific">Specific Level</option>
				</select>
	        </div>
	        <div id="parent_input_lvl" class="form-group" style="display: none;"> 
	        	<label for="input_lvl">Level</label>
				<input type="text" class="form-control" placeholder="Input Level" value="" name="input_lvl" id="input_lvl">
	        </div>
	        <div id="date_input" class="form-group" style="display: none;"> 
	        	<label for="date_type">Register Date :</label>
				<select class="form-control" id="date_type" name="date_type" required>
        			<option value="all">All Time</option>
        			<option value="range">Date range</option>
				</select>
	        </div>
	        <div id="date_range" class="form-group" style="display: none;"> 
	        	<label for="item_source">Register Date :</label>
	            <input type="text" class="form-control" placeholder="Item source" name="reg_date" id="reg_date">
	        </div>
	        <div class="form-group"> 
	        	<label for="item_source">Item :</label>
	            <input type="text" class="item_source form-control" placeholder="Item source" name="item_source" id="item_source">
	        </div>
	        <div class="form-group"> 
	        	<label for="item_source">Jumlah :</label>
	            <input type="text" class="form-control" placeholder="Jumlah" name="jumlah" id="jumlah" minlength="1" maxlength="1000" value="1">
	        </div>
	        <div class="form-group"> 
	        	<label for="item_source">Catatan (Optional) :</label>
	            <textarea name="description" rows="4" class="form-control"></textarea>
	        </div>
	        <button type="submit" class="btn btn-primary">Submit</button>
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
		let res_new_username = $("#res_new_username");
		res_new_username.append(`
			<tr>
				<td style="width:100%;"><input type="text" class="form-control input_new_username" placeholder="Username" name="new_username[]"></td>
				<td style=""><button type="button" class="btn_remove_username btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
			</tr>
		`);
		addEventNewUsername();
	});

	$(document).on('change','#type',function(){
		var val = $('option:selected',this).attr('value');
		if(val=='single'){
			$("#date_input").hide();
			$("#date_range").hide();
			$("#parent_input_lvl").hide();
			$("#parent_select_level").hide();
			$("#user_input").show();
			$("#res_new_username").empty();
		}else{
			$("#user_input").hide();
			$("#res_new_username").empty();
			$("#date_range").hide();
			$('#date_type').val("all");
			$('#date_type').change();
			$("#date_input").show();

			$('#select_level').val("all");
			$('#select_level').change();
			$("#parent_select_level").show();
		}
	});

	$(document).on('change','#select_level',function(){
		var val = $('option:selected',this).attr('value');
		if(val=='specific'){
			$('#input_lvl').val(120); 
			$("#parent_input_lvl").show();
		}else{
			$("#parent_input_lvl").hide();
			$('#input_lvl').val(''); 
		}
	});

	$(document).on('change','#date_type',function(){
		var val = $('option:selected',this).attr('value');
		if(val=='all'){
			$("#date_range").hide();
		}else{
			$("#date_range").show();
		}
	})

	$('#reg_date').daterangepicker({
	  "locale": {
	        "format": "YYYY-MM-DD",
	        "separator": " to ",
	    },
	    "minYear": 2019,
	    "maxYear": 2025,
	    "timePicker24Hour": true,
	    "autoApply": true,
	    ranges: {
	        'Today': [moment(), moment()],
	        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	        'This Month': [moment().startOf('month'), moment().endOf('month')],
	        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	    },
	    "startDate": moment().subtract(7, 'days'),
	    "endDate": moment(),
	    "drops": "up"
	}, function(start, end, label) {
	  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
	});

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
    });

    $(".item_source").autocomplete({
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
		                    value: value.bin_source+' | '+value.nama,
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
})
</script>