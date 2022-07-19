<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/FrontLib.php';

class Frontpage_json extends FrontLib {

	public function __construct(){

		parent::__construct();

		error_reporting(0);

      $this->is_login();

	} 

   

   // public function process_payment(){

   //    if(!$this->onlyAllowAccessFromAjax()){

   //       return $this->output

   //          ->set_content_type('application/json')

   //          ->set_status_header(200)

   //          ->set_output(json_encode(array(

   //             'result'=>'Error: Only Allow Access From Ajax'

   //          )));

   //    } 

       

   //    $result = $this->donate_process_payment(true);

   //    return $this->output

   //       ->set_content_type('application/json')

   //       ->set_status_header(200)

   //       ->set_output(json_encode(array(

   //          'result'=>$result,

   //       )));

   // }

   

   public function checkin_now(){

      if(!$this->onlyAllowAccessFromAjax()){

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>'Error: Only Allow Access From Ajax'

            )));

      }

      $this->load->model("frontpage_model");

		$user_id = $this->propid;

      $this->db = dbloader("default");

      $this->db->trans_begin();

      $get_user = $this->main_m->getWhereUser(array(

			'id'=>$user_id

		))->row_array();

      if(count($get_user) == 0){

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>'User Account is not found'

            )));

      }

      $get_char = $this->frontpage_model->getCharacter(array(

			'USER_IDX' => $user_id,

			'CHARACTER_MAXGRADE >=' => 120,

		));

		if(count($get_char) == 0){ 

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>'If you want daily check in at least you must have char level 120.'

            )));

		} 

      $available_checkin_date = $this->plus_min_date($get_user['last_checkin_date'],["+1 day","Y-m-d"]);

      $date_now = date('Y-m-d', strtotime($GLOBALS['date_now'])); 

      if(!empty($get_user['last_checkin_date'])){

         if($available_checkin_date > $date_now){

            return $this->output

               ->set_content_type('application/json')

               ->set_status_header(200)

               ->set_output(json_encode(array(

                  'result'=>'You Checked In for today'

               )));

         }

		}

      $daily_checkin_item = $this->db->query("SELECT * FROM daily_checkin_item where checkin_day > ".$get_user['last_checkin_day']." and is_active='yes' order by checkin_day ASC LIMIT 1")->row_array();

      

      if(count($daily_checkin_item) == 0){

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>'Daily Checkin Item is not found'

            )));

      }

      $this->db->query("UPDATE tbl_user SET 

      last_checkin_date=NOW(), 

      last_checkin_day=".$daily_checkin_item['checkin_day']." 

      WHERE id='$user_id'");

      if($this->db->trans_status() === FALSE) {

         $this->db->trans_rollback();

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>'Failed To Checkin (1)'

            )));

      } 

      

      $all_daily_checkin_item = $this->db->get_where('daily_checkin_item', array(

         'checkin_day'=>$daily_checkin_item['checkin_day'],

         'is_active'=>'yes',

      ))->result_array();

      foreach ($all_daily_checkin_item as $key) {

         $this->db->insert('daily_checkin',array(

            'checkin_item_id'=>$key['id'],

            'user_id'=>$user_id,

            'checkin_year'=>date('Y'),

            'checkin_month'=>date('m')

         ));

         if($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();

            return $this->output

               ->set_content_type('application/json')

               ->set_status_header(200)

               ->set_output(json_encode(array(

                  'result'=>'Failed To Checkin (2)'

               )));

         }

         $this->load->model("im_model");

         $insert_item = $this->im_model->insert_item(

            $key['bin_code'],

            $user_id,

            $key['qty']

         );

         if(!$insert_item){ 

            return $this->output

               ->set_content_type('application/json')

               ->set_status_header(200)

               ->set_output(json_encode(array(

                  'result'=>'Failed To Checkin (3)'

               )));

         }

      }

      // start check if next day is available items or not

      $check_available_checkin_item = $this->db->query("SELECT * FROM daily_checkin_item where checkin_day > ".($get_user['last_checkin_day']+1)." and is_active='yes' order by checkin_day ASC LIMIT 1")->row_array();

      

      if(count($check_available_checkin_item) == 0){

         $this->db->query("UPDATE tbl_user SET last_checkin_day=0 

         WHERE id='$user_id'");

         if($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();

            return $this->output

               ->set_content_type('application/json')

               ->set_status_header(200)

               ->set_output(json_encode(array(

                  'result'=>'Failed To Checkin (4)'

               )));

         }

      }

      // end check if next day is available items or not



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

 

	function load_view($p=''){

      if(!$this->onlyAllowAccessFromAjax()){

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>'Error: Only Allow Access From Ajax'

            )));

      }

      if(empty($p)){

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>'Error: Only Allow Access From Ajax'

            )));

      }

      $this->global['load_data'] = $this->securePost('data',true,[]);

      if($p == 'banner_and_hot_news'){

         $this->load->model('frontpage_model');

         $this->global['news'] = $this->frontpage_model->getNews('News',4);

         $this->global['news_event'] = $this->frontpage_model->getNews('Event',4);

         $this->global['news_server_info'] = $this->frontpage_model->getNews('Server Info',4);

         $this->global['news_item_mall'] = $this->frontpage_model->getNews('Item Mall',4);

      }

      if($p == 'server_stat_and_hot_items'){ 

         $this->load->model("im_model");

         $this->global['hot_items'] = $this->im_model->im_list_by(8,'counter');	

         $config_web = $this->getConfigWeb(true);

         $this->global['config_web'] = $config_web;

         // dump($this->global); exit;

      }

      if($p == 'main_gallery'){ 

         $this->load->model('frontpage_model');

         $this->global['s_media'] = $this->frontpage_model->getMedia('s',3);

      }

      $this->load->view('app/_main/_load/'.$p, array('global_data'=>$this->global));

	}



   function homepage(){

      if(!$this->onlyAllowAccessFromAjax()){

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>'Error: Only Allow Access From Ajax'

            )));

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

            // if($job[0]=='fighter'):
            //    $res_job = '<span class="pointer" role="button" title="'. $job[1] .'" data-toggle="tooltip" data-placement="bottom">
            //       <img src="' . base_url('assets/frontpage/img/class/fighter/Job 1/fighter.png') . '" style="width:24px;" alt="">
            //    </span>';
            // elseif($job[0]=='rogue'):
            //    $res_job = '<span class="pointer" role="button" title="'. $job[1] .'" data-toggle="tooltip" data-placement="bottom">
            //       <img src="' . base_url('assets/frontpage/img/class/rogue/Job 1/rogue.png') . '" style="width:24px;" alt="">
            //    </span>';
            // elseif($job[0]=='mage'):
            //    $res_job = '<span class="pointer" role="button" title="'. $job[1] .'" data-toggle="tooltip" data-placement="bottom">
            //       <img src="' . base_url('assets/frontpage/img/class/mage/Job 1/mage.png') . '" style="width:24px;" alt="">
            //    </span>';
            // endif;
            
            $res_job = '<span class="pointer" role="button" title="'. $job[1] .'" data-toggle="tooltip" data-placement="bottom">
               <img src="' . base_url('assets/frontpage/img/class/'.$job[0].'/'.$job[1].'.png') . '" style="width:24px;" alt="">
            </span>';

         else: 

            // $res_job = '<span class="pointer" role="button" title="'. $job .'" data-toggle="tooltip" data-placement="bottom">

            //    <i class="fab fa-earlybirds"></i>

            // </span>';

         endif;

         $res_level_rank[$cntr]['job'] = $res_job;

         $res_level_rank[$cntr]['job_text'] = $job[0]; 



         $res_level_rank[$cntr]['name'] = $val['a'];

         $res_level_rank[$cntr]['lvl'] = $val['b'];

         $res_level_rank[$cntr]['exp'] = number_format($val['exp'],0,',','.');

      }

      $data['level_rank'] = $res_level_rank;

      json($data);

   }



   function open_menu(){

      if(!$this->onlyAllowAccessFromAjax()){

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>false

            ))); 

      }

      $view = $this->load->view("app/_part/open_menu.php",[],true);

      return $this->output

         ->set_content_type('application/json')

         ->set_status_header(200)

         ->set_output(json_encode(array(

            'data'=>$view

         )));

   }



   function refresh_point(){

      if(!$this->onlyAllowAccessFromAjax()){

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>false

            ))); 

      }



      $is_login = $this->isLoggedIn();

      if(!$is_login){

         return $this->output

            ->set_content_type('application/json')

            ->set_status_header(200)

            ->set_output(json_encode(array(

               'result'=>false

            ))); 

      }



      $this->load->model("member_model"); 

      $username = $this->session->userdata('id_loginid');

      $refresh = $this->member_model->refresh_point($username);

      $result = array(

         // 'star_point'=>$refresh['star_point'],

         // 'silver_point'=>$refresh['silver_point'],

         'cash_point'=>$refresh['star_point'],

         // 'silver_point'=>$refresh['silver_point'],

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

            ->set_status_header(200)

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