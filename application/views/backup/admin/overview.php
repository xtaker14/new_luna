<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_part/head.php") ?>
	<?php $this->load->view("admin/_part/css.php") ?>
	<?php $this->load->view("admin/_part/head_js.php") ?>
<style type="text/css">
html{height:100%;margin:0}body{display:flex;flex-direction:column;width:100%;min-height:100vh;background-color:#f3f3f3}main{flex-grow:1;width:100%;padding:0;min-height:50vh}p{margin:0;padding:0}
</style>
</head>
<body>
	<?php $this->load->view("admin/_part/navbar.php") ?>
	<?php $this->load->view("admin/_part/content.php") ?>
	<?php $this->load->view("admin/_part/modal_loader.php") ?>
	<?php $this->load->view("admin/_part/scrolltop.php") ?>
	<?php $this->load->view("admin/_part/footer_js.php") ?>
</body>
</html>