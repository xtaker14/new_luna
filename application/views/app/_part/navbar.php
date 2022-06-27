<!-- 
<div class="card d-none d-md-block parent_nav">
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
  </nav>
</div> -->

<div class="card d-none d-md-block parent_nav"> 
  <nav class="navbar navbar-expand-md navbar-dark" align="center">
    <div style="position: absolute;">
      <div class="clock-container">
        <div class="clock-col">
          <p class="clock-day clock-timer">
          </p>
          <!-- <p class="clock-label">
          Day
          </p> -->
        </div>
        <div class="clock-connector"><p>, </p></div>
        <div class="clock-col">
          <p class="clock-hours clock-timer">
          </p>
          <!-- <p class="clock-label">
          Hrs
          </p> -->
        </div>
        <div class="clock-connector"><p>:</p></div>
        <div class="clock-col">
          <p class="clock-minutes clock-timer">
          </p>
          <!-- <p class="clock-label">
          Mins
          </p> -->
        </div>
        <div class="clock-connector"><p>:</p></div>
        <div class="clock-col">
          <p class="clock-seconds clock-timer">
          </p>
          <!-- <p class="clock-label">
          Secs
          </p> -->
        </div>
      </div>
      
      <h5 style="margin-bottom: 0px; margin-top: 5px; text-align:center; background: -webkit-linear-gradient(#fff, #36d1dc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 16px;"><?= date('d M Y'); ?></h5>
    </div>

    <ul class="navbar-nav m-auto">
      <li data-aos="fade-right" data-aos-delay="100" class="nav-item active p-2 <?= empty($this->uri->segment(1)) ? 'current' : ''; ?>">
        <a class="nav-link text-center" href="<?= base_url() ?>">
          <!-- <i class="fas fa-home mr-1"></i> -->
          Home
          <img class="nav-img" src="<?= CDN_IMG.('assets/frontpage/img/nav/slime.png'); ?>">
        </a>
      </li> 
      <li data-aos="fade-right" data-aos-delay="200" class="nav-item active p-2 <?= $this->uri->segment(1) == 'shop' ? 'current' : ''; ?>">
        <a class="nav-link text-center" href="<?= base_url('shop') ?>">
          <!-- <i class="fas fa-shopping-basket mr-1"></i> -->
          Shop
          <img class="nav-img" src="<?= CDN_IMG.('assets/frontpage/img/nav/slime.png'); ?>">
        </a>
      </li> 
      <li data-aos="fade-down" data-aos-delay="700" class="nav-item-center" style="">
        <div class="nav-center-text">
          <h5>PLAYERS ONLINE</h5>
          <div class="nav-center-count p_online">
            0
          </div>
        </div>
      </li> 
      <li data-aos="fade-left" data-aos-delay="400" class="nav-item active p-2 <?= $this->uri->segment(1) == 'rank' ? 'current' : ''; ?>">
        <a class="nav-link text-center" href="<?= base_url('rank') ?>">
          <!-- <i class="fas fa-crown mr-1" ></i> -->
          Rank
          <img class="nav-img" src="<?= CDN_IMG.('assets/frontpage/img/nav/slime.png'); ?>">
        </a>
      </li> 
      
      <?php if(!empty($this->session->userdata('usr_session'))): ?>
        <li data-aos="fade-right" data-aos-delay="300" class="nav-item active p-2 <?= $this->uri->segment(1) == 'donate' ? 'current' : ''; ?>">
          <a class="nav-link text-center" href="<?= base_url('donate') ?>">
            <!-- <i class="far fa-money-bill-alt mr-1"></i> -->
            Donate
            <img class="nav-img" src="<?= CDN_IMG.('assets/frontpage/img/nav/slime.png'); ?>">
          </a>
        </li>
      <?php else: ?>
        <li data-aos="fade-left" data-aos-delay="600" class="nav-item active p-2 <?= $this->uri->segment(1) == 'p' && $this->uri->segment(2) == 'terms-of-services' ? 'current' : ''; ?>">
          <a class="nav-link text-center" href="<?= base_url('p/terms-of-services') ?>">
            <!-- <i class="fas fa-balance-scale mr-1"></i> -->
            T.O.S
            <img class="nav-img" src="<?= CDN_IMG.('assets/frontpage/img/nav/slime.png'); ?>">
          </a>
        </li> 
      <?php endif; ?>
    </ul> 
  </nav>
</div>