<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php'; 

class Duitku_c extends FrontLib
{
	public function __construct(){
		parent::__construct();
		// exit;
        $this->load->library('duitku');
	}
    
	public function return($pars=''){ 
		if($pars != getenv('KEY_EXTERNAL_ACCESS')){
            return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode(array(
					'result'=>false, 
				))); 
        }
        if(!$this->onlyAllowAccessFromPost()){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Only Allow Access From Post'
                )));
        }

        $this->load->library('duitku');
        $this->db = dbloader("default"); 

        $this->db->trans_begin();
        $this->db->insert('dumptable',array(
            'name' => 'test return', 
        ));
        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>false,
                    'msg'=>'Error: (3)'
                ))); 
        } 
        $this->db->trans_commit();

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'result'=>true,
                'msg'=>'return success'
            )));
	} 

	public function callback($pars=''){
		if($pars != getenv('KEY_EXTERNAL_ACCESS')){
            return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode(array(
					'result'=>false, 
				))); 
        }
        if(!$this->onlyAllowAccessFromPost()){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>'Error: Only Allow Access From Post'
                )));
        }

        
        try {
            $res_callback = $this->duitku->paymentCallback(array($this, 'onPaymentSuccess'), array($this, 'onPaymentFailed')); 
            
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>true,
                    'data'=>$res_callback,
                    'msg'=>'callback success'
                )));
        } catch (Exception $e) {
            // http_response_code(400);
            // echo $e->getMessage();

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>false,
                    'data'=>false,
                    'msg'=>'Error: '.$e->getMessage()
                ))); 
        }
	} 

    public function onPaymentSuccess($post_data){
        $this->db = dbloader("default"); 

        $this->db->trans_begin();
        $this->db->insert('dumptable',array(
            'name' => 'callback onPaymentSuccess 1', 
            'test' => json_encode($post_data), 
            'created_date' => $GLOBALS['date_now'], 
        ));
        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array(
                'result'=>false,
                'msg'=>'error : insert dumptable', 
            ); 
        } 
        $this->db->trans_commit();
 
        $g_donate = $this->db->query("
            SELECT 
                dl.price as bill, 
                dl.currency, 
                dl.items, 
                d.* 
            FROM 
                donate_duitku d
            INNER JOIN 
                donate_price_list dl 
            ON 
                d.donate_price_id = dl.id 
            WHERE 
                DATE(d.created_date) = CURDATE() AND 
                d.status = 'pending' AND 
                d.reference = '".$post_data->reference."' AND 
                d.merchant_order_id = '".$post_data->merchantOrderId."'  
            LIMIT 1
        ")->row_array();

        if(!empty($g_donate) && is_array($g_donate)){ 

            if(count($g_donate)>0){
                $g_duitku_log = $this->db->query("
                    SELECT 
                        * 
                    FROM 
                        duitku_log 
                    WHERE 
                        reference = '".$post_data->reference."' AND 
                        merchant_code = '".$post_data->merchantCode."' AND 
                        merchant_order_id = '".$post_data->merchantOrderId."' AND 
                        payment_code = '".$post_data->paymentCode."' 
                    LIMIT 1
                ")->row_array(); 
                // amount = '".$this->escape_str($amount)."' 
                
                if(empty($g_duitku_log)){ 
                    $this->db->trans_begin();
                    $this->db->insert('duitku_log',array(
                        'amount' => $g_donate['bill'],
                        'payment_fee' => $g_donate['payment_fee'],
                        'reference' => $post_data->reference,
                        'merchant_code' => $post_data->merchantCode,
                        'merchant_order_id' => $post_data->merchantOrderId,
                        'product_detail' => $post_data->productDetail,
                        'payment_code' => $post_data->paymentCode,
                        'status_code' => 'paid',
                        'created_date' => $GLOBALS['date_now'], 
                    ));
                    if($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        return array(
                            'result'=>false,
                            'msg'=>'error : insert log', 
                        );
                    } 
                    $this->db->trans_commit();
                } 

                $result_callback = $this->insertAutoDonateDuitku($g_donate);
                if(!$result_callback){
                    return array(
                        'result'=>false,
                        'msg'=>'error : insert and update donate', 
                    );
                }
            }
        }else{ 
            return array(
                'result'=>false,
                'msg'=>'error : data donate not found', 
            );
        }
        
        return array(
            'result'=>true,
            'msg'=>'success', 
            'data'=>$post_data, 
        );
	} 

	public function onPaymentFailed($post_data){
        $this->db = dbloader("default"); 
 
        $g_donate = $this->db->query("
            SELECT 
                dl.price as bill, 
                dl.currency, 
                dl.items, 
                d.* 
            FROM 
                donate_duitku d
            INNER JOIN 
                donate_price_list dl 
            ON 
                d.donate_price_id = dl.id 
            WHERE 
                DATE(d.created_date) = CURDATE() AND 
                d.status = 'pending' AND 
                d.reference = '".$post_data->reference."' AND 
                d.merchant_order_id = '".$post_data->merchantOrderId."'  
            LIMIT 1
        ")->row_array();

        if(!empty($g_donate) && is_array($g_donate)){ 
            if(count($g_donate)>0){
                $g_duitku_log = $this->db->query("
                    SELECT 
                        * 
                    FROM 
                        duitku_log 
                    WHERE 
                        reference = '".$post_data->reference."' AND 
                        merchant_code = '".$post_data->merchantCode."' AND 
                        merchant_order_id = '".$post_data->merchantOrderId."' AND 
                        payment_code = '".$post_data->paymentCode."' 
                    LIMIT 1
                ")->row_array(); 
                // amount = '".$this->escape_str($amount)."' 
                
                $this->db->trans_begin();
                if(empty($g_duitku_log)){ 
                    $this->db->insert('duitku_log',array(
                        'amount' => $g_donate['bill'],
                        'payment_fee' => $g_donate['payment_fee'],
                        'reference' => $post_data->reference,
                        'merchant_code' => $post_data->merchantCode,
                        'merchant_order_id' => $post_data->merchantOrderId,
                        'product_detail' => $post_data->productDetail,
                        'payment_code' => $post_data->paymentCode,
                        'status_code' => 'expired',
                        'created_date' => $GLOBALS['date_now'], 
                    ));
                    if($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        
                        return array(
                            'result'=>false,
                            'msg'=>'error : insert log', 
                        );
                    } 
                } 
                
                $this->db->update('donate_duitku', array(
                    'complete_date' => $GLOBALS['date_now'],
                    'status' => 'expired',
                ),array(
                    'id'=>$g_donate['id']
                ));
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    
                    return array(
                        'result'=>false,
                        'msg'=>'error : insert and update donate', 
                    );
                }
            }
        }else{
            $this->db->trans_rollback();
            return array(
                'result'=>false,
                'msg'=>'error : data donate not found', 
            );
        }

        $this->db->trans_commit();
        return array(
            'result'=>true,
            'msg'=>'failed or expired', 
            'data'=>$post_data, 
        );

	} 
}