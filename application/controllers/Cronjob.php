<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';
class Cronjob extends FrontLib {
	public function __construct(){
		parent::__construct();
		error_reporting(0); 
	} 

	public function processDonatePaypal($pars){ 
        if($pars != getenv('KEY_EXTERNAL_ACCESS')){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode(array(
                    'result'=>false
                )));
        }
		$this->load->library('Cekmutasi/Cekmutasi');

		$m_paypal = $this->cekmutasi->paypal()->mutation([
			'date'		=> [
				// 'from'	=> date('Y-m-d') . ' 00:00:00',
				'from'	=> date('Y-m-d H:i:s', strtotime('-2 hour')), // 2jam yg lalu
				'to'	=> date('Y-m-d') . ' 23:59:59'
			]
		]);  

        $result_callback = true;
        if($m_paypal->success === true){
            $m_data = $m_paypal->response;
            foreach ($m_data as $key => $data) {
                # Waktu transaksi dalam format unix timestamp
				$time = $data->unix_timestamp;
				$payment_date = date('Y-m-d H:i:s', $time );
				$type = $data->type;
				$email = $data->email;
				$name = $data->name;
				$transactionid = $data->transactionid;
				$amount = $data->amount;
				
				if( $type == "payment" ) // dana masuk
				{
					$this->db = dbloader("default");
                    $g_cekmutasi_log = $this->db->query("
						SELECT 
							* 
						FROM 
                            cekmutasi_log 
						WHERE 
							cekmutasi_paypal_transactionid = '".$transactionid."' AND 
							cekmutasi_paypal_email = '".$email."' AND 
							cekmutasi_paypal_name = '".$name."' AND 
							cekmutasi_payment_date = '".$payment_date."' AND 
							cekmutasi_payment_type = '".$type."' AND 
                            cekmutasi_amount = '".$this->escape_str($amount)."' 
						LIMIT 1
					")->row_array(); 
                    
					if(empty($g_cekmutasi_log)){ 
                        $this->db->trans_begin();
                        $this->db->insert('cekmutasi_log',array(
                            'cekmutasi_service_name' => 'Paypal',
                            'cekmutasi_service_code' => 'paypal',
                            'cekmutasi_payment_type' => $type,
                            'cekmutasi_payment_date' => $payment_date,
                            'cekmutasi_amount' => $amount,
                            'cekmutasi_paypal_transactionid' => $transactionid,
                            'cekmutasi_paypal_email' => $email,
                            'cekmutasi_paypal_name' => $name,   
                        ));
                        if($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                                return $this->output
                                    ->set_content_type('application/json')
                                    ->set_status_header(200)
                                    ->set_output(json_encode(array(
                                        'result'=>false,
                                        'msg'=>'Error: (1)'
                                    )));
                        } 
                        $this->db->trans_commit();
                    }

					$this->db = dbloader("default"); 
					$g_donate = $this->db->query("
						SELECT 
							dl.price as bill, 
							dl.currency, 
							dl.items, 
							d.* 
						FROM 
							donate d
						INNER JOIN 
							donate_price_list dl 
						ON 
							d.donate_price_id = dl.id 
						WHERE 
							DATE(d.created_date) = CURDATE() AND 
							d.status = 'unpaid' AND 
                            d.total_bill = '".$this->escape_str($amount)."'
						LIMIT 1
					")->row_array();
                    
					if(!empty($g_donate) && is_array($g_donate)){ 
                        if(count($g_donate)>0){
                            $result_callback = $this->insertAutoDonate($g_donate, array(
                                'type' => $type,
                                'payment_date' => $payment_date,
                                'amount' => $amount,
                                'transactionid' => $transactionid,
                                'email' => $email,
                                'name' => $name, 
                            ), 'paypal');
                            if(!$result_callback){
                                break;
                            }
                        }
					}
				}
            }
        } 
        if(!$result_callback){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'result'=>false,
                    'msg'=>'Error: (2)'
                ))); 
        }
        
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'result'=>true,
                'msg'=>'success'
            )));  
	} 

    function checkDailyDonate($pars){ 
        if($pars != getenv('KEY_EXTERNAL_ACCESS')){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode(array(
                    'result'=>false
                )));
        }
        $this->db = dbloader("default");
        $this->db->trans_begin();

        $get_donate = $this->db->query("
            SELECT 
                * 
            from 
                donate 
            where 
                status = 'unpaid' AND 
                DATE(created_date) <= SUBDATE(CURDATE(),2)
        ");
        // SUBDATE(CURDATE(),2) 2 hari yg lalu
        
        $res_donate = $get_donate->result_array();
        $count_donate = count($res_donate);

        if($count_donate>0){
            foreach ($res_donate as $key) {
                $this->db->delete('donate',array(
                    'id'=>$key['id']
                ));
            }
        }

        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode(array(
                    'result'=>false,
                    'msg'=>'Failed To Delete (1)'
                )));
        } 

        $get_unique_numbers = $this->db->query("
            select 
                * 
            from 
                unique_numbers 
            where 
                created_date <= SUBDATE(CURDATE(),1)
        ");
        $res_unique_numbers = $get_unique_numbers->result_array();
        $count_unique_numbers = count($res_unique_numbers);

        if($count_unique_numbers>0){
            foreach ($res_unique_numbers as $key) {
                $this->db->delete('unique_numbers',array(
                    'id'=>$key['id']
                ));
            }
        }

        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode(array(
                    'result'=>false,
                    'msg'=>'Failed To Delete (2)'
                )));
        } 
        $this->db->trans_commit();

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'result'=>true,
                'msg'=>'Success'
            )));
    } 
}