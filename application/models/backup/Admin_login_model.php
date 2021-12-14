<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_login_model extends MY_Model
{

    public function __construct(){
        parent::__construct();
    }
    
    function adminLogin($email, $password)
    {
        $this->db->select('BaseTbl.id, BaseTbl.password, BaseTbl.nama, BaseTbl.jabatan, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_admin as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.email', $email);
        $query = $this->db->get();        
        $user = $query->row();        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function checkEmailExist($email)
    {
        $this->db->select('id');
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_admin');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

}

?>