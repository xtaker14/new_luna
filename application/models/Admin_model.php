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

    function total_donate($get_select, $where_data=array()){
		$this->db = dbloader("default");
        $select = '';
        if($get_select == 'point'){
            $select = '  
                SUM(d.donate_point) as point 
            ';
        }
        if($get_select == 'price'){
            $select = '  
                dl.currency, 
                SUM(dl.price) as price 
            ';
        } 
		$this->db->select($select);
        $this->db->join('donate_price_list as dl', 'd.donate_price_id = dl.id', 'inner'); 

        if(!empty($where_data)){
            foreach($where_data as $key => $val){
                $this->db->where($key, $val, FALSE);
            }
        }
        $this->db->where('d.status', "'paid'", FALSE); 

        if($get_select == 'price'){
            $this->db->group_by('dl.currency'); 
        }

        $this->db->order_by('SUM(d.donate_point)','DESC'); 
        $this->db->order_by('DATE(d.created_date)','DESC'); 
        
		return $this->db->get('donate d')->result_array();
	}
    
    function create_dump_item_name(){
		$this->db = dbloader("LUNA_LOGDB");
        if ($this->db->table_exists('temp_log_item_name')) {
            // table exists some code run query
            // check count to update
            $this->db->select('count(*) cnt_temp');
            $cnt_temp = $this->db->get('temp_log_item_name');
            $cnt_temp = $cnt_temp->row()->cnt_temp;
        }else{
            $this->db->trans_begin();
            $sql = '
                CREATE TABLE [dbo].[temp_log_item_name](
                    [id] [int] NOT NULL,
                    [bin_source] [int] NOT NULL,
                    [nama] [varchar](150) NOT NULL,
                CONSTRAINT [PK_temp_log_item_name] PRIMARY KEY CLUSTERED 
                (
                    [id] ASC 
                    ) WITH ( 
                        PAD_INDEX = OFF, 
                        STATISTICS_NORECOMPUTE = OFF, 
                        IGNORE_DUP_KEY = OFF, 
                        ALLOW_ROW_LOCKS = ON, 
                        ALLOW_PAGE_LOCKS = ON 
                    ) ON [PRIMARY] 
                ) ON [PRIMARY]
            ';

            if(!$this->db->query($sql)) {
                $msg_err = $this->db->error();
                $this->db->trans_rollback();
                dump($msg_err); exit;
            } 
            $this->db->trans_commit();
        } 

		$this->db = dbloader("default"); 
        $cnt = $this->db->query("
            SELECT 
                count(*) cnt 
            FROM 
                tbl_item 
            WHERE 
                bin_source != 0 AND 
                bin_source IS NOT NULL AND  
                nama != '' AND 
                nama IS NOT NULL 
        ");
        $cnt = $cnt->row()->cnt;
        
        if($cnt_temp != $cnt){
		    $this->db = dbloader("LUNA_LOGDB");
            $this->db->empty_table('temp_log_item_name');
        }else{
            return true;
        }

        $show_cnt = 10;
        $loop_cnt = ceil($cnt/$show_cnt);

        $ar_item = [];
		$this->db = dbloader("default");
        for($i=0; $i<=$loop_cnt; $i++){
            $start = $show_cnt*$i;
            $this->db->select('*');
            $this->db->order_by('id', 'asc');
            $get_item = $this->db->get('tbl_item', $show_cnt, $start);
            $ar_item[$i] = [];

            foreach ($get_item->result_array() as $key) {
                $ar_item[$i][] = $key;
            }
        }

        $this->db = dbloader("LUNA_LOGDB");
        $this->db->trans_begin();
        foreach ($ar_item as $idx => $key) { 
            foreach ($key as $idx2 => $key2) {
                if(!empty($key2['bin_source'])){
                    $this->db->insert('temp_log_item_name',array(
                        'id'=>$key2['id'],
                        'bin_source'=>$key2['bin_source'],
                        'nama'=>$key2['nama'],
                    ));
                    if($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        return false;
                    }  
                }
            } 
        }
        $this->db->trans_commit();
        return true;
    }
    function check_game_trade_log($day=null){
		$this->db = dbloader("LUNA_LOGDB");
        if (!$this->db->table_exists('TB_ITEM_LOG_'.$day)) {
            // table exists some code run query
            return false;
        }
        return true;
	}
    function res_game_trade_log($day=null, $ar_search=[], $limit=null, $offset=null){
		$this->db = dbloader("LUNA_LOGDB");
        $select = ' 
            il.*,
            tli.nama ITEM_NAME,
            (
                SELECT 
                    TOP 1 il2.ITEMDUR 
                FROM 
                    TB_ITEM_LOG_'.$day.' il2 
                WHERE 
                    il2.LOGTYPE = 401 AND 
                    il2.ITEMIDX > 0 AND 
                    il2.ITEMDUR > 0 AND 
                    (
                        il2.LOGIDX 
                        BETWEEN 
                        (il.LOGIDX + 1) AND (il.LOGIDX + 10)
                    ) 
                ORDER BY il2.LOGIDX ASC 
            ) QTY_VEND 
        ';
		$this->db->select($select);

        $top_gold = null;
        if(!empty($ar_search['top_gold'])){
            $top_gold = $ar_search['top_gold'];
        }
        if($top_gold == 'yes'){
            $this->db->order_by('il.CHANGEMONEY', 'DESC'); 
        }else{
            $this->db->order_by('REGDATE', 'DESC'); 
        }
        $res = $this->game_trade_log($day, $ar_search, $limit, $offset);
        return $res;
	}
    function count_game_trade_log($day=null, $ar_search=[], $limit=null, $offset=null){
		$this->db = dbloader("LUNA_LOGDB");
        $select = ' 
            count(il.LOGIDX) as count_log 
        ';
		$this->db->select($select);

        $res = $this->game_trade_log($day, $ar_search, $limit, $offset);
        return $res;
	}
    
    function game_trade_log($day=null, $ar_search=[], $limit=null, $offset=null){
        $kategori = $ar_search['kategori']; 

        $username = null;
        if(!empty($ar_search['username'])){
            $username = $ar_search['username'];
        }
        $top_gold = null;
        if(!empty($ar_search['top_gold'])){
            $top_gold = $ar_search['top_gold'];
        }
        $item_name = null;
        if(!empty($ar_search['item_name'])){
            $item_name = $ar_search['item_name'];
        }

        if($kategori == 'all'){
            $this->db->where('il.LOGTYPE IN ', '(
                1502, 
                500, 
                1, 
                200, 
                300,

                203,
                100,
                101,
                402
            )', FALSE);
        }

        if($kategori == 'iss'){
            // Item Shop Storage
            $this->db->where('il.LOGTYPE', 1502);
        }
        if($kategori == 'ti'){
            // Trade Item
            $this->db->where('il.LOGTYPE', 500);
            $this->db->where('il.CHANGEMONEY', 0);
            $this->db->where('il.ITEMIDX > ', 0);
            $this->db->where('il.ITEMDUR > ', 0);
            $this->db->where('il.ITEMFROMPOS > ', 0);
            $this->db->where('il.ITEMTOPOS > ', 0);
        }
        if($kategori == 'tg'){
            // Trade Gold
            $this->db->where('il.LOGTYPE', 500);
            $this->db->where('il.CHANGEMONEY > ', 0);
            $this->db->where('il.ITEMIDX', 0);
        }
        if($kategori == 'bi'){
            // Buy Item
            $this->db->where('il.LOGTYPE', 200);
        }
        if($kategori == 'si'){
            // Sell Item
            $this->db->where('il.LOGTYPE', 300);
        }

        if($kategori == 'di'){
            // Drop Item (Remove Item)
            $this->db->where('il.LOGTYPE', 1);
        }
        if($kategori == 'dim'){
            // Drop Item (Get Item From Monster)
            $this->db->where('il.LOGTYPE', 203);
            $this->db->where('il.ITEMIDX > ', 0);
            $this->db->where('il.ITEMDUR > ', 0);
        }
        if($kategori == 'bpu'){
            // Bank (Pick Up) mengambil
            $this->db->where('il.LOGTYPE', 101);
            $this->db->where('il.FROMCHRNAME', '#Storage');
        }
        if($kategori == 'bpi'){
            // Bank (Put In) menaruh
            $this->db->where('il.LOGTYPE', 100);
            $this->db->where('il.FROMCHRNAME', '#Storage');
        }
        if($kategori == 'bv'){
            // Buy Vending
            $this->db->where('il.LOGTYPE', 402);
            $this->db->where('il.CHANGEMONEY > ', 0);
            $this->db->where('il.ITEMIDX > ', 0);
        }

        if(!empty($username)){
            // $this->db->group_start()
            // $this->db->group_end()
            $this->db->where("
                (
                    il.FROMCHRNAME LIKE '%".$username."%' OR 
                    il.TOCHRNAME LIKE '%".$username."%'  
                )
            "); 
        }
        if(!empty($item_name)){ 
            $this->db->where("
                tli.nama LIKE '%".$item_name."%' 
            "); 
        }
        $this->db->join('temp_log_item_name as tli', 'tli.bin_source = il.ITEMIDX', 'left'); 

        $res = null;
        if(isset($limit) && isset($offset)){
            $res = $this->db->get('TB_ITEM_LOG_'.$day.' as il ', $limit, $offset);  
        }else{
            $res = $this->db->get('TB_ITEM_LOG_'.$day.' as il ');  
        } 
        if(empty($res)){
            return false;
        }
		return $res;
	}
    
    function top_donate_list($where_data=array(),$withdate=true){
		$this->db = dbloader("default");
        $select = ' 
            d.username,
            SUM(d.donate_point) as donate_point 
        ';
        if($withdate){
            $select .= ',SUM(dl.price) as total_bill ';
            $select .= ',dl.currency ';
            $select .= ',DATE(d.created_date) as created_date ';
        }
		$this->db->select($select);
        $this->db->join('donate_price_list as dl', 'd.donate_price_id = dl.id', 'inner'); 

        if(!empty($where_data)){
            foreach($where_data as $key => $val){
                $this->db->where($key, $val, FALSE);
            }
        }
        $this->db->where('d.status', "'paid'", FALSE);
        
        $this->db->group_by('d.username');
        if($withdate){
            $this->db->group_by('dl.currency');
            $this->db->group_by('DATE(d.created_date)'); 
        }
 
        $this->db->order_by('SUM(d.donate_point)','DESC'); 
        $this->db->order_by('DATE(d.created_date)','DESC'); 
        
		return $this->db->get('donate d')->result_array();
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
		return $this->db->get_where('donate_duitku d',$where)->result_array();
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

    function update_article($info,$id)
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