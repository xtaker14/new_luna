<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php'; 
class Cekmutasi2 extends FrontLib
{
	public function __construct(){
		parent::__construct();
		// exit;
	}

	public function process($pars){
		if($pars != $this->pars_external_access){
            return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode(array(
					'result'=>false, 
				))); 
        }
		$this->load->library('Cekmutasi/Cekmutasi');

		$ipn = $this->cekmutasi->catchIPN();

		$result_callback = false;
		if( $ipn->action == "payment_report" )
		{
			$service_name = $ipn->content->service_name;
			$service_code = $ipn->content->service_code;
			$account_number = $ipn->content->account_number;
			$account_name = $ipn->content->account_name;
			foreach( $ipn->content->data as $data )
			{
				# Waktu transaksi dalam format unix timestamp
				$time = $data->unix_timestamp;
				$payment_date = date('Y-m-d H:i:s', $time );

				# Tipe transaksi : credit / debit
				$type = $data->type;

				# Jumlah (2 desimal) : 50000.00
				$amount = $data->amount;

				# Berita transfer
				$description = $data->description;

				# Saldo rekening (2 desimal) : 1500000.00
				$balance = $data->balance;
				
				if( $type == "credit" ) // dana masuk
				{
					$this->db = dbloader("default");
                    $g_cekmutasi_log = $this->db->query("
						SELECT 
							* 
						FROM 
                            cekmutasi_log 
						WHERE 
							cekmutasi_service_name = '".$service_name."' AND 
							cekmutasi_service_code = '".$service_code."' AND 
							cekmutasi_account_number = '".$account_number."' AND 
							cekmutasi_account_name = '".$account_name."' AND 
							cekmutasi_payment_date = '".$payment_date."' AND 
							cekmutasi_payment_type = '".$type."' AND 
                            cekmutasi_amount = '".$this->escape_str($amount)."' 
						LIMIT 1
					")->row_array(); 
                    
					if(empty($g_cekmutasi_log)){ 
                        $this->db->trans_begin();
						$this->db->insert('cekmutasi_log',array(
							'cekmutasi_service_name' => $service_name,
							'cekmutasi_service_code' => $service_code,
							'cekmutasi_account_number' => $account_number,
							'cekmutasi_account_name' => $account_name,
							'cekmutasi_payment_date' => $payment_date,
							'cekmutasi_payment_type' => $type,
							'cekmutasi_amount' => $amount,
							'cekmutasi_description' => $description,  
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
                                'service_name' => $service_name,
								'service_code' => $service_code,
								'account_number' => $account_number,
								'account_name' => $account_name,
								'payment_date' => $payment_date,
								'type' => $type,
								'amount' => $amount,
								'description' => $description, 
                            ), 'bank_tf');
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
	
	// public function mutasiBank()
	// {
	// 	$this->load->library('cekmutasi/cekmutasi');

	// 	$mutasi = $this->cekmutasi->bank()->mutation([
	// 		'date'		=> [
	// 			'from'	=> date('Y-m-d') . ' 00:00:00',
	// 			'to'	=> date('Y-m-d') . ' 23:59:59'
	// 		]
	// 	]);

	// 	dump($mutasi);
	// }

	// public function mutasiPayPal()
	// {
	// 	$this->load->library('cekmutasi/cekmutasi');

	// 	$mutasi = $this->cekmutasi->paypal()->mutation([
	// 		'date'		=> [
	// 			'from'	=> date('Y-m-d') . ' 00:00:00',
	// 			'to'	=> date('Y-m-d') . ' 23:59:59'
	// 		]
	// 	]);

	// 	dump($mutasi);
	// }

	// public function mutasiOVO()
	// {
	// 	$this->load->library('cekmutasi/cekmutasi');

	// 	$mutasi = $this->cekmutasi->ovo()->mutation([
	// 		'date'		=> [
	// 			'from'	=> date('Y-m-d') . ' 00:00:00',
	// 			'to'	=> date('Y-m-d') . ' 23:59:59'
	// 		]
	// 	]);

	// 	dump($mutasi);
	// }

	// public function mutasiGoPay()
	// {
	// 	$this->load->library('cekmutasi/cekmutasi');

	// 	$mutasi = $this->cekmutasi->gopay()->mutation([
	// 		'date'		=> [
	// 			'from'	=> date('Y-m-d') . ' 00:00:00',
	// 			'to'	=> date('Y-m-d') . ' 23:59:59'
	// 		]
	// 	]);

	// 	dump($mutasi);
	// }

	// public function balance()
	// {
	// 	$this->load->library('cekmutasi/cekmutasi');

	// 	$balance = $this->cekmutasi->balance();

	// 	dump($balance);
	// }

	// public function handleCallback()
	// {
	// 	$this->load->library('cekmutasi/cekmutasi');

	// 	$ipn = $this->cekmutasi->catchIPN();

	// 	dump($ipn);
	// }
}