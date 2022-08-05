<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/AdminController.php';
class Admin extends AdminController {
    public function __construct()
    {
		parent::__construct();
		error_reporting(0);
		$this->isLoggedIn();
	}

	function checkin_item($id=null){
		$this->global['php_name'] = 'checkin_item';
		$get_last_checkin_day = $this->db->query('
			SELECT 
				checkin_day 
			FROM 
				daily_checkin_item 
			WHERE 
				checkin_month = "'.date('m').'" 
				AND checkin_year = "'.date('Y').'" 
			ORDER BY 
				checkin_day DESC 
			LIMIT 1
		')->row_array(); 
		$this->global['get_last_checkin_day'] = 1;
		if(count($get_last_checkin_day)>0){
			$this->global['get_last_checkin_day'] = $get_last_checkin_day['checkin_day']+1;
		}
		if($id>0){
			$get_checkin = $this->db->get_where('daily_checkin_item',array(
				'id'=>$id
			))->row_array();
			if(empty($get_checkin)){
				setFlashData('error', 'Daily Checkin Item is not found');
				redirect('adm/checkin_item_list');
			}
			$this->global['get_checkin'] = $get_checkin;
			$this->global['get_last_checkin_day'] = $get_checkin['checkin_day'];
		}
	    $this->loadPage();
	}

	function checkin_item_list(){
		$this->global['php_name'] = 'checkin_item_list';
		$this->global['checkin_item_list'] = $this->db->query("SELECT * FROM daily_checkin_item ORDER BY checkin_day DESC")->result_array();
	    $this->loadPage();
	}

	function checkin_history(){
		$this->global['php_name'] = 'checkin_history';
		$this->db->select('dc.*, u.username, dci.name as item_name');
		$this->db->order_by('dc.created_date','DESC');
        $this->db->join('tbl_user as u', 'u.id = dc.user_id', 'inner');
        $this->db->join('daily_checkin_item as dci', 'dci.id = dc.checkin_item_id', 'inner');
		$this->global['checkin_history'] = $this->db->get("daily_checkin dc")->result_array();
	    $this->loadPage();
	}

	function dashboard(){
		$this->global['im'] = $this->db->query('SELECT itemid FROM itemmall')->num_rows(); 
		$this->global['im_piece'] = $this->db->query('SELECT id FROM itemmall_piece')->num_rows(); 
		$this->global['php_name'] = 'dashboard';
	    $this->loadPage();
	}

	function my_profile(){ 
		$this->global['user_admin'] = $this->db->get_where('tbl_admin',array(
			'id'=>$this->userId
		))->row_array();
		$this->global['config_web'] = $this->getConfigWeb();  
		$this->global['php_name'] = 'my_profile';
	    $this->loadPage();
	} 
	
	function web_config(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		
		$this->load->model("admin_model");
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'web_config';
	    $this->loadPage();
	}

	function char_list(){
		$this->load->model("admin_model");
		$this->global['config_web'] = $this->getConfigWeb();

		$this->db->select('
			*
		'); 
		$this->db->order_by('u.star_point','desc');
		// $this->db->select('u.*, rc.referral_code');
		// $this->db->join('referral_code rc','rc.user_id=u.id','left');
		$this->global['tbl_user'] = $this->db->get("tbl_user u")->result_array();
		$this->global['php_name'] = 'char_list';
	    $this->loadPage();
	} 

	function char($id){
		$this->load->model("admin_model");
		$this->global['config_web'] = $this->getConfigWeb();

		$this->db->select('
			*
		'); 
		$this->db->order_by('star_point','desc');
		$this->db->where('id',$id);
		$this->global['tbl_user'] = $this->db->get("tbl_user")->row_array();
		
		$this->global['php_name'] = 'char';
	    $this->loadPage();
	} 
	
	function send_item_log(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		
		$this->load->model("admin_model");
		$this->global['config_web'] = $this->getConfigWeb();

		$this->db->select('sl.*, a.email email_admin');
		$this->db->order_by('sl.created_date','DESC'); 
        $this->db->join('tbl_admin as a', 'a.id = sl.admin_id', 'inner');
		$this->global['send_item_log'] = $this->db->get("send_item_log sl")->result_array();

		$this->global['php_name'] = 'send_item_log';
	    $this->loadPage();
	} 

	function collapse_page(){
		redirect('');
		$this->load->model("admin_model");
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'collapse_page';
	    $this->loadPage();
	}
	
	function im_log(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'im_log';
		$this->db->order_by('id','desc');
		$this->db->select('
			il.id,
			u.username,
			il.itemid,
			im.itemname,
			il.price,
			il.qty,
			imd.nama disc,
			il.total_price,
			il.date
		');
        $this->db->join('tbl_user as u', 'u.id = il.user_idx', 'inner');
        $this->db->join('itemmall as im', 'im.itemid = il.itemid', 'inner');
        $this->db->join('itemmall_discount as imd', 'imd.id = il.discount_id', 'left');
		$this->global['im_log_list'] = $this->db->get("itemmall_log as il")->result_array();

		$this->db->group_by('im.itemname');
		$this->db->order_by('sum(il.qty)','desc');
		$this->db->order_by('sum(il.total_price)','desc');
		$this->db->select('
			im.itemname,
			sum(il.qty) total_qty,
			sum(il.total_price) total_all_price 
		');
        $this->db->join('tbl_user as u', 'u.id = il.user_idx', 'inner');
        $this->db->join('itemmall as im', 'im.itemid = il.itemid', 'inner');
        $this->db->join('itemmall_discount as imd', 'imd.id = il.discount_id', 'left');
		$this->global['im_log_total_list'] = $this->db->get("itemmall_log as il")->result_array();
	    $this->loadPage();
	}
	function new_im(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'new_im';
		$this->global['category'] = $this->db->query("SELECT * FROM itemcategory where is_active='yes'")->result_array(); 
	    $this->loadPage();
	}
	function im_edit($im_id){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'edit_im';
		$this->global['category'] = $this->db->query("SELECT * FROM itemcategory where is_active='yes'")->result_array(); 

		$on = "im.itemtype = ic.id";
		$cat = "ic.categoryname";
		$this->global['get_im'] = $this->db->query("SELECT im.*, $cat as category FROM itemmall im  JOIN itemcategory ic on $on where ic.is_active='yes' and itemid='$im_id' ORDER BY itemid DESC")->row_array();

	    $this->loadPage();
	}

	function im_list(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'im_list';
		$on = "im.itemtype = ic.id";
		$cat = "ic.categoryname";
		$this->global['im_list'] = $this->db->query("SELECT itemid,itemname,status,$cat as category FROM itemmall im JOIN itemcategory ic on $on where ic.is_active='yes' ORDER BY itemid DESC")->result_array();
	    $this->loadPage();
	}

	function im_piece_list(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'im_piece_list';
		$on = "pc.itemid = im.itemid";
		$im_name = "im.itemname";
		$this->global['piece_list'] = $this->db->query("SELECT id,name,price,$im_name as itemname FROM itemmall_piece pc JOIN itemmall im on $on ORDER BY id DESC")->result_array();
	    $this->loadPage();
	}

	function new_im_piece($im_id){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'new_im_piece';
		$this->global['im_id'] = $im_id;
	    $this->loadPage();
	}
	
	function im_piece_edit($id){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'edit_im_piece';
		$on = "pc.itemid = im.itemid";
		$im_name = "im.itemname";
		$this->global['get_piece'] = $this->db->query("SELECT pc.*, $im_name as itemname FROM itemmall_piece pc JOIN itemmall im on $on where id='$id' ORDER BY id DESC")->row_array();
		$this->global['im_id'] = $this->global['get_piece']['itemid'];
	    $this->loadPage();
	}
	
	function donate(){ 
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->load->model("admin_model");
      	$this->global['donate_price_list'] = $this->admin_model->donate_price_list();
      	$this->global['donate_list'] = $this->admin_model->donate_list(); 
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'donate';
	    $this->loadPage();
	}
	
	function game_trade_log($val_day=''){  
		if($this->session->userdata('open-admin-hidden') !== true){
			redirect('adm'); 
		}

		$this->load->model("admin_model"); 

		$case = $this->secureGet('kategori', true);
		$top_gold = $this->secureGet('top_gold', true);
		$username = $this->secureGet('username', true);
		$item_name = $this->secureGet('item_name', true); 
 
		$this->global['val_top_gold'] = $top_gold;
		$this->global['val_item_name'] = $item_name;
		if(empty($val_day)){
			$val_day = date('Y-m-d');
		}
		if(empty($val_day)){
			$case = 'all';
		}
		$this->global['val_day'] = $val_day;
		$url_username = $username;
		// if($username == '-empty-'){
		// 	$username = '';
		// }
		$this->global['val_username'] = $username;
		$t_day = date('Ymd',strtotime($val_day));

		$this->global['category'] = $case; 
		$check_dump = $this->admin_model->create_dump_item_name();
		if(!$check_dump){
			setFlashData('error', 'Error ketika import data dummy item name..');
			redirect('adm');
		} 

		$check_table = $this->admin_model->check_game_trade_log($t_day);
		if(!$check_table){
			$this->global['trade_log'] = [];
			$this->global['pagination'] = '';
			
			$this->global['config_web'] = $this->getConfigWeb();
			$this->global['php_name'] = 'game_trade_log';
			$this->loadPage();
			return;
		}

		$ar_search['kategori'] = $case;
		$ar_search['username'] = $username;
		$ar_search['top_gold'] = $top_gold;
		$ar_search['item_name'] = $item_name;

        $pagi_this = $this;
        $pagination = $this->userPagination(array(
				'base_url' => base_url() . '/adm/game_trade_log/'.$val_day,
				'start_page' => 0,
				'num_links' => 2,
				'total_rows' => $this->admin_model->count_game_trade_log($t_day,$ar_search)->row()->count_log,
				'per_page' => 12,
				'uri_segment' => 4,
			),
			function ($pars) use ($pagi_this, $t_day, $ar_search) {
				$list = $pagi_this->admin_model->res_game_trade_log(
					$t_day,
					$ar_search,
					$pars["per_page"],
					$pars['page']
				)->result_array();

				$pagination = $pagi_this->pagination->create_links();
				return array(
					'total_rows' => $pars['total_rows'],
					'list' => $list,
					'pagination' => $pagination,
				);
			}
        );
		
        $this->global['trade_log'] = $pagination['list'];
        $this->global['pagination'] = $pagination['pagination']; 
		
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'game_trade_log';
	    $this->loadPage();
	}

	function top_donate($case='week',$t_val1='',$t_val2=''){  
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		
		$this->load->model("admin_model"); 
		// $this->global['list_month'] = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$this->global['list_month'] = [];
		foreach(getListMonth() as $key => $val){
			$this->global['list_month'][] = $val;
		}

		$where_donate=[
			'd.show_log = ' => "'yes'" // start mulai tanggal 11 agustus 2021
		];
		if ($case == 'today') {
			$where_donate['DATE(d.created_date) = '] = 'CURDATE()';
		}
		if ($case == 'week') {
			$where_donate['YEARWEEK(d.created_date, 1) = '] = 'YEARWEEK(CURDATE(), 1)';
		}
		if ($case == 'month') {
			$where_donate['YEAR(d.created_date) = '] = 'YEAR(CURDATE())';
			$where_donate['MONTH(d.created_date) = '] = 'MONTH(CURDATE())';
		}
		if ($case == 'year') {
			$where_donate['YEAR(d.created_date) = '] = 'YEAR(CURDATE())'; 
		}
		if ($case == 's_day') {
			$where_donate['DATE(d.created_date) = '] = "'{$t_val1}'"; 
		} 
		if ($case == 's_range') {
			$where_donate['DATE(d.created_date) >= '] = "'{$t_val1}'"; 
			$where_donate['DATE(d.created_date) <= '] = "'{$t_val2}'"; 
		}
		if ($case == 's_week') {
			$where_donate['DATE(d.created_date) >= '] = "'{$t_val1}'"; 
			$where_donate['DATE(d.created_date) <= '] = "'{$t_val2}'"; 
		}
		if ($case == 's_month') {
			$where_donate['YEAR(d.created_date) = '] = "'{$t_val1}'"; 
			$where_donate['MONTH(d.created_date) = '] = "'".($t_val2+1)."'"; 
		}
		if ($case == 's_year') {
			$where_donate['YEAR(d.created_date) = '] = "'{$t_val1}'"; 
		} 

		$this->global['category'] = $case;
		$this->global['t_val1'] = $t_val1;
		$this->global['t_val2'] = $t_val2;
      	$this->global['donate_list'] = $this->admin_model->top_donate_list($where_donate); 
      	$this->global['accumulation_donate_list'] = $this->admin_model->top_donate_list($where_donate,false); 
      	$this->global['total_point_donate'] = $this->admin_model->total_donate('point', $where_donate)[0]; 
      	$this->global['total_price_donate'] = $this->admin_model->total_donate('price', $where_donate);  
		
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'top_donate';
	    $this->loadPage();
	} 

	function donate_price(){ 
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->load->model("admin_model");
      	$this->global['donate_price_list'] = $this->admin_model->donate_price_list();
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'donate_price';

		// dump(count($this->global['donate_price_list']), $this->global['donate_price_list']); exit;
	    $this->loadPage();
	} 
	
	function new_donate_price(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'new_donate_price';
	    $this->loadPage();
	}

	function edit_donate_price($id){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'new_donate_price';
		$this->global['get_dp'] = $this->db->get_where("donate_price_list",array(
			"id"=>$id
		))->row_array();

	    $this->loadPage();
	}

	function referral(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->load->model("admin_model"); 
      	$this->global['referral_list'] = $this->admin_model->referral_list();
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'referral';
	    $this->loadPage();
	}

	function referral_history(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->load->model("admin_model"); 
      	$this->global['referral_history_list'] = $this->admin_model->referral_history_list();
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'referral_history';
	    $this->loadPage();
	}

	function new_referral(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->load->model("admin_model");
		$this->global['config_web'] = $this->getConfigWeb();
		$this->global['php_name'] = 'new_referral';
	    $this->loadPage();
	}

	function edit_referral($id){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
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
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'topup';
	    $this->loadPage();
	}

	function topup_log(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
		$this->global['php_name'] = 'topup_log';
		$this->load->model('im_model');
		$this->global['topup_log'] = $this->im_model->topup_log();
	    $this->loadPage();
	}

	function send_item(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
		}
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
		$this->global['news_category'] = $this->db->get_where('news_category',array())->result_array();
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
			json(false);
			return;
		}else{
			$this->global['account_list'] = $this->db->query('SELECT * FROM tbl_admin')->result();
			$this->global['php_name'] = 'account_list';
		    $this->loadPage();
		}
	}

	function g_account_list(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
			return;
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
			json(false);
			return;
		}else{
			$this->global['php_name'] = 'add_source';
		    $this->loadPage();
		}
	}
}