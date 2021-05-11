<div id="page-w" class="page-wrapper chiller-theme sidebar-bg toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="javascript:void(0)">
        <i class="fas fa-bars"></i>
    </a>
    <?php $this->load->view("admin/_part/sidebar.php") ?>
    <main class="page-content">
        <div class="main container-fluid">
            <?php $this->load->view("admin/_part/session_flash.php") ?>
            <div class="row">
                <?php $this->load->view("admin/_main/".$php_name.".php") ?>
            </div>
        </div>
    </main>
</div>
