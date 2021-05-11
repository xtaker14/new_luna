<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Member_login extends CI_Controller {

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

	function register(){
        $check = $this->google_verify();
        if($check == true){
            setFlashData('error', 'Please try again bro..');
            redirect(base_url('register'));
        }else{
            $this->load->model("member_model");
            $isAdminLogin = $this->session->userdata('usr_session');            
            if($isAdminLogin == TRUE){
                setFlashData('error', 'Please logout for register..');
                redirect(base_url());
            }else{		
        		$id_email = strtolower($this->input->post('id_email',true));
        		$id_loginid = $this->input->post('user_id',true);
        		$pin_code = $this->input->post('pin',true);
        		$id_passwd = $this->input->post('password',true);
        		$c_password = $this->input->post('c_password',true);

        		$this->load->library('form_validation');
                
                $this->form_validation->set_rules('id_email', 'id_email', 'required|valid_email|max_length[50]|trim');
                $this->form_validation->set_rules('user_id', 'user_id', 'required|min_length[4]|max_length[16]');
                $this->form_validation->set_rules('pin', 'pin', 'required|numeric|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[16]');
                $this->form_validation->set_rules('c_password', 'Password Confirmation', 'required|matches[password]');
                if($this->form_validation->run() == FALSE || stripos($id_loginid,"admin") !== FALSE)
                {
                	setFlashData('error', 'Failed to registry, please make sure your information is valid.');
                    redirect(base_url());
                }
                else
                {
                    $check_user = $this->member_model->select_idx($id_loginid);
                    if(!empty($check_user)){                    
                        setFlashData('error', 'Username is not avaliable..');
                        redirect(base_url());
                    }else{
                        $this->load->helper('string');
                        $data = array($id_loginid, $id_email, $id_passwd, $pin_code);
            			$do = $this->member_model->insert_WebMember($data);
            			if($do==true){
            				setFlashData('success', 'You have successfully register..');
            				redirect(base_url());
            			}else{
                            setFlashData('error', 'Something error..');
            				redirect(base_url());
            			}
                    }
        		}
            }
        }
	}

	function login(){
        $check = $this->google_verify();
        if($check == true){
            setFlashData('error', 'Please try again bro..');
            redirect(base_url('login'));
        }else{
            $this->load->model("member_model");
            $isAdminLogin = $this->session->userdata('usr_session');        
            if($isAdminLogin == TRUE){
                setFlashData('error', 'Please logout for register..');
                redirect(base_url());
            }else{            
                $this->load->library('form_validation');  
                $this->form_validation->set_rules('user_id', 'user_id', 'required|min_length[4]|max_length[16]');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[16]');
                
                if($this->form_validation->run() == FALSE)
                {
                    setFlashData('error', 'Something error..');
                    redirect(base_url('login'));
                }
                else
                {
        			$id_loginid = $this->input->post('user_id',true);
        			$id_passwd = $this->input->post('password',true);

                    $result = $this->member_model->login($id_loginid,$id_passwd);
                    if(!empty($result)){
                        $sess = array( 'propid'=>$result->id,
                        			   'usr_code'=>$result->code,
                                       'id_email'=>$result->email,
                                       'star_point'=>$result->star_point,
                                       'id_loginid'=>$id_loginid,
                                       'usr_session' => TRUE
                                    );
                        $this->session->set_userdata($sess);
                        setFlashData('success', 'You are login as '.$id_loginid.'.');
                        redirect(base_url());
                    }else{
                        setFlashData('error', 'User id or password mismatch');                
                        redirect(base_url('login'));
                    }
                }
            }
        }
    }
}