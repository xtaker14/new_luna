<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller  { 

	protected $core_data;
	protected $id_config_web;
	protected $midtrans_server_key;
	protected $midtrans_client_key; 
    protected $referral_bonus_points;
    // protected $cekmutasi_to_idr_payment_type;
    // protected $cekmutasi_to_idr_name;
    // protected $cekmutasi_to_idr_account;
    // protected $cekmutasi_to_idr_code;
    // protected $cekmutasi_to_usd_payment_type;
    // protected $cekmutasi_to_usd_name;
    // protected $cekmutasi_to_usd_account;
    // protected $cekmutasi_to_usd_code;

	function __construct() {
		parent::__construct(); 
		date_default_timezone_set("Asia/Bangkok");
		$GLOBALS['date_now'] = date('Y-m-d H:i:00');
		$GLOBALS['cur_date'] = date('Y-m-d');
		$this->id_config_web = 1; 
		// $this->midtrans_server_key = 'SB-Mid-server-GDoow-q6ibYwOEZQz0NJt9Yk'; 
		// $this->midtrans_client_key = 'SB-Mid-client-YD0FjP9biAWH1ewS'; 
		$this->midtrans_server_key = ''; 
		$this->midtrans_client_key = '';
		
		// $this->cekmutasi_to_idr_payment_type = 'BCA';
		// $this->cekmutasi_to_idr_name = 'Eldwin';
		// $this->cekmutasi_to_idr_account = '0954282143';
		// $this->cekmutasi_to_idr_code = '014';

		// $this->cekmutasi_to_usd_payment_type = 'PAYPAL';
		// $this->cekmutasi_to_usd_name = '@eldwindi';
		// $this->cekmutasi_to_usd_account = 'eldwindi@gmail.com';
		// $this->cekmutasi_to_usd_code = '';

		$this->referral_bonus_points = 15; // percent

        $this->load->model('admin_model','main_m',TRUE);	
		$data_config_web = $this->main_m->getConfigWeb($this->id_config_web);
		if(count($data_config_web)>1){
			$this->referral_bonus_points = $data_config_web['referral_bonus_points'];
			define('SITE_NAME', ucwords($data_config_web['web_name']));
		}

		// ---
		$get_mt_key = $this->secureGet('maintenance-key', true);
		$get_admin_key = $this->secureGet('admin-key', true);
		if($get_mt_key){
			$this->session->set_userdata('maintenance-key', $get_mt_key);
		}
		if($get_admin_key){
			$this->session->set_userdata('admin-key', $get_admin_key);
		} 
		$this->routesAPI();
		$GLOBALS['check_allowed_ip'] = $this->checkAllowedIp();
		$this->isOtherLinkMT();
		$is_allowed_admin = $this->allowedAdmin(); 
		if($is_allowed_admin){
			$get_admin_hidden_key = $this->secureGet('admin-hidden-key', true);
			if($get_admin_hidden_key){  
				$this->session->set_userdata('admin-hidden-key', $get_admin_hidden_key);
			}
			if(empty($this->session->userdata('open-admin-hidden'))){
				$this->allowedHiddenAdmin();
			}

		}
		// ---

		$get_browser = $this->getBrowser();
		switch ($get_browser['shortname']) {
			case 'firefox':
			case 'chrome':
				
				return true;
				break;
			default:
				// echo 'Use browser engine Firefox/Chrome';
				// exit;
				return true;
				break;
		}
	} 

	private function setStylePagination(&$config){
		$config['first_link']       = false;
		$config['last_link']        = false;

		// $config['anchor_class'] = 'class="page-link" ';
		$config['attributes'] = array('class' => 'page-link');

		$config['prev_tag_open']    = '<li class="page-item">';
		$config['prev_tag_close']   = '</li>'; 
		$config['prev_link']        = '<i class="fas fa-chevron-left"></i>';

		$config['next_tag_open']    = '<li class="page-item">';
		$config['next_tag_close']   = '</li>';
		$config['next_link']        = '<i class="fas fa-chevron-right"></i>';

		$config['full_tag_open']    = '<nav class="d-inline-block"><ul class="pagination mb-0">';
		$config['full_tag_close']   = '</ul></nav>';

		$config['num_tag_open']     = '<li class="page-item">';
		$config['num_tag_close']    = '</li>';

		$config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="javascript:;">';
		$config['cur_tag_close']    = '</a></li>';
	}

	public function userPagination($params, $callback=false){
		$this->load->library('pagination');

		//konfigurasi pagination
		$config['reuse_query_string'] = true;
        $config['base_url'] = $params['base_url']; //site url
        $config['total_rows'] = $params['total_rows']; //total row
        $config['per_page'] = $params['per_page'];  //show record per halaman
        $config['uri_segment'] = $params['uri_segment'];  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
		if(!isset($params['num_links'])){
			$params['num_links']= floor($choice);
		}else{ 
			if(!$this->uri->segment($params['uri_segment'])){
				$params['num_links'] = $params['num_links'] * 2;
			}else{
				if($this->uri->segment($params['uri_segment']) == $config["per_page"]){
					$params['num_links'] = floor($params['num_links'] * 1.5);
				}
			}
		}
        $config["num_links"] = $params['num_links'];
 
        $this->setStylePagination($config);
 
		$data['per_page'] = $config['per_page'];
		$data['total_rows'] = $config['total_rows'];
        $this->pagination->initialize($config);
		if(!isset($params['start_page'])){
			$params['start_page']= 0;
		}
        $data['page'] = ($this->uri->segment($params['uri_segment'])) ? $this->uri->segment($params['uri_segment']) : $params['start_page'];


		$start = (int)$this->uri->segment($params['uri_segment']) + 1;
		if ($this->uri->segment($params['uri_segment']) + $config['per_page'] > $config['total_rows']) {
			$end = $config['total_rows'];
		} else {
			$end = (int)$this->uri->segment($params['uri_segment']) + $config['per_page'];
		}
		$data['show_result_count']= "Showing ".$start." - ".$end." of ".$config['total_rows']." Results";

		if($callback !== false){
			return $callback($data);
		}
        return false;
	}

	private function routesAPI() {
		// $this->session->unset_userdata('ROUTES-API');
		// $this->session->unset_userdata('TIMER-ROUTES-API');

		if(!$this->session->userdata('ROUTES-API')){
			$routes_api = array(
				'test'=> array(
					'encrypt' => 'aa/'.randomNumber(), 
					'decrypt' => 'aa/test'
				),
				'checkin_now'=> array(
					'encrypt' => 'checkin/'.randomNumber(), 
					'decrypt' => 'checkin/checkin_now'
				),
			);
			$i=0;
			foreach ($routes_api as $key => $val) {
				$i++;
				$GLOBALS['ROUTES-API'][$key]['encrypt'] = $val['encrypt'].$i;
				$GLOBALS['ROUTES-API'][$key]['decrypt'] = $val['decrypt'];
			}
			$this->session->set_userdata('ROUTES-API', $GLOBALS['ROUTES-API']);
		}else{
			$GLOBALS['ROUTES-API'] = $this->session->userdata('ROUTES-API');
		}
		if (
			$this->session->userdata('TIMER-ROUTES-API') && 
			(time() - $this->session->userdata('TIMER-ROUTES-API') > 1800)
		) { // 30 min
			$this->session->unset_userdata('ROUTES-API');
		}
		$this->session->set_userdata('TIMER-ROUTES-API', time());
		// dump(array($GLOBALS['ROUTES-API']));
	}

	protected function midtrans_update_status($order_id, $t_midtrans){
		$midtrans_data_new = (array)$t_midtrans->status($order_id);
		if(count($midtrans_data_new)==0){
			return 0;
		}
		if(isset($midtrans_data_new['payment_amounts'][0])){
			$donate_update['midtrans_paid_at'] = $this->secureStr($midtrans_data_new['payment_amounts'][0]->paid_at,true,[
				':',
				'/',
				'-',
			]);
			$donate_update['midtrans_paid_amount'] = $this->secureStr($midtrans_data_new['payment_amounts'][0]->amount,true,[
				'.',
			]);
		}
		$donate_update['midtrans_currency'] = $this->secureStr($midtrans_data_new['currency'],true);
		$donate_update['midtrans_signature_key'] = $this->secureStr($midtrans_data_new['signature_key'],true,[
			'-',
			'_',
		]);
		$donate_update['midtrans_merchant_id'] = $this->secureStr($midtrans_data_new['merchant_id'],true,[
			'-',
			'_',
		]);
		
		$midtrans_cc_card_type = $this->secureStr($midtrans_data_new['card_type'],true);
		$midtrans_cc_masked_card = $this->secureStr($midtrans_data_new['masked_card'],true,[
			'-',
			'_',
		]);  
		$donate_update['midtrans_cc_card_type'] = $midtrans_cc_card_type;
		$donate_update['midtrans_cc_masked_card'] = $midtrans_cc_masked_card;

		// ---
		if(isset($midtrans_data_new['settlement_time'])){
			$donate_update['midtrans_settlement_time'] = $this->secureStr($midtrans_data_new['settlement_time'],true,[
				':',
				'/',
				'-',
			]); 
		}
		if(isset($midtrans_data_new['approval_code'])){
			$donate_update['midtrans_approval_code'] = $this->secureStr($midtrans_data_new['approval_code'],true,[
				'-',
				'_',
			]);
		}
		if(isset($midtrans_data_new['eci'])){
			$donate_update['midtrans_cc_eci'] = $this->secureStr($midtrans_data_new['eci'],true); 
		}
		if(isset($midtrans_data_new['channel_response_message'])){
			$donate_update['midtrans_cc_channel_response_message'] = $this->secureStr($midtrans_data_new['channel_response_message'],true); 
		}
		if(isset($midtrans_data_new['channel_response_code'])){
			$donate_update['midtrans_cc_channel_response_code'] = $this->secureStr($midtrans_data_new['channel_response_code'],true); 
		}
		if(isset($midtrans_data_new['acquirer'])){
			$donate_update['midtrans_acquirer'] = $this->secureStr($midtrans_data_new['acquirer'],true); 
		}
		if(isset($midtrans_data_new['issuer'])){
			$donate_update['midtrans_issuer'] = $this->secureStr($midtrans_data_new['issuer'],true); 
		}
		if(isset($midtrans_data_new['transaction_type'])){
			$donate_update['midtrans_transaction_type'] = $this->secureStr($midtrans_data_new['transaction_type'],true); 
		}
		// ---

		$donate_update['status'] = $this->secureStr($midtrans_data_new['transaction_status'],true);
		$donate_update['midtrans_status_message'] = $this->secureStr($midtrans_data_new['status_message'],true);
		$donate_update['midtrans_status_code'] = $this->secureStr($midtrans_data_new['status_code'],true);
		$donate_update['midtrans_fraud_status'] = $this->secureStr($midtrans_data_new['fraud_status'],true);
		
		return $donate_update;
	}

	protected function update_donate($donate_id, $midtrans_data, $status){
        $this->load->model("admin_model");
        $this->load->model("member_model"); 
        $get_donate = $this->admin_model->donate_list(array('d.id'=>$donate_id));
            
        if(empty($get_donate)){ 
            return 'Error: Donate Data is not found';
        } 
        $user_id = $get_donate[0]['user_id'];
        $user_data = $this->member_model->getWhereUser(array(
            'id'=>$user_id
        ))->row_array();
        if(empty($user_data)){ 
            return 'Error: User Data is not found';
        }
        $user_email = $user_data['email']; 

        $this->db = dbloader("default"); 
        $where_update = array(
            'id'=>$donate_id
        );
        $donate_update = $midtrans_data;
        $donate_update['status'] = $status; 

        $this->db->trans_begin();
        $this->db->update('donate_duitku',$donate_update,$where_update);
        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback(); 
            return 'Error: Failed To Update Status';
        }
        
        $this->db->trans_commit();
        return true; 
    }

	public function send_email($pars_data, $show_error = false){
		$data_config_web = $this->main_m->getConfigWeb($this->id_config_web);
		$config = array();
		if($data_config_web['email_active_dummy'] == 'yes'){
			$config = Array(
			    'protocol' => 'smtp',
			    'smtp_host' => 'smtp.mailtrap.io',
			    'smtp_port' => 2525,
			    'smtp_user' => 'b731d3b713ba79',
			    'smtp_pass' => 'ef070ca71c5034',
			    'mailtype'  => 'html',
			    'charset'   => 'iso-8859-1',
			    // 'charset'   => 'utf-8',
			    // 'crlf'   => '\r\n',
			    // 'newline'   => '\r\n',
			    // 'wordwrap'   => true,
			);
		}else{
			$config['useragent'] = 'CodeIgniter';
			$config['protocol'] = $data_config_web['email_protocol'];
			$config['smtp_host'] = $data_config_web['email_smtp_host'];
			$config['smtp_user'] = $data_config_web['email_smtp_user'];
			$config['smtp_pass'] = $data_config_web['email_smtp_pass'];
			$config['smtp_port'] = $data_config_web['email_smtp_port'];
			$config['charset'] = $data_config_web['email_charset'];
			$config['smtp_timeout'] = 5;
			$config['wordwrap'] = TRUE;
			$config['wrapchars'] = 76;
			$config['mailtype'] = 'html';
			$config['validate'] = FALSE;
			$config['priority'] = 3;
			$config['crlf'] = "\r\n";
			$config['newline'] = "\r\n";
			$config['bcc_batch_mode'] = FALSE;
			$config['bcc_batch_size'] = 200; 
		}
		
        echo '<script>f_main.loading(true);</script>';
        // $this->load->library('email', $config);
		$this->email->initialize($config);

        $this->email->from($pars_data['from'], $pars_data['title']);
        $this->email->to($pars_data['to']);

        $this->email->subject($pars_data['subject']);
        $this->email->message($pars_data['msg']);  

        $result = $this->email->send();
        if ($result) {
            echo '<script>f_main.loading(false);</script>';
            return true;
        }else{
			if($show_error){
				show_error($this->email->print_debugger());
				exit; 
			}else{
				return false; 
			}
        }
    }

	public function allowedHiddenAdmin(){
		$this->load->model('admin_model','main_m',TRUE);
		$get_admin_hidden_key = $this->session->userdata('admin-hidden-key');
		$data_config_web = $this->main_m->getConfigWeb($this->id_config_web);
		if(count($data_config_web)>1){
			if($get_admin_hidden_key){
				if($get_admin_hidden_key === $this->edit_decrypt($data_config_web['admin_hidden_access_key'])){
					$this->session->set_userdata('open-admin-hidden', true);
					return true;
				}
			} 
			$this->session->set_userdata('open-admin-hidden', false);
			return false;
		} 
	}

	public function allowedAdmin(){
		$current_url = $this->uri->segment(1);
		if(strtolower($current_url) === 'adm'){
			$this->load->model('admin_model','main_m',TRUE);
			$get_admin_key = $this->session->userdata('admin-key');
			$data_config_web = $this->main_m->getConfigWeb($this->id_config_web);
			if(count($data_config_web)>1){
				if($get_admin_key){
					if($get_admin_key == $data_config_web['admin_access_key']){
						return true;
					}
				}
				if($GLOBALS['check_allowed_ip']){
					return true;
				}
				show_404();
				return false;
			}
			return true;
		}else{
			$this->isMT('is_maintenance');
		}
	}

	public function isMT($mt_name){
        $this->load->model('admin_model','main_m',TRUE);
		$get_mt_key = $this->session->userdata('maintenance-key');
		$data_config_web = $this->main_m->getConfigWeb($this->id_config_web);
		if(count($data_config_web)>1){
			if($data_config_web[$mt_name] == 'yes'){
				if($get_mt_key){
					if($get_mt_key == $data_config_web['maintenance_access_key']){
						return true;
					}
				}
				if($GLOBALS['check_allowed_ip']){
					return true;
				}
				show_404();
				return false;
			}
		}
		return true;
	}

	public function isOtherLinkMT(){
        $this->load->model('admin_model','main_m',TRUE);	
		$get_mt_key = $this->session->userdata('maintenance-key');
		$data_config_web = $this->main_m->getConfigWeb($this->id_config_web);
		if(count($data_config_web)>1){
			if(!empty($data_config_web['other_maintenance'])){
				$exp_link_mt = explode(',',str_replace(' ','', trim($data_config_web['other_maintenance'])));
				// $this->uri->segment($params['uri_segment'])

				foreach($exp_link_mt as $key => $val){
					if($val == $this->uri->segment(1)){
						if($get_mt_key){
							if($get_mt_key == $data_config_web['maintenance_access_key']){
								return true;
							}
						}
						if($GLOBALS['check_allowed_ip']){
							return true;
						}
						show_404();
						return false;
					}
				}
			}
		}
		return true;
	}

	public function checkAllowedIp(){
		$this->load->model("admin_model");
		$data = $this->admin_model->getAllowedIp(array())->result_array();
	
		foreach($data as $key){
			$pub_ip = $this->ci->input->ip_address();
			switch($pub_ip){
				case '127.0.0.1':
				case '::1':
					$pub_ip = $this->getClientIp();
					break;
			}
			if($key['admin_address'] == $pub_ip){
				return true;
			}
		}
		return false;
	}
	
    public function edit_encrypt( $s ) {
        $cryptKey  = 'newluna';
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $s, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }
    
    public function edit_decrypt($s) {
        $cryptKey  = 'newluna';
        $qDecoded  = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $s ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    } 

	public function getClientIp() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';

		return $ipaddress;
	}  

	protected function dd($data,$exit=false){
		dump($data);
		if(!$exit){
			exit;
		}
	} 

	protected function xssClean($val,$exclude=false)
	{
		$bad_val = array("'", "\"", "/", "^", "!", "|", "{", "}", "[", "]", "(", ")", "<", ">", "?", "#", "~", "`", "," ,"+", "-", "=", "$", "%", "*", "\\", "&", ";");
		if($exclude !== false){
			$bad_val = array_diff( $bad_val, $exclude);
			$bad_val = array_values($bad_val);
		}

		$replace = array();

		for ($i=0; $i<count($bad_val); $i++) { 
			$replace[] = "";
		}

		return str_replace($bad_val, $replace, $val);
	}

	protected function secureStr($data,$more=false,$exclude=false){
		if($more){
			if(is_array($exclude) && in_array("-", $exclude)){
				$data = preg_replace("/(\-+)/", "-", $data);
			}
			return $this->xssClean($this->security->xss_clean($data),$exclude);
		}
		return $this->security->xss_clean($data);
	}

	protected function securePost($data,$more=false,$exclude=false){
		if(!$this->input->post($data)){
			return false;
		}
		if($more){
			if(is_array($exclude) && in_array("-", $exclude)){
				$data = preg_replace("/(\-+)/", "-", $data);
			}
			return $this->xssClean($this->security->xss_clean($this->input->post($data)),$exclude);
		}
		return $this->security->xss_clean($this->input->post($data));
	}

	protected function secureGet($data,$more=false,$exclude=false){ 
		$convert_data = $this->input->get($data);
		if($convert_data === 0 || $convert_data === '0'){
			return 0;
		}
		if(!$convert_data){
			return false;
		}
		if($more){
			if(is_array($exclude) && in_array("-", $exclude)){
				$data = preg_replace("/(\-+)/", "-", $data);
			}
			return $this->xssClean($this->security->xss_clean($convert_data),$exclude);
		}
		return $this->security->xss_clean($convert_data);
	}

	protected function secureInputFile($data){
		if ($this->security->xss_clean($data, TRUE) === FALSE)
		{
			return "file failed the XSS test";
		}
		return $this->security->sanitize_filename($this->input->post($data));
	}

	protected function redirect($location){
	    echo "<script>window.location.href='".$location."'</script>";
	    exit();
	}

	protected function checkMyIp(){
		return $this->input->ip_address();
	} 

	protected function onlyAllowAccessFromAjax(){
		$result = true;
		if(!$this->input->is_ajax_request())
		{
			$result = false;
		}
		// if($result == false){
		// 	// return $this->dd(array(
		// 	// 	'text' => 'Error 500',
		// 	// 	'result' => false,
		// 	// 	'type' => 'danger'
        //     // ));
		// 	return show_404();
		// }
		return $result;
	}

	protected function onlyAllowAccessFromPost(){
		if(!($this->input->method() === 'post'))
		{
			return false;
		}
		return true;
	}

	protected function insertAutoDonateDuitku($g_donate){
		$this->load->model("member_model"); 

		$this->db = dbloader("default");
		$this->db_mssql = dbloader("LUNA_GAMEDB");
		
		$this->db->trans_begin();
		$this->db_mssql->trans_begin();

		$this->db->update('donate_duitku', array(
			'complete_date' => $GLOBALS['date_now'],
			'status' => 'paid',
		),array(
			'id'=>$g_donate['id']
		));
		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		}

		$donate_id = $g_donate['id'];  
		$user_id = $g_donate['user_id'];
		$user_data = $this->member_model->getWhereUser(array(
			'id'=>$user_id
		))->row_array();
		if(empty($user_data)){ 
			return false;
		} 
			
		$cash_points = (int)$g_donate['donate_point'];
		$this->db->update('tbl_user',array(
			'star_point'=> ((int)$user_data['star_point'] + $cash_points),
		),array(
			'id'=>$user_id
		));
		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback(); 
			return false;
		}

		if(!empty($g_donate['items'])){
			$get_items = json_decode($g_donate['items'], true);
			if(!empty($get_items)){ 

				foreach ($get_items as $key => $val) {
					$this->db_mssql->query("
						INSERT INTO TB_ITEM 
						(
							CHARACTER_IDX,
							ITEM_IDX,
							ITEM_POSITION,
							ITEM_DURABILITY,
							ITEM_SHOPIDX
						) VALUES (
							0,
							'".$val['items_source']."',
							280,
							'".$val['items_qty']."',
							$user_id
						)
					");
					if($this->db_mssql->trans_status() === FALSE) {
						$this->db->trans_rollback();
						$this->db_mssql->trans_rollback();
						return false;
					}
				}
			}
		}

		// when used referral code
		$referral_code = $g_donate['referral_code'];
		if(!empty($referral_code)){ 

			$where_referral = array(
				'referral_code'=>$referral_code
			);
			$data_referral_code = $this->db->get_where('referral_code',$where_referral)->row_array();
			if(count($data_referral_code)==0){ 
				$this->db->trans_rollback(); 
				$this->db_mssql->trans_rollback();
				return false;
			} 
			$bonus_point = $cash_points * ($this->referral_bonus_points / 100);
			
			$this->db->query("
				UPDATE 
					referral_code 
				SET 
					modified_date = '".$GLOBALS['date_now']."', 
					point = point + $bonus_point 
				WHERE 
					referral_code = '$referral_code' 
			");
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback(); 
				$this->db_mssql->trans_rollback();
				return false;
			}

			$ref_history_insert = array(
				'donate_id' => $donate_id, 
				'from_user_id' => $user_id,
				'referral_code' => $referral_code,
				'point' => $bonus_point,
			);
			$this->db->insert('referral_code_history',$ref_history_insert);
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback(); 
				$this->db_mssql->trans_rollback();
				return false;
			}
			
			$this->db->query("
				UPDATE 
					tbl_user 
				SET 
					star_point = star_point + $bonus_point 
				WHERE 
					referral_code = '$referral_code' 
			");
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback(); 
				$this->db_mssql->trans_rollback();
				return false;
			}

			$this->db->query("
				UPDATE 
					tbl_user 
				SET 
					star_point = star_point + $bonus_point 
				WHERE id = $user_id 
			");
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback(); 
				$this->db_mssql->trans_rollback();
				return false;
			} 
		}
		$this->db->trans_commit();
		$this->db_mssql->trans_commit();
		
		return true;
	}

	protected function insertAutoDonate($g_donate, $ins_donate, $t_type){
		$this->load->model("member_model"); 
		$this->db = dbloader("default");

		$this->db->trans_begin();
		if($t_type === 'paypal'){
			$this->db->update('donate',array(
				'cekmutasi_service_name' => 'Paypal',
				'cekmutasi_service_code' => 'paypal',
				'cekmutasi_payment_type' => $ins_donate['type'],
				'cekmutasi_payment_date' => $ins_donate['payment_date'],
				'cekmutasi_amount' => $ins_donate['amount'],
				'cekmutasi_paypal_transactionid' => $ins_donate['transactionid'],
				'cekmutasi_paypal_email' => $ins_donate['email'],
				'cekmutasi_paypal_name' => $ins_donate['name'],
				'status' => 'paid',
			),array(
				'id'=>$g_donate['id']
			));
		}else{
			$this->db->update('donate',array(
				'cekmutasi_service_name' => $ins_donate['service_name'],
				'cekmutasi_service_code' => $ins_donate['service_code'],
				'cekmutasi_account_number' => $ins_donate['account_number'],
				'cekmutasi_account_name' => $ins_donate['account_name'],
				'cekmutasi_payment_date' => $ins_donate['payment_date'],
				'cekmutasi_payment_type' => $ins_donate['type'],
				'cekmutasi_amount' => $ins_donate['amount'],
				'cekmutasi_description' => $ins_donate['description'], 
				'status' => 'paid',
			),array(
				'id'=>$g_donate['id']
			));
		}
		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		}

		$donate_id = $g_donate['id'];  
		$user_id = $g_donate['user_id'];
		$user_data = $this->member_model->getWhereUser(array(
			'id'=>$user_id
		))->row_array();
		if(empty($user_data)){ 
			return false;
		} 
			
		$cash_points = (int)$g_donate['donate_point'];
		$this->db->update('tbl_user',array(
			'star_point'=> ((int)$user_data['star_point'] + $cash_points),
		),array(
			'id'=>$user_id
		));
		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback(); 
			return false;
		}
		$this->db->trans_commit();

		if(!empty($g_donate['items'])){
			$get_items = json_decode($g_donate['items'], true);
			if(!empty($get_items)){
				$this->db = dbloader("LUNA_GAMEDB");

				$this->db->trans_begin();
				foreach ($get_items as $key => $val) {
					$this->db->query("
						INSERT INTO TB_ITEM 
						(
							CHARACTER_IDX,
							ITEM_IDX,
							ITEM_POSITION,
							ITEM_DURABILITY,
							ITEM_SHOPIDX
						) VALUES (
							0,
							'".$val['items_source']."',
							280,
							'".$val['items_qty']."',
							$user_id
						)
					");
					if($this->db->trans_status() === FALSE) {
						$this->db->trans_rollback();
						return false;
					}
				}
				$this->db->trans_commit();
			}
		}

		// when used referral code
		$referral_code = $g_donate['referral_code'];
		if(!empty($referral_code)){ 
			$this->db = dbloader("default");

			$this->db->trans_begin();
			$where_referral = array(
				'referral_code'=>$referral_code
			);
			$data_referral_code = $this->db->get_where('referral_code',$where_referral)->row_array();
			if(count($data_referral_code)==0){ 
				return false;
			} 
			$bonus_point = $cash_points * ($this->referral_bonus_points / 100);
			
			$this->db->query("UPDATE referral_code SET modified_date = '".$GLOBALS['date_now']."', point = point + $bonus_point WHERE referral_code = '$referral_code' ");
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback(); 
				return false;
			}

			$ref_history_insert = array(
				'donate_id' => $donate_id, 
				'from_user_id' => $user_id,
				'referral_code' => $referral_code,
				'point' => $bonus_point,
			);
			$this->db->insert('referral_code_history',$ref_history_insert);
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback(); 
				return false;
			}
			
			$this->db->query("UPDATE tbl_user SET star_point = star_point + $bonus_point WHERE referral_code = '$referral_code' ");
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback(); 
				return false;
			}

			$this->db->query("UPDATE tbl_user SET star_point = star_point + $bonus_point WHERE id = $user_id ");
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback(); 
				return false;
			} 
			$this->db->trans_commit();
		}
		
		// $this->db = dbloader("default");

		// $this->db->trans_begin();
		// $this->db->delete('unique_numbers',array(
		// 	'name'=>'donate',
		// 	'value'=>$g_donate['code_price'],
		// 	'created_date'=>$GLOBALS['cur_date'],
		// ));
		// if($this->db->trans_status() === FALSE) {
		// 	$this->db->trans_rollback(); 
		// 	return false;
		// } 
		// $this->db->trans_commit(); 
		
		return true;
	}

	protected function generateUniqueNumber($start=100,$end=999,$type='donate') {
		$number = mt_rand($start, $end); // better than rand()

		// call the same function if the barcode exists already
		if ($this->uniqueNumberExists($number, $type)) {
			return $this->generateUniqueNumber();
		}

		// otherwise, it's valid and can be used
        $this->db = dbloader("default"); 
		$this->db->trans_begin();
		$this->db->insert('unique_numbers',array(
			'name'=>$type,
			'value'=>$number,
			'created_date'=>date('Y-m-d'),
		)); 
		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} 

		$this->db->trans_commit();
		return $number;
	}

	protected function uniqueNumberExists($number, $type) { 
		$unique_numbers = $this->db->get_where('unique_numbers',array(
			'name'=>$type,
			'value'=>$number,
		))->row_array();
		if(count($unique_numbers)>0){ 
			return true;
		}
	}

	protected function getBrowser() 
	{ 
	    $u_agent = $this->input->user_agent(); 
	    $bname = 'Unknown';
	    $platform = 'Unknown';
	    $version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
		    $platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		    $platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
		    $platform = 'windows';
		}

		$ub = "";
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
		    $bname = 'Internet Explorer'; 
		    $ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
		    $bname = 'Mozilla Firefox'; 
		    $ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
		    $bname = 'Google Chrome'; 
		    $ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
		    $bname = 'Apple Safari'; 
		    $ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
		    $bname = 'Opera'; 
		    $ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
		    $bname = 'Netscape'; 
		    $ub = "Netscape"; 
		} 

		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
		    // we have no matching number just continue
		}

		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
		    //we will have two since we are not using 'other' argument yet
		    //see if version is before or after the name
		    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				
				if(count($matches['version'])>0){
		        	$version= $matches['version'][0];
				}
		        
		    }
		    else {
				if(count($matches['version'])>0){
		        	$version= $matches['version'][1];
				}
		    }
		}
		else {
			if(count($matches['version'])>0){
				$version= $matches['version'][0];
			} 
		}

		// check if we have a number
		if ($version==null || $version=="") {$version="?";}

		return array(
		    'userAgent' => $u_agent,
		    'name'      => $bname,
		    'shortname' => strtolower($ub),
		    'version'   => $version,
		    'platform'  => $platform,
		    'pattern'    => $pattern
		);
	} 

}