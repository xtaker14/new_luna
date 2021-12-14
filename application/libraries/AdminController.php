<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class AdminController extends MY_Controller {
	protected $role = '';
	protected $userId = '';
	protected $nama = '';
	protected $jabatan = '';
	protected $global = array ();
	protected $lastLogin = '';

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
		$this->load->model("admin_model");
		$data = $this->admin_model->getConfigWeb($this->id_config_web); 
		if($alldata){
			return $data;
		}
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

		$this->load->model('admin_model','main_m',TRUE);
		$data_config_web = $this->main_m->getConfigWeb($this->id_config_web);
		if(count($data_config_web)>1){
			redirect ( 'adm/login?admin-key='.$data_config_web['admin_access_key'] );
		} 
		redirect ( 'adm/login' );
	}

    function loadPage(){ 		
		$config_web = $this->getConfigWeb(true);
		$this->global['config_web'] = $config_web;
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