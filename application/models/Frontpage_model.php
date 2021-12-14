<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Frontpage_model extends MY_Model{
	public function __construct(){
		parent::__construct();
		error_reporting(0);
	}

	// function getConfigWeb($id=1){
	// 	$this->db = dbloader("default");
	// 	return $this->db->get_where('web_config',array(
	// 		'id'=>$id
	// 	))->row_array();
	// }

	function referral_history_list($where_data=false, $or_where_data=false){
		$this->db = dbloader("default"); 
		$this->db->select('uu.username as from_username, u.username as username, rch.*');
        $this->db->join('tbl_user as u', 'u.referral_code = rch.referral_code', 'inner');
        $this->db->join('tbl_user as uu', 'uu.id = rch.from_user_id', 'inner');

		$where = array(); 
		$or_where = array(); 
		if($where_data && is_array($where_data)){
			foreach ($where_data as $key => $val) {
				$where[$key]=$val;
			}
		}
		if($or_where_data && is_array($or_where_data)){
			foreach ($or_where_data as $key => $val) {
				$or_where[$key]=$val;
			}
		}
		if(!empty($where)){
        	$this->db->where($where);
		}
		if(!empty($or_where)){
        	$this->db->or_where($or_where);
		}
        
        $this->db->order_by('rch.created_date','DESC');
        $this->db->order_by('u.username','ASC');
		return $this->db->get('referral_code_history rch')->result_array();
	}

	function getIMCategory(){
		$this->db = dbloader("default");
		return $this->db->query("SELECT * FROM itemcategory where is_active='yes'")->result_array(); 
	}
	
	function getOverview($where,$max=false){
		$where['category'] = 'Overview';
		if($max){
			$this->db->limit($max);
		}
		$do = $this->db->get_where("news",$where)->result_array();
		return $do;
	}

	function getNews($category = '',$max=4){
		$where = "";
		if(!empty($category)){
			$where .= " AND category = '$category' ";
		}
		$do = $this->db->query("
			SELECT * FROM news WHERE category != 'Page' $where AND is_active='yes' ORDER BY id DESC LIMIT $max
		")->result_array();
		return $do;
	}

	function top_news(){
		$do = $this->db->query("SELECT * FROM news WHERE category != 'Page' AND is_active='yes' ORDER BY id DESC LIMIT 4")->result_array();
		return $do;
	}

	function news($url){
		$do = $this->db->query("SELECT * FROM news WHERE url = '$url' AND category != 'Page' AND is_active='yes' ")->row_array();
		return $do;
	}

	function page($url){
		$do = $this->db->query("SELECT * FROM news WHERE url = '$url' AND category = 'Page' AND is_active='yes' ")->row_array();
		return $do;
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
		$config_web = $this->getConfigWeb(true);
		$this->db = dbloader("LUNA_MEMBERDB");
		$p_online = $this->db->query("SELECT propid from LoginTable")->num_rows();
		if(count((int)$p_online)>0){
			if(empty($config_web['initial_total_online'])){
				$config_web['initial_total_online'] = 0;
			}
			$p_online = (int)$p_online + $config_web['initial_total_online'];
		}
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

	function getMedia($type='all',$max=10){
		$this->db = dbloader("default");
		$where = array(
			'is_hidden'=>'no'
		);
		if($type == 's'){
			$where['type'] = 'ss';
		}
		if($type == 'w'){
			$where['type'] = 'wallpaper';
		}
		$this->db->order_by('no_order','ASC');
		$this->db->order_by('created_date','DESC');
		$this->db->limit($max);
		return $this->db->get_where('media',$where)->result_array();
	}

	function getCharacter($filter=array()){
		$this->db = dbloader("LUNA_GAMEDB"); 
		$where = '';
		

		if(isset($filter['USER_IDX'])){
			if($where != ''){
				$where .= " AND ";
			}
			$where .= "USER_IDX = ".$filter['USER_IDX'];
		}
		if(isset($filter['CHARACTER_MAXGRADE'])){
			if($where != ''){
				$where .= " AND ";
			}
			$where .= "CHARACTER_MAXGRADE >= '".$filter['CHARACTER_MAXGRADE']."'";
		}
		$res = $this->db->query("SELECT * FROM TB_CHARACTER WHERE $where")->result_array();
		return $res;
	}

	function getPlayerRank($a='kill',$max=100){ 
		$this->db = dbloader("LUNA_GAMEDB"); 

		$type = '';
		$select = '';
		$join = '';
		$where = '';
		$order = '';
		if($a == 'kill'){
			$type = 'tmm.KILL_POINT';
			$select = "
				TOP $max CHARACTER_NAME as a,
				CHARACTER_MAXGRADE as b,
				CHARACTER_JOB1 as c1,
				CHARACTER_JOB2 as c2,
				CHARACTER_JOB3 as c3,
				CHARACTER_JOB4 as c4,
				CHARACTER_JOB5 as c5,
				CHARACTER_JOB6 as c6,
				$type as k
			";
			$join = "
				JOIN TB_KILL_POINT tmm on tmm.CHARACTER_IDX = tb.character_idx 
			";
			$where = "
				WHERE CHARACTER_STANDINDEX < 5 AND CHARACTER_JOB4 > 0 
			";
			$order = "
				ORDER BY $type DESC
			";
		}
		else if($a == 'level'){
			$type = '';
			$select = "
				TOP $max CHARACTER_NAME as a,
				CHARACTER_MAXGRADE as b,
				CHARACTER_JOB1 as c1,
				CHARACTER_JOB2 as c2,
				CHARACTER_JOB3 as c3,
				CHARACTER_JOB4 as c4,
				CHARACTER_JOB5 as c5,
				CHARACTER_JOB6 as c6,
				CHARACTER_EXPOINT as exp
			";
			$join = "";
			$where = "
				WHERE CHARACTER_STANDINDEX < 5 AND CHARACTER_JOB4 > 0 
			";
			$order = "
				ORDER BY CHARACTER_MAXGRADE DESC, CHARACTER_EXPOINT DESC
			";
		}
		else if($a == 'guild'){
			$type = '';
			$select = "
				TOP $max 
				GuildName,
				MasterName,
				GuildLevel,
				CreateDate
			";
			$join = "
				JOIN TB_GUILD tg on tg.MasterIdx = tb.character_idx
			";
			$where = "";
			$order = "
				ORDER BY GuildLevel DESC, CreateDate ASC
			";
		}
		else if($a == 'cs'){
			$type = '';
			$select = "
				TOP $max swc.*, tg.GuildName, tg.MasterName   
			";
			$join = "
				INNER JOIN TB_GUILD tg
				ON tg.MasterIdx = tb.character_idx 
				INNER JOIN SIEGEWARFARE_WATERSEED_COMPLETE swc 
				ON swc.GUILDIDX=tg.GuildIdx
			";
			$where = "";
			$order = "
				ORDER BY ID_IDX ASC
			";
			
		}
		else{
			//$play = "CHARACTER_PLAYTIME";
		}
		
		$do = $this->db->query("
			SELECT 
				$select 
			FROM 
				TB_CHARACTER tb 
			$join 
			$where 
			$order
		")->result_array();

		return $do;

	}
}