<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';
class Member_action extends FrontLib {
	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model("member_model");
        $this->is_login();
	}

    function go_pin_req(){
        $check = $this->google_verify();
        if($check == true){
            setFlashData('error', 'Failed, please try again..');
            redirect(base_url('pin_req'));
        }else{
            //do change
            $code = $this->session->userdata ( 'usr_code' );
            $email = $this->session->userdata ( 'id_email' );
            if(empty($code) || empty($email)){
                setFlashData('error', 'you must login..');
                redirect(base_url('login'));
            }else{
                $is_requested = $this->member_model->pin_req_checker($code);
                if($is_requested > 0){
                    setFlashData('error', 'You have requested today, please check your email inbox or spam..');
                    redirect(base_url(''));
                }else{
                    $rand_code = random_string('alnum', 50);
                    $subject = 'Change PIN Request';
                    $reset_url = base_url('change_pin/'.$rand_code);
                    $mail_content = '<p>You have request new PIN for Zone Luna account.<br><br>Click this link : <a href="'.$reset_url.'" target="_blank">Click here</a><br>or,<br>Copy and paste this link to your browser : '.$reset_url.'</p>';

                    $this->load->model('send_mail');
                    $info = array('to' => $email,
                                  'subject' => $subject,
                                  'content' => $mail_content,
                                  'from' => array('email' => 'noreply@Zoneluna.com', 'name' => SITE_NAME));
                    $do = $this->send_mail->send($info);

                    if($do){
                        $request_info = array('code' => $code, 'rand_code' => $rand_code, 'created' => date('Y-m-d-H-i-s'));
                        $do = $this->member_model->go_pin_req($request_info);
                        if($do){
                            setFlashData('success', 'Success request, please check you email.');
                            redirect(base_url('pin_req')); 
                        }else{
                            setFlashData('error', 'failed, please try again..');
                            redirect(base_url('pin_req'));
                        }
                    }else{
                        setFlashData('error', 'failed to send email..');
                        redirect(base_url('pin_req'));
                    }
                }
            }
        }
    }

    function go_change_pin(){
        $check = $this->google_verify();
        if($check == true){
            setFlashData('error', 'Failed, please try again..');
            redirect(base_url('change_pin'));
        }else{
            //do change
            $code = $this->session->userdata ( 'usr_code' );
            if(empty($code)){
                setFlashData('error', 'you must login..');
                redirect(base_url('login'));
            }else{
                $new_pin = $this->input->post('pin',true);
                $rand_code = $this->input->post('rand_code',true);
                $password = $this->input->post('password',true);
                $this->load->library('form_validation');
                $this->form_validation->set_rules('pin', 'pin', 'required|numeric|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[16]');
                $this->form_validation->set_rules('rand_code', 'rand_code', 'required|min_length[40]');
                if($this->form_validation->run() == FALSE){
                    setFlashData('error', 'Failed to change pin, please make sure your information is valid.');
                    redirect(base_url('change_pin/'.$rand_code)); 
                }else{
                    $do = $this->member_model->change_pin($code,$rand_code,$password,$new_pin);
                    if(!empty($do)){
                        setFlashData($do[1], $do[2]);
                        redirect(base_url($do[0])); 
                    }
                }
            }
        }
    }

    function go_change_pwd(){
        $check = $this->google_verify();
        if($check == true){
            setFlashData('error', 'Please comfirm human verification..');
            redirect(base_url('change_pin'));
        }else{
            //do change
            $code = $this->session->userdata ( 'usr_code' );

            if(empty($code)){
                setFlashData('error', 'you must login..');
                redirect(base_url('login'));
            }else{
                $pin = $this->input->post('pin',true);
                $old_password = $this->input->post('old_password',true);
                $new_password = $this->input->post('new_password',true);
                $this->load->library('form_validation');
                $this->form_validation->set_rules('pin', 'pin', 'required|numeric|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]');
                $this->form_validation->set_rules('old_password', 'old_password', 'required|min_length[6]|max_length[16]');
                $this->form_validation->set_rules('new_password', 'new_password', 'required|min_length[6]|max_length[16]');
                if($this->form_validation->run() == FALSE){
                    setFlashData('error', 'Failed to change password, please make sure your information is valid.');
                    redirect(base_url('change_pwd')); 
                }else{
                    $do = $this->member_model->change_pwd($code,$old_password,$new_password,$pin);
                    if(!empty($do)){
                        setFlashData($do[0], $do[1]);
                        redirect(base_url('change_pwd'));
                    }
                }
            }
        }
    }

    function logout() {
		$this->session->sess_destroy();
		setFlashData('success', 'You are logout..');	
		redirect(base_url());	
	}
    function go_teleport() {
        $check = $this->google_verify();
        if($check == true){
            setFlashData('error', 'Failed, please try again..');
            redirect(base_url('teleport'));
        }else{
            $map_id = $this->input->post('b',true);
            $char_idx = $this->input->post('a',true);
            $user_idx = $this->propid;
            $this->load->library('form_validation');
                
            $this->form_validation->set_rules('a', 'a', 'required');
            $this->form_validation->set_rules('b', 'b', 'required');
            if($this->form_validation->run() == FALSE || empty($user_idx)){
                setFlashData('error', 'Error! Something error, please contact moonlight luna administrator.');
                redirect(base_url('teleport'));
            }else{
                $pos_x = 0;
                $pos_y = 0;
                if($map_id==19){
                    $pos_x = 15600;
                    $pos_y = 11700;
                }elseif($map_id==20){
                    $pos_x = 35800;
                    $pos_y = 38200;
                }else{
                    setFlashData('error', 'Please make sure you select alker harbor or gate of alker');
                    redirect(base_url('teleport'));  
                    die; 
                }
                $info = array('char_idx' => $char_idx, 'user_idx' => $user_idx, 'map_id' => $map_id,  'pos_x' => $pos_x, 'pos_y' => $pos_y);
                $do = $this->member_model->update_map($info);
                if($do==true){
                    setFlashData('success', 'Success, Please login Zone luna.');   
                    redirect(base_url('teleport'));  
                }else{
                    setFlashData('error', 'Error, please contact Zone luna administrator.');
                    redirect(base_url('teleport'));  
                }
            }
        }
    }
}