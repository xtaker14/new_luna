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
	        	<label for="username">username</label>
	            <input type="text" class="form-control" placeholder="username" name="username" id="username">
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
	            <input type="text" class="form-control" placeholder="umlah" name="jumlah" id="jumlah" minlength="1" maxlength="1000" value="1">
	        </div>
	        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('change','#type',function(){
		var val = $('option:selected',this).attr('value');
		if(val=='single'){
			$("#date_input").hide();
			$("#date_range").hide();
			$("#user_input").show();
		}else{
			$("#user_input").hide();
			$("#date_range").hide();
			$('#date_type').val("all");
			$('#date_type').change();
			$("#date_input").show();
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
    })

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
    })
})
</script>