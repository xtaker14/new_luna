<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';

class Donate extends FrontLib {

	public function __construct(){
		parent::__construct();
		error_reporting(0); 
        $this->is_login();
        $this->xepo_secure(); 

        // $params = array('server_key' => $this->midtrans_server_key, 'production' => false);
		// $this->load->library('midtrans');
		// $this->midtrans->config($params);
        $this->load->library('form_validation');
	} 

    function popup($case){
        if(!$this->onlyAllowAccessFromAjax()){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Only Allow Access From Ajax'
                )));
        }

        $this->load->model("frontpage_model");
        $id = $this->securePost('id',true,false);
        if(empty($id)){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: ID is not found'
                )));
        }
        $user_id = $this->propid;
        $web_config = $this->getConfigWeb(); 
        $get_donate = $this->frontpage_model->donate_list($user_id, array('d.id'=>$id));
        if(empty($get_donate)){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Donate Data is not found'
                )));
        }
        
        $xepo_name = $this->global['xepo_secure']['name'];
        $xepo_value = $this->global['xepo_secure']['hash']; 
        
        $view_popup = 'app/_main/_donate/_part/unpaid_popup.php';
        if($get_donate[0]['status'] == 'paid'){
            $view_popup = 'app/_main/_donate/_part/paid_popup.php';
        }
        $account_tf = array(
            'idr_payment_type' => $this->cekmutasi_to_idr_payment_type,
            'idr_name' => $this->cekmutasi_to_idr_name,
            'idr_account' => $this->cekmutasi_to_idr_account,
            'idr_code' => $this->cekmutasi_to_idr_code,

            'usd_payment_type' => $this->cekmutasi_to_usd_payment_type,
            'usd_name' => $this->cekmutasi_to_usd_name,
            'usd_account' => $this->cekmutasi_to_usd_account,
            'usd_code' => $this->cekmutasi_to_usd_code,
        );
        $view = $this->load->view($view_popup, array( 
            'xepo_name'=>$xepo_name,
            'xepo_value'=>$xepo_value,
            'get_donate' => $get_donate[0],
            'account_tf' => $account_tf,
        ), true);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'result'=>$view, 
                'xepo_name'=>$xepo_name,
                'xepo_value'=>$xepo_value, 
            ))); 
    }
    // function backup_popup($case){
    //     if(!$this->onlyAllowAccessFromAjax()){
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: Only Allow Access From Ajax'
    //             )));
    //     }

    //     $this->load->model("frontpage_model");
    //     $id = $this->securePost('id',true,false);
    //     if(empty($id)){
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: ID is not found'
    //             )));
    //     }
    //     $user_id = $this->propid;
    //     $web_config = $this->getConfigWeb(); 
    //     $get_donate = $this->frontpage_model->donate_list($user_id, array('d.id'=>$id));
    //     if(empty($get_donate)){
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: Donate Data is not found'
    //             )));
    //     }
        
    //     $xepo_name = $this->global['xepo_secure']['name'];
    //     $xepo_value = $this->global['xepo_secure']['hash'];

    //     $midtrans_status = (array)$this->midtrans->status($get_donate[0]['midtrans_order_id']); 

    //     $view_popup = '';
    //     switch($midtrans_status['transaction_status']){
    //         case "settlement":
    //         case "capture":
    //             $view_popup = 'app/_main/_donate/_part/paid_popup.php';
    //             break;
    //         case "pending":
    //             $view_popup = 'app/_main/_donate/_part/pending_popup.php';
    //             break;
    //         case "deny":
    //             $view_popup = 'app/_main/_donate/_part/denied_popup.php';
    //             break;
    //         case "expire":
    //             $view_popup = 'app/_main/_donate/_part/expired_popup.php';
    //             break;
    //         case "cancel":
    //             $view_popup = 'app/_main/_donate/_part/cancelled_popup.php';
    //             break;
    //     }
        
    //     $view = $this->load->view($view_popup, array(
    //         'midtrans_status' => $midtrans_status,
    //         'xepo_name'=>$xepo_name,
    //         'xepo_value'=>$xepo_value,
    //         'get_donate' => $get_donate[0],
    //     ), true);

    //     return $this->output
    //         ->set_content_type('application/json')
    //         ->set_status_header(200)
    //         ->set_output(json_encode(array(
    //             'result'=>$view, 
    //             'xepo_name'=>$xepo_name,
    //             'xepo_value'=>$xepo_value, 
    //         ))); 
    // }

    public function get_token_donate()
    { 
        if(!$this->onlyAllowAccessFromAjax()){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Only Allow Access From Ajax'
                )));
        } 
        $user_id = $this->propid;
        $usr_code = $this->usr_code; 
        $donate_id = $this->secureGet('donate_id',true,false);
        $order_id = $this->secureGet('order_id',true,[
            '-',
        ]);

        if(empty($order_id) || empty($donate_id)){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Order ID is not found'
                )));
        }

        $get_donate = $this->db->get_where('donate',array(
            'id'=>$donate_id
        ))->row_array();
        if(count($get_donate)==0){ 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Please try again, Donate data is not found'
                )));
        }

        $get_donate_price = $this->db->get_where('donate_price_list',array(
            'id'=>$get_donate['donate_price_id']
        ))->row_array();
        if(count($get_donate_price)==0){ 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Please try again, Donate Price data is not found'
                )));
        }

		// Required
		$transaction_details = array(
		  'order_id' => $order_id,
		  'gross_amount' => $get_donate_price['price'], // no decimal allowed for creditcard
		);
        
        $currency = $get_donate_price['currency'];
        $float_num = 0;
        if($currency === 'USD'){
            $float_num = 2;
        }
        $value = number_format($get_donate_price['value'],0,',','.');
        $price = number_format($get_donate_price['price'],$float_num,',','.');
        $item_name = $value.' Diamonds - '.$currency.' '.$price;

		$item1_details = array(
		  'id' => $get_donate['donate_price_id'],
		  'price' => $get_donate_price['price'],
		  'quantity' => 1,
		  'name' => $item_name
		);

		// Optional
		$item_details = array($item1_details); 

		// Optional
		$customer_details = array(
		  'first_name'    => $get_donate['username'],
		  'last_name'     => "",
		  'email'         => $this->id_email,
		//   'phone'         => "", 
		); 
        $credit_card['secure'] = true; 

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    // public function process_payment(){
    //     if(!$this->onlyAllowAccessFromAjax()){
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: Only Allow Access From Ajax'
    //             )));
    //     } 
        
    //     $xepo_name = $this->global['xepo_secure']['name'];
    //     $xepo_value = $this->global['xepo_secure']['hash'];
    //     $user_id = $this->propid;
    //     $usr_code = $this->usr_code; 
         
    //     $result = $this->donate_process_payment();

    //     return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>$result,
    //                 'xepo_name'=>$xepo_name,
    //                 'xepo_value'=>$xepo_value, 
    //             )));
    // } 

    public function get_bonus_items(){
        if(!$this->onlyAllowAccessFromAjax()){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Only Allow Access From Ajax'
                )));
        }
        
        $user_id = $this->propid;
        $usr_code = $this->usr_code;
        $id_donate_price = $this->securePost('id_donate_price',true,false);
        $xepo_name = $this->global['xepo_secure']['name'];
        $xepo_value = $this->global['xepo_secure']['hash'];

        if(empty($user_id) || empty($usr_code)){ 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: You must login',
                    'xepo_name'=>$xepo_name,
                    'xepo_value'=>$xepo_value, 
                )));
        }else{
            $this->db = dbloader("default");

            $get_donate_price = $this->db->get_where('donate_price_list',array(
                'id'=>$id_donate_price
            ))->row_array();
            if(count($get_donate_price)==0){ 
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Please try again',
                        'xepo_name'=>$xepo_name,
                        'xepo_value'=>$xepo_value, 
                    )));
            }
             
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>true,
                    'data'=>json_decode($get_donate_price['items'], true),
                    'xepo_name'=>$xepo_name,
                    'xepo_value'=>$xepo_value, 
                )));
        }
    }

    public function delete_temp_order(){
        if(!$this->onlyAllowAccessFromAjax()){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Only Allow Access From Ajax'
                )));
        }
        
        $user_id = $this->propid;
        $usr_code = $this->usr_code;
        $donate_id = $this->securePost('donate_id',true,false);

        if(empty($user_id) || empty($usr_code)){ 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: You must login'
                )));
        }else{
            $this->db = dbloader("default");

            $this->db->trans_begin();
            $this->db->delete('donate',array(
                'id'=>$donate_id
            )); 
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Failed To Insert Donate'
                    )));
            } 

            $this->db->trans_commit();
            $xepo_name = $this->global['xepo_secure']['name'];
            $xepo_value = $this->global['xepo_secure']['hash'];
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>true,
                    'xepo_name'=>$xepo_name,
                    'xepo_value'=>$xepo_value, 
                )));
        }
    }

    public function remove_unpaid_donate(){
        if(!$this->onlyAllowAccessFromAjax()){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Only Allow Access From Ajax'
                )));
        }
        $user_id = $this->propid;
        $usr_code = $this->usr_code;
        $id = $this->input->post('id',true);

        if(empty($user_id) || empty($usr_code)){ 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: You must login'
                )));
        }else{
            $this->db = dbloader("default"); 
            
            $get_donate = $this->db->get_where('donate',array(
                'id'=>$id,
                'user_id'=>$user_id,
                'status'=>'unpaid',
            ))->row_array();
            if(count($get_donate)==0){ 
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Please try again'
                    )));
            }

            $this->db->trans_begin();
            $this->db->delete('donate',array(
                'id'=>$id,
            ));
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Failed To Delete Donate (1)'
                    )));
            }
            // $this->db->delete('unique_numbers',array(
            //     'name'=>'donate',
            //     'value'=>$get_donate['code_price'],
            //     'created_date'=>$GLOBALS['cur_date'],
            // )); 
            // if($this->db->trans_status() === FALSE) {
            //     $this->db->trans_rollback();
            //     return $this->output
            //         ->set_content_type('application/json')
            //         ->set_status_header(200)
            //         ->set_output(json_encode(array(
            //             'result'=>'Error: Failed To Delete Donate (2)'
            //         )));
            // }
            $this->db->trans_commit();

            $xepo_name = $this->global['xepo_secure']['name'];
            $xepo_value = $this->global['xepo_secure']['hash'];
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>true,  
                    'xepo_name'=>$xepo_name,
                    'xepo_value'=>$xepo_value, 
                )));
        }
    }
    public function buy(){
        if(!$this->onlyAllowAccessFromAjax()){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Only Allow Access From Ajax'
                )));
        }
        $check = $this->google_verify();
        if($check == true){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Please try again'
                )));
        }else{
            $user_id = $this->propid;
            $usr_code = $this->usr_code;
            $input_username = $this->input->post('input_username',true);
            $input_amount = $this->input->post('input_amount',true);
            $input_referral_code = $this->input->post('input_referral_code',true); 

            $this->db = dbloader("default");
            $get_donate = $this->db->get_where('donate',array( 
                'user_id'=>$user_id,
                'status'=>'unpaid',
            ))->result_array(); 

            if(count($get_donate) >= 3){ 
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Warn: Donate data with your "Unpaid" Status has reached the maximum(3), try deleting one of the "Unpaid" statuses and try donating again.'
                    )));
            }
    
            $exp_input_amount = explode('|',$input_amount);
            if(count($exp_input_amount)==0){ 
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Please try again'
                    )));
            }
            $donate_price_id = $exp_input_amount[0];
            $donate_point = $exp_input_amount[1];
    
            $get_donate_price = $this->db->get_where('donate_price_list',array(
                'id'=>$donate_price_id
            ))->row_array();
            if(count($get_donate_price)==0){ 
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Please try again'
                    )));
            }
            
            $this->form_validation->set_rules('input_username', 'USERNAME', 'trim|required');
            $this->form_validation->set_rules('input_amount', 'DONATION TYPES', 'trim|required');
            $this->form_validation->set_rules('input_referral_code', 'REFERRAL CODE', 'trim'); 
    
            if ($this->form_validation->run() == false) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Form validation failed'
                    )));
            }else{
                if(empty($user_id) || empty($usr_code)){ 
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'result'=>'Error: You must login'
                        )));
                }else{
                    $this->db = dbloader("default");
    
                    $data_referral_code = null;
                    if(!empty($input_referral_code)){
                        $this->db->where('referral_code', $input_referral_code);
                        $this->db->where('is_deleted', 'no');
                        $this->db->where('user_id !=', $user_id);
                        $data_referral_code = $this->db->get('referral_code')->row_array();
                        if(count($data_referral_code)==0){
                            return $this->output
                                ->set_content_type('application/json')
                                ->set_status_header(200)
                                ->set_output(json_encode(array(
                                    'result'=>'Warning: Referral Code is not found'
                                )));
                        } 
                    }

                    $min_unumber = 100;
                    $max_unumber = 999;
                    $cekmutasi_to_payment_type = $this->cekmutasi_to_idr_payment_type;
                    $cekmutasi_to_name = $this->cekmutasi_to_idr_name;
                    $cekmutasi_to_account = $this->cekmutasi_to_idr_account;
                    if($get_donate_price['currency'] == 'USD'){
                        $min_unumber = 10;
                        $max_unumber = 99;
                        $cekmutasi_to_payment_type = $this->cekmutasi_to_usd_payment_type;
                        $cekmutasi_to_name = $this->cekmutasi_to_usd_name;
                        $cekmutasi_to_account = $this->cekmutasi_to_usd_account;
                    }
                    $g_unique_numb = $this->generateUniqueNumber($min_unumber,$max_unumber,'donate');
                    if(!$g_unique_numb){
                        return $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(200)
                            ->set_output(json_encode(array(
                                'result'=>'Error: generate Code Price'
                            )));
                    }

                    $g_unique_numb = (int)$g_unique_numb;
                    $total_bill = (int)$get_donate_price['price'] + $g_unique_numb; 
                    if($get_donate_price['currency'] == 'USD'){
                        $total_bill = $get_donate_price['price'] + (float)('0.'.(string)$g_unique_numb);
                    }
                    $donate_insert = array(
                        'payment_method' => 'Transfer',
                        'cekmutasi_to_payment_type' => $cekmutasi_to_payment_type,
                        'cekmutasi_to_name' => $cekmutasi_to_name,
                        'cekmutasi_to_account' => $cekmutasi_to_account,
                        'total_bill' => $total_bill,
                        'user_id' => $user_id,
                        'code_price' => $g_unique_numb,
                        'user_code' => $usr_code,
                        'username' => $input_username,
                        'donate_price_id' => $donate_price_id,
                        'donate_point' => $donate_point,
                        'created_date' => $GLOBALS['date_now'],
                    );
                    if(!empty($data_referral_code)){
                        $donate_insert['referral_code'] = $input_referral_code;
                    }
                    $this->db->trans_begin();
                    $this->db->insert('donate',$donate_insert);
                    $donate_id = $this->db->insert_id();
                    if($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        return $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(200)
                            ->set_output(json_encode(array(
                                'result'=>'Error: Failed To Insert Donate'
                            )));
                    } 
    
                    $this->db->trans_commit();
                    $xepo_name = $this->global['xepo_secure']['name'];
                    $xepo_value = $this->global['xepo_secure']['hash'];
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'result'=>true, 
                            'data'=>array(
                                'donate_id'=>$donate_id,
                            ),
                            'xepo_name'=>$xepo_name,
                            'xepo_value'=>$xepo_value, 
                        )));
                }
            }
        }
    }


    // public function _backup_buy() {
    //     if(!$this->onlyAllowAccessFromAjax()){
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: Only Allow Access From Ajax'
    //             )));
    //     }

    //     $check = $this->google_verify();
    //     if($check == true){
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: Please try again'
    //             )));
    //     }else{
    //         $user_id = $this->propid;
    //         $usr_code = $this->usr_code;
    //         $input_username = $this->input->post('input_username',true);
    //         $input_amount = $this->input->post('input_amount',true);
    //         $input_referral_code = $this->input->post('input_referral_code',true); 
    
    //         $exp_input_amount = explode('|',$input_amount);
    //         if(count($exp_input_amount)==0){ 
    //             return $this->output
    //                 ->set_content_type('application/json')
    //                 ->set_status_header(200)
    //                 ->set_output(json_encode(array(
    //                     'result'=>'Error: Please try again'
    //                 )));
    //         }
    //         $donate_price_id = $exp_input_amount[0];
    //         $donate_price = $exp_input_amount[1];
    
    //         $get_donate_price = $this->db->get_where('donate_price_list',array(
    //             'id'=>$donate_price_id
    //         ))->row_array();
    //         if(count($get_donate_price)==0){ 
    //             return $this->output
    //                 ->set_content_type('application/json')
    //                 ->set_status_header(200)
    //                 ->set_output(json_encode(array(
    //                     'result'=>'Error: Please try again'
    //                 )));
    //         }
            
    //         $this->form_validation->set_rules('input_username', 'USERNAME', 'trim|required');
    //         $this->form_validation->set_rules('input_amount', 'DONATION TYPES', 'trim|required');
    //         $this->form_validation->set_rules('input_referral_code', 'REFERRAL CODE', 'trim'); 
    
    //         if ($this->form_validation->run() == false) {
    //             return $this->output
    //                 ->set_content_type('application/json')
    //                 ->set_status_header(200)
    //                 ->set_output(json_encode(array(
    //                     'result'=>'Error: Form validation failed'
    //                 )));
    //         }else{
    //             if(empty($user_id) || empty($usr_code)){ 
    //                 return $this->output
    //                     ->set_content_type('application/json')
    //                     ->set_status_header(200)
    //                     ->set_output(json_encode(array(
    //                         'result'=>'Error: You must login'
    //                     )));
    //             }else{
    //                 $this->db = dbloader("default");
    
    //                 $data_referral_code = null;
    //                 if(!empty($input_referral_code)){
    //                     $this->db->where('referral_code', $input_referral_code);
    //                     $this->db->where('is_deleted', 'no');
    //                     $this->db->where('user_id !=', $user_id);
    //                     $data_referral_code = $this->db->get('referral_code')->row_array();
    //                     if(count($data_referral_code)==0){
    //                         return $this->output
    //                             ->set_content_type('application/json')
    //                             ->set_status_header(200)
    //                             ->set_output(json_encode(array(
    //                                 'result'=>'Warning: Referral Code is not found'
    //                             )));
    //                     } 
    //                 } 
    
    //                 $donate_insert = array(
    //                     'user_id' => $user_id,
    //                     'user_code' => $usr_code,
    //                     'username' => $input_username,
    //                     'donate_price_id' => $donate_price_id,
    //                     'donate_price' => $donate_price,
    //                     'created_date' => $GLOBALS['date_now'],
    //                 );
    //                 if(!empty($data_referral_code)){
    //                     $donate_insert['referral_code'] = $input_referral_code;
    //                 }
    //                 $this->db->trans_begin();
    //                 $this->db->insert('donate',$donate_insert);
    //                 $donate_id = $this->db->insert_id();
    //                 if($this->db->trans_status() === FALSE) {
    //                     $this->db->trans_rollback();
    //                     return $this->output
    //                         ->set_content_type('application/json')
    //                         ->set_status_header(200)
    //                         ->set_output(json_encode(array(
    //                             'result'=>'Error: Failed To Insert Donate'
    //                         )));
    //                 } 
    
    //                 $this->db->trans_commit();
    //                 $xepo_name = $this->global['xepo_secure']['name'];
    //                 $xepo_value = $this->global['xepo_secure']['hash'];
    //                 return $this->output
    //                     ->set_content_type('application/json')
    //                     ->set_status_header(200)
    //                     ->set_output(json_encode(array(
    //                         'result'=>true, 
    //                         'data'=>array(
    //                             'order_id'=>(date("YmdHis") .'-'. $donate_id),
    //                             'donate_id'=>$donate_id,
    //                         ),
    //                         'xepo_name'=>$xepo_name,
    //                         'xepo_value'=>$xepo_value, 
    //                     )));
    //             }
    //         }
    //     }
    // }
}