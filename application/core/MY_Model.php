<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
    function __construct()
    {
        parent::__construct();
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
}
