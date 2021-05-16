<?php
	$this->load->view("app/_main/_home/h_banner.php");
	if(!empty($news)){
		$this->load->view("app/_main/_home/h_notice.php");
	}
	$this->load->view("app/_main/_home/h_race.php");

	$this->load->view("app/_main/_home/h_gallery.php");
?>	
