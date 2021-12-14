
<div class="card d-none d-md-block parent_nav">
  <!-- <nav class="navbar navbar-expand-md navbar-dark bg-purple shadow-sm rounded p-0" align="center"> -->
  <nav class="navbar navbar-expand-md navbar-dark" align="center">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active p-2 <?= empty($this->uri->segment(1)) ? 'current' : ''; ?>">
          <a class="nav-link text-center" href="<?= base_url() ?>"><i class="fas fa-home mr-1"></i>Home</a>
        </li>
        <li class="nav-item active p-2 <?= $this->uri->segment(1) == 'shop' ? 'current' : ''; ?>">
          <a class="nav-link text-center" href="<?= base_url('shop') ?>"><i class="fas fa-shopping-basket mr-1"></i>Shop</a>
        </li>
        <li class="nav-item active p-2 <?= $this->uri->segment(1) == 'donate' ? 'current' : ''; ?>">
          <a class="nav-link text-center" href="<?= base_url('donate') ?>"><i class="fas fa-gem mr-1"></i>Donate</a>
        </li>
        <li class="nav-item active p-2 <?= $this->uri->segment(1) == 'rank' ? 'current' : ''; ?>">
          <a class="nav-link text-center" href="<?= base_url('rank') ?>"><i class="fas fa-crown mr-1" ></i>Rank</a>
        </li>
          <li class="nav-item active p-2 <?= $this->uri->segment(1) == 'p' && $this->uri->segment(2) == 'download-page' ? 'current' : ''; ?>">
          <a class="nav-link text-center" href="<?= base_url('p/download-page') ?>"><i class="fas fa-download mr-1"></i>Download</a>
        </li>
        <!-- <li class="nav-item active p-2 <?= $this->uri->segment(1) == 'p' && $this->uri->segment(2) == 'terms-of-services' ? 'current' : ''; ?>">
          <a class="nav-link text-center" href="<?= base_url('p/terms-of-services') ?>"><i class="fas fa-balance-scale mr-1"></i>Terms Of Services</a>
        </li> -->
        <?php 
        $active_others = '';
        if($this->uri->segment(1) == 'p' && $this->uri->segment(2) == 'terms-of-services'){
          $active_others = 'current';
        }
        elseif($this->uri->segment(1) == 'media'){
          $active_others = 'current';
        }
        ?>
        <li class="nav-item dropdown active p-2 <?= $active_others; ?> ">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <!-- <i class="fas fa-ellipsis-v"></i> -->
            <i class="fas fa-th-list"></i>
            Others
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= base_url('overview') ?>">Information</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url('media') ?>">Media</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url('p/terms-of-services') ?>">Terms Of Services</a>
          </div>
        </li>
      </ul>
      <!--
      <form id="search_form" action="" method="post" class="form-inline my-2 my-lg-0 mx-2" align="right">
          <div class="form-group">
              <input class="form-control" type="search" id="search_txt" name="search_txt" placeholder="Search items.." required >
          </div> 
      </form>
      -->
  </nav>
</div>