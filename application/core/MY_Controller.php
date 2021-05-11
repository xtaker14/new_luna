<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller  { 

	protected $core_data;
	protected $id_config_web;
	protected $transfer_point_tax;
	protected $min_transfer_point;
	protected $change_nick_fee;
	protected $change_gender_fee;

	function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$GLOBALS['date_now'] = date('Y-m-d H:i:00');
		$this->id_config_web = 1;

		// $this->transfer_point_tax = 15;
		// $this->min_transfer_point = 800;
		// $this->change_nick_fee = 1100;
		// $this->change_gender_fee = 1700;
		// $this->discount_item_mall = null;

        // $this->load->model('Model_main','main_m',TRUE);	
		// $data_config_web = $this->main_m->checkConfigWeb(array(
		// 	'id' => $this->id_config_web,
		// ))->row_array();
		// if (count($data_config_web) > 1) {
		// 	$this->transfer_point_tax = $data_config_web['transfer_point_tax'];
		// 	$this->min_transfer_point = $data_config_web['min_transfer_point'];
		// 	$this->change_nick_fee = $data_config_web['change_nick_fee'];
		// 	$this->change_gender_fee = $data_config_web['change_gender_fee'];
		// 	$this->discount_item_mall = $data_config_web['discount_item_mall'];
		// } 

		// if(preg_match('/(Chrome|CriOS)\//i',$this->input->user_agent())
		//  && !preg_match('/(Aviator|ChromePlus|coc_|Dragon|Edge|Flock|Iron|Kinza|Maxthon|MxNitro|Nichrome|OPR|Perk|Rockmelt|Seznam|Sleipnir|Spark|UBrowser|Vivaldi|WebExplorer|YaBrowser)/i',$this->input->user_agent())){
		//     // Browser might be Google Chrome
		// }
		// "INSERT INTO table (title) VALUES(".$this->db->escape($omgomg).")";
		// $get_browser = $this->getBrowser();
		// switch ($get_browser['shortname']) {
		// 	case 'firefox':
		// 	case 'chrome':
		// 		$get_mt_key = $this->secureGet('maintenance-key', true);
		// 		$get_admin_key = $this->secureGet('admin-key', true);
		// 		if($get_mt_key){
		// 			$this->session->set_userdata('maintenance-key', $get_mt_key);
		// 		}
		// 		if($get_admin_key){
		// 			$this->session->set_userdata('admin-key', $get_admin_key);
		// 		}
		// 		$this->routesAPI();
		// 		$GLOBALS['check_allowed_ip'] = $this->checkAllowedIp();
		// 		$this->isOtherLinkMT();
		// 		$this->allowedAdmin(); 
				
		// 		return true;
		// 		break;
		// 	default:
		// 		echo 'Use browser engine Firefox/Chrome';
		// 		exit;
		// 		break;
		// }
	}

	public function allowedAdmin(){
		$current_url = $this->uri->segment(1);
		if(strtolower($current_url) === 'admin'){
			$get_admin_key = $this->session->userdata('admin-key');
			$data_config_web = $this->main_m->checkConfigWeb(array(
				'id'=>$this->id_config_web,
			))->row_array();
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
        $this->load->model('Model_main','main_m',TRUE);	
		$get_mt_key = $this->session->userdata('maintenance-key');
		$data_config_web = $this->main_m->checkConfigWeb(array(
			'id'=>$this->id_config_web,
		))->row_array();
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
        $this->load->model('Model_main','main_m',TRUE);	
		$get_mt_key = $this->session->userdata('maintenance-key');
		$data_config_web = $this->main_m->checkConfigWeb(array(
			'id'=>$this->id_config_web,
		))->row_array();
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
		$this->load->library('Main', null, 'main_l');		
		return $this->main_l->checkAllowedIp();
	}

	private function routesAPI() {
		// $this->session->unset_userdata('ROUTES-API');
		// $this->session->unset_userdata('TIMER-ROUTES-API');

		$this->load->helper('funct_helper');
		if(!$this->session->userdata('ROUTES-API')){
			$routes_api = array(
				// user ---
				'refresh_point'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/refresh_point'
				),
				'fix_5101'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/fix_5101'
				),
				'reset_ui'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/reset_ui'
				),
				'signin_refresh_captcha'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/signin/refresh_captcha'
				),
				'signin_process'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/signin/process'
				),
				'signup_refresh_captcha'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/signup/refresh_captcha'
				),
				'signup_process'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/signup/process'
				),
				'change_password_refresh_captcha'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/change_password/refresh_captcha'
				),
				'change_password_process'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/change_password/process'
				),
				'change_pin_refresh_captcha'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/change_pin/refresh_captcha'
				),
				'change_pin_process'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/change_pin/process'
				),
				'shop_process'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/shop/process'
				),
				'transfer_point_refresh_captcha'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/transfer_point/refresh_captcha'
				),
				'transfer_point_process'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/transfer_point/process'
				),
				'change_nick_refresh_captcha'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/change_nick/refresh_captcha'
				),
				'change_nick_process'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/change_nick/process'
				),
				'change_gender_refresh_captcha'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/change_gender/refresh_captcha'
				),
				'change_gender_process'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/change_gender/process'
				),

				'spin' => array(
					'encrypt' => 'user/api/' . randomNumber(),
					'decrypt' => 'user/api/wheel/spin'
				),
				'wheel_refresh_captcha'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/wheel/refresh_captcha'
				),
				'wheel_load'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/wheel/load'
				),
				'spin_paid' => array(
					'encrypt' => 'user/api/' . randomNumber(),
					'decrypt' => 'user/api/wheel/spin_paid'
				),
				'wheel_refresh_captcha_paid'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/wheel/refresh_captcha_paid'
				),
				'wheel_load_paid'=> array(
					'encrypt' => 'user/api/'.randomNumber(), 
					'decrypt' => 'user/api/wheel/load_paid'
				),

				// admin ---
				'admin_signin_process'=> array(
					'encrypt' => 'admin/api/' . randomNumber(),
					'decrypt' => 'admin/api/signin/process'
				),
				'admin_setting_process'=> array(
					'encrypt' => 'admin/api/'.randomNumber(), 
					'decrypt' => 'admin/api/setting/process'
				),
				'admin_mt_setting_process' => array(
					'encrypt' => 'admin/api/' . randomNumber(),
					'decrypt' => 'admin/api/mt_setting/process'
				),

				'admin_shop_best_seller' => array(
					'encrypt' => 'admin/api/' . randomNumber(),
					'decrypt' => 'admin/api/shop/best_seller'
				),
				'admin_shop_delete_item' => array(
					'encrypt' => 'admin/api/' . randomNumber(),
					'decrypt' => 'admin/api/shop/delete'
				),
				'admin_shop_process' => array(
					'encrypt' => 'admin/api/' . randomNumber(),
					'decrypt' => 'admin/api/shop/process'
				),

				'admin_wheel_delete_item' => array(
					'encrypt' => 'admin/api/' . randomNumber(),
					'decrypt' => 'admin/api/wheel/delete'
				),
				'admin_wheel_process' => array(
					'encrypt' => 'admin/api/' . randomNumber(),
					'decrypt' => 'admin/api/wheel/process'
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

	protected function afterAdminLogin($ajax=false){
		if($ajax){
			if(!$this->session->userdata('is_admin_login')){
				return false;
			}
			$this->adminLastOnline();
			return true;
		}
		if(!$this->session->userdata('is_admin_login')){
			$this->redirect(base_url('admin/signin'));
		}
		$this->adminLastOnline();
	}

	protected function adminLastOnline(){
		$this->load->model('admin/Model_Signin');
		$data_admin_user = $this->Model_Signin->getUserWhere("id = '".$this->session->userdata('admin_userid')."'")->row_array();

		// $time_online=strtotime($data_admin_user['logged_in_date']);
		// $time=time();
		// $last_online = date('i', $time-$time_online)." min ago";
		$last_online = getTimeBetweenTwoDate($GLOBALS['date_now'], $data_admin_user['logged_in_date']);
		$this->core_data['last_online'] = $last_online.' ago';
	}

	protected function beforeAdminLogin($ajax=false){
		if($ajax){
			if($this->session->userdata('is_admin_login')){
				return false;
			}
			return true;
		}
		if($this->session->userdata('is_admin_login')){
			$this->redirect(base_url('admin/dashboard'));
		}
	}

	protected function afterLogin($ajax=false){
		if($ajax){
			if(!$this->session->userdata('is_login')){
				return false;
			}
			return true;
		}
		if(!$this->session->userdata('is_login')){
			$this->redirect(base_url('signin'));
		}
	}

	protected function beforeLogin($ajax=false){
		if($ajax){
			if($this->session->userdata('is_login')){
				return false;
			}
			return true;
		}
		if($this->session->userdata('is_login')){
			$this->redirect(base_url('our_rules'));
		}
	}

	protected function dd($data,$exit=false){
		dump($data);
		if(!$exit){
			exit;
		}
	}

	protected function configCaptcha($data=null){
		$img_path = './assets/corporate/captcha/' . (!empty($data['img_path']) ? $data['img_path'] : '');
		if (!is_dir($img_path)) {
			mkdir($img_path, 0777, TRUE);
		}

		return array(
            'img_path' => $img_path,
            'img_url' => base_url() . $img_path,
            'font_path' => './assets/corporate/Roboto-Black.ttf',
            'word_length' => (!empty($data['word_length']) ? $data['word_length'] : 6),
            'font_size' => (!empty($data['font_size']) ? $data['font_size'] : 40),
            'img_width' => (!empty($data['img_width']) ? $data['img_width'] : '250'),
            'img_height' => (!empty($data['img_height']) ? $data['img_height'] : 200),
            'pool' => (!empty($data['pool']) ? $data['pool'] : '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ'),
            'expiration' => (!empty($data['expiration']) ? $data['expiration'] : 7200),
            'colors' => array(
                'background' => array(17, 17, 17),
                'border' => array(255, 255, 255),
                'text' => array(251, 192, 45),
                'grid' => array(238, 168, 96, 255)
            )
		);
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
			return $this->xssClean($this->security->xss_clean($data),$exclude);
		}
		return $this->security->xss_clean($data);
	}

	protected function securePost($data,$more=false,$exclude=false){
		if(!$this->input->post($data)){
			return false;
		}
		if($more){
			return $this->xssClean($this->security->xss_clean($this->input->post($data)),$exclude);
		}
		return $this->security->xss_clean($this->input->post($data));
	}

	protected function secureGet($data,$more=false,$exclude=false){
		$this->load->helper('funct_helper');
		$convert_data = $this->input->get($data);
		if($convert_data === 0 || $convert_data === '0'){
			return 0;
		}
		if(!$convert_data){
			return false;
		}
		if($more){
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

	protected function onlyAllowAccessFromWeb(){
		$result = true;
		if($this->input->is_ajax_request() || $this->input->is_cli_request())
		{
			$result = false;
		}
		if($this->input->method() != 'get'){
			$result = false;
		}
		if($result == false){
			return $this->dd(array(
				'text' => 'Error 500',
				'result' => false,
				'type' => 'danger'
			));
		}
		return $result;
	}

	protected function onlyAllowAccessFromAjax(){
		$result = true;
		if(!$this->input->is_ajax_request())
		{
			$result = false;
		}
		if($result == false){
			// return $this->dd(array(
			// 	'text' => 'Error 500',
			// 	'result' => false,
			// 	'type' => 'danger'
            // ));
			return show_404();
		}
		return $result;
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
		        $version= $matches['version'][0];
		    }
		    else {
		        $version= $matches['version'][1];
		    }
		}
		else {
		    $version= $matches['version'][0];
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