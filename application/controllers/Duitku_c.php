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

        $this->db = dbloader("default");
        
        try {
            $res_callback = $this->duitku->paymentCallback();

            $this->db->trans_begin();
            $this->db->insert('dumptable',array(
                'name' => 'test callback', 
                'test' => json_encode($res_callback), 
            ));
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'result'=>false,
                        'data'=>false,
                        'msg'=>'Error: Insert Data'
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
                    'data'=>false,
                    'msg'=>'Error: '.$e->getMessage()
                ))); 
        }
	} 
}