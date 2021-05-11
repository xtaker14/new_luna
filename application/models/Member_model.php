<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends MY_Model
{
  function getWhereUser($data=false){
    $where = array();
    if($data){
      $where = $data;
    }
    $this->db = dbloader("default");
    return $this->db->get_where('tbl_user',$where);
  }
  function insert_WebMember($d){
    $code = random_string('alnum', 50);
    $pw = getHashedPassword($d[2]);
    $pin_code = getHashedPassword($d[3]);
    $this->db = dbloader("default");
    $this->db->trans_begin();
    try{
      $data = array('username' => $d[0], 'code' => $code, 'pin_code' => $pin_code, 'email' => $d[1], 'password' => $pw);//'star_point' => 99999
      $do = $this->db->insert('tbl_user', $data); 
      if($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return false;
      }   

      if($do){
        $propid = $this->db->insert_id();
        $this->register($code,$d[0],$d[1],$d[2],$propid, array($this->db));
        return true;
      }
    }
    catch (Exception $e) {
      $this->db->trans_rollback();
      return false;
    }
  }

  function register($code,$id_loginid,$id_email,$id_passwd,$id, $db=array()){
    $this->db = dbloader("LUNA_MEMBERDB");
    $this->db->trans_begin();
    try{
      $do = $this->db->query("INSERT INTO chr_log_info(propid, code, id_loginid, id_passwd, id_email,UserLevel) values('$id', '$code', '$id_loginid', '$id_passwd', '$id_email',6)");
      if($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return false;
      }  
      if(!empty($db) && is_array($db)){
        foreach ($db as $key => $val) {
          $val->trans_commit();
        }
      }
      $this->db->trans_commit();
      return true;
    }
    catch (Exception $e) {
      $this->db->trans_rollback();
      return false;
    }
  }

  function refresh_point($username){
    $this->db = dbloader("default");
    if(!$username){
      return false;
    }
    $res = $this->db->get_where('tbl_user',array('username'=>$username))->row();
    if($res){
      return $res->star_point;
    }else{
      return false;
    }
  } 

  function select_idx($username){
    $this->db = dbloader("default");
    $a = $this->db->query("SELECT id FROM tbl_user WHERE username = '$username'")->row();
  return $a;
  }
  function login($username,$password){
    $this->db = dbloader("default");
    $a = $this->db->query("SELECT id,code,email,password,star_point FROM tbl_user WHERE username = '$username'")->row();
    if($a){
      if(verifyHashedPassword($password, $a->password)){
        return $a;
      }else{
        return array();
      }
    }else{
      return array();
    }
  }

  function pin_req_checker($code){
      $a = $this->db->query("SELECT id FROM tbl_pin_reset WHERE code = '$code' AND DATE(created) = DATE(NOW())")->row();
      return $a;    
  }

  function go_pin_req($info){
    //info = array('code' => $code, 'rand_code' => $rand_code, 'created' => date('Y-m-d-H-i-s'));
    $this->db = dbloader("default");
    $do = $this->db->on_duplicate('tbl_pin_reset', $info);
    if($do){
      return true;
    }else{
      return false;
    }
  }

  function change_pin($code,$rand_code,$password,$new_pin){
    $this->db = dbloader("default");
    $redirect = 'change_pin/'.$rand_code;
    $x = $this->db->query("SELECT id FROM tbl_pin_reset WHERE code = '$code' AND rand_code = '$rand_code' ")->row();
    if(!empty($x->id)){
    $a = $this->db->query("SELECT password FROM tbl_user WHERE code = '$code' ")->row();           
      if($a){
        if(verifyHashedPassword($password, $a->password)){
            $pin = getHashedPassword($new_pin);
            $do = $this->db->query("UPDATE tbl_user set pin_code = '$pin' WHERE code = '$code' ");
          if($do){
            return array('','success', 'Success to change PIN.' );
          }else{
            return array($redirect,'error', 'failed to change PIN' );
          }
        }else{
          return array($redirect,'error', 'wrong password' );
        }
      }else{
        return array('','error', 'can not find your information' );
      }
    }else{
      return array('pin_req','error', 'Please request Change PIN again' );
    }
  }

  function change_pwd($code,$old_password,$new_password,$pin){
    $this->db = dbloader("default");
    $a = $this->db->query("SELECT password,pin_code FROM tbl_user WHERE code = '$code' ")->row();
    if($a){
      if(verifyHashedPassword($old_password, $a->password) == true && verifyHashedPassword($pin, $a->pin_code) == true ){
          $hash_pwd = getHashedPassword($new_password);
          $do = $this->db->query("UPDATE tbl_user set password = '$hash_pwd' WHERE code = '$code' ");
        if($do){
          $this->db = dbloader("LUNA_MEMBERDB");
          $do2 = $this->db->query("UPDATE chr_log_info set id_passwd = '$new_password' WHERE code = '$code' ");
          if($do2){
            return array('success', 'Success to change Password.' );
          }else{
            return array('error', 'failed to change game password, please contact star luna admin.' );
          }
        }else{
          return array('error', 'failed to change password' );
        }
      }else{
        return array('error', 'wrong pin or old password' );
      }
    }else{
      return array('error', 'something error..' );
    }
  }

  function chr_teleport($user_idx){
 		$this->db = dbloader("LUNA_GAMEDB");
      $do = $this->db->query("SELECT CHARACTER_IDX,CHARACTER_NAME FROM TB_CHARACTER WHERE USER_IDX = $user_idx AND CHARACTER_STANDINDEX != 5 ")->result_array();
      return $do;
  }
 	function update_map($i){
		$this->db = dbloader("LUNA_GAMEDB");
    $do = $this->db->query("UPDATE TB_CHARACTER set CHARACTER_MAP = ".$i['map_id'].",CHARACTER_POS_X = ".$i['pos_x'].",CHARACTER_POS_Y = ".$i['pos_y']." where CHARACTER_IDX = '".$i['char_idx']."' AND USER_IDX = ".$i['user_idx']." ");
    if($do){
    	return true;
    }else{
    	return false;
    }
	}
  function select_member($username){
    $this->db = dbloader("default");
    $m = $this->db->query("SELECT id FROM tbl_user WHERE username = '$username'")->row_array();
    return $m['id'];
  }
  function del_member($a,$b){
      $this->db->query("DELETE FROM tbl_user WHERE id = $a AND username = '$b'");
      $this->db = dbloader("LUNA_MEMBERDB");
      $this->db->query("DELETE FROM chr_log_info WHERE propid = $a AND id_loginid = '$b'");
  }
  function select_aLLmember($date=''){
    $this->db = dbloader("LUNA_MEMBERDB");
    $m = '';
    if(!empty($date)){
      if($date[0]==$date[1]){
        $date[1] = date('Y-m-d', strtotime("+1 day", strtotime($date[1])));
      }
      $m = $this->db->query("SELECT propid FROM chr_log_info WHERE (id_regdate BETWEEN '$date[0]' AND '$date[1]') ")->result_array();
    }else{
      $m = $this->db->query("SELECT propid FROM chr_log_info")->result_array();
    }
    return $m;
  }

}