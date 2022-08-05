<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';

class Rand extends FrontLib {
	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model("member_model");
	}

    public function _remap($method){
        // $this->dd(array($method, $GLOBALS['ROUTES-API'], $this->session->userdata('ROUTES-API')));
        // $ar_current_uri = $this->uri->segment_array();
        $current_uri = $this->uri->uri_string();
        $key_ar = array_search($current_uri, array_column($GLOBALS['ROUTES-API'], 'encrypt'));

        // dump($current_uri, array_column($GLOBALS['ROUTES-API'], 'encrypt'), $key_ar); exit;

        if($key_ar !== false){
            $ar_routes_api = array_values($GLOBALS['ROUTES-API']);
            $encrypt_val = $ar_routes_api[$key_ar]['encrypt'];
            $decrypt_val = $ar_routes_api[$key_ar]['decrypt'];
            $ar_value['encrypt'] = explode('/', $encrypt_val);
            $ar_value['decrypt'] = explode('/', $decrypt_val);

            if(count($ar_value['decrypt']) > 2){
                $function_name = $ar_value['decrypt'][1];
                $args = array();
                for ($i=2; $i<count($ar_value['decrypt']); $i++) {
                    $args[] = $ar_value['decrypt'][$i];
                }
                if(method_exists($this, $function_name)) {
				    call_user_func_array(array($this, $function_name), $args);
				}
            }else{
                $function_name = $ar_value['decrypt'][1];
                if(method_exists($this, $function_name)) {
					$this->$function_name();
				}
            }

        }
        
        return $this->resAPI(400, $this->restBadRequest());
    }

    private function resAPI($status_code, $res_array){
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output(json_encode($res_array));
        exit;
    }

    private function restConnectionError(){
        return array(
            'v' => $this->security->get_csrf_hash(),
            'text' => 'Error 500',
            'type' => 'danger',
            'result' => 'Connection Error!',
            // 'error' => $this->db->_error_message(),
        );
    }

    private function restSuccess(){
        return array(
            'v' => $this->security->get_csrf_hash(),
            'text' => 'Success',
            'type' => 'OK',
            'result' => true,
        );
    }

    private function restBadRequest(){
        return array(
            'v' => $this->security->get_csrf_hash(),
            'text' => 'Error 400',
            'type' => 'Bad Request',
            'result' => false,
        );
    }

}

?>