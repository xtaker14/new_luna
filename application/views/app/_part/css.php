<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel='stylesheet' id='rs-plugin-settings-css'  href='<?= base_url(); ?>assets/plugins/revslider/public/assets/css/rs6.css?ver=6.2.8' type='text/css' media='all' />

<style type="text/css">
.swal-overlay {
	background-color: rgba(43, 165, 137, 0.45);
}
.swal-modal {
	/* background-color: rgba(63,255,106,0.69); */
	background-color: rgba(63,255,106,0.85);
	/* border: 3px solid white; */
	border: 3px solid #61551E;
}
.swal-icon--success__hide-corners,
.swal-icon--success::after, .swal-icon--success::before {
	background: transparent;
}
.swal-icon--success__line{
	background-color: #fff;
}
.swal-icon--success__ring{
	border-color: #fff;
}

/* start tabs */
.project-tab {
	/* padding-top: 15px; */
}
.project-tab #tabs{
    background: #007b5e;
    color: #eee;
}
.project-tab #tabs h6.section-title{
    color: #eee;
}

#tbl_media_ss_table .gallery{
	/* margin-top: 3px;
	margin-bottom: 3px; */
	margin: 3px;
}
#tbl_media_ss_table .gallery-image{
	border-top: 1px dashed #fff;
	border-bottom: 1px dashed #fff;
	border-right: 1px dashed #fff;
	border-left: 1px dashed #fff;
}

.parent_nav nav.navbar.navbar-dark{
	background-image: linear-gradient(#477cb2, #366ba1);
	box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2) !important;
} 
.parent_nav nav.navbar li.nav-item{
	padding: 0px !important;
	margin-left:7.5px;
	margin-right:7.5px;
}

#im_list .im_list_item {
	border: 1px dashed #fff;
}

.item-set-image{
	/* display: inline-block;
	float: left;
	margin: 0 15px 0 0; */
	width: 100%;
	text-align: center;
	display: flex;
	padding: 10px;
	text-align: center;
	background: #e8e8e8;
	border: 2px solid #f2ede7;
	box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.2);
}

.nav-item:hover{
    /* background: #0000001a; */
	box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2);
}
.nav-item.current {
    /* background: #0000001a !important; */
	box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2) !important;
}

.form_blue_input_group .input-group,
#btn-imBuy .input-group,
#reg_form .input-group,
#srv_form_login .input-group{
	box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2);
}

.form_blue_input_group .input-group .input-group-text,
#btn-imBuy .input-group .input-group-text,
#reg_form .input-group .input-group-text,
#srv_form_login .input-group .input-group-text{
	background-color: #61aaf4;
	color: #fff;
}

#srv_form_login .input-group input 
{
	text-align: right;
}

.parent_nav nav.navbar li.nav-item img.nav-img{
	width: 30px;
  	margin-top: -5px;
}
.parent_nav nav.navbar li.nav-item-center{
	/* width:160px; */
	width:180px;
	margin-left:20px;
	margin-right:20px;
	margin-top:-15px;
}
.parent_nav nav.navbar li.nav-item-center div.nav-center-text{
	position: absolute;
	height: 100px;
	width: 100%;
	background-image: radial-gradient(circle, #9ce61a 15%, #587d15 90%);
	border-top-left-radius: 30px;
	border-top-right-radius: 30px;
	border-bottom-left-radius: 60px;
	border-bottom-right-radius: 60px;
	/* border: 2px solid #827360; */
	border: 2px solid #61551E;
	/* box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2) !important; */
	box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.4) !important;
	text-align: center;
}
.parent_nav nav.navbar li.nav-item-center div.nav-center-text h5{
	color: #fff;
	margin-top: 25px;
	font-weight: bold;
	font-size: 1.1rem;
	/* box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2) !important; */
	text-shadow: 2px 2px 4px #464343;
}
.parent_nav nav.navbar li.nav-item-center div.nav-center-text div.nav-center-count{
	color:#fff;
	background: black;
	/* margin-left: 20px; */
	/* margin-right: 20px; */
	width: 80px;
	margin:auto;
	border-radius:4px;
	box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2) !important;
}

.project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #0062cc;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 3px solid !important;
    font-size: 16px;
    font-weight: bold;
}
.project-tab .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    /* color: #0062cc; */
    color: #fff;
    font-size: 16px;
    font-weight: 600;
}
.project-tab .nav-link {
	background: #0000001a;
}
.project-tab .nav-link:hover {
    border: none;
}
.project-tab thead{
    background: #f3f3f3;
    color: #333;
}
.project-tab a{
    text-decoration: none;
    color: #333;
    font-weight: 600;
}
.table-scroll{
	padding-top: 10px;
	height: 630px;
	overflow-y: auto;
	/* overflow-x: hidden; */
}
/* end tabs */

.carousel-indicators li {
    width: 10px !important;
	height: 10px !important;
	background-color: #007bff !important;
	border-radius: 100%;
}

#level_rank_table tbody tr td,
#guild_rank_table tbody tr td,
#cs_rank_table tbody tr td {
	color: #fff !important;
}


/* -- preloader -- */
/* 
#preloader {
	background-color: #101010;
	height: 100%;
	width: 100%;
	position: fixed;
	margin-top: 0px;
	top: 0px;
	z-index: 9999999;
}
#preloader span {
	position: absolute;
	width: 20px;
	height: 20px;
	background: #2df1fb;
	opacity: 1;
	border-radius: 20px;
	animation: preloader 1s infinite ease-in-out;
	top: 50%;
	left: 45%;
	-o-transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	-webkit-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
}
#preloader span:nth-child(2) {
	animation-delay: .2s;
	left: 47%;
}
#preloader span:nth-child(3) {
	left: 49%;
	animation-delay: .4s;
}
#preloader span:nth-child(4) {
	left: 51%;
	animation-delay: .6s;
}
#preloader span:nth-child(5) {
	left: 53%;
	animation-delay: .8s;
}
@keyframes preloader {
	0% {
		opacity: 1;
		transform: translateY(0);
		box-shadow: 0 0 3px rgba(0, 0, 0, 0.05);
	}
	50% {
		opacity: 1;
		transform: translateY(-10px);
		background: #fff;
		box-shadow: 0 20px 3px rgba(0, 0, 0, 0.05);
	}
	100% {
		opacity: 0.3;
		transform: translateY(0);
		box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
	}
} */

@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&display=swap');
#preloader { 
	position: fixed;
	background: #fff;
	display: grid;
	place-content: center;
	min-height: 100vh;
	width: 100%;
	margin: 0;
	padding: 2px;
	box-sizing: border-box;
	overflow: hidden;
	z-index: 9999999;
}

#preloader h1 {
	font-family: 'Open Sans', -apple-system, 'Segoe UI', sans-serif !important;
	font-size: 50px !important;
	font-weight: bold !important;
	/* color: #2a88ed; */
	color: #5a9938; 
	text-shadow: 2px 2px 4px #464343;
	box-sizing: border-box;
}
#preloader .dots {
	display: inline-flex;
}
#preloader .dots--animate .dot.z {
	animation: scale 0.8s 0.2s forwards;
}
#preloader .dots--animate .dot.f, .dots--animate .dot.s {
	animation: right 0.5s forwards;
}
#preloader .dots--animate .dot.l {
	animation: rightDown 0.4s 0.1s forwards linear, drop 2s 0.4s forwards linear;
}
#preloader .dot {
	display: inline-block;
	width: 10px;
	height: 10px;
	/* background: #2a88ed; */
	background: #5a9938;
	text-shadow: 2px 2px 4px #464343;
	border-radius: 10px;
	position: relative;
	margin-left: 6px;
}
#preloader .dot.z {
	position: absolute;
	transform: scale(0);
}
@keyframes scale {
	100% {
		transform: scale(1);
	}
}
#preloader .dot.f, .dot.s {
	transform: translateX(0px);
}
@keyframes right {
	100% {
		transform: translateX(16px);
	}
}
#preloader .dot.t {
	background: transparent;
}
#preloader .dot .l {
	margin-left: 0;
	position: absolute;
	top: 0;
	left: 0;
}
@keyframes rightDown {
	50% {
		top: 4px;
		left: 16px;
	}
	100% {
		top: 12px;
		left: 24px;
	}
}
@keyframes drop {
	100% {
		transform: translate(70px, calc(35px + (100vh/2)));
	}
}
/* 
#preloader .abs-twitter {
	position: fixed;
	right: calc(24px + .6vw);
	top: calc(22px + .6vw);
	transform: translate(-8px, 4px);
	opacity: 0;
	transition: 0.3s ease-in;
}
#preloader .abs-twitter--show {
	transform: translate(0, 0);
	opacity: 1;
	animation: birdie 1s 0.8s linear infinite;
}
@keyframes birdie {
	13% {
		transform: rotate(14deg);
	}
	26% {
		transform: rotate(28deg);
	}
	100% {
		transform: rotate(0deg);
	} 
} 
*/
/* -- preloader -- */

.parent_img_fly_city{
	position: absolute;
	width: 100%;
	display: flex;
	align-content: center;
	justify-content: end;
}

.parent_img_fly_city:not(.loader_fly_city){ 
    -webkit-animation: moveUpDown 2s infinite alternate;
    animation: moveUpDown 2s infinite alternate;

}

.parent_img_fly_city.loader_fly_city{ 
    -webkit-animation: moveUpDown 1s infinite alternate;
    animation: moveUpDown 1s infinite alternate;
}

@-webkit-keyframes moveUpDown {
    0% { transform: translateY(0); }
    100% { transform: translateY(-12px); }
}

@keyframes moveUpDown {
    0% { transform: translateY(0); }
    100% { transform: translateY(-12px); }
}

/* start clock */
.clock-day:before {
	content: var(--timer-day);
}
.clock-hours:before {
	content: var(--timer-hours);
}
.clock-minutes:before {
	content: var(--timer-minutes);
}
.clock-seconds:before {
	content: var(--timer-seconds);
} 

.clock-container {
	border-radius: 5px;
	/* padding: 13px 0px;  */
	display: flex;
	/* background-image: linear-gradient(to right, #90aef0, #36d1dc) !important; */
	box-shadow: 0 4px 15px 2px rgba(87, 147, 239, 0.75);
	padding-left: 5px;
	padding-right: 5px;
}

.clock-col {
	text-align: center;
	/* margin-right: 40px;
	margin-left: 40px; */
	min-width: 20px;
	margin:auto;
	position: relative;
}

.clock-connector p{
	font-size: 20px; 
	margin: auto !important;
	position: relative;
	top: -2px;
	text-transform: uppercase;
	margin-top: -2px;
	color: #fff;
}

.clock-timer:before {
	color: #fff;
	font-size: 20px;
	text-transform: uppercase;
}

.clock-label {
	color: #fff;
	text-transform: uppercase;
	font-size: 14px;
	margin-top: 10px;
}

@media (max-width: 825px) {
	.clock-container {
		/* flex-direction: column; */
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.clock-col + .clock-col {
		margin-top: 20px;
	}
	.clock-col:before,
	.clock-col:after {
		display: none!important;
	}
}
@media (max-width: 520px) {
	.clock-container {
		flex-direction: column;
		padding-top: 20px;
		padding-bottom: 20px;
	} 
	.clock-container .clock-connector{
		text-align: center;
	}
}
/* end clock */

.white-text{
	color: #fff !important;
}
.page-footer{
	/* margin-top: 70px; */
	margin-top: 30px;
	/* background-image: linear-gradient(to right, #90aef0, #36d1dc) !important; */
	/* box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2) !important; */
	display: block !important;
	z-index: 1;
}
.parent_discord{
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: end;
	position: fixed;
	bottom: 15px;
	right: 15px;
	z-index: 1;
	moz-transition: all .4s ease-in-out;
    -o-transition: all .4s ease-in-out;
    -webkit-transition: all .4s ease-in-out;
    transition: all .4s ease-in-out;
	z-index: 100;
}

.btn_open_discord{
	outline:0;   
	border:none;  
	
	background-color:black;
	padding:2px;
	border-radius:5px;
	box-shadow: -3px 3px #7289da, -2px 2px #7289da, -1px 1px #7289da;
	border: 1px solid #7289da;
	moz-transition: all .2s ease-out;
	-o-transition: all .2s ease-out;
	-webkit-transition: all .2s ease-out;
	transition: all .2s ease-out;
}
.btn_open_discord:active{
	box-shadow:-1px 1px #7289da, -1px 1px #7289da, -1px 1px #7289da;
	margin-right: 2px;
	margin-bottom: -2px;
}
.bottom_background{
    mask-image: -webkit-gradient(linear, center top, center bottom, color-stop(0.00, rgba(0,0,0,0)), color-stop(0.20, rgba(0,0,0,1)));
    -webkit-mask-image: -webkit-gradient(linear, center top, center bottom, color-stop(0.00, rgba(0,0,0,0)), color-stop(0.20, rgba(0,0,0,1)));

    width: calc(100% + 120px);
    height: 700px;
    background: url(<?= base_url('assets/frontpage/img/bottom_bg.jpg') ?>);
    background-size:cover;
    /* background-clip: border-box;
    background-origin: border-box; */
    background-position: 0 -210px;
    /* background-position: bottom; */
    background-repeat: no-repeat;
    position: absolute;
    bottom: 0;
    left: -55px;
    z-index: 0;
}
/***
Social Icons
***/
.social-icons {
    padding: 0;
    margin: 0;
}

.social-icons:before,
.social-icons:after {
    content: " ";
    display: table;
}
.social-icons:after {
    clear: both;
}

.social-icons li {
    float: left;
    display: inline;
    list-style: none;
    margin-right: 5px;
    margin-bottom: 5px;
    text-indent: -9999px;
}
.social-icons li > a {
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px;
    width: 28px;
    height: 28px;
    display: block;
    background-position: 0 0;
    background-repeat: no-repeat;
    transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
}
.social-icons li:hover > a {
    background-position: 0 -38px;
}
.social-icons li .amazon {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/amazon.png) no-repeat;
}
.social-icons li .behance {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/behance.png) no-repeat;
}
.social-icons li .blogger {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/blogger.png) no-repeat;
}
.social-icons li .deviantart {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/deviantart.png) no-repeat;
}
.social-icons li .dribbble {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/dribbble.png) no-repeat;
}
.social-icons li .dropbox {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/dropbox.png) no-repeat;
}
.social-icons li .evernote {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/evernote.png) no-repeat;
}
.social-icons li .facebook {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/facebook.png) no-repeat;
}
.social-icons li .forrst {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/forrst.png) no-repeat;
}
.social-icons li .github {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/github.png) no-repeat;
}
.social-icons li .googleplus {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/googleplus.png) no-repeat;
}
.social-icons li .jolicloud {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/jolicloud.png) no-repeat;
}
.social-icons li .last-fm {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/last-fm.png) no-repeat;
}
.social-icons li .linkedin {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/linkedin.png) no-repeat;
}
.social-icons li .picasa {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/picasa.png) no-repeat;
}
.social-icons li .pintrest {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/pintrest.png) no-repeat;
}
.social-icons li .rss {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/rss.png) no-repeat;
}
.social-icons li .skype {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/skype.png) no-repeat;
}
.social-icons li .spotify {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/spotify.png) no-repeat;
}
.social-icons li .stumbleupon {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/stumbleupon.png) no-repeat;
}
.social-icons li .tumblr {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/tumblr.png) no-repeat;
}
.social-icons li .twitter {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/twitter.png) no-repeat;
}
.social-icons li .vimeo {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/vimeo.png) no-repeat;
}
.social-icons li .wordpress {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/wordpress.png) no-repeat;
}
.social-icons li .xing {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/xing.png) no-repeat;
}
.social-icons li .yahoo {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/yahoo.png) no-repeat;
}
.social-icons li .youtube {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/youtube.png) no-repeat;
}
.social-icons li .vk {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/vk.png) no-repeat;
}
.social-icons li .instagram {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/instagram.png) no-repeat;
}
.social-icons li .reddit {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/reddit.png) no-repeat;
}
.social-icons li .aboutme {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/aboutme.png) no-repeat;
}
.social-icons li .flickr {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/flickr.png) no-repeat;
}
.social-icons li .foursquare {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/foursquare.png) no-repeat;
}
.social-icons li .gravatar {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/gravatar.png) no-repeat;
}
.social-icons li .klout {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/klout.png) no-repeat;
}
.social-icons li .myspace {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/myspace.png) no-repeat;
}
.social-icons li .quora {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/quora.png) no-repeat;
}
.social-icons.social-icons-color > li > a {
    opacity: 0.7;
    background-position: 0 -38px !important;
}
.social-icons.social-icons-color > li > a:hover {
    opacity: 1;
}
.social-icons.social-icons-circle > li > a {
    border-radius: 25px !important;
}

/***
Inline Social Icons
***/
.social-icon {
    display: inline-block !important;
    width: 28px;
    height: 28px;
    background-position: 0 0;
    background-repeat: no-repeat;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px;
    transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
}
.social-icon.social-icon-circle {
    border-radius: 25px !important;
}

.social-icon.amazon {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/amazon.png) no-repeat;
}
.social-icon.behance {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/behance.png) no-repeat;
}
.social-icon.blogger {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/blogger.png) no-repeat;
}
.social-icon.deviantart {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/deviantart.png) no-repeat;
}
.social-icon.dribbble {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/dribbble.png) no-repeat;
}
.social-icon.dropbox {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/dropbox.png) no-repeat;
}
.social-icon.evernote {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/evernote.png) no-repeat;
}
.social-icon.facebook {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/facebook.png) no-repeat;
}
.social-icon.forrst {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/forrst.png) no-repeat;
}
.social-icon.github {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/github.png) no-repeat;
}
.social-icon.googleplus {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/googleplus.png) no-repeat;
}
.social-icon.jolicloud {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/jolicloud.png) no-repeat;
}
.social-icon.last-fm {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/last-fm.png) no-repeat;
}
.social-icon.linkedin {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/linkedin.png) no-repeat;
}
.social-icon.picasa {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/picasa.png) no-repeat;
}
.social-icon.pintrest {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/pintrest.png) no-repeat;
}
.social-icon.rss {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/rss.png) no-repeat;
}
.social-icon.skype {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/skype.png) no-repeat;
}
.social-icon.spotify {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/spotify.png) no-repeat;
}
.social-icon.stumbleupon {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/stumbleupon.png) no-repeat;
}
.social-icon.tumblr {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/tumblr.png) no-repeat;
}
.social-icon.twitter {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/twitter.png) no-repeat;
}
.social-icon.vimeo {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/vimeo.png) no-repeat;
}
.social-icon.wordpress {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/wordpress.png) no-repeat;
}
.social-icon.xing {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/xing.png) no-repeat;
}
.social-icon.yahoo {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/yahoo.png) no-repeat;
}
.social-icon.youtube {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/youtube.png) no-repeat;
}
.social-icon.vk {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/vk.png) no-repeat;
}
.social-icon.instagram {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/instagram.png) no-repeat;
}
.social-icon.reddit {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/reddit.png) no-repeat;
}
.social-icon.aboutme {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/aboutme.png) no-repeat;
}
.social-icon.flickr {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/flickr.png) no-repeat;
}
.social-icon.foursquare {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/foursquare.png) no-repeat;
}
.social-icon.gravatar {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/gravatar.png) no-repeat;
}
.social-icon.klout {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/klout.png) no-repeat;
}
.social-icon.myspace {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/myspace.png) no-repeat;
}
.social-icon.quora {
    background: url(<?= base_url('assets/frontpage/img/') ?>social/quora.png) no-repeat;
}
.social-icon:hover {
    background-position: 0 -38px;
}

.social-icon-color {
    opacity: 0.7;
    background-position: 0 -38px !important;
}
.social-icon-color:hover {
    opacity: 1;
}

div.copyright,
div.parent-social-icons{
	top: 0;
	/* transform: translate(-50%); */
} 

div.copyright h5{
	color: white;
  	text-shadow: 2px 2px 4px #000000;
}
ul.social-icons li{
	margin-bottom: 0;
}
ul.social-icons li:nth-last-child(1) {
	margin-right:0;
}

/* start button  */

/* -- btn one -- */ 

.btn-one {
	border: none;
	border-radius: 4px;
	text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.48);
	overflow: hidden;
	padding: 5px 5px 5px 5px;
	/* margin-bottom: 10px; */
	font-size: 16px;
	position: relative;
	color: white;
	outline: none;
	cursor: pointer;
	width: 100%;
	-webkit-transition: background-position .7s,box-shadow .4s;
	transition: background-position .7s,box-shadow .4s;
	background-size: 110%;
	font-family: 'Oswald', sans-serif;
	height: 100%;
}
.btn-one:not(.btn-darker){  
	box-shadow: 0px 0px 0px 2px rgba(255, 255, 255, 0.16) inset, 0px 0px 5px 0px #33E7EA;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#338CEA), to(rgba(161, 245, 245, 0.24))), url("#");
	background-image: linear-gradient(to bottom, #338CEA, rgba(161, 245, 245, 0.24)), url("#"); 
}
.btn-one.btn-darker { 
	box-shadow: 0px 0px 0px 2px rgba(255, 255, 255, 0.16) inset, 0px 0px 5px 0px #33E7EA;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#338CEA), to(rgba(18, 32, 241, 0.35))), url("#");
	background-image: linear-gradient(to bottom, #338CEA, rgba(18, 32, 241, 0.35)), url("#");
}
.btn-one:hover {
  	background-position: 0% 30%;
  	box-shadow: 0px 0px 0px 2px rgba(255, 255, 255, 0.16) inset, 0px 0px 20px 0px #33E7EA;
}
.btn-one b {
  	color: #1CF4FF;
	font-weight: 700;
} 


.btn-two {
	border: none;
	border-radius: 4px;
	text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.48);
	overflow: hidden;
	padding: 5px 5px 5px 5px;
	/* margin-bottom: 10px; */
	font-size: 16px;
	position: relative;
	color: white;
	outline: none;
	cursor: pointer;
	width: 100%;
	-webkit-transition: background-position .7s,box-shadow .4s;
	transition: background-position .7s,box-shadow .4s;
	background-size: 110%;
	font-family: 'Oswald', sans-serif;
	height: 100%;
	
	box-shadow: 0px 0px 0px 2px rgba(255, 255, 255, 0.16) inset, 0px 0px 5px 0px #ed6ea0;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#f7186a), to(rgba(245, 161, 161, 0.24))), url("#");
	background-image: linear-gradient(to bottom, #f7186a, rgba(245, 161, 161, 0.24)), url("#"); 
} 
.btn-two:hover {
  	background-position: 0% 30%;
  	box-shadow: 0px 0px 0px 2px rgba(255, 255, 255, 0.16) inset, 0px 0px 20px 0px #ed6ea0;
}
.btn-two b {
  	color: #1CF4FF;
	font-weight: 700;
} 


.btn-three {
	border: none;
	border-radius: 4px;
	text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.48);
	overflow: hidden;
	padding: 5px 5px 5px 5px;
	/* margin-bottom: 10px; */
	font-size: 16px;
	position: relative;
	color: white;
	outline: none;
	cursor: pointer;
	width: 100%;
	-webkit-transition: background-position .7s,box-shadow .4s;
	transition: background-position .7s,box-shadow .4s;
	background-size: 110%;
	font-family: 'Oswald', sans-serif;
	height: 100%;
	
	box-shadow: 0px 0px 0px 2px rgba(255, 255, 255, 0.16) inset, 0px 0px 5px 0px #7eed6e;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#18f75a), to(rgba(199, 245, 161, 0.24))), url("#");
	background-image: linear-gradient(to bottom, #18f75a, rgba(199, 245, 161, 0.24)), url("#"); 
} 
.btn-three:hover {
  	background-position: 0% 30%;
  	box-shadow: 0px 0px 0px 2px rgba(255, 255, 255, 0.16) inset, 0px 0px 20px 0px #7eed6e;
}
.btn-three b {
  	color: #1CF4FF;
	font-weight: 700;
} 

/* .btn-one:hover:after{
	right: -20px;
	-webkit-transition: right .4s,-webkit-transform 30s .2s linear;
	transition: right .4s,-webkit-transform 30s .2s linear;
	transition: right .4s,transform 30s .2s linear;
	transition: right .4s,transform 30s .2s linear,-webkit-transform 30s .2s linear;
}
.btn-one:before{
	font-family: FontAwesome;
	display: block;
	position: absolute;
}
.btn-one:before{
	-webkit-transition: all 1s;
	transition: all 1s;
	font-size: 20px;
	left: 25px;
	top: 19px;
}
.btn-one:after{
	-webkit-transition: right .4s, -webkit-transform .2s;
	transition: right .4s, -webkit-transform .2s;
	transition: right .4s, transform .2s;
	transition: right .4s, transform .2s, -webkit-transform .2s;
	font-size: 100px;
	opacity: .3;
	right: -120px;
	top: -17px;
}
.btn-one:hover:after {
  	-webkit-transform: scale(1);
          transform: scale(1);
}
.btn-one:hover:before {
  	-webkit-transform: scale(1.2);
          transform: scale(1.2);
}
.btn-one:after, .btn-one:before {
  	content: "";
} */

/* -- btn one -- */

.buttons {
	margin: 10%;
	text-align: center;
}

.btn-black{
	background-color: #353333 !important;
}
.btn-hover {
	width: 100%;
    font-size: 14px !important;
    font-weight: 600;
    color: #fff !important;
    cursor: pointer;
    height: 35px;
    text-align: center;
    border: none;
    background-size: 300% 100%;
    border-radius: 50px;
    moz-transition: all .4s ease-in-out;
    -o-transition: all .4s ease-in-out;
    -webkit-transition: all .4s ease-in-out;
    transition: all .4s ease-in-out;
}

.btn-hover:hover {
	background-position: 100% 0;
	moz-transition: all .4s ease-in-out;
	-o-transition: all .4s ease-in-out;
	-webkit-transition: all .4s ease-in-out;
	transition: all .4s ease-in-out;
}

.btn-hover:focus {
	outline: none;
}

.btn-hover.color-1 {
	background-image: linear-gradient(to right, #25aae1, #40e495, #30dd8a, #2bb673);
	box-shadow: 0 4px 15px 0 rgba(49, 196, 190, 0.75);
}

.btn-hover.color-2 {
	background-image: linear-gradient(to right, #f5ce62, #e43603, #fa7199, #e85a19);
	box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);
}

.btn-hover.color-3 {
	background-image: linear-gradient(to right, #667eea, #764ba2, #6B8DD6, #8E37D7);
	box-shadow: 0 4px 15px 0 rgba(116, 79, 168, 0.75);
}

.btn-hover.color-orange {
	background-image: linear-gradient(to right, #fc6076, #ff9a44, #ef9d43, #e75516);
	box-shadow: 0 4px 15px 0 rgba(252, 104, 110, 0.75);
}

.btn-hover.color-green {
	background-image: linear-gradient(to right, #0ba360, #3cba92, #30dd8a, #2bb673);
	box-shadow: 0 4px 15px 0 rgba(23, 168, 108, 0.75);
}

.btn-hover.color-6 {
	background-image: linear-gradient(to right, #009245, #FCEE21, #00A8C5, #D9E021);
	box-shadow: 0 4px 15px 0 rgba(83, 176, 57, 0.75);
}

.btn-hover.color-7 {
	background-image: linear-gradient(to right, #6253e1, #852D91, #A3A1FF, #F24645);
	box-shadow: 0 4px 15px 0 rgba(126, 52, 161, 0.75);
}

.btn-hover.color-black {
	background-image: linear-gradient(to right, #29323c, #485563, #2b5876, #4e4376);
	box-shadow: 0 4px 15px 0 rgba(45, 54, 65, 0.75);
}

.btn-hover.color-blue {
	background-image: linear-gradient(to right, #25aae1, #4481eb, #04befe, #3f86ed);
	box-shadow: 0 4px 15px 0 rgba(65, 132, 234, 0.75);
}

.btn-hover.color-red {
	background-image: linear-gradient(to right, #ed6ea0, #ec8c69, #f7186a, #FBB03B);
	box-shadow: 0 4px 15px 0 rgba(236, 116, 149, 0.75);
}

.btn-hover.color-darkred {
	background-image: linear-gradient(to right, #eb3941, #f15e64, #e14e53, #e2373f);
	box-shadow: 0 5px 15px rgba(242, 97, 103, .4);
}

/* end button  */

/* start header title */ 

.content_header_title h2 {
	font-size: 19px;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.box_header_title {
	position: relative;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%); 
	/* height: 300px; */
	/* background: #111845a6; */
	background: #451111a6;
	box-sizing: border-box;
	overflow: hidden;
	box-shadow: 0 20px 50px rgb(23, 32, 90);
	/* border: 2px solid #2a3cad; */
	border: 2px solid #ad2a8c;
	color: white;
	padding: 8px;
}

.box_header_title:before {
	content: '';
	position: absolute;
	top: 0;
	/* left: -100%; */
	width: 100%;
	height: 100%;
	background: rgba(255, 255, 255, 0.1);
	transition: 0.5s;
	pointer-events: none;
}

.box_header_title:hover:before {
	/* left: -50%; */
	transform: skewX(-5deg);
}

.box_header_title .content_header_title {
	position: relative; 
	/* border: 1px solid #f0a591; */
	border: 1px solid #979eb0;
	padding: 7px;
	text-align: center;
	box-shadow: 0 5px 10px rgba(9, 0, 0, 0.5);
}

.box_header_title span {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	display: block;
	box-sizing: border-box;
}

.box_header_title span:nth-child(1) {
	transform: rotate(0deg);
}
/* 
.box_header_title span:nth-child(2) {
	transform: rotate(90deg);
} */

.box_header_title span:nth-child(2) {
	transform: rotate(180deg);
}

/* .box_header_title span:nth-child(4) {
	transform: rotate(270deg);
} */

.box_header_title span:before {
	content: '';
	position: absolute;
	width: 100%;
	height: 2px;
	/* background: #50dfdb; */
	background: #df7250;
	animation: animate_header_title 4s linear infinite;
}

@keyframes animate_header_title {
	0% {
		transform: scaleX(0);
		transform-origin: left;
	}
	50% {
		transform: scaleX(1);
		transform-origin: left;
	}
	50.1% {
		transform: scaleX(1);
		transform-origin: right;
	}
	100% {
		transform: scaleX(0);
		transform-origin: right;
	}
}

/* end header title */

.parent_banner{ 
	
	mask-image: -webkit-gradient(linear, center bottom, center top, color-stop(0.00, rgba(0,0,0,0)), color-stop(0.17, rgba(0,0,0,1)));
	-webkit-mask-image: -webkit-gradient(linear, center bottom, center top, color-stop(0.00, rgba(0,0,0,0)), color-stop(0.17, rgba(0,0,0,1)));

    background: url(<?= base_url('assets/frontpage/img/top_banner_1.png') ?>);
    height:600px;
    width:100%;
    background-size:cover;
    background-clip: border-box;
    background-origin: border-box;
    background-position: 0 -350px;
    /* background-position: bottom; */
    background-repeat: no-repeat;
    position: relative;
    padding: 0;
}
.parent_banner img.image_logo_char{
    position: absolute;
    width: 400px;
    right: 0;
    bottom: 25px;
}
.parent_banner img.image_logo_mobile{
    display: none;
}
.parent_banner .clouds{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}
.parent_banner .clouds img{
    position: absolute;
    bottom: 0;
    max-width: 100%;
    animation: cloud_animate calc(8s * var(--i)) linear infinite;
}
#srv_status .list-group-item{
    padding: 0rem 0.5rem;
    background-color: transparent !important;
}
.dwn-btn{
	padding: 12px 0px !important;
}
#srv_status{
	background-size: 110px auto;
	min-height: 70px;
	background-position: bottom right;
	background-repeat: no-repeat;
	/* margin-top: 15px; */
}

#srv_status ul li{
	background-color: transparent !important;
}

.card_side{
	z-index: 1;
	position: relative;
	margin-bottom: 20px;
	margin-top: -117px;
}
.card_side .face_side{
	width: 100%;
	height: 60px;
	transition:.4s; 
}

.card_side .card_side_img{
	position: relative;
	z-index: 1;
	margin-bottom: 15px;
}

.card_side .card_side_img a{
	position: relative;
	text-align: center;
	display: flex;
	justify-content:center;
	align-items:center; 
}

.card_side .card_side_img a img{
	/* transition: 1s; */
}
.card_side .card_side_img a .img_play_in,
.card_side .card_side_img a:hover .img_play_out{
	display: none;
	opacity: 0;
}
.card_side .card_side_img a .img_play_out, 
.card_side .card_side_img a:hover .img_play_in{
	display: block;
	opacity: 1;
}

.card_side .card_side_img a span{
	position: absolute;
	font-size: 18px;
	font-weight: bold;
	color: #ede9e9;
}

.card_side .face_side.face_side1{
	position: relative;
	background: #333;
	display: flex;
	justify-content: center;
	align-content:center;
	align-items: center;
	z-index: 1;
	margin-bottom:20px;
	cursor: pointer;
	border-radius: 15px;
	
	/* box-shadow:
		inset 0 0 40px whitesmoke,
		inset 20px 0 60px #0087ff,
		inset -20px 0 60px #0ff,
		inset 20px 0 100px #f0f,
		inset -20px 0 100px #0ff,
		0 0 50px #fff,
		-10px 0 80px #3800ff,
		10px 0 80px #0ff; */
	
	background-color: #6a93d0;
	border: 2px solid transparent;
	border-color: #5b56c1;
	box-shadow:
		inset 0 0 20px whitesmoke,
		inset 10px 0 15px #0087ff,
		inset -10px 0 15px #0ff,
		inset 10px 0 30px #f0f,
		inset -10px 0 30px #0ff,
		0 0 35px #fff,
		-5px 0 50px #3800ff,
		5px 0 20px #0ff;
	
	background-image: -webkit-linear-gradient(top, #589bff 0%, #6c6ac0 100%);
	background-image: -o-linear-gradient(top, #589bff 0%, #6c6ac0 100%);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#589bff), to(#6c6ac0));
	background-image: linear-gradient(to bottom, #589bff 0%, #6c6ac0 100%);

	/* border: 1px solid #00b7ff; */
	/* transform: translateY(100px); */
}
.card_side .face_side.face_side1:hover{
	/* transform: translateY(0); */
	box-shadow: 
		inset 0 0 20px whitesmoke,
		inset 10px 0 15px #0ff,
		inset -10px 0 15px #0ff,
		inset 10px 0 30px #0cbe5a,
		inset -10px 0 30px #0ff,
		0 0 35px #fff,
		-5px 0 50px #09c226,
		5px 0 20px #0ff; 
}

.card_side .face_side.face_side1 .content{
	/* opacity: .2; */
	transition:  0.5s;
	text-align: center; 

}
.card_side .face_side.face_side1:hover .content{
/* opacity: 1; */ 
}
.card_side .face_side.face_side1 .content i{
	font-size: 3em;
	color: white;
	display: inline-block; 
}
.card_side .face_side.face_side1 .content h3{
	font-size: 1em;
	color: white;
	text-align: center; 
	margin:0px;
}
.card_side .face_side.face_side1 .content a{
	transition: .5s;
}

@keyframes cloud_animate{
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

img.image_logo{
    width: 350px; 
}

.cover_loading {
	display: none;
}

.no-js .cover_loading {
	content: '';
	display: inline-flex;
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: #444;
	z-index: 999;
	display: flex;
	justify-content: center;
	align-items: center;
}

@font-face {
	font-family: 'Apercu Pro';
	src: url(<?php print_r(base_url('assets/frontpage/font/apercu/ApercuPro.eot?#iefix')) ?>);
	src: url('<?php print_r(base_url('assets/frontpage/font/apercu/ApercuPro.eot?#iefix')) ?>') format('embedded-opentype'), url(<?php print_r(base_url('assets/frontpage/font/apercu/ApercuPro.woff2')) ?>) format('woff2'), url(<?php print_r(base_url('assets/frontpage/font/apercu/ApercuPro.woff')) ?>) format('woff'), url(<?php print_r(base_url('assets/frontpage/font/apercu/ApercuPro.ttf')) ?>) format('truetype');
	font-weight: 400;
	font-style: normal
}

html {
	height: 100%;
	margin: 0
}

body {
	font-family: 'Apercu Pro' !important;
	display: flex;
	flex-direction: column;
	width: 100%;
	min-height: 100vh;
	color: #000 !important;
	background-image: url("<?= base_url('assets/frontpage/img/bg.png') ?>");
	background-repeat: no-repeat;
	background-position: top;
	background-size: cover;
	padding-right: 0 !important;
    position: relative;
    overflow-x: hidden;
}

main { 
	flex-grow: 1;
	width: 100%;
	padding: 0;
	/* margin-bottom: 10px !important; */
	min-height: 50vh;
    /* background-color: #f1f1f1; */
    /* background-color: rgb(163, 208, 248); */
    /* background-color: rgb(233 247 255); */
    background-color: rgb(151, 213, 253);
}

p {
	margin: 0 !important;
	padding: 0 !important
}

.h1,
h1 {
	font-size: 1rem !important
}

a:hover,
a:visited {
	text-decoration: none !important
}

.main_content {
	/* background-color: #ffffff; */
	background-color: rgba(255, 255, 255, 0.85);
	box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2) !important;
	/* margin-top: -20px; */
	position: relative;
    z-index: 1;
}

.bg-blue-gradient {
    /* background-image: linear-gradient(to right, #ff00ff, #ea00f9, #d500f2, #c000eb, #ab00e4, #8741f3, #5b5bfc, #006cff, #0090ff, #00adff, #00c7ff, #00deff); */
    background-image: -webkit-linear-gradient(to right, #ca0000, #ca0000) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background-image: linear-gradient(to right, #ca0000, #ca0000) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2) !important;
}
.parent_nav{
    background-color: transparent !important;
    border:none !important;
}
.main_left_section{
    position: relative;
    margin-top: -185px;
}
.main_child_left_section{
    min-height: 215px;
} 

@media (max-width: 1560px) {
	.bottom_background{
		background-position: 0 -170px;
	}
}
@media (max-width: 1460px) {
	.bottom_background{
		background-position: 0 -130px;
	}
}
@media (max-width: 1375px) {
	.bottom_background{
		background-position: bottom;
	}
}
@media (max-width: 1290px) {
	.parent_banner{ 
        height:400px; 
        background-position: 0 -270px;
        /* background-position: bottom; */ 
    }
    .parent_banner img.image_logo_char{ 
        width: 300px; 
        bottom: 15px;
    }
}
@media (max-width: 1199px) {
	.parent_banner{ 
        height:400px; 
        background-position: 0 -270px;
        /* background-position: bottom; */ 
    }
    .parent_banner img.image_logo_char{ 
        width: 300px; 
        bottom: 15px;
    }
    .parent_form_login{
        margin-top: 50px !important;
    }
}
@media (max-width: 1015px) {
    .parent_banner{ 
        background-position: bottom; 
    }
}
@media (max-width: 991px) {
	.main_content{ 
        max-width: 100% !important; 
    }
    .main_left_section{
        top: 0;
        margin-top: 15px;
    }
    .main_child_left_section{
        min-height: 0px;
    }
    .parent_main_navbar .container,
	.page-footer .container{
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }
	.parent_copyright{
		padding-left:15px !important;
	}
	.parent_social{
		padding-right:15px !important;
	}
    .left_main_navbar{
        width: 0px !important;
        min-width: 0px !important;
        max-width: 0px !important;
    }
    .right_main_navbar{
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }
}

@media (max-width: 950px) {
	
	.parent_copyright{
		display:none;
	}
	.parent_social{
		display:none;
	}
	
	.parent_left_main_content {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
        margin-bottom: 0;
	}
    .main_left_section{
        display: flex !important;
        flex-direction: column;
    }
    #srv_form_login{
        order: 1;
    }
    #srv_status{
        order: 2;
    }
    #srv_hot_items{
        order: 3;
    }
    #srv_rank{
        order: 4;
    }
	.parent_right_main_content {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
	}
    .main_child_left_section{
        /* width: 50%; */
        display: none;
    }
    .parent_form_login{
        margin-top: 30px !important;
    }
    .parent_banner img.image_logo_mobile{
        position: absolute;
        display: block;
        width: 250px;
        bottom: 15px;
        z-index: 1;
    }
}

@media (max-width: 767px) {
	
	.parent_nav nav.navbar{
		display: none;
	} 
    .right_main_navbar .parent_nav{
        display: block !important; 
    }
    .right_main_navbar .parent_nav ul{
        display: flex !important;
        flex-direction: row;
    }
    .right_main_navbar .parent_nav ul li:nth-last-child(1),
    .right_main_navbar .parent_nav ul li:nth-last-child(3){
        display: none;
    }

    .parent_banner img.image_logo_mobile{ 
        width: 200px; 
    }
	.parent_banner img.image_logo_char {
		width: 250px; 
	}
}
@media (max-width: 690px) {
	.parent_banner img.image_logo_char {
		width: 220px; 
	}
    .parent_banner img.image_logo_mobile{
        position: absolute;
        display: block;
        width: 180px;
        bottom: 15px;
        z-index: 1;
    }
}

@media (max-width: 600px) {
	.parent_banner img.image_logo_char {
        display: none;
	}
    .parent_banner img.image_logo_mobile{  
        width: 250px;
        bottom: 35px;
        left: 0;
        right: 0;
        margin: auto;
    }
}
@media (max-width: 575px) {
	.main_content {
		/* margin-top: -10px; */
	}
}

@keyframes click-wave {
	0% {
		height: 40px;
		width: 40px;
		opacity: .35;
		position: relative
	}
	100% {
		height: 200px;
		width: 200px;
		margin-left: -80px;
		margin-top: -80px;
		opacity: 0
	}
}

.option-input {
	font-family: Roboto, sans-serif;
	-webkit-appearance: none;
	-moz-appearance: none;
	-ms-appearance: none;
	-o-appearance: none;
	appearance: none;
	position: relative;
	top: 13.33333px;
	right: 0;
	bottom: 0;
	left: 0;
	height: 40px;
	width: 40px;
	transition: all .15s ease-out 0s;
	background: #cbd1d8;
	border: none;
	color: #fff;
	cursor: pointer;
	display: inline-block;
	margin-right: .5rem;
	outline: 0;
	position: relative;
	z-index: 990
}

.option-input:hover {
	background: #9faab7
}

.option-input:checked {
	background: #40e0d0
}

.option-input:checked::before {
	height: 40px;
	width: 40px;
	position: absolute;
	content: '✔';
	display: inline-block;
	font-size: 26.66667px;
	text-align: center;
	line-height: 40px
}

.option-input:checked::after {
	-webkit-animation: click-wave .65s;
	-moz-animation: click-wave .65s;
	animation: click-wave .65s;
	background: #40e0d0;
	content: '';
	display: block;
	position: relative;
	z-index: 100
}

.option-input.radio {
	border-radius: 50%
}

.option-input.radio::after {
	border-radius: 50%
}

.img-ras {
	max-height: 200px !important
}

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha256-rByPlHULObEjJ6XQxW/flG2r+22R5dKiAoef+aXWfik=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" integrity="sha256-JHGEmB629pipTkMag9aMaw32I8zle24p3FpsEeI6oZU=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" />
<!--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/css/bootstrap-select.min.css" integrity="sha256-jwJEU4p1YdtymLFwAjYfam5Pj5NOnylms63k7LYQ9Jk=" crossorigin="anonymous">
-->

<link rel="stylesheet" href="<?php print_r(base_url('assets/frontpage/css/frontpage.min.css')) ?>" />