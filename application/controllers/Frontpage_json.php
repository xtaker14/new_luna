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
      $level_rank = $this->frontpage_model->getPlayerRank('level',5);
      $res_level_rank = array();
      $cntr = -1;
      foreach ($level_rank as $key => $val){
         $cntr++;
         $job = ''; 
         if($val['c4'] > 0 && $val['c5'] == 0){
            if($val['c1'] == 4){
               $job = 'Master';
            }else{
               $kw = intval($val['c1'].$val['c4']);
               $job = luna_job4($kw);
            }
         }elseif($val['c5'] > 0  && $val['c6'] == 0){
            if($val['c1'] == 4){
               $job = 'Expand Road';
            }else{
               $kw = intval($val['c1'].$val['c5']);
               $job = luna_job5($kw);
            }
         }elseif($val['c6'] > 0){
            if($val['c1'] == 4){
               $job = 'Tyrant';
            }else{
               $kw = intval($val['c1'].$val['c6']);
               $job = luna_job6($kw);
            }
         }
         $no = $key+1;
         
         if($no==1):
            $no = '<img src="'. base_url('assets/frontpage/img/medal_1st.png'). '" style="width:24px;" alt="">';
         elseif($no==2): 
            $no = '<img src="'. base_url('assets/frontpage/img/medal_2nd.png'). '" style="width:24px;" alt="">';
         elseif($no==3): 
            $no = '<img src="'. base_url('assets/frontpage/img/medal_3rd.png'). '" style="width:24px;" alt="">';
         endif;
         $res_level_rank[$cntr]['no'] = $no;

         $res_job = '';
         if(is_array($job)):
            if($job[0]=='fighter'):
               $res_job = '<span class="pointer" role="button" title="'. $job[1] .'" data-toggle="tooltip" data-placement="bottom">
                  <img src="' . base_url('assets/frontpage/img/basic_job_fighter.png') . '" style="width:24px;" alt="">
               </span>';
            elseif($job[0]=='rogue'):
               $res_job = '<span class="pointer" role="button" title="'. $job[1] .'" data-toggle="tooltip" data-placement="bottom">
                  <img src="' . base_url('assets/frontpage/img/basic_job_rogue.png') . '" style="width:24px;" alt="">
               </span>';
            elseif($job[0]=='mage'):
               $res_job = '<span class="pointer" role="button" title="'. $job[1] .'" data-toggle="tooltip" data-placement="bottom">
                  <img src="' . base_url('assets/frontpage/img/basic_job_mage.png') . '" style="width:24px;" alt="">
               </span>';
            endif;
         else: 
            $res_job = '<span class="pointer" role="button" title="'. $job .'" data-toggle="tooltip" data-placement="bottom">
               <i class="fab fa-earlybirds"></i>
            </span>';
         endif;
         $res_level_rank[$cntr]['job'] = $res_job;
         

         $res_level_rank[$cntr]['name'] = $val['a'];
         $res_level_rank[$cntr]['lvl'] = $val['b'];
         $res_level_rank[$cntr]['exp'] = number_format($val['exp'],0,',','.');
      }
      $data['level_rank'] = $res_level_rank;
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
      $refresh = $this->member_model->refresh_point($username);
      $result = array(
         'star_point'=>$refresh['star_point'],
         'silver_point'=>$refresh['silver_point'],
      );

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