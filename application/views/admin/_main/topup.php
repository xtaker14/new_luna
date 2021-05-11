<?php
$list = '';
$arr = array(20 => '(20p) - Rp 10.000', 115 => '(115p) - Rp 50.000', 235 => '(235p) - Rp 100.000', 1200 => '(1200p) - Rp 500.000', 2500 => '(2500p) - Rp 1.000.000');
foreach ($arr as $key => $val) {
	$list .= '<option value="'.$key.'">'.$val.'</option>';
}
 ?>
<div class="col-md-10 offset-md-1">
	<div class="card mb-3">
		<div class="card-header bg-white"><h5><b>Top-UP / DONATION</b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="topup_form" method="POST" action="<?php print_r(site_url('adm/go_topup')) ?>">
        	 <div class="form-group"> 
	        	<label for="username">username</label>
	            <input type="text" class="form-control col-md-4" placeholder="username" name="username" id="username">
	        </div>
	        <div class="form-row mb-3">
		        <div class="col-md-6">
		        	<label for="item_source">Star point :</label>
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
		        <div class="col-md-6"> 
		        	<label for="item_source">Costume:</label>
		        	<div class="input-group">
		        		<div class="input-group-prepend">
				          <div class="input-group-text">
							<i class="fas fa-gem text-primary" data-fa-transform="rotate-30"></i>
				          </div>
				        </div>
				        <input type="text" class="form-control" placeholder="point" name="costume_point" id="costume_point">
				    </div>
		        </div>
	        </div>
	        <input type="hidden" name="<?=$xepo_secure['name'];?>" value="<?=$xepo_secure['hash'];?>" />
	        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('change','#point',function(){
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