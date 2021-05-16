<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';
class Frontpage extends FrontLib {
	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->is_login();
		$this->xepo_secure();
	}
	function homepage(){
		$a = $this->session->userdata('usr_code'); 
		$this->load->model('frontpage_model');
		$this->global['s_media'] = $this->frontpage_model->getMedia('s',4);
		$this->global['news'] = $this->frontpage_model->top_news();
		$this->global['php_name'] = "homepage";
		$this->loadViews();
	}
	function register(){
		$this->global['php_name'] = "usr_register";
		$this->loadViews();
	}
	function login(){
		$this->global['php_name'] = "usr_login";
		$this->loadViews();
	}
	function media(){
		$this->load->model("frontpage_model");
		$this->global['s_media'] = $this->frontpage_model->getMedia('s',8);
      	$this->global['w_media'] = $this->frontpage_model->getMedia('w',8);
		$this->global['php_name'] = "media";
		$this->loadViews();
	}
	function dwn(){
		//https://drive.google.com/uc?id=1_dfa7xg4GsGO4OA7rqzwRzg6Fj42t_l-&export=download
		$this->load->library('gdrive_read');
		$token = $this->gdrive_read->a_token();
    	$url= file_get_contents("https://www.googleapis.com/drive/v2/files/1Rc2AavOHyjzlY_wQY9D2g0WcG2s3iL3H?fields=downloadUrl&access_token=$token");
		$result = json_decode($url,true);
		$download_url = $result['downloadUrl']."&access_token=".$token;
		header("Location:".$download_url);
	}
	function shop(){
		//setFlashData('popup', 'berhasil membeli item..');
		//setFlashData('shop', 'error');
		//setFlashData('shop', 'success');
		$this->global['php_name'] = "shop";
		$this->loadViews();
	}
	function rank(){
		$this->load->model("frontpage_model");
      	$this->global['level_rank'] = $this->frontpage_model->getPlayerRank('level',50);
      	$this->global['guld_rank'] = $this->frontpage_model->getPlayerRank('guild',50);
      	// $this->global['cs_rank'] = $this->frontpage_model->getPlayerRank('cs',50);
		$this->global['php_name'] = "rank";
		$this->loadViews();
	}
	function donate(){
		$user_id = $this->propid;
		if(empty($user_id)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		} 
		$this->load->model("frontpage_model");
      	$this->global['donate_price_list'] = $this->frontpage_model->donate_price_list();
      	$this->global['donate_list'] = $this->frontpage_model->donate_list($user_id);
		$this->global['account_number'] = $this->getConfigWeb()['account_number'];
		$this->global['php_name'] = "donate";
		$this->loadViews();
	}
	function page($url){
		$url = urldecode($url);
		$this->load->model('frontpage_model');
		$this->global['data'] = $this->frontpage_model->page($url);
		$this->global['php_name'] = "page";
		$this->loadViews();
	}
	function news($url){
		$this->load->model('frontpage_model');
		$this->global['data'] = $this->frontpage_model->news($url);
		$this->global['php_name'] = "news";
		$this->loadViews();
	}
	function topup_history(){
		$user_idx = $this->propid;
		if(empty($user_idx)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		}
		$this->load->model('im_model');
		$this->global['his'] = $this->im_model->topup_log($user_idx);
		$this->global['php_name'] = "history";
		$this->loadViews();
	}
	function teleport(){
		$user_idx = $this->propid;
		if(empty($user_idx)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		}
		$this->load->model('member_model');
		$this->global['data'] = $this->member_model->chr_teleport($user_idx);
		$this->global['php_name'] = "teleport";
		$this->loadViews();
	}
	function pin_req(){
		$user_idx = $this->propid;
		if(empty($user_idx)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		}else{
			$this->global['php_name'] = "pin_req";
			$this->loadViews();
		}
	}

	function change_pin($rand_code){
		$user_idx = $this->propid;
		if(empty($user_idx)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		}else{
			$this->global['php_name'] = "change_pin";
			$this->global['rand_code'] = $rand_code;
			$this->loadViews();
		}
	}

	function change_pwd(){
		$user_idx = $this->propid;
		if(empty($user_idx)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		}else{
			$this->global['php_name'] = "change_pwd";
			$this->loadViews();
		}
	}
}