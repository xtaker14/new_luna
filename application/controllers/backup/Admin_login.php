<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/AdminController.php';
class Admin_login extends AdminController {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_login_model');
    }
    
    function login()
    {
        $isAdminLogin = $this->session->userdata ( 'isAdminLogin' );
        
        if($isAdminLogin == TRUE)
        {
            redirect('/adm/dashboard','refresh');

        }else{
            $data['xepo_secure'] = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
            );

            $this->load->view('admin/login',$data);
        }
    }
    
    
    /**
     * This function used to logged in admin
     */
    public function glogin()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->login();
        }
        else
        {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            $result = $this->admin_login_model->adminLogin($email, $password);
            
            if(!empty($result))
            {

                $sessionArray = array('userId'=>$result->id,                    
                                        'role'=>$result->roleId,
                                        'nama'=>$result->nama,
                                        'jabatan'=>$result->jabatan,
                                        'isAdminLogin' => TRUE
                                );
                
                $this->session->sess_expiration = '32140800'; //~ one year
                $this->session->set_userdata($sessionArray);

                redirect('/adm/dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                
                redirect('/adm/login');
            }
        }
    }

}

?>