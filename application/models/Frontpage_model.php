<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Frontpage_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		error_reporting(0);
	}

	function getConfigWeb($id=1){
		$this->db = dbloader("default");
		return $this->db->get_where('web_config',array(
			'id'=>$id
		))->row_array();
	}

	function top_news(){
		$do = $this->db->query("SELECT * FROM news WHERE category != 'Page' ORDER BY id DESC LIMIT 4")->result_array();
		return $do;
	}

	function news($url){
		$do = $this->db->query("SELECT * FROM news WHERE url = '$url' AND category != 'Page' ")->row_array();
		return $do;
	}

	function page($url){
		$do = $this->db->query("SELECT * FROM news WHERE url = '$url' AND category = 'Page' ")->row_array();
		return $do;
	}

	function donate_price_list(){
		$this->db = dbloader("default");
		return $this->db->get_where('donate_price_list',array('is_deleted'=>'no'))->result_array();
	}
	function donate_list($user_id,$where_data=false){
		$this->db = dbloader("default");
		$this->db->select('dl.price as bill, dl.currency, d.*');
        $this->db->join('donate_price_list as dl', 'd.donate_price_id = dl.id', 'inner');
		
		$this->db->order_by('d.created_date','DESC');
		$this->db->order_by('d.status','ASC'); 
 
		$where['d.user_id'] = $user_id; 
		if($where_data && is_array($where_data)){
			foreach ($where_data as $key => $val) {
				$where[$key]=$val;
			}
		}
		return $this->db->get_where('donate d',$where)->result_array();
	}

	function server_stat(){
		$this->db = dbloader("LUNA_MEMBERDB");
		$p_online = $this->db->query("SELECT propid from LoginTable")->num_rows();
		$account_reg = $this->db->query("SELECT propid from chr_log_info")->num_rows();
		$this->db = dbloader("LUNA_GAMEDB");
		$char_count = $this->db->query("SELECT CHARACTER_IDX from TB_CHARACTER")->num_rows();

		$arr = array('p_online' => $p_online, 'account_reg' => $account_reg, 'char_count' => $char_count);
		return $arr;
	}

	function top_char_rank($max=5){

		$this->db = dbloader("LUNA_GAMEDB");

		$on = "tmm.CHARACTER_IDX = tb.character_idx";

		//$kill = "tmm.KillMonNumTotal";
		$kill = "tmm.KILL_POINT";

		//$play = "tmm.PlayTimeTotal";

		$do = $this->db->query("SELECT top $max CHARACTER_NAME as a,CHARACTER_MAXGRADE as b,CHARACTER_JOB1 as c1,CHARACTER_JOB2 as c2, CHARACTER_JOB3 as c3, CHARACTER_JOB4 as c4, CHARACTER_JOB5 as c5, CHARACTER_JOB6 as c6, $kill as k  FROM TB_CHARACTER tb JOIN TB_KILL_POINT tmm on $on WHERE CHARACTER_STANDINDEX < 5 AND CHARACTER_JOB4 > 0 ORDER BY $kill DESC")->result_array();

		return $do;
	}

	function top_100_rank($a='kill',$max=100){ 
		$this->db = dbloader("LUNA_GAMEDB"); 
		$on = "tmm.CHARACTER_IDX = tb.character_idx"; 
		$kill = "tmm.KILL_POINT";	

		//$play = "tmm.PlayTimeTotal"; 
		$type = $kill;

		if($a!=='kill'){ 
			//$type = $play; 
		}
		
		$do = $this->db->query("SELECT top $max CHARACTER_NAME as a,CHARACTER_MAXGRADE as b,CHARACTER_JOB1 as c1,CHARACTER_JOB2 as c2, CHARACTER_JOB3 as c3, CHARACTER_JOB4 as c4, CHARACTER_JOB5 as c5, CHARACTER_JOB6 as c6, $kill as k  FROM TB_CHARACTER tb JOIN TB_KILL_POINT tmm on $on WHERE CHARACTER_STANDINDEX < 5 AND CHARACTER_JOB4 > 0 ORDER BY $type DESC")->result_array();

		return $do;

	}
}