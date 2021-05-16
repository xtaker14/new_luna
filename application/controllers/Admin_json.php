<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/AdminController.php';
class Admin_json extends AdminController {
    public function __construct()
    {
		parent::__construct();
		$this->isLoggedIn();
	}

    private function sendEmailStatus($data_send,$status='paid',$show_error=false){
        $pars = array();
        if(!empty($data_send['pars_view'])){
            $pars = $data_send['pars_view'];
            unset($data_send['pars_view']);
        }
        $msg = $this->load->view('admin/_main/_donate/_email/'.$status.'.php', $pars, true);
        $data_send['msg'] = $msg;
        return $this->send_email($data_send,$show_error);
    }

    function donate_process($case){
        switch ($case) {
            case 'paid':
                $this->load->model("admin_model");
                $this->load->model("member_model");
                $donate_id = $this->input->post('donate_id',true);
                $to_status = $this->input->post('to_status',true);
                $get_donate = $this->admin_model->donate_list(array('d.id'=>$donate_id));
                    
                if(empty($get_donate)){ 
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode(array(
                            'result'=>'Error: Donate Data is not found'
                        )));
                }
                $admin_id = $this->userId;
                $user_id = $get_donate[0]['user_id'];
                $user_data = $this->member_model->getWhereUser(array(
                    'id'=>$user_id
                ))->row_array();
                if(empty($user_data)){ 
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode(array(
                            'result'=>'Error: User Data is not found'
                        )));
                }
                $user_email = $user_data['email']; 

                $this->db = dbloader("default");
                $donate_update = array(  
                    'admin_id' => $admin_id,
                ); 
                $where_update = array(
                    'id'=>$donate_id
                );
                $donate_update['status'] = $to_status;
                if($to_status == 'complete'){
                    $donate_update['complete_date'] = $GLOBALS['date_now'];
                }else{
                    $donate_update['canceled_date'] = $GLOBALS['date_now'];
                }

                $this->db->trans_begin();
                $this->db->update('donate',$donate_update,$where_update);
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback(); 
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode(array(
                            'result'=>'Error: Failed To Update Status Complete'
                        )));
                }

                if($to_status == 'complete'){
                    $diamonds = (int)$get_donate[0]['donate_price'];
                    $this->db->update('tbl_user',array(
                        'star_point'=> ((int)$user_data['star_point'] + $diamonds),
                    ),array(
                        'id'=>$user_id
                    ));
                    if($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback(); 
                        return $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(403)
                            ->set_output(json_encode(array(
                                'result'=>'Error: Failed To Update Diamonds'
                            )));
                    }
                    $referral_code = $get_donate[0]['referral_code'];
                    if(!empty($referral_code)){
                        $where_referral = array(
                            'referral_code'=>$referral_code
                        );
                        $data_referral_code = $this->db->get_where('referral_code',$where_referral)->row_array();
                        if(count($data_referral_code)==0){ 
                            return $this->output
                                ->set_content_type('application/json')
                                ->set_status_header(403)
                                ->set_output(json_encode(array(
                                    'result'=>'Error: Referral Code is not found'
                                )));
                        } 
                        $silver_point = $diamonds * ($this->referral_bonus_points / 100);

                        // $ref_update = array(
                        //     'modified_date' => $GLOBALS['date_now'],
                        //     'silver_point' => "silver_point + $silver_point",
                        // );
                        // $this->db->update('referral_code',$ref_update,$where_referral);
                        $this->db->query("UPDATE referral_code SET modified_date = '".$GLOBALS['date_now']."', silver_point = silver_point + $silver_point WHERE referral_code = '$referral_code' ");
                        if($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback(); 
                            return $this->output
                                ->set_content_type('application/json')
                                ->set_status_header(403)
                                ->set_output(json_encode(array(
                                    'result'=>'Error: Failed To Update Refferal Code'
                                )));
                        }

                        // $this->referral_bonus_points
                        $ref_history_insert = array(
                            'donate_id' => $donate_id,
                            'admin_id' => $admin_id,
                            'from_user_id' => $user_id,
                            'referral_code' => $referral_code,
                            'silver_point' => $silver_point,
                        );
                        $this->db->insert('referral_code_history',$ref_history_insert);
                        if($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback(); 
                            return $this->output
                                ->set_content_type('application/json')
                                ->set_status_header(403)
                                ->set_output(json_encode(array(
                                    'result'=>'Error: Failed To Update Refferal Code History'
                                )));
                        }
                        
                        // $this->db->update('tbl_user',array(
                        //     'silver_point'=> "silver_point + $silver_point",
                        // ),$where_referral);
                        $this->db->query("UPDATE tbl_user SET silver_point = silver_point + $silver_point WHERE referral_code = '$referral_code' ");
                        if($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback(); 
                            return $this->output
                                ->set_content_type('application/json')
                                ->set_status_header(403)
                                ->set_output(json_encode(array(
                                    'result'=>'Error: Failed To Update Silver Point By Referral Code'
                                )));
                        }

                        // $this->db->update('tbl_user',array(
                        //     'silver_point'=> "silver_point + $silver_point",
                        // ),array(
                        //     'id'=>$user_id
                        // ));
                        $this->db->query("UPDATE tbl_user SET silver_point = silver_point + $silver_point WHERE id = $user_id ");
                        if($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback(); 
                            return $this->output
                                ->set_content_type('application/json')
                                ->set_status_header(403)
                                ->set_output(json_encode(array(
                                    'result'=>'Error: Failed To Update Silver Point'
                                )));
                        }
                    }
                }
                
                $this->db->trans_commit();
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>true, 
                    )));

                // $web_config = $this->getConfigWeb();
                // $email_account_number = $web_config['email_account_number'];
				// $send_email = $this->sendEmailStatus(array(
                //     'title'=>'[Paid] Donate Order',
                //     'from'=>$email_account_number,
                //     'to'=>$user_email,
                //     'subject'=>'[Luna Zone] Payment has been sent',
                //     'pars_view'=>array('get_donate'=>$get_donate[0])
                // ),'paid');

                // if($send_email){
                //     $this->db->trans_commit();
                //     setFlashData('success', 'Successfully submitted recheck to our staff');
                // }else{
                //     $this->db->trans_rollback();
                //     setFlashData('error', 'Error: Failed to send email');
                // }
                // redirect(base_url('adm/donate'));
                // return $send_email;
                break;
        }
    }

	function usr_search(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            json('');
        }else{
    		$q = $this->input->post('username',true);
            $this->db = dbloader("LUNA_MEMBERDB");
            $do = $this->db->query("SELECT TOP 5 id_loginid from chr_log_info WHERE id_loginid LIKE '%$q%' ")->result_array();
            json($do);
        }
	}
    
    function set_status_referral(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            json('');
        }else{
            $id = $this->input->post('id',true);
            $this->db->select('*');
            $this->db->from('referral_code');
            $this->db->where('id = '.$id);
            $do = $this->db->get()->row_array(); 
            if(count($do)>0){
                $set_to = 'yes';
                if($do['is_deleted']=='yes'){
                    $set_to = 'no';
                }
                $this->db->trans_begin();
                $this->db->update('referral_code',array(
                    'is_deleted'=>$set_to
                ),array(
                    'id'=>$id
                ));
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback(); 
                    return json(array(
                        'result'=>false
                    ));
                }
                $this->db->trans_commit();
                json(array(
                    'result'=>$set_to
                ));
            }else{
                json(array(
                    'result'=>false
                ));
            }
        }
    }
    function referral_code_search(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            json('');
        }else{
            $q = $this->input->post('text',true);
            $this->db->select('*');
            $this->db->from('referral_code');
            $this->db->where('referral_code LIKE "%'.$q.'%"');
            $this->db->limit(10);
            $do = $this->db->get()->result_array(); 
            json($do);
        }
    }
    function username_search(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            json('');
        }else{
            $q = $this->input->post('text',true);
            $this->db->select('*');
            $this->db->from('tbl_user');
            $this->db->where('username LIKE "%'.$q.'%" AND (referral_code = \'\' OR referral_code IS NULL)');
            $this->db->limit(10);
            $do = $this->db->get()->result_array(); 
            json($do);
        }
    }
    function bin_search(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            json('');
        }else{
            $q = $this->input->post('text',true);
            $this->db->select('*');
            $this->db->from('tbl_item');
            $this->db->where('(nama LIKE "%'.$q.'%" OR bin_source LIKE "%'.$q.'%" )');
            $this->db->limit(10);
            $do = $this->db->get()->result_array(); 
            json($do);
        }
    }

    function get_data_admin(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            $this->json(array('null'));
        }else{
            $admin_id = $this->input->post('admin_id',TRUE);
            $data = $this->db->query('SELECT * FROM tbl_admin WHERE id="'.$admin_id.'"')->row();
            json($data);
        }
    }
}