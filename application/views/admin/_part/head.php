<?php 
$upload_path = "assets/frontpage/img/web_config";
$logo_img = CDN_IMG.($upload_path.'/'.$config_web['logo_img']);
$favico = CDN_IMG.($upload_path.'/'.$config_web['favico_img']);
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<link rel="shortcut icon" type="image/x-icon" href="<?= $favico; ?>" />
<title>Admin Panel</title>
