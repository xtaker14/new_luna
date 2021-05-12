<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';

class Donate extends FrontLib {

	public function __construct(){
		parent::__construct();
		error_reporting(0); 
        $this->is_login();
        $this->xepo_secure();
        $this->load->library('form_validation');
	}
    
    private function sendEmailStatus($data_send,$status='paid',$show_error=false){
        $pars = array();
        if(!empty($data_send['pars_view'])){
            $pars = $data_send['pars_view'];
            unset($data_send['pars_view']);
        }
        $msg = $this->load->view('app/_main/_donate/_email/'.$status.'.php', $pars, true);
        $data_send['msg'] = $msg;
        return $this->send_email($data_send,$show_error);
    }

    function submit($case){
        switch ($case) {
            case 'paid':
                $this->load->model("frontpage_model");
                $user_id = $this->propid;
                $user_email = $this->id_email;
                $donate_id = $this->input->post('donate_id',true);
                $get_donate = $this->frontpage_model->donate_list($user_id, array('d.id'=>$donate_id));
                if(empty($get_donate)){
                    setFlashData('error', 'Error: Donate Data is not found');
                    redirect(base_url('donate'));
                }

                $date_now = date('d M Y');
                if(!empty($get_donate[0]['recheck_date'])){
                    $recheck_again_date = $this->plus_min_date($get_donate[0]['recheck_date'],["+1 day","d M Y"]);
                    if($date_now !== $recheck_again_date){
                        setFlashData('error', 'Error: This is not the time to recheck');
                        redirect(base_url('donate'));
                    }
                }

                $this->db = dbloader("default");
                $donate_update = array(  
                    'recheck_date' => $GLOBALS['date_now'], 
                ); 
                $where_update = array(
                    'id'=>$donate_id
                );

                $this->db->trans_begin();
                $this->db->update('donate',$donate_update,$where_update);
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    setFlashData('error', 'Error: Failed To Recheck');
                    redirect(base_url('donate'));
                    return false;
                }

                $web_config = $this->getConfigWeb();
                $email_account_number = $web_config['email_account_number'];
				$send_email = $this->sendEmailStatus(array(
                    'title'=>'[Paid] Donate Order',
                    'from'=>$user_email,
                    'to'=>$email_account_number,
                    'subject'=>'[Luna Zone] Payment has been sent',
                    'pars_view'=>array('get_donate'=>$get_donate[0])
                ),'paid');

                if($send_email){
                    $this->db->trans_commit();
                    setFlashData('success', 'Successfully submitted recheck to our staff');
                }else{
                    $this->db->trans_rollback();
                    setFlashData('error', 'Error: Failed to send email');
                }
                redirect(base_url('donate'));
                return $send_email;
                break;
                
            case 'pending': 
                $this->load->model("frontpage_model");
                $user_id = $this->propid;
                $user_email = $this->id_email;
                $donate_id = $this->input->post('donate_id',true);
                if(empty($donate_id)){
                    setFlashData('error', 'Error: Donate ID is not found');
                    redirect(base_url('donate'));
                }
                $input_account_number = $this->input->post('input_account_number',true);

                $get_donate = $this->frontpage_model->donate_list($user_id, array('d.id'=>$donate_id));
                if(empty($get_donate)){
                    setFlashData('error', 'Error: Donate Data is not found');
                    redirect(base_url('donate'));
                }

                $this->db = dbloader("default");
                $donate_update = array( 
                    'payment_method' => $input_account_number,
                    'status' => 'paid', 
                    'paid_date' => $GLOBALS['date_now'], 
                ); 
                $where_update = array(
                    'id'=>$donate_id
                );

                $this->db->trans_begin();
                $this->db->update('donate',$donate_update,$where_update);
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    setFlashData('error', 'Error: Failed To Update Status Paid');
                    redirect(base_url('donate'));
                    return false;
                }

                $get_donate[0]['status']='paid';
                $get_donate[0]['payment_method']=$input_account_number;
                $web_config = $this->getConfigWeb();
                $email_account_number = $web_config['email_account_number'];
                $send_email = $this->sendEmailStatus(array(
                    'title'=>'[Paid] Donate Order',
                    'from'=>$user_email,
                    'to'=>$email_account_number,
                    'subject'=>'[Luna Zone] Payment has been sent',
                    'pars_view'=>array('get_donate'=>$get_donate[0])
                ),'paid', true);

                if($send_email){
                    $this->db->trans_commit();
                    setFlashData('success', 'Successfully paid, wait a moment until our staff is done checking');
                }else{
                    $this->db->trans_rollback();
                    setFlashData('error', 'Error: Failed To Send Email');
                }
                redirect(base_url('donate'));
                return $send_email;
                break;
        } 
    }

    function popup($case){
        if(!$this->onlyAllowAccessFromAjax()){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode(array(
                    'result'=>'Error: Only Allow Access From Ajax'
                )));
        }

        switch ($case) {
            case 'paid': 
                $this->load->model("frontpage_model");
                $id = $this->input->post('id',true);
                if(empty($id)){
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode(array(
                            'result'=>'Error: ID is not found'
                        )));
                }
                $user_id = $this->propid;
                $web_config = $this->getConfigWeb();
                $account_number = $web_config['account_number'];
                $get_donate = $this->frontpage_model->donate_list($user_id, array('d.id'=>$id));
                if(empty($get_donate)){
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode(array(
                            'result'=>'Error: Donate Data is not found'
                        )));
                }
                
                $xepo_name = $this->global['xepo_secure']['name'];
                $xepo_value = $this->global['xepo_secure']['hash'];

                $get_donate[0]['recheck_again_date'] = $this->plus_min_date($get_donate[0]['recheck_date'],["+1 day","Y-m-d H:i:s"]);

                $view = $this->load->view('app/_main/_donate/_part/paid_popup.php', array(
                    'account_number' => $account_number,
                    'xepo_name'=>$xepo_name,
                    'xepo_value'=>$xepo_value,
                    'get_donate' => $get_donate[0],
                ), true);

                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>$view, 
                        'xepo_name'=>$xepo_name,
                        'xepo_value'=>$xepo_value, 
                    )));
                break;
            case 'pending': 
                $this->load->model("frontpage_model");
                $id = $this->input->post('id',true);
                if(empty($id)){
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode(array(
                            'result'=>'Error: ID is not found'
                        )));
                }
                $user_id = $this->propid;
                $web_config = $this->getConfigWeb();
                $account_number = $web_config['account_number'];
                $get_donate = $this->frontpage_model->donate_list($user_id, array('d.id'=>$id));
                if(empty($get_donate)){
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode(array(
                            'result'=>'Error: Donate Data is not found'
                        )));
                }
                
                $xepo_name = $this->global['xepo_secure']['name'];
                $xepo_value = $this->global['xepo_secure']['hash'];
                $view = $this->load->view('app/_main/_donate/_part/pending_popup.php', array(
                    'account_number' => $account_number,
                    'xepo_name'=>$xepo_name,
                    'xepo_value'=>$xepo_value,
                    'get_donate' => $get_donate[0],
                ), true);

                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>$view, 
                        'xepo_name'=>$xepo_name,
                        'xepo_value'=>$xepo_value, 
                    )));
                break;
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(403)
            ->set_output(json_encode(array(
                'result'=>false
            )));
    }

    function buy() {
        $check = $this->google_verify();
        if($check == true){
            setFlashData('error', 'Error: Please try again');
            redirect(base_url('donate'));
        }else{
            $user_id = $this->propid;
            $usr_code = $this->usr_code;
            $input_username = $this->input->post('input_username',true);
            $input_amount = $this->input->post('input_amount',true);
            $input_referral_code = $this->input->post('input_referral_code',true); 

            $exp_input_amount = explode('|',$input_amount);
            if(count($exp_input_amount)==0){ 
                setFlashData('error', 'Error: Please try again');
                redirect(base_url('donate'));
            }
            $donate_price_id = $exp_input_amount[0];
            $donate_price = $exp_input_amount[1];

            // $this->form_validation->set_rules('pin', 'pin', 'required|numeric|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]');
            $this->form_validation->set_rules('input_username', 'USERNAME', 'trim|required');
            $this->form_validation->set_rules('input_amount', 'DONATION TYPES', 'trim|required');
            $this->form_validation->set_rules('input_referral_code', 'REFERRAL CODE', 'trim'); 

            if ($this->form_validation->run() == false) {
                setFlashData('error', 'Error: Form validation failed');
                redirect(base_url('donate'));
            }else{
                if(empty($user_id) || empty($usr_code)){ 
                    setFlashData('error', 'Error: You must login');
                    redirect(base_url('donate'));
                }else{
                    // user_id
                    // user_code
                    // username
                    // donate_price_id
                    // donate_price
                    // referral_code
                    // payment_method
                    // status
                    // paid_date
                    // complete_date
                    $this->db = dbloader("default");
 
                    $data_referral_code = null;
                    if(!empty($input_referral_code)){
                        $this->db->where('referral_code', $input_referral_code);
                        $this->db->where('is_deleted', 'no');
                        $this->db->where('user_id !=', $user_id);
                        $data_referral_code = $this->db->get('referral_code')->row_array();
                        if(count($data_referral_code)==0){
                            setFlashData('error', 'Referral Code is not found');
                            redirect(base_url('donate'));
                        } 
                    } 

                    $donate_insert = array(
                        'user_id' => $user_id,
                        'user_code' => $usr_code,
                        'username' => $input_username,
                        'donate_price_id' => $donate_price_id,
                        'donate_price' => $donate_price,
                        // 'referral_code' => $input_referral_code,
                        // 'payment_method' => '',
                        // 'status' => 'pending',
                        'created_date' => $GLOBALS['date_now'], 
                        // 'paid_date' => null,
                        // 'complete_date' => null,
                    );
                    if(!empty($data_referral_code)){
                        $donate_insert['referral_code'] = $input_referral_code;
                    }
                    $this->db->trans_begin();
                    $this->db->insert('donate',$donate_insert);
                    $donate_id = $this->db->insert_id();
                    if($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        setFlashData('error', 'Error: Failed To Insert Donate');
                        redirect(base_url('donate'));
                        return false;
                    }
                    // $referral_insert = array(
                    //     'donate_id' => $donate_id,
                    //     'from_user_id' => $user_id,
                    //     'referral_code' => $input_referral_code,
                    //     'point' => 0, 
                    // );
                    // $this->db->insert('referral_code_history',$referral_insert);

                    $this->db->trans_commit();
					setFlashData('success', 'Successfully submitting a donation, please proceed to the payment process');
                    redirect(base_url('donate'));
                    return true;
                }
            }
        }
    }
}