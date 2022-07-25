<?php
	$this->load->view("app/_main/_home/h_banner.php");
	if(!empty($news)){
		$this->load->view("app/_main/_home/h_notice.php");
	}
	// $this->load->view("app/_main/_home/h_race.php");
	// $this->load->view("app/_main/_home/h_gallery.php");
?>	

<?php if($php_name =='homepage'): ?>
	<!-- <div class="row">
		<div class="col-md-12 parent_left_homepage_mobile" style="display: none;">
			<?php //$this->load->view("app/_part/_sidebar/rank.php"); ?>
		</div>
	</div> -->
<?php endif; ?>	
