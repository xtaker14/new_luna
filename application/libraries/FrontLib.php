<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class FrontLib extends CI_Controller {
	protected $global = array();
	protected $usr_code = '';
	protected $propid = '';
	protected $id_email = '';
	protected $id_loginid = '';
	protected $star_point = '';
	protected $usr_session = '';

	function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->global['date_now'] = date('Y-m-d H:i:00');
	}
	
	protected function onlyAllowAccessFromAjax(){
		$result = true;
		if(!$this->input->is_ajax_request())
		{
			$result = false;
		} 
		return $result;
	}

	protected function getConfigWeb(){
		$this->load->model("frontpage_model");
		$data = $this->frontpage_model->getConfigWeb(1); 
		$dec_account_number = json_decode($data['account_number'], true);
		// $account_number=array();
		// foreach($exp_account_number as $key => $val){
		// 	$exp_val = explode('=>',$val);
		// 	$account_number[$exp_val[0]] = $exp_val[1];
		// }
		$data['account_number'] = $dec_account_number; 
		return $data;
	}
	
	function plus_min_date($date,$res_date = ["+1 day","Y-m-d"]){
        // $date = "Mar 03, 2011";
        $date = strtotime($date);
        $date = strtotime($res_date[0], $date);
        return date($res_date[1], $date);
    }

	function send_email($pars_data, $show_error = false){  
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
        $this->email->set_newline("\r\n");
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
	
	function is_login(){
		$this->usr_code = $this->session->userdata ( 'usr_code' );
		$this->propid = $this->session->userdata ( 'propid' );
		$this->id_email = $this->session->userdata ( 'id_email' );
		$this->id_loginid = $this->session->userdata ( 'id_loginid' );
		$this->star_point = $this->session->userdata ( 'star_point' );
		$this->usr_session = $this->session->userdata ( 'usr_session' );
		$this->global['usr_code'] = $this->usr_code;
		$this->global['propid'] = $this->propid;
		$this->global['id_email'] = $this->id_email;
		$this->global['id_loginid'] = $this->id_loginid;
		$this->global['star_point'] = $this->star_point;
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
