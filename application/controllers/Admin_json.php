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
    
    function donate_process(){ 
        $this->load->model("admin_model");
        $this->load->model("member_model");
        $donate_id = $this->input->post('donate_id',true);
        $to_status = $this->input->post('to_status',true);
        $description = $this->input->post('description',true);
        $get_donate = $this->admin_model->donate_list(array('d.id'=>$donate_id));
            
        if(empty($get_donate)){ 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
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
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: User Data is not found'
                )));
        }

        $this->db = dbloader("default");
        $donate_update = array(  
            'admin_id' => $admin_id,
        ); 
        $where_update = array(
            'id'=>$donate_id
        );
        $donate_update['status'] = $to_status;
        $donate_update['is_acc_by_admin'] = 'yes';
        $donate_update['admin_description'] = $description;
        if($to_status == 'paid'){
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
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Failed To Update Status'
                )));
        }

        if($to_status == 'paid'){
            
            $cash_points = (int)$get_donate[0]['donate_point'];
            $this->db->update('tbl_user',array(
                'star_point'=> ((int)$user_data['star_point'] + $cash_points),
            ),array(
                'id'=>$user_id
            ));
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback(); 
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Failed To Update Diamond'
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
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'result'=>'Error: Referral Code is not found'
                        )));
                } 
                $bonus_point = $cash_points * ($this->referral_bonus_points / 100);
                
                $this->db->query("UPDATE referral_code SET modified_date = '".$GLOBALS['date_now']."', silver_point = silver_point + $bonus_point WHERE referral_code = '$referral_code' ");
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback(); 
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
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
                    'silver_point' => $bonus_point,
                );
                $this->db->insert('referral_code_history',$ref_history_insert);
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback(); 
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'result'=>'Error: Failed To Update Refferal Code History'
                        )));
                }
                
                $this->db->query("UPDATE tbl_user SET star_point = star_point + $bonus_point WHERE referral_code = '$referral_code' ");
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback(); 
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'result'=>'Error: Failed To Update Silver Point By Referral Code'
                        )));
                }
                
                $this->db->query("UPDATE tbl_user SET star_point = star_point + $bonus_point WHERE id = $user_id ");
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback(); 
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
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
    }
    
    function go_make_donate_price(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>''
                )));
        }else{
            $post_data = $this->input->post('post_data');
            $id = $this->secureStr($post_data['input_id'],true);
            $input_value = $this->secureStr($post_data['input_value'],true);
            $input_price = $this->secureStr($post_data['input_price'],true);
            $input_currency = $this->secureStr($post_data['input_currency'],true);
            $input_description = $this->secureStr($post_data['input_description'],true);
            $is_hidden = $post_data['is_hidden']; 
            if(!empty($is_hidden)){
                $is_hidden='yes';
            }else{
                $is_hidden='no';
            }
            $res_all_items = $this->input->post('res_all_items');
    
            $data_save = array(
                'value' => $input_value,
                'price' => $input_price,
                'currency' => $input_currency,
                'description' => $input_description,
                'is_hidden' => $is_hidden,
                'items' => $res_all_items,
            );
    
            $this->db = dbloader("default"); 
            $this->db->trans_begin();
            if(isset($id) && !empty($id)){
                $data_save['modified_date'] = $GLOBALS['date_now'];
    
                $this->db->update('donate_price_list',$data_save,array(
                    'id'=>$id
                ));
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'result'=>'Error: (1)'
                        )));
                }
            }else{ 
                $data_save['created_date'] = $GLOBALS['date_now'];
    
                $this->db->insert('donate_price_list',$data_save);
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'result'=>'Error: (2)'
                        )));
                }
            }
            $this->db->trans_commit(); 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>true, 
                )));
        }
	}

    function web_config(){
        $this->load->model("admin_model");
        $this->load->model("member_model");
        $admin_id = $this->userId;
        
        $post_data = $this->input->post('post_data');
        $input_web_name = $this->secureStr($post_data['input_web_name'],true);
        $input_title_web_name = $this->secureStr($post_data['input_title_web_name'],true);
        $input_initial_total_online = $this->secureStr($post_data['input_initial_total_online'],true);
        $input_email_account_number = $this->secureStr($post_data['input_email_account_number'],true);
        $input_widget_discord_link = $this->secureStr($post_data['input_widget_discord_link'],true,[
            ':',
            '/',
            '.',
            '?',
            '=',
            '&',
            '-',
            '_',
        ]);
        $input_admin_access_key = $this->secureStr($post_data['input_admin_access_key'],true,[
            '_',
        ]);
        $input_maintenance_access_key = $this->secureStr($post_data['input_maintenance_access_key'],true,[
            '_',
        ]);
        $input_referral_bonus_points = $this->secureStr($post_data['input_referral_bonus_points'],true);
        $input_is_maintenance = $this->secureStr($post_data['input_is_maintenance'],true);
        $input_other_maintenance = $this->secureStr($post_data['input_other_maintenance'],true);
        $input_server_location = $this->secureStr($post_data['input_server_location'],true,[
            '[',
            ']',
        ]);
        $input_server_status = $this->secureStr($post_data['input_server_status'],true);
        $input_server_cap_lvl = $this->secureStr($post_data['input_server_cap_lvl'],true);
        $input_server_exp = $this->secureStr($post_data['input_server_exp'],true);
        $input_server_exp_party = $this->secureStr($post_data['input_server_exp_party'],true);
        $input_server_gold = $this->secureStr($post_data['input_server_gold'],true);
        $input_server_drop = $this->secureStr($post_data['input_server_drop'],true);

        $input_email_active_dummy = $this->secureStr($post_data['input_email_active_dummy'],true);
        $input_email_protocol = $this->secureStr($post_data['input_email_protocol'],true);
        $input_email_smtp_port = $this->secureStr($post_data['input_email_smtp_port'],true);
        $input_email_smtp_host = $this->secureStr($post_data['input_email_smtp_host'],true,[
            ':',
            '/',
            '.',
            '?',
            '=',
            '&',
            '-',
            '_',
        ]);
        $input_email_charset = $this->secureStr($post_data['input_email_charset'],true,[
            ':',
            '/',
            '.',
            '?',
            '=',
            '&',
            '-',
            '_',
        ]);
        $input_email_smtp_user = $this->secureStr($post_data['input_email_smtp_user'],true);
        $input_email_smtp_pass = $this->secureStr($post_data['input_email_smtp_pass'],true);
        
        $account_number = $this->input->post('account_number');

        if(empty($input_initial_total_online)){
            $input_initial_total_online = 0;
        }
            
        $get_configweb = $this->getConfigWeb(); 
        if(empty($get_configweb)){ 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Web Config tidak ditemukan'
                )));
        } 

        $this->db->trans_begin(); 
        $this->db->update('web_config',array(
            'web_name'=>$input_web_name,
            'title_web_name'=>$input_title_web_name,
            'initial_total_online'=>$input_initial_total_online,
            'server_location' => $input_server_location,
            'server_status' => $input_server_status,
            'server_cap_lvl' => $input_server_cap_lvl,
            'server_exp_party' => $input_server_exp_party,
            'server_exp' => $input_server_exp,
            'server_gold' => $input_server_gold,
            'server_drop' => $input_server_drop,
            'email_account_number'=>$input_email_account_number,
            'widget_discord_link'=>$input_widget_discord_link,
            'admin_access_key'=>$input_admin_access_key,
            'maintenance_access_key'=>$input_maintenance_access_key,
            'referral_bonus_points'=>$input_referral_bonus_points,
            'is_maintenance'=>$input_is_maintenance,
            'other_maintenance'=>$input_other_maintenance,
            'account_number'=>$account_number,

            'email_active_dummy' => $input_email_active_dummy,
            'email_protocol' => $input_email_protocol,
            'email_smtp_port' => $input_email_smtp_port,
            'email_smtp_host' => $input_email_smtp_host,
            'email_charset' => $input_email_charset,
            'email_smtp_user' => $input_email_smtp_user,
            'email_smtp_pass' => $input_email_smtp_pass,
        ),array(
            'id'=>$this->id_config_web
        )); 
        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback(); 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Failed To Update Web Config'
                )));
        } 
        $this->db->trans_commit();
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'result'=>true, 
            )));
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
    function set_status_media(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            json('');
        }else{
            $id = $this->input->post('id',true);
            $this->db->select('*');
            $this->db->from('media');
            $this->db->where('id = '.$id);
            $do = $this->db->get()->row_array(); 
            if(count($do)>0){
                $set_to = 'yes';
                if($do['is_hidden']=='yes'){
                    $set_to = 'no';
                }
                $this->db->trans_begin();
                $this->db->update('media',array(
                    'is_hidden'=>$set_to
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
    function get_media_last_no_order(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            json('');
        }else{
            $type = $this->input->post('type',true);
            $this->db->order_by('no_order','DESC');
            $this->db->select('no_order');
            $this->db->from('media');
            $this->db->where('type',$type);
            $this->db->limit(1);
            $do = $this->db->get()->row_array(); 
            json($do);
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
    function update_checkin_day(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            json('');
        }else{
            $id = $this->input->post('id',true); 
            $value = $this->input->post('value',true); 

            $this->db->trans_begin();
            $modified_date = $GLOBALS['date_now'];
            $do = $this->db->update('daily_checkin_item',array(
                'checkin_day' => $value,
                'modified_date' => $modified_date,
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
            return json(array(
                'result'=>true,
                'modified_date' => date('d M Y H:i:s', strtotime($modified_date)),
            ));
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