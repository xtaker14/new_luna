<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Im_model extends MY_Model{
	public function __construct(){
		parent::__construct();
		error_reporting(0);
	}

	function topup_log($user_idx=""){
		$where = "";
		if(!empty($user_idx)){
			$where = "WHERE user_idx = '$user_idx'";
		}
		$get = $this->db->query("SELECT * FROM topup_log $where ORDER BY id DESC")->result_array();
		return $get;
	}

	function im_byCategory($cat_id){
		$get = $this->db->query("SELECT itemid,itemname,itemimage,itemtype,isDiscount FROM itemmall WHERE itemtype = '$cat_id' AND status = 1 ORDER BY itemid DESC")->result_array();
		return $get;
	}

	function im_list_by($count,$type){
		$do = $this->db->select('itemid,itemname,itemimage,itemtype,isDiscount')
		->from('itemmall')
		->where('status',1)
		->ORDER_BY($type,"DESC")
		->LIMIT($count)
		->get()->result_array();
		return $do;
	}

	function im_detail($im_id){
		$do = $this->db->query("SELECT * FROM itemmall WHERE itemid = '$im_id' AND status = 1 ")->row_array();
		return $do;
	}

	function piece_list($im_id){
		$p = $this->db->query("SELECT * FROM itemmall_piece WHERE itemid = '$im_id' ")->result_array();
		return $p;
	}

	function discount_list(){
		$dis = $this->db->query("SELECT * FROM itemmall_discount")->result_array();
		return $dis;
	}

	function discount_byId($dis_id){
		$p = $this->db->query("SELECT * FROM itemmall_discount WHERE id = '$dis_id' ")->row_array();
		return $p;
	}

	//BUY SYSTEM

	function itemid_byPiece($piece_id){
		$this->db = dbloader("default");
		$do = $this->db->query("SELECT * FROM itemmall_piece WHERE id = '$piece_id' ")->row_array();
		return $do;
	}

	function im_type($im_id){
		$this->db = dbloader("default");
		$do = $this->db->query("SELECT itemtype FROM itemmall WHERE itemid = '$im_id' ")->row_array();
		return $do['itemtype'];
	}

	function get_IDPoint($usr_code,$user_idx,$pin_code){
   		$this->db = dbloader("default");
		$a = $this->db->query("SELECT pin_code,silver_point,star_point FROM tbl_user WHERE code = '$usr_code'")->row_array();
	  if($a){
	    if(verifyHashedPassword($pin_code, $a['pin_code'])){
	      	return array(
			  	'status' => true, 
				'star_point' => $a['star_point'],
				'silver_point' => $a['silver_point'],
			);
	    }else{
	      return array('status' => false, 'star_point' => 0, 'silver_point' => 0);
	    }
	  }else{
	    return array('status' => false, 'star_point' => 0, 'silver_point' => 0);
	  }
   	}

	//insert Item to GAMEDB
	function insert_item($bin_code,$user_idx,$qty=1){
		$this->db = dbloader("LUNA_GAMEDB");
		$do = $this->db->query("INSERT INTO TB_ITEM (CHARACTER_IDX,ITEM_IDX,ITEM_POSITION,ITEM_DURABILITY,ITEM_SHOPIDX) VALUES (0,$bin_code,280,$qty,$user_idx)");
		if($do){
			return true;
		}else{
			return false;
		}
	}

	function update_idPoint($usr_code,$user_idx,$total_price,$field='star_point'){
		$this->db = dbloader("default");
        $this->db->query("UPDATE tbl_user set $field = $field-$total_price where code = '$usr_code' AND id = $user_idx ");
	}

	function insert_IMlog($data,$field='counter'){
		$this->db = dbloader("default");
		$do = $this->db->insert('itemmall_log', $data);
		// set counter
		$itemid = $data['itemid'];
		$this->db->query("UPDATE itemmall set $field = $field+1 where itemid = '$itemid'");
	}

	//Admin Panel (IM Service)

	function adm_topup($username,$point){
		$this->db = dbloader("default");
        $do = $this->db->query("UPDATE tbl_user set star_point = star_point+$point where username = '$username'");
        if($do){
        	return TRUE;
        }else{
        	return FALSE;
        }
	}

	function insert_topup_log($info){
		$this->db = dbloader("default");
		$this->db->insert('topup_log', $info);
	}
}