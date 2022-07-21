<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends MY_Model
{

    public function __construct(){
        parent::__construct();
    }

    function referral_history_list($where_data=false){
		$this->db = dbloader("default"); 
		$this->db->select('uu.username as from_username, u.username as username, rch.*');
        $this->db->join('tbl_user as u', 'u.referral_code = rch.referral_code', 'inner');
        $this->db->join('tbl_user as uu', 'uu.id = rch.from_user_id', 'inner');
        
        $this->db->order_by('rch.created_date','DESC');
        $this->db->order_by('u.username','ASC');

		$where = array(); 
		if($where_data && is_array($where_data)){
			foreach ($where_data as $key => $val) {
				$where[$key]=$val;
			}
		}
		return $this->db->get_where('referral_code_history rch',$where)->result_array();
	}

    function referral_list($where_data=false){
		$this->db = dbloader("default"); 
		$this->db->select('u.username as username, rc.*');
        $this->db->join('tbl_user as u', 'u.referral_code = rc.referral_code', 'inner');
        
        $this->db->order_by('rc.point','DESC');
        $this->db->order_by('u.username','ASC');

		$where = array(); 
		if($where_data && is_array($where_data)){
			foreach ($where_data as $key => $val) {
				$where[$key]=$val;
			}
		}
		return $this->db->get_where('referral_code rc',$where)->result_array();
	}

    function donate_list($where_data=false){
		$this->db = dbloader("default");
		$this->db->select('dl.price as bill, dl.currency, d.*');
        $this->db->join('donate_price_list as dl', 'd.donate_price_id = dl.id', 'inner'); 
        
        $this->db->order_by('d.status','DESC');
        $this->db->order_by('d.created_date','DESC'); 

		$where = array(); 
		if($where_data && is_array($where_data)){
			foreach ($where_data as $key => $val) {
				$where[$key]=$val;
			}
		}
		return $this->db->get_where('donate d',$where)->result_array();
	}

    function insert_im($data){

        $do = $this->db->insert('itemmall', $data);
        if($do){
            return true;
        }else{
            return false;
        }
    }

    function insert_im_piece($data){
        $do = $this->db->insert('itemmall_piece', $data);
        if($do){
            return true;
        }else{
            return false;
        }
    }

    function update_im_stat($a,$b)
    {
        $do = $this->db->set('status', $b)->where('itemid', $a)->update('itemmall');

        if($do){
            return true;
        }else{
            return false;
        }
    }

    function im_delete($a)
    {
        $img = $this->db->select('itemimage')->from('itemmall')->where('itemid',$a)->get()->row_array();
        $do = $this->db->where('itemid',$a)->delete('itemmall');
        if($do){
            unlink('./'.$img['itemimage']);
            return true;
        }else{
            return false;
        }
    }

    function im_piece_delete($id)
    {
        $img = $this->db->select('img')->from('itemmall_piece')->where('id',$id)->get()->row_array();
        $do = $this->db->where('id',$id)->delete('itemmall_piece');
        if($do){
            if(!empty($img['img'])){
                unlink('./'.$img['img']);
            }
            return true;
        }else{
            return false;
        }
    }

    function insert_article($data){
        $do = $this->db->insert('news', $data);
        if($do){
            return true;
        }else{
            return false;
       }
    }

    function article_delete($id)
    {
        $do = $this->db->where('id',$id)->delete('news');
        if($do){
            return true;
        }else{
            return false;
        }
    }

    function update_aticle($info,$id)
    {
        $do = $this->db->where('id', $id)->update('news', $info);
        if($do){
            return true;
        }else{
            return false;
        }
    }


    function del_web_admin($id)
    {
        $do = $this->db->where('id',$id)->delete('tbl_admin');
        if($do){
            return true;
        }else{
            return false;
        }
    }

    function insert_WebMember($d){
        $code = random_string('alnum', 50);
        $pw = getHashedPassword($d[2]);
        $pin_code = getHashedPassword($d[3]);
        $this->db = dbloader("default");
        $data = array('username' => $d[0], 'code' => $code, 'pin_code' => $pin_code, 'email' => $d[1], 'password' => $pw);
        $do = $this->db->insert('tbl_user', $data);    
        if($do){
          $propid = $this->db->insert_id();
          $info = array($code,$d[0],$d[1],$d[2],$propid,$d[4]);
          $this->register($info);
          return true;
        }else{
          return false;
        }

    }

    function register($i){
      $this->db = dbloader("LUNA_MEMBERDB");
      $do = $this->db->query("INSERT INTO chr_log_info(id_idx, propid, code, id_loginid, id_passwd, id_email,UserLevel) values('$i[4]', '$i[4]', '$i[0]', '$i[1]', '$i[3]', '$i[2]',$i[5])");
    }

}

?>