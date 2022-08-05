<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';

class Checkin extends FrontLib {
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

    public function checkin_now(){
        // if(!$this->onlyAllowAccessFromAjax()){
        //     return $this->output
        //         ->set_content_type('application/json')
        //         ->set_status_header(200)
        //         ->set_output(json_encode(array(
        //         'result'=>'Error: Only Allow Access From Ajax'
        //         )));
        // }
        // $xepo_name = $this->global['xepo_secure']['name'];
        // $xepo_value = $this->global['xepo_secure']['hash'];

        $this->is_login();
        $this->load->model("frontpage_model");
        $this->load->model("im_model");
        $this->db = dbloader("default");
        $this->db->trans_begin();
        
        $user_id = $this->propid;
		$config_web = $this->getConfigWeb(true);

        $get_user = $this->main_m->getWhereUser(array(
            'id'=>$user_id
        ))->row_array();
        if(count($get_user) == 0){
            setFlashData('error', 'User Account is not found');
            redirect(base_url('daily_login'));
            return;
        }
        $get_char = $this->frontpage_model->getCharacter(array(
            'USER_IDX' => $user_id,
            'CHARACTER_MAXGRADE >=' => 120,
        ));

        if(count($get_char) == 0){ 
            setFlashData('error', 'If you want daily check in at least you must have char level 120.');
            redirect(base_url('daily_login'));
            return;
        } 

        $u_last_checkin_day = 0;
        if(!empty($get_user['last_checkin_day'])){
            $u_last_checkin_day = $get_user['last_checkin_day'];
        } 
        $u_last_checkin_day++;

        $daily_checkin_item = $this->db->query("
            SELECT 
                * 
            FROM 
                daily_checkin_item 
            WHERE 
                checkin_day >= ".$u_last_checkin_day." 
				and checkin_month = '".$config_web['daily_checkin_month']."' 
				and checkin_year = '".$config_web['daily_checkin_year']."' 
                and is_active='yes' 
            order by 
                checkin_day ASC 
            LIMIT 1
        ")->result_array();
        if(count($daily_checkin_item) == 0){
            setFlashData('error', 'Item Daily Checkin is not found');
            redirect(base_url('daily_login'));
            return;
        }
        // dump($daily_checkin_item, $u_last_checkin_day); exit;

        $date_now = date('Y-m-d H:i', strtotime($GLOBALS['date_now'])); 
		$row_daily_checkin_item = array();
        $get_daily_checkin_counter = array();
		foreach($daily_checkin_item as $idx => $val){
			if($val['checkin_day'] == $u_last_checkin_day){
				$row_daily_checkin_item = $val;
        
                $get_daily_checkin_counter = $this->db->get_where("daily_checkin_counter",array(
                    'checkin_item_id'=>$row_daily_checkin_item['id'],
                    'user_id'=>$user_id,
                ))->row_array(); 

                if(!empty($get_daily_checkin_counter)){
					$available_checkin_date = $this->plus_min_date($get_daily_checkin_counter['modified_date'],["+2 hours","Y-m-d H:i"]);
					if($get_daily_checkin_counter['counter_checkin'] == 3){
						$available_checkin_date = $this->plus_min_date($get_daily_checkin_counter['modified_date'],["+1 day","Y-m-d"]);
					}else{

                    }
                    
                    if($available_checkin_date > $date_now){
                        if($get_daily_checkin_counter['counter_checkin'] == 3){
					        $available_checkin_date = date('d M Y', strtotime($available_checkin_date));
                        }else{
					        $available_checkin_date = date('H:i, d M Y', strtotime($available_checkin_date));
                        }
                        
                        setFlashData('error', 'Wait until '.$available_checkin_date.' to check in again');
                        redirect(base_url('daily_login'));
                        return;
                    }
                }
            }
        }
        
        $daily_checkin_counter_id = null;
        if(empty($get_daily_checkin_counter)){
            $this->db->insert('daily_checkin_counter',array(
                'checkin_item_id'=>$row_daily_checkin_item['id'],
                'user_id'=>$user_id,
                'counter_checkin'=>'1',
                'is_claimed'=>'no',
                'created_date'=>$GLOBALS['date_now'],
                'modified_date'=>$GLOBALS['date_now'],
            ));
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                setFlashData('error', 'Failed To Checkin (1)');
                redirect(base_url('daily_login'));
                return;
            }
            $daily_checkin_counter_id = $this->db->insert_id(); 
        }else{
            $daily_checkin_counter_id = $get_daily_checkin_counter['id'];
            
            $q_update_checkin_counter = "
                counter_checkin = counter_checkin + 1, 
                modified_date = '".$GLOBALS['date_now']."'
            ";

            if($get_daily_checkin_counter['counter_checkin'] == 2){
                $q_update_checkin_counter .= ",is_claimed = 'yes' ";
                
                $this->db->query("
                    UPDATE 
                        tbl_user 
                    SET 
                        last_checkin_date = NOW(), 
                        last_checkin_month = '".$row_daily_checkin_item['checkin_month']."', 
                        last_checkin_year = '".$row_daily_checkin_item['checkin_year']."', 
                        last_checkin_day = ".$row_daily_checkin_item['checkin_day']." 
                    WHERE 
                        id = '$user_id'
                ");
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    setFlashData('error', 'Failed To Checkin (2)');
                    redirect(base_url('daily_login'));
                    return;
                } 

                $this->db->insert('daily_checkin',array(
                    'checkin_item_id'=>$row_daily_checkin_item['id'],
                    'user_id'=>$user_id,
                    'checkin_year'=>date('Y'),
                    'checkin_month'=>date('m')
                ));
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    setFlashData('error', 'Failed To Checkin (3)');
                    redirect(base_url('daily_login'));
                    return;
                }

                $insert_item = $this->im_model->insert_item(
                    $row_daily_checkin_item['bin_code'],
                    $user_id,
                    $row_daily_checkin_item['qty']
                );
                if(!$insert_item){ 
                    $this->db->trans_rollback();
                    setFlashData('error', 'Failed To Checkin (4)');
                    redirect(base_url('daily_login'));
                    return;
                }
            } 

            $this->db->query("
                UPDATE 
                    daily_checkin_counter 
                SET 
                    ".$q_update_checkin_counter." 
                WHERE 
                    id='".$get_daily_checkin_counter['id']."'
            ");

            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                setFlashData('error', 'Failed To Checkin (5)');
                redirect(base_url('daily_login'));
                return;
            }
        } 

        $get_daily_checkin_counter = $this->db->get_where("daily_checkin_counter",array(
            'id'=>$daily_checkin_counter_id,
        ))->row_array();

        $this->db->insert('daily_checkin_counter_history',array(
            'checkin_counter_id'=>$get_daily_checkin_counter['id'],
            'counter_checkin'=>$get_daily_checkin_counter['counter_checkin'], 
            'created_date'=>$GLOBALS['date_now'],
        ));
        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            setFlashData('error', 'Failed To Checkin (6)');
            redirect(base_url('daily_login'));
            return;
        }

        // $this->session->unset_userdata('ROUTES-API')['checkin_now'];
		// unset($GLOBALS['ROUTES-API']['checkin_now']);
        // $routes_api = array(
        //     'checkin_now'=> array(
        //         'encrypt' => 'checkin/'.randomNumber(), 
        //         'decrypt' => 'checkin/checkin_now'
        //     ),
        // );
        // $i=0;
        // foreach ($routes_api as $key => $val) {
        //     $i++;
        //     $GLOBALS['ROUTES-API'][$key]['encrypt'] = $val['encrypt'].$i;
        //     $GLOBALS['ROUTES-API'][$key]['decrypt'] = $val['decrypt'];
        // }
        // $this->session->set_userdata('ROUTES-API', $GLOBALS['ROUTES-API']); 

        $this->db->trans_commit();
        setFlashData('success', 'Successfully checked in');
        redirect(base_url('daily_login'));
        return;
    }
}

?>