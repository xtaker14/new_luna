<?php 
header('Content-Type: text/html; charset=utf-8');
 ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content='#000000' name='theme-color'/>
<meta content='#000000' name='msapplication-navbutton-color'/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<link rel="shortcut icon" type="image/x-icon" href="<?php print_r(site_url('favicon.ico')) ?>" />
<meta name="Language" content="en" />
<meta http-equiv="content-language" content="en" />
<link rel="canonical" href="<?php print_r(current_url()); ?>"/>
<title><?= SITE_NAME ?></title>
<?php $this->load->view("app/_part/head-js.php") ?>
<?php $this->load->view("app/_part/css.php") ?>
<style type="text/css">
.topbar {
	height: 38px;
	width: 100%;
	margin: 0;
	padding: 0;
	line-height: 38px;
	font-size: 12px;
	background: #ffffff;
	box-shadow: 0 1px 3px rgb(0 0 0 / 10%);
}
.shadow {
	box-shadow: 0 1px 5px rgb(0 0 0 / 20%);
	-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.2);
	-webkit-box-shadow: 0 1px 5px rgb(0 0 0 / 20%);
	-o-box-shadow: 0 1px 5px rgba(0,0,0,0.2);
}
.outer-grid {
    max-width: 1366px;
    min-width: 1067px;
    margin: auto;
    padding: 0 15px;
}
.topbar span.right {
    line-height: 0;
}
.right {
    float: right !important;
}
span.server-status {
    padding: 11px 0 0 20px;
    margin: 8px 0 0 15px;
    display: inline-block;
    height: 22px;
    background: url(assets/frontpage/img/server-status-icon.png) left no-repeat;
}
span.server-status.online {
    background-position: 0 0;
    color: #94b350;
}
span.server-status {
    padding: 11px 0 0 20px;
    margin: 8px 0 0 15px;
    display: inline-block;
    height: 22px;
    background: url(assets/frontpage/img/server-status-icon.png) left no-repeat;
}
span.server-status.offline {
    background-position: 0 -44px;
    color: #f47d53;
}
.footer {
    height: 80px;
    width: 100%;
    background: #ffffff;
}
.footer .grid {
    position: relative;
}
.footer a {
    margin: 0 10px 0 0;
    color: #818181;
}
a.bottom-button {
    height: 43px;
    width: 43px;
    margin: 0 5px;
    display: inline-block;
    vertical-align: middle;
}
.doge {
    background: url(assets/frontpage/img/doge.png) center no-repeat;
    width: 66px;
    height: 59px;
    position: absolute;
    top: -49px;
    left: -105px;
}
.logo-small {
    width: 100%;
    height: 100%;
    line-height: 80px;
    padding: 0;
    text-align: center;
}
a.bottom-button.facebook {
    background: url(assets/frontpage/img/facebook.png) center no-repeat;
}
a.bottom-button.contact {
    background: url(assets/frontpage/img/contact.png) center no-repeat;
}
a.bottom-button.helper {
    margin-right: 30px;
    background: url(assets/frontpage/img/help.png) center no-repeat;
}
</style>
<script data-ad-client="ca-pub-7600905645602632" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
	<div class="topbar shadow">
        <div class="outer-grid">
            <b>Server Time:</b> 12:35, April 17th 2021
            <span class="right"><b>Server Status:</b> <span class="server-status online">Online</span> <span class="server-status offline">Busy</span></span>
        </div>
    </div>


	<div class="cover_loading">
		<div class="fa-4x"><i class="fas fa-cog fa-spin text-white"></i></div>
		<div class="fa-2x"><i class="fas fa-cog fa-spin text-white"></i></div>
	</div>
	<main>
		<div class="container"> 
					<div class="col-md-12" style="background-color: rgb(000000);">
					<img src="<?php print_r(base_url('assets/frontpage/img/top_banner.png')) ?>" class="img-fluid" />
				</div>
			</div>
			<div class="d-block" align="center">
			<?php $this->load->view("app/_part/sess_flash.php"); ?>
			</div>
		</div>
		<div class="container main_content mb-4" >
			<div class="row">
				<div class="col-md-4 mb-2 pt-3"> 
					<?php $this->load->view("app/_part/sidebar_left.php") ?>
				</div>
				<div class="col-md-8 mb-2 pt-3">
					<?php $this->load->view("app/_part/navbar.php") ?>
					<?php $this->load->view("app/_main/".$php_name.".php") ?>	
				</div>			
				</div>
			</div>
		</div>
	</main>
	<?php $this->load->view("app/_part/im_modal.php");?>
	<?php $this->load->view("app/_part/sticky.icon.php") ?>
	<?php $this->load->view("app/_part/footer.html") ?>
	<?php $this->load->view("app/_part/footer-js.php") ?>

	<div class="footer shadow">
        <div class="grid">
            <div class="doge"></div>
            <div class="logo-small">
                <a href="#" class="bottom-button facebook"></a>
                <a href="mailto:example@mail.com" class="bottom-button contact"></a>
                <a href="#" class="bottom-button helper"></a>
            </div>
        </div>
    </div>

</body>
</html>