<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel='stylesheet' id='rs-plugin-settings-css'  href='<?= base_url(); ?>assets/plugins/revslider/public/assets/css/rs6.css?ver=6.2.8' type='text/css' media='all' />

<style type="text/css">
/* start tabs */
.project-tab {
	padding-top: 15px;
}
.project-tab #tabs{
    background: #007b5e;
    color: #eee;
}
.project-tab #tabs h6.section-title{
    color: #eee;
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
    color: #0062cc;
    font-size: 16px;
    font-weight: 600;
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
	padding: 13px 0px; 
	display: flex;
	background-image: linear-gradient(to right, #90aef0, #36d1dc) !important;
	box-shadow: 0 4px 15px 0 rgba(65, 132, 234, 0.75);
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
		flex-direction: column;
		padding-top: 40px;
		padding-bottom: 40px;
	}
	.clock-col + .clock-col {
		margin-top: 20px;
	}
	.clock-col:before,
	.clock-col:after {
		display: none!important;
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
	transform: translate(-50%);
} 
ul.social-icons li{
	margin-bottom: 0;
}
ul.social-icons li:nth-last-child(1) {
	margin-right:0;
}

/* start button  */

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
	background: #111845a6;
	box-sizing: border-box;
	overflow: hidden;
	box-shadow: 0 20px 50px rgb(23, 32, 90);
	border: 2px solid #2a3cad;
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
	background: #50dfdb;
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
    background: url(<?= base_url('assets/frontpage/img/top_banner_1.png') ?>);
    height:500px;
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
	background-image: url("https://mythicluna.com/assets/frontpage/img/bg.png");
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
    background-color: rgb(177, 242, 244);
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
	background-color: #f1f1f1;
	/* margin-top: -20px; */
	position: relative;
    z-index: 1;
}

.nav-item:hover{
    background: #0000001a;
}
.nav-item.current {
    background: #0000001a !important;
}

.bg-blue-gradient {
    /* background-image: linear-gradient(to right, #ff00ff, #ea00f9, #d500f2, #c000eb, #ab00e4, #8741f3, #5b5bfc, #006cff, #0090ff, #00adff, #00c7ff, #00deff); */
    background-image: -webkit-linear-gradient(to right, #90aef0, #36d1dc) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background-image: linear-gradient(to right, #90aef0, #36d1dc) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    box-shadow: 0 0.150rem 0.50rem rgba(0,0,0,.2) !important;
}
.parent_nav{
    background-color: transparent !important;
    border:none !important;
}
.main_left_section{
    position: relative;
    top: -220px;
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