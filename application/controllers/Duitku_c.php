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
        return false;

		if($pars != getenv('KEY_EXTERNAL_ACCESS')){
            return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode(array(
					'result'=>false, 
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
        $this->db = dbloader("default"); 

        $duitkuConfig = new \Duitku\Config("7dc33f9a23a558389fff2656d51eb184", "DS12634"); 
        $duitkuConfig->setSandboxMode(true);
        
        try {
            $result_callback = \Duitku\Pop::callback($duitkuConfig);
		 
            if(!$result_callback){
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>false,
                        'msg'=>'Error: (2)'
                    ))); 
            }

            header('Content-Type: application/json');
            $notif = json_decode($result_callback);

            // var_dump($result_callback);

            if ($notif->resultCode == "00") {
                // Action Success
            } else if ($notif->resultCode == "01") {
                // Action Failed
            }

            $this->db->trans_begin();
            $this->db->insert('dumptable',array(
                'name' => 'test callback', 
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
                    'data'=>$notif,
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
                    'data'=>$e->getMessage(),
                    'msg'=>'Error: (1)'
                ))); 
        }
	} 
}