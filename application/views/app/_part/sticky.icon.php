<style type="text/css">
.list_icon{
    position:fixed;
    bottom:90px;
    right:10px;
    z-index: 1020;
}
.list_icon li{
	cursor: pointer;
}
</style>
<ul class="list_icon list_none d-block d-md-none">
	<?php if($this->uri->segment(2) !=='donate'){ ?>
	<li class="rounded-circle bg-primary text-center mt-3 p-2">
		<a class="text-white" href="<?= base_url('donate') ?>"><i class="fas fa-gem fa-2x"></i></a>
	</li>
	<?php } if($php_name !=='shop' && !empty($usr_session)){ ?>
	<li class="rounded-circle bg-danger text-center mt-3 p-2">
		<a class="text-white" href="<?= base_url('shop') ?>"><i class="fas fa-shopping-basket fa-2x"></i></a>
	</li>
	<?php } if($php_name !=='homepage'){ ?>
	<li class="rounded-circle bg-success text-center mt-3 p-2">
		<a class="text-white" href="<?= base_url() ?>"><i class="fas fa-home fa-2x"></i></a>
	</li>
	<?php } ?>
</ul>

