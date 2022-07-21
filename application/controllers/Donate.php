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

        // require_once dirname(__FILE__) . '/Duitku.php';
        $this->load->library('duitku');
	}

    function popup_backup($case){
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
            $this->db->delete('donate_duitku',array(
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
            
            $get_donate = $this->db->get_where('donate_duitku',array(
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
            $this->db->delete('donate_duitku',array(
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
            //     'name'=>'donate_duitku',
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

        switch ($case) {
            case 'check_status':
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

                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>$get_donate[0], 
                        'xepo_name'=>$xepo_name,
                        'xepo_value'=>$xepo_value, 
                    )));
                break; 
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'result'=>'Error: Request not found'
            ))); 
    }

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

        if(empty($user_id) || empty($usr_code)){ 
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: You must login',
                )));
        }else{
            $this->load->library('duitku');
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
                    )));
            } 
            
            $resp_pop = $this->duitku->getPaymentMethodByAmount($get_donate_price['price']);

            array_multisort(array_column($resp_pop, 'type'), SORT_DESC, $resp_pop);
            
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>true,
                    'data'=>json_decode($get_donate_price['items'], true),
                    'payment'=>$resp_pop, 
                )));
        }
    }

    public function buy(){  
        // if(!$this->onlyAllowAccessFromAjax()){
        //     return $this->output
        //         ->set_content_type('application/json')
        //         ->set_status_header(200)
        //         ->set_output(json_encode(array(
        //             'result'=>'Error: Only Allow Access From Ajax'
        //         )));
        // }
        $check = $this->google_verify();
        $xepo_name = $this->global['xepo_secure']['name'];
        $xepo_value = $this->global['xepo_secure']['hash'];

        if($check == true){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Please try again',
                    'xepo_name'=>$xepo_name,
                    'xepo_value'=>$xepo_value, 
                )));
        }else{ 
            $user_id = $this->propid;
            $usr_code = $this->usr_code;
            $ses_username = $this->session->userdata('id_loginid');
            $ses_email = $this->session->userdata('id_email');
            $donate_price_id = $this->input->post('input_amount',true);
            $input_payment = $this->securePost('input_payment',true,false);

            $input_referral_code = $this->input->post('input_referral_code',true); 

            if(empty($user_id) || empty($usr_code)){ 
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: You must login',
                        'xepo_name'=>$xepo_name,
                        'xepo_value'=>$xepo_value, 
                    )));
            } 
            
            if(empty($donate_price_id)){
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Amount is not found',
                        'xepo_name'=>$xepo_name,
                        'xepo_value'=>$xepo_value, 
                    )));
            } 
            
            if(empty($input_payment)){
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Payment Method is not found (1)',
                        'xepo_name'=>$xepo_name,
                        'xepo_value'=>$xepo_value, 
                    )));
            }

            $this->db = dbloader("default");
            $get_donate = $this->db->get_where('donate_duitku',array( 
                'user_id'=>$user_id,
                'status'=>'pending',
            ))->result_array(); 

            // if(count($get_donate) >= 3){ 
            //     return $this->output
            //         ->set_content_type('application/json')
            //         ->set_status_header(200)
            //         ->set_output(json_encode(array(
            //             'result'=>'Warn: Your Pending Donate data has reached the maximum (3), try deleting one of the "Pending" statuses and try donating again.'
            //         )));
            // }
    
            $get_donate_price = $this->db->get_where('donate_price_list',array(
                'id'=>$donate_price_id
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
            $donate_point = $get_donate_price['value'];
            
            $get_payment_method = $this->duitku->getPaymentMethod($input_payment, $get_donate_price['price']);

            $this->xepo_secure(); 
            $xepo_name = $this->global['xepo_secure']['name'];
            $xepo_value = $this->global['xepo_secure']['hash'];

            if(!$get_payment_method){ 
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: Payment Method is not found (2)',
                        'xepo_name'=>$xepo_name,
                        'xepo_value'=>$xepo_value, 
                    )));
            }

            $min_unumber = 100;
            $max_unumber = 999; 
            $g_unique_numb = $this->generateUniqueNumber($min_unumber,$max_unumber,'donate');
            if(!$g_unique_numb){
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>'Error: generate Unique Number',
                        'xepo_name'=>$xepo_name,
                        'xepo_value'=>$xepo_value, 
                    )));
            }

            $payment_amount      = $get_donate_price['price']; // Amount
            $product_details     = 'Donate '.$get_donate_price['value'].' Diamonds';
            $merchant_order_id    = date("Ymd") . ($g_unique_numb); // from merchant, unique   
            $additional_param    = ''; // optional
            $merchant_user_info   = ''; // optional
            $callback_url        = base_url('duitku/callback/new_luna_classic'); // url for callback
            // $return_url          = base_url('duitku/return/new_luna_classic'); // url for redirect
            $return_url          = base_url(''); // url for redirect
            $expiry_period       = 60; // set the expired time in minutes

            // Customer Detail
            $email              = $ses_email; // your customer email
            // $phoneNumber        = $this->input->post('input_phone',true); // your customer phone number (optional)
            $customer_va_name     = $ses_username; // display name on bank confirmation display
            $exp_full_name       = split_name($customer_va_name);
            $first_name          = $exp_full_name[0];
            $last_name           = $exp_full_name[1];

            // // Address
            // $alamat             = "Jl. Kembangan Raya";
            // $city               = "Jakarta";
            // $postalCode         = "11530";
            // $countryCode        = "ID";

            // $address = array(
            //     'firstName'     => $first_name,
            //     'lastName'      => $last_name,
            //     'address'       => $alamat,
            //     'city'          => $city,
            //     'postalCode'    => $postalCode,
            //     'phone'         => $phoneNumber,
            //     'countryCode'   => $countryCode
            // );

            $customerDetail = array(
                'firstName'         => $first_name,
                'lastName'          => $last_name,
                'email'             => $email,
                // 'phoneNumber'       => $phoneNumber,
                // 'billingAddress'    => $address,
                // 'shippingAddress'   => $address
            ); 

            // Item Details
            $item1 = array(
                'name'      => $product_details,
                'price'     => $payment_amount,
                'quantity'  => 1
            );

            $itemDetails = array(
                $item1
            );
            
            // Parameter PaymentMethod is optional
            // PaymentMethod list => https://docs.duitku.com/pop/id/#payment-method
            $params = array( 
                'paymentMethod'     => $get_payment_method['code'],
                'paymentAmount'     => $payment_amount,
                'merchantOrderId'   => $merchant_order_id,
                'productDetails'    => $product_details,
                'additionalParam'   => $additional_param,
                'merchantUserInfo'  => $merchant_user_info,
                'customerVaName'    => $customer_va_name,
                'email'             => $email,
                'phoneNumber'       => $phoneNumber,
                'itemDetails'       => $itemDetails,
                'customerDetail'    => $customerDetail,
                'callbackUrl'       => $callback_url,
                'returnUrl'         => $return_url,
                'expiryPeriod'      => $expiry_period
            );

            try {
                // createInvoice Request
                $resp_pop = \Duitku\Pop::createInvoice($params, $this->duitku->config); 
                // $resp_pop = json_decode($resp_pop, true);
                // $resp_pop['xepo_name'] = $xepo_name;
                // $resp_pop['xepo_value'] = $xepo_value;

                $this->xepo_secure(); 
                $xepo_name = $this->global['xepo_secure']['name'];
                $xepo_value = $this->global['xepo_secure']['hash'];

                $resp_pop = json_decode($resp_pop);
                $resp_pop->xepo_name = $xepo_name;
                $resp_pop->xepo_value = $xepo_value;
                
                // // $resp_pop->result = true;
                // header('Content-Type: application/json');
                // echo json_encode($resp_pop);
                // return;  

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
                                'result'=>'Warning: Referral Code is not found',
                                'xepo_name'=>$xepo_name,
                                'xepo_value'=>$xepo_value, 
                            )));
                    } 
                }
                
                $donate_insert = array(
                    'user_id' => $user_id,
                    'user_code' => $usr_code,
                    'username' => $ses_username,
                    'donate_price_id' => $donate_price_id,
                    'donate_point' => $donate_point,
                    'reference' => $resp_pop->reference,
                    'merchant_code' => $resp_pop->merchantCode,
                    'merchant_name' => '',
                    'merchant_order_id' => $merchant_order_id,
                    'va_number' => '',
                    'product_detail' => $product_details,
                    'email' => $ses_email,
                    'redirect_url' => '',
                    'payment_fee' => $get_payment_method['fee'],
                    'payment_code' => $get_payment_method['code'],
                    'payment_name' => $get_payment_method['name'],
                    'payment_type' => $get_payment_method['type'],
                    'payment_url' => $resp_pop->paymentUrl,
                    'status' => 'pending', 
                    'created_date' => $GLOBALS['date_now'],
                );
                if(!empty($data_referral_code)){
                    $donate_insert['referral_code'] = $input_referral_code;
                }
                $this->db->trans_begin();
                $this->db->insert('donate_duitku',$donate_insert);
                $donate_id = $this->db->insert_id();
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'result'=>'Error: Failed To Insert Donate',
                            'xepo_name'=>$xepo_name,
                            'xepo_value'=>$xepo_value, 
                        )));
                } 

                $this->db->trans_commit();
                $resp_pop->result = true;

                header('Content-Type: application/json');
                echo json_encode($resp_pop);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            return;  
        }
    }

    public function buy_backup(){
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

    // public function get_token_donate()
    // { 
    //     if(!$this->onlyAllowAccessFromAjax()){
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: Only Allow Access From Ajax'
    //             )));
    //     } 
    //     $user_id = $this->propid;
    //     $usr_code = $this->usr_code; 
    //     $donate_id = $this->secureGet('donate_id',true,false);
    //     $order_id = $this->secureGet('order_id',true,[
    //         '-',
    //     ]);

    //     if(empty($order_id) || empty($donate_id)){
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: Order ID is not found'
    //             )));
    //     }

    //     $get_donate = $this->db->get_where('donate',array(
    //         'id'=>$donate_id
    //     ))->row_array();
    //     if(count($get_donate)==0){ 
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: Please try again, Donate data is not found'
    //             )));
    //     }

    //     $get_donate_price = $this->db->get_where('donate_price_list',array(
    //         'id'=>$get_donate['donate_price_id']
    //     ))->row_array();
    //     if(count($get_donate_price)==0){ 
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(200)
    //             ->set_output(json_encode(array(
    //                 'result'=>'Error: Please try again, Donate Price data is not found'
    //             )));
    //     }

	// 	// Required
	// 	$transaction_details = array(
	// 	  'order_id' => $order_id,
	// 	  'gross_amount' => $get_donate_price['price'], // no decimal allowed for creditcard
	// 	);
        
    //     $currency = $get_donate_price['currency'];
    //     $float_num = 0;
    //     if($currency === 'USD'){
    //         $float_num = 2;
    //     }
    //     $value = number_format($get_donate_price['value'],0,',','.');
    //     $price = number_format($get_donate_price['price'],$float_num,',','.');
    //     $item_name = $value.' Diamonds - '.$currency.' '.$price;

	// 	$item1_details = array(
	// 	  'id' => $get_donate['donate_price_id'],
	// 	  'price' => $get_donate_price['price'],
	// 	  'quantity' => 1,
	// 	  'name' => $item_name
	// 	);

	// 	// Optional
	// 	$item_details = array($item1_details); 

	// 	// Optional
	// 	$customer_details = array(
	// 	  'first_name'    => $get_donate['username'],
	// 	  'last_name'     => "",
	// 	  'email'         => $this->id_email,
	// 	//   'phone'         => "", 
	// 	); 
    //     $credit_card['secure'] = true; 

    //     $time = time();
    //     $custom_expiry = array(
    //         'start_time' => date("Y-m-d H:i:s O",$time),
    //         'unit' => 'minute', 
    //         'duration'  => 2
    //     );
        
    //     $transaction_data = array(
    //         'transaction_details'=> $transaction_details,
    //         'item_details'       => $item_details,
    //         'customer_details'   => $customer_details,
    //         'credit_card'        => $credit_card,
    //         'expiry'             => $custom_expiry
    //     );

	// 	error_log(json_encode($transaction_data));
	// 	$snapToken = $this->midtrans->getSnapToken($transaction_data);
	// 	error_log($snapToken);
	// 	echo $snapToken;
    // }

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