<script src="<?php print_r(site_url('assets/lib/jquery-ui/jquery-ui.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/popper/popper.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/bs4/js/bootstrap.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/jquery-validation/dist/jquery.validate.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/datatables/responsive-2.2.2/js/dataTables.responsive.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/datatables/responsive-2.2.2/js/responsive.bootstrap4.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/bootstrap-select/dist/js/bootstrap-select.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/croppie/croppie.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/exif-js-2.3.0/exif.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/jquery-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/summernote-0.8.11-dist/dist/summernote-bs4.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/lib/clipboard/clipboard.min.js')) ?>"></script>
<script src="<?php print_r(site_url('assets/js/main.js')) ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','#fb_login',function(){
		fb_login = "<?php print_r(htmlspecialchars($loginURL)) ?>";
		window.location.href = fb_login;
	})
})
</script>
