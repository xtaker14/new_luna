<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function getWhereUser($data=false){
        $where = array();
        if($data){
          $where = $data;
        }
        $this->db = dbloader("default");
        return $this->db->get_where('tbl_user',$where);
    }
    
    function getConfigWeb($id=1){
		$this->db = dbloader("default");
		return $this->db->get_where('web_config',array(
			'id'=>$id
		))->row_array();
	}

    function donate_price_list(){
		$this->db = dbloader("default");
		return $this->db->get_where('donate_price_list',array('is_deleted'=>'no'))->result_array();
	} 

    public function getAllowedIp($where, $limit=null, $offset=null){
		$this->db = dbloader("default");

		$where['admin_address IS NOT NULL'] = NULL;
        $this->db->order_by('id', 'ASC');
        if(isset($limit) && isset($offset)){
            $exec = $this->db->get_where('tallowedip', $where, $limit, $offset);
        }else{
            $exec = $this->db->get_where('tallowedip', $where);
        }
		$res_query = $exec;

		$res = $res_query;
		return $res;
	}
}
