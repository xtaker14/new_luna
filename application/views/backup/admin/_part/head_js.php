<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    var baseURL = "<?php print_r(base_url()) ?>";
    $(document).ready(function(){
	    if ( window.innerWidth < 768) {     
		  $("#page-w").removeClass("toggled");
		} 
	});
</script>
