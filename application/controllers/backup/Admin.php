<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/AdminController.php';
class Admin extends AdminController {
    public function __construct()
    {
		parent::__construct();
		error_reporting(0);
		$this->isLoggedIn();
	}

	function dashboard(){
		$this->global['im'] = $this->db->query('SELECT itemid FROM itemmall')->num_rows(); 
		$this->global['im_piece'] = $this->db->query('SELECT id FROM itemmall_piece')->num_rows(); 
		$this->global['php_name'] = 'dashboard';
	    $this->loadPage();
	}

	function new_im(){
		$this->global['php_name'] = 'new_im';
		$this->global['category'] = $this->db->query('SELECT * FROM itemcategory')->result_array(); 
	    $this->loadPage();
	}

	function im_list(){
		$this->global['php_name'] = 'im_list';
		$on = "im.itemtype = ic.id";
		$cat = "ic.categoryname";
		$this->global['im_list'] = $this->db->query("SELECT itemid,itemname,status,$cat as category FROM itemmall im JOIN itemcategory ic on $on ORDER BY itemid DESC")->result_array();
	    $this->loadPage();
	}

	function im_piece_list(){
		$this->global['php_name'] = 'im_piece_list';
		$on = "pc.itemid = im.itemid";
		$im_name = "im.itemname";
		$this->global['piece_list'] = $this->db->query("SELECT id,name,price,$im_name as itemname FROM itemmall_piece pc JOIN itemmall im on $on ORDER BY id DESC")->result_array();
	    $this->loadPage();
	}

	function new_im_piece($im_id){
		$this->global['php_name'] = 'new_im_piece';
		$this->global['im_id'] = $im_id;
	    $this->loadPage();
	}
	
	function donate(){
		$this->load->model("admin_model");
      	$this->global['donate_price_list'] = $this->admin_model->donate_price_list();
      	$this->global['donate_list'] = $this->admin_model->donate_list();
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'donate';
	    $this->loadPage();
	}

	function referral(){
		$this->load->model("admin_model"); 
      	$this->global['referral_list'] = $this->admin_model->referral_list();
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'referral';
	    $this->loadPage();
	}

	function referral_history(){
		$this->load->model("admin_model"); 
      	$this->global['referral_history_list'] = $this->admin_model->referral_history_list();
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'referral_history';
	    $this->loadPage();
	}

	function new_referral(){
		$this->load->model("admin_model");
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'new_referral';
	    $this->loadPage();
	}

	function edit_referral($id){
		if(empty($id)){
			setFlashData('error', 'ID tidak boleh kosong..');
			redirect('adm/referral');
		}
		$this->load->model("admin_model");
      	$get_referral = $this->admin_model->referral_list(array(
			'rc.id'=>$id
		));
		if(empty($get_referral)){
			setFlashData('error', 'Referral tidak ditemukan..');
			redirect('adm/referral');
		}
		$this->global['get_referral'] = $get_referral[0];
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'new_referral';
	    $this->loadPage();
	}

	function topup(){
		$this->global['php_name'] = 'topup';
	    $this->loadPage();
	}

	function topup_log(){
		$this->global['php_name'] = 'topup_log';
		$this->load->model('im_model');
		$this->global['topup_log'] = $this->im_model->topup_log();
	    $this->loadPage();
	}

	function send_item(){
		$this->global['php_name'] = 'send_item';
	    $this->loadPage();
	}

	
	function media(){
      	$this->global['media_list'] = $this->db->get('media')->result_array();
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'media';
	    $this->loadPage();
	}

	function new_media(){
		$this->global['php_name'] = 'new_media';
	    $this->loadPage();
	}
	
	function media_edit($id){
		if(empty($id)){
			setFlashData('error', 'ID tidak boleh kosong..');
			redirect('adm/media');
		}
		$this->load->model("admin_model");
      	$get_media = $this->db->get_where('media',array(
			'id'=>$id
		))->row_array();
		if(empty($get_media)){
			setFlashData('error', 'Media tidak ditemukan..');
			redirect('adm/media');
		}
		$this->global['get_media'] = $get_media;
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'new_media';
	    $this->loadPage();
	}

	function new_article(){
		$this->global['php_name'] = 'new_article';
	    $this->loadPage();
	}

	function article_list(){
		$this->global['php_name'] = 'article_list';
		$this->global['article_list'] = $this->db->query('SELECT * FROM news ORDER BY id DESC')->result();
	    $this->loadPage();
	}

	function article_edit($article_id){
		$this->global['php_name'] = 'article_edit';
		$this->global['article'] = $this->db->query("SELECT * FROM news WHERE id = $article_id ")->row_array();
	    $this->loadPage();
	}

	function account_list(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			$this->denied();
		}else{
			$this->global['account_list'] = $this->db->query('SELECT * FROM tbl_admin')->result();
			$this->global['php_name'] = 'account_list';
		    $this->loadPage();
		}
	}

	function g_account_list(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			$this->denied();
		}else{
    		$this->db = dbloader("LUNA_MEMBERDB");
    		$this->global['adm_list'] = $this->db->query("SELECT * FROM game_role")->result();
    		$on = "a.UserLevel = b.usr_role";
			$this->global['account_list'] = $this->db->query("SELECT id_idx,id_loginid,UserLevel,b.title as title FROM chr_log_info a JOIN game_role b on $on WHERE UserLevel < 6")->result();
			$this->global['php_name'] = 'g_account_list';
		    $this->loadPage();
		}
	}

	function add_source(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			$this->denied();
		}else{
			$this->global['php_name'] = 'add_source';
		    $this->loadPage();
		}
	}
}