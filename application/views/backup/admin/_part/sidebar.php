<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <!-- sidebar-brand  -->
        <div class="sidebar-item sidebar-brand">
            <a href="<?php print_r(site_url()) ?>" target="_blank"><?php print_r(SITE_NAME) ?></a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <!-- sidebar-menu  -->
        <div class=" sidebar-item sidebar-menu">
            <ul>
                <li>
                  <a href="<?php print_r(site_url('adm/dashboard')) ?>">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span></a>
                </li>
                <li class="sidebar-dropdown">
                    <a href="javascript:void(0)">
                        <i class="fas fa-shopping-basket mr-1" style="margin-right: 10px !important;"></i>
                        <span>Item Mall</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="<?php print_r(site_url('adm/new_im')) ?>">
                                    <i class="fas fa-cart-plus"></i>
                                     <span>New Item</span>
                                 </a>
                            </li>
                            <li>
                                <a href="<?php print_r(site_url('adm/im_list')) ?>">
                                    <i class="fas fa-list-ul"></i>
                                     <span>Item List</span>
                                 </a>
                            </li>
                            <li>
                                <a href="<?php print_r(site_url('adm/im_piece_list')) ?>">
                                    <i class="fas fa-list-ul"></i>
                                     <span>Piece List</span>
                                 </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="javascript:void(0)">
                        <i class="fas fa-gem"></i>
                        <span>Donation</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                           <li>
                                <a href="<?php print_r(site_url('adm/topup')) ?>">
                                    <i class="fas fa-gem text-primary"></i>
                                     <span>Top-up</span>
                                 </a>
                            </li>
                            <li>
                                <a href="<?php print_r(site_url('adm/topup_log')) ?>">
                                    <i class="fas fa-list-ul"></i>
                                     <span>Top-up Log</span>
                                 </a>
                            </li>
                            <li>
                                <a href="<?php print_r(site_url('adm/send_item')) ?>">
                                    <i class="fas fa-gift text-success"></i>
                                     <span>Send Item</span>
                                 </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="javascript:void(0)">
                        <i class="fas fa-gem"></i>
                        <span>New Donation</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                           <li>
                                <a href="<?php print_r(site_url('adm/donate')) ?>">
                                    <i class="fas fa-gem text-primary"></i>
                                    <span>Process</span>
                                </a>
                            </li> 
                           <li>
                                <a href="<?php print_r(site_url('adm/referral')) ?>">
                                    <!-- <i class="fa fa-coins text-primary"></i> -->
                                    <i class="fas fa-list-ul"></i>
                                    <span>Referral Code</span>
                                </a>
                            </li> 
                           <li>
                                <a href="<?php print_r(site_url('adm/referral_history')) ?>">
                                    <!-- <i class="fa fa-coins text-primary"></i> -->
                                    <i class="fas fa-list-ul"></i>
                                    <span>Referral History</span>
                                </a>
                            </li> 
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="javascript:void(0)">
                        <i class="far fa-newspaper"></i>
                        <span>Article</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                              <a href="<?php print_r(site_url('adm/new_article')) ?>">
                                <i class="far fa-newspaper"></i>
                                <span>New Article</span></a>
                            </li>
                            <li>
                                <a href="<?php print_r(site_url('adm/article_list')) ?>">
                                    <i class="fas fa-list-ul"></i>
                                     <span>Article List</span>
                                 </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="sidebar-dropdown">
                    <a href="javascript:void(0)">
                        <i class="far fa-images"></i>
                        <span>Media</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                              <a href="<?php print_r(site_url('adm/new_media')) ?>">
                                <i class="far fa-images"></i>
                                <span>New Media</span></a>
                            </li>
                            <li>
                                <a href="<?php print_r(site_url('adm/media')) ?>">
                                    <i class="fas fa-list-ul"></i>
                                     <span>Media List</span>
                                 </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <?php if($role==ROLE_DEVELOPER){?>
                    <li class="header-menu">
                        <span>Developer</span>
                    </li>
                    <li>
                    <a href="<?php print_r(site_url('adm/add_source')) ?>">
                        <i class="fas fa-code"></i>
                        <span>Add Item Source</span></a>
                    </li>
                    <li>
                    <a href="<?php print_r(site_url('adm/g_account_list')) ?>">
                        <i class="fas fa-users"></i>
                        <span>GAME Account</span></a>
                    </li>
                    <li>
                    <a href="<?php print_r(site_url('adm/account_list')) ?>">
                        <i class="fas fa-users"></i>
                        <span>Web Account</span></a>
                    </li>
                <?php }?>
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-footer  -->
    <div class="sidebar-footer">
        <div class="dropdown">
            <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
                <span class="badge-sonar"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuMessage">
                <a class="dropdown-item text-dark" href="#">My profile</a>
                <a class="dropdown-item text-dark" href="#">Setting</a>
            </div>
        </div>
        <div>
            <a href="<?php print_r(site_url('adm/logout')) ?>" title="Klik untuk Keluar" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-power-off text-danger"></i>
            </a>
        </div>
    </div>
</nav>