<?php
	$this->load->view("app/_main/_home/h_banner.php");
	if(!empty($news)){
		$this->load->view("app/_main/_home/h_notice.php");
	}
	$this->load->view("app/_main/_home/h_race.php");
?>	

<script type="text/javascript">
$(document).ready(function(){
	$('html').removeClass('no-js');
	$.getJSON(baseURL+"api/homepage", function(r){
		$("#srv_status .p_online").html(r.srv.p_online);
		$("#srv_status .account_reg").html(r.srv.account_reg);
		$("#srv_status .char_count").html(r.srv.char_count);
		$.each(r.rank, function (key, val) {
			var no = key+1;
	        $("#side_rank").append(
				'<tr><td>'+no+
				'</td><td>'+val.a+
				'</td><td>'+val.b+
				// '</td><td>'+val.k+
				'</td></tr>'
			);
	    });
	});
})
</script>