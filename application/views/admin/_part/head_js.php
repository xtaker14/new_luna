<script type="text/javascript" src="<?= base_url('assets/admin/js/jquery-3.3.1.min.js'); ?>"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script> -->
<script type="text/javascript">
    var baseURL = "<?php print_r(base_url()) ?>";
    $(document).ready(function(){
	    if ( window.innerWidth < 768) {     
		  $("#page-w").removeClass("toggled");
		} 
	});
</script>
