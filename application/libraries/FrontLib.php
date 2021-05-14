<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class FrontLib extends MY_Controller {
	protected $global = array();
	protected $usr_code = '';
	protected $propid = '';
	protected $id_email = '';
	protected $id_loginid = '';
	protected $star_point = '';
	protected $silver_point = '';
	protected $usr_session = '';

	function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok"); 
	}
	
	protected function onlyAllowAccessFromAjax(){
		$result = true;
		if(!$this->input->is_ajax_request())
		{
			$result = false;
		} 
		return $result;
	}

	protected function getConfigWeb($alldata=false){
		$this->load->model("frontpage_model");
		$data = $this->frontpage_model->getConfigWeb($this->id_config_web); 
		if($alldata){
			return $data;
		}
		$dec_account_number = json_decode($data['account_number'], true);

		// echo '<pre>';
		// foreach($dec_account_number as $key => $val){
		// 	var_dump($key);
		// 	echo "<br>";
		// 	foreach($val as $key2 => $val2){
		// 		var_dump($key2, $val2);
		// 	}
		// }
		// exit;
		
		$data['account_number'] = $dec_account_number; 
		return $data;
	}
	
	function plus_min_date($date,$res_date = ["+1 day","Y-m-d"]){
        // $date = "Mar 03, 2011";
        $date = strtotime($date);
        $date = strtotime($res_date[0], $date);
        return date($res_date[1], $date);
    }
	
	function is_login(){
		$this->usr_code = $this->session->userdata ( 'usr_code' );
		$this->propid = $this->session->userdata ( 'propid' );
		$this->id_email = $this->session->userdata ( 'id_email' );
		$this->id_loginid = $this->session->userdata ( 'id_loginid' );
		$this->star_point = $this->session->userdata ( 'star_point' );
		$this->silver_point = $this->session->userdata ( 'silver_point' );
		$this->usr_session = $this->session->userdata ( 'usr_session' );
		$this->global['usr_code'] = $this->usr_code;
		$this->global['propid'] = $this->propid;
		$this->global['id_email'] = $this->id_email;
		$this->global['id_loginid'] = $this->id_loginid;
		$this->global['star_point'] = $this->star_point;
		$this->global['silver_point'] = $this->silver_point;
		$this->global['usr_session'] = $this->usr_session;
	}

	function isLoggedIn(){
		$usr_session = $this->session->userdata ( 'usr_session' );
		if (! isset ( $usr_session ) || $usr_session != TRUE) {
			return false;
		}
		return true;
	}

	function xepo_secure(){
		$this->global['xepo_secure'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
        );
	}
	
	/*START CODE */
	function loadViews(){
		$this->load->model("im_model");
		$this->global['hot_items'] = $this->im_model->im_list_by(8,'counter');	
		$config_web = $this->getConfigWeb(true);
		$this->global['config_web'] = $config_web;
        $this->load->view('app/overview', $this->global);
    }
    
	function notfound(){
		redirect('');
	}

	function google_verify(){

        $site_secret = "6LfVWswZAAAAAFVNNtg4ypyYFIClSRKoe4uSs6jG";

        $responseKey = $_POST['g-recaptcha-response'];

        $userIP = $_SERVER['REMOTE_ADDR'];

        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$site_secret&response=$responseKey&remoteip=$userIP";

        $response = file_get_contents($url);

        $check = json_decode($response);

        if($check->success == true ){// && $check->score > 0.5

            return true;

        }else{

            return false;

        }

    }
}
