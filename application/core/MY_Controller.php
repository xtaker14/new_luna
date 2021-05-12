<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller  { 

	protected $core_data;
	protected $id_config_web;
    protected $referral_bonus_points;

	function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$GLOBALS['date_now'] = date('Y-m-d H:i:00');
		$this->id_config_web = 1; 

		$this->referral_bonus_points = 15; // percent

        $this->load->model('admin_model','main_m',TRUE);	
		$data_config_web = $this->main_m->getConfigWeb($this->id_config_web);
		if(count($data_config_web)>1){
			$this->referral_bonus_points = $data_config_web['referral_bonus_points'];
		}
		
		$get_browser = $this->getBrowser();
		switch ($get_browser['shortname']) {
			case 'firefox':
			case 'chrome':
				$get_mt_key = $this->secureGet('maintenance-key', true);
				$get_admin_key = $this->secureGet('admin-key', true);
				if($get_mt_key){
					$this->session->set_userdata('maintenance-key', $get_mt_key);
				}
				if($get_admin_key){
					$this->session->set_userdata('admin-key', $get_admin_key);
				} 
				$GLOBALS['check_allowed_ip'] = $this->checkAllowedIp();
				$this->isOtherLinkMT();
				$this->allowedAdmin(); 
				
				return true;
				break;
			default:
				echo 'Use browser engine Firefox/Chrome';
				exit;
				break;
		}
	}

	public function send_email($pars_data, $show_error = false){
        // $config['useragent'] = 'CodeIgniter';
		// $config['protocol'] = 'smtp';
		// $config['smtp_host'] = 'ssl://smtp.googlemail.com';
		// $config['smtp_user'] = 'pinstarluna@gmail.com';
		// $config['smtp_pass'] = 'blacklist007008009';
		// $config['smtp_port'] = 465; 
		// $config['smtp_timeout'] = 5;
		// $config['wordwrap'] = TRUE;
		// $config['wrapchars'] = 76;
		// $config['mailtype'] = 'html';
		// $config['charset'] = 'utf-8';
		// $config['validate'] = FALSE;
		// $config['priority'] = 3;
		// $config['crlf'] = "\r\n";
		// $config['newline'] = "\r\n";
		// $config['bcc_batch_mode'] = FALSE;
		// $config['bcc_batch_size'] = 200; 

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => 'a397adb76f2d71',
            'smtp_pass' => 'eaaad2b1d161a2',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            // 'charset'   => 'utf-8',
            // 'crlf'   => '\r\n',
            // 'newline'   => '\r\n',
            // 'wordwrap'   => true,
        );
		
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

	public function allowedAdmin(){
		$current_url = $this->uri->segment(1);
		if(strtolower($current_url) === 'admin'){
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