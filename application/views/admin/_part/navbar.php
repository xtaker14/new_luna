<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
  <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      	<?php if(isset($nama) && !empty($nama)){?>
      		<span><?php print_r($nama)?> </span>
      	<?php }else{ ?>
      		<span>Admin <?php print_r(SITE_NAME) ?></span>
      	<?php } ?>
        <i class="fas fa-user-circle fa-fw"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="<?php print_r(site_url('adm/logout')) ?>" ><i class="fa fa-power-off text-danger"></i> Logout</a>
      </div>
    </li>
  </ul>
</nav>
