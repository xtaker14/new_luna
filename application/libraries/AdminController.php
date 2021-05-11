<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class AdminController extends CI_Controller {
	protected $role = '';
	protected $userId = '';
	protected $nama = '';
	protected $jabatan = '';
	protected $global = array ();
	protected $lastLogin = '';

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
		$this->load->model("admin_model");
		$data = $this->admin_model->getConfigWeb(1); 
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

	function isLoggedIn() {
		$isAdminLogin = $this->session->userdata ( 'isAdminLogin' );
		
		if (! isset ( $isAdminLogin ) || $isAdminLogin != TRUE) {
			redirect ( '/adm/login' );
		} else {
			$this->role = $this->session->userdata ( 'role' );
			$this->userId = $this->session->userdata ( 'userId' );
			$this->nama = $this->session->userdata ( 'nama' );
			$this->jabatan = $this->session->userdata ( 'jabatan' );
			$this->lastLogin = $this->session->userdata ( 'lastLogin' );
			
			$this->global ['nama'] = $this->nama;
			$this->global ['userId'] = $this->userId;
			$this->global ['role'] = $this->role;
			$this->global ['jabatan'] = $this->jabatan;
			$this->global ['last_login'] = $this->lastLogin;
		}
	}

	function checker($status,$jabatan='') {
		if ($this->role > $status) {

			return false; //return to access denied	

		} else if($this->role == ROLE_MODERATOR){	
						
			if($this->jabatan == $jabatan){
				return true;//Jika jabatan = jabatan di DB
			}else{
				return false;	
			}

		}else{
			return true;
		}

	}
	
	function logout() {
		$this->session->sess_destroy();		
		redirect ( 'adm/login' );
	}

    function loadPage(){ 	
		$this->load->view('admin/overview', $this->global);
    }

	function denied() {
		$this->global['php_name'] = '_page/denied';
	    $this->loadPage();
	}

    function nopage() {
		$this->global['php_name'] = '_page/nopage';
	    $this->loadPage();
	}
}