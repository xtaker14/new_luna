<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';
class Frontpage_json extends FrontLib {
	public function __construct(){
		parent::__construct();
		error_reporting(0);
      $this->is_login();
	}

   function homepage(){
      if(!$this->onlyAllowAccessFromAjax()){
         redirect('');
      }
      $this->load->model("frontpage_model");
      $data['srv'] = $this->frontpage_model->server_stat();
      $data['rank'] = $this->frontpage_model->top_char_rank();
      json($data);
   }

   function refresh_point(){
      if(!$this->onlyAllowAccessFromAjax()){
         return $this->output
            ->set_content_type('application/json')
            ->set_status_header(403)
            ->set_output(json_encode(array(
               'result'=>false
            ))); 
      }

      $is_login = $this->isLoggedIn();
      if(!$is_login){
         return $this->output
            ->set_content_type('application/json')
            ->set_status_header(403)
            ->set_output(json_encode(array(
               'result'=>false
            ))); 
      }

      $this->load->model("member_model"); 
      $username = $this->session->userdata('id_loginid');
      $result = $this->member_model->refresh_point($username);

      if($result){
         return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
               'result'=>$result
            )));
      }else{
         return $this->output
            ->set_content_type('application/json')
            ->set_status_header(403)
            ->set_output(json_encode(array(
               'result'=>'Error'
            ))); 
      }
  }

   /*
   function top_rank(){

      $this->load->model("frontpage_model");
      $val = $this->frontpage_model->top_50_rank('kill');
      $rank['data'] = array_map(function($val) {
         $job = intval($val['c1'].$val['c2']);
         $job = luna_job($job);
         
          return array(
              'Job' => $job,
              'Name' => $val['a'],
              'Level' => $val['b'],
              'Kill' => $val['k']
          );
      }, $val );
      //buat job array
      json($rank);
   }
   */
}