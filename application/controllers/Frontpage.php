<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';
class Frontpage extends FrontLib {
	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->is_login();
		$this->xepo_secure();
		
		$popup = $this->session->flashdata('popup');
		$stat = $this->session->flashdata('shop');
		if($popup){
			$this->session->set_flashdata('popup',$popup);
		}
		if($stat){
			$this->session->set_flashdata('shop',$stat);
		} 
	}
	
	function overviewpage(){
		$this->load->model('frontpage_model');
		$config_web = $this->getConfigWeb(true);
		$this->global['data_overview'] = $this->frontpage_model->getOverview(array(
			'is_active'=>'yes'
		)); 
		$this->global['config_web'] = $config_web;
		$this->global['php_name'] = "overview_page";
		$this->loadViews();
	}
	function overview_page($url = 'server_information'){
		if($url !== 'server_information'){
            redirect(base_url());
		}
		// $url = urldecode($url);
		// $this->load->model('frontpage_model');
		// $this->global['data'] = $this->frontpage_model->page($url);
		// $this->global['php_name'] = "page";
		$config_web = $this->getConfigWeb(true);
		$this->global['config_web'] = $config_web;
        $this->load->view('app/overview_page', $this->global);
	}

	function homepage(){
		// if(!$this->session->userdata('first_overview_page')){
		// 	$this->session->set_userdata('first_overview_page',true);
        //     redirect(base_url('overview/server_information'));
		// }
		$a = $this->session->userdata('usr_code'); 
		$this->load->model('frontpage_model');
		$this->global['s_media'] = $this->frontpage_model->getMedia('s',4);

		// $this->global['news'] = $this->frontpage_model->top_news(); 
		$this->global['news'] = $this->frontpage_model->getNews('News',4);
		$this->global['news_event'] = $this->frontpage_model->getNews('Event',4);
		$this->global['news_server_info'] = $this->frontpage_model->getNews('Server Info',4);
		$this->global['news_item_mall'] = $this->frontpage_model->getNews('Item Mall',4);

		$this->global['php_name'] = "homepage";
		$this->loadViews();
	}
	function register(){
		$this->global['php_name'] = "usr_register";
		$this->loadViews();
	}
	function login(){
		// redirect to home
		redirect(base_url());

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
	function shop($open_to=null){
		//setFlashData('popup', 'berhasil membeli item..');
		//setFlashData('shop', 'error');
		//setFlashData('shop', 'success');

		$this->load->library('shop_lib');
		$this->load->model("im_model");
		$this->load->model("frontpage_model");

		// $get_new = $this->im_model->im_best_list_by(3,'itemid');
		$get_hot = $this->im_model->im_best_list_by(5,'counter');

		$shop_hot_items = array();
		foreach ($get_hot as $idx => $val) {
			foreach ($val as $idx2 => $val2) {
				$mark_name = "hot";
				$id_item = $val2['itemid'];
				$get_im = $this->shop_lib->im_maker($val2, $mark_name);
				if(!empty($get_im)){
					$shop_hot_items[] = $get_im;
				}
			}
		}

		$this->global['im_category'] = $this->frontpage_model->getIMCategory();
		$this->global['shop_hot_items'] = $shop_hot_items;
		$this->global['open_to'] = $open_to;

		$this->global['php_name'] = "shop";
		$this->loadViews();
	}
	
	function user(){
		$user_id = $this->propid;
		if(empty($user_id)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		}  
		$this->load->model("frontpage_model");
		$this->global['get_user'] = $this->main_m->getWhereUser(array(
			'id'=>$user_id
		))->row_array();
      	$this->global['referral_history_list'] = $this->frontpage_model->referral_history_list(array(
			'uu.id' => $user_id
		),array(
			'u.id' => $user_id
		)); 
		$this->global['php_name'] = "user";
		$this->loadViews();
	}

	function daily_login(){
		// redirect to home
		redirect(base_url());

		$user_id = $this->propid;
		if(empty($user_id)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		} 
		$this->load->model("frontpage_model");
		$this->global['php_name'] = "daily_login";
		$this->db->order_by('checkin_day','ASC');
		$this->global['daily_checkin_items'] = $this->db->get_where("daily_checkin_item",array(
			'is_active'=>'yes',
		))->result_array(); 
		$this->global['get_user'] = $this->main_m->getWhereUser(array(
			'id'=>$user_id
		))->row_array();
		
      	$get_char = $this->frontpage_model->getCharacter(array(
			'USER_IDX' => $user_id,
			'CHARACTER_MAXGRADE >=' => 120,
		));
		if(count($get_char) == 0){
        	// $this->session->set_flashdata('error', 'If you want daily check in at least you must have char level 120.');
            // redirect(base_url());
		} 
		
		$check_available_checkin_item = $this->db->query("SELECT * FROM daily_checkin_item where checkin_day > ".$this->global['get_user']['last_checkin_day']." and is_active='yes' order by checkin_day ASC LIMIT 1")->row_array();
		if(count($check_available_checkin_item) == 0){ 
        	// $this->session->set_flashdata('error', 'Daily Checkin Item is not found.');
            // redirect(base_url());
		}
		$this->global['count_daily_checkin_item'] = count($check_available_checkin_item);
		$this->global['available_checkin'] = true;
		$date_now = date('Y-m-d', strtotime($GLOBALS['date_now'])); 
		$available_checkin_date = $this->plus_min_date($this->global['get_user']['last_checkin_date'],["+1 day","Y-m-d"]);
		$this->global['available_checkin_date'] = date('d M Y', strtotime($available_checkin_date));
		if(!empty($this->global['get_user']['last_checkin_date'])){
			if($available_checkin_date > $date_now){
				$this->global['available_checkin'] = false;
			}
		}
		
		$this->global['checkin_day'] = $this->global['get_user']['last_checkin_day'];
		
		$this->loadViews();
	}
	function rank(){
		$this->load->model("frontpage_model");
      	$this->global['level_rank'] = $this->frontpage_model->getPlayerRank('level',15);
      	$this->global['guld_rank'] = $this->frontpage_model->getPlayerRank('guild',15);
      	$this->global['cs_rank'] = $this->frontpage_model->getPlayerRank('cs',2);
		$this->global['php_name'] = "rank";
		$this->loadViews();
	}
	function acc_history(){
		$user_id = $this->propid;
		if(empty($user_id)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		} 

		$this->load->model("frontpage_model");
		
		$this->db = dbloader("default"); 
		$this->db->trans_begin();

        $get_donate = $this->db->query("
            SELECT 
                * 
            from 
                donate_duitku 
            where 
                user_id = '".$user_id."' AND 
                status = 'pending' AND 
                NOW() >= expiry_period 
        ");
        
        $res_donate = $get_donate->result_array();
        $count_donate = count($res_donate);

        if($count_donate>0){
            foreach ($res_donate as $key) {
                $this->db->update('donate_duitku', array(
                    'canceled_date' => $GLOBALS['date_now'],
                    'status' => 'expired',
                ),array(
                    'id'=>$key['id']
                ));
            }
        }

        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        	$this->session->set_flashdata('error', 'Failed to update donate history.');
        }  
        $this->db->trans_commit();
		
      	$this->global['donate_list'] = $this->frontpage_model->donate_list($user_id);
		$this->global['account_number'] = $this->getConfigWeb()['account_number'];
		$this->global['php_name'] = "acc_history";
		$this->loadViews();
	}
	function donate(){
		// $this->global['php_name'] = "donate_test";
		// $this->loadViews();
		// return;

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

	function change_email(){
		$user_idx = $this->propid;
		if(empty($user_idx)){
        	$this->session->set_flashdata('error', 'Please login first.');
            redirect(base_url());
		}else{
			$this->global['php_name'] = "change_email";
			$this->loadViews();
		}
	}
}