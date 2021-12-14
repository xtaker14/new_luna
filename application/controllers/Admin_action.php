<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/AdminController.php';
class Admin_action extends AdminController {
    public function __construct()
    {
		parent::__construct();
		$this->isLoggedIn();
	}

	function go_topup()
	{
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$usr = $this->input->post('username',true);
			$new_usr = $this->input->post('new_username',true);
			$p = $this->input->post('point',true);
			$cp = $this->input->post('costume_point',true);
			$descr = $this->input->post('description',true);

			if(!empty($cp)){ $p = $cp; }

			$this->load->model('member_model');
			$propid = $this->member_model->select_member($usr);

			if(empty($propid)){
				setFlashData('error', 'username not exist..');
				redirect('adm/topup');			
			}else{
				$this->load->model('im_model'); 

				$do = $this->im_model->adm_topup($usr,$p);
				if($do){
					$admin_idx = $this->userId;
					$info = array(
						"username" => $usr,
						"user_idx" => $propid,
						"star_point" => $p,
						"admin_idx" => $admin_idx,
						"date" => date('Y-m-d H:i:s'),
						"description" => $descr,
					);
					$this->im_model->insert_topup_log($info);
				}else{
					setFlashData('error', 'Gagal kirim point ke username : '.$usr);
					redirect('adm/topup');
				} 
				
				if(!empty($new_usr)){ 
					foreach ($new_usr as $idx => $val) {
						$do = $this->im_model->adm_topup($val,$p);
						if($do){
							$admin_idx = $this->userId;
							$info = array(
								"username" => $val,
								"user_idx" => $propid,
								"star_point" => $p,
								"admin_idx" => $admin_idx,
								"date" => date('Y-m-d H:i:s'),
								"description" => $descr,
							);
							$this->im_model->insert_topup_log($info);
						}else{
							setFlashData('error', 'Gagal kirim point ke username : '.$val);
							redirect('adm/topup');
						} 
					} 
				}
				setFlashData('success', 'Berhasil kirim point');
				redirect('adm/topup_log');
			}
		}
	}

	function go_make_refferal_code(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$this->load->model('admin_model');
			$this->db = dbloader("default"); 

			$id = $this->input->post('id',true); 
			$is_deleted = $this->input->post('is_deleted',true); 
			$referral_code = $this->input->post('referral_code',true); 
			$username = $this->input->post('username',true);
			// $silver_point = toggle_to_int($this->input->post('silver_point',true)); 
			$admin_id = $this->userId;

			if(isset($is_deleted)){
				$is_deleted='no';
			}else{
				$is_deleted='yes';
			}

			$data_user = $this->admin_model->getWhereUser(array(
				'username'=>$username
			))->row_array();
			if(empty($data_user)){
				setFlashData('error', 'terjadi error data user tidak ditemukan..');
				redirect('adm/new_referral');
			}

			$data_referral = array();
			if(!empty($id)){
				$data_referral = $this->db->query("
					SELECT * FROM referral_code WHERE (referral_code = '$referral_code' OR user_id = ".$data_user['id'].") AND id != $id 
				")->row_array();
				if(count($data_referral)>0){
					setFlashData('error', 'terjadi error, username / refferal code sudah pernah di buat..');
					redirect('adm/new_referral');
				}

			}else{
				$this->db->where('referral_code', $referral_code);
				$this->db->or_where('user_id', $data_user['id']);
				$data_referral = $this->db->get('referral_code')->row_array();
				if(count($data_referral)>0){
					setFlashData('error', 'terjadi error, username / refferal code sudah pernah di buat..');
					redirect('adm/new_referral');
				}
			}
			
			if(isset($id) && !empty($id)){
				$data = array(
					'is_deleted'=>$is_deleted,
					'referral_code'=>$referral_code,
					// 'silver_point'=>$silver_point,
					'admin_id'=>$admin_id,
				);

				$this->db->trans_begin();
				$this->db->update('referral_code',$data,array(
					'id'=>$id
				));
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback(); 
					setFlashData('error', 'terjadi error saat update data referral..');
					redirect('adm/new_referral');
				}

				$this->db->update('tbl_user',array(
					'referral_code'=>$referral_code,
					// 'silver_point'=>$silver_point,
				),array(
					'id'=>$data_user['id']
				));
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback(); 
					setFlashData('error', 'terjadi error saat update data user referral code..');
					redirect('adm/new_referral');
				}
			}else{
				$data = array(
					'is_deleted'=>$is_deleted,
					'referral_code'=>$referral_code,
					'user_id'=>$data_user['id'],
					'user_code'=>$data_user['code'],
					// 'silver_point'=>$silver_point,
					'silver_point'=>0,
					'admin_id'=>$admin_id,
				);
	
				$this->db->trans_begin();
				$this->db->insert('referral_code',$data);
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback(); 
					setFlashData('error', 'terjadi error saat simpan data referral..');
					redirect('adm/new_referral');
				}
	
				$this->db->update('tbl_user',array(
					'referral_code'=>$referral_code,
					// 'silver_point'=>$silver_point,
				),array(
					'id'=>$data_user['id']
				));
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback(); 
					setFlashData('error', 'terjadi error saat update data user referral code..');
					redirect('adm/new_referral');
				}
			}

			$this->db->trans_commit();
			setFlashData('success', 'berhasil insert');
			redirect('adm/referral');
		}
	}
	
	function go_make_im()
	{
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$a = $this->input->post('title',true);
			$c = $this->input->post('itemtype');
			$d = toggle_to_int($this->input->post('discount',true));
			$e = toggle_to_int($this->input->post('seal',true));				
			$f = $this->input->post('description');
			$g = toggle_to_int($this->input->post('set',true));		
			$h = $this->input->post('set_option');
			$i = toggle_to_int($this->input->post('status',true));

			$dir = "assets/frontpage/img/shop/item_mall/";
			$fn = title_to_url(strtolower($a));
			$p_img = $_FILES['userfile']['name'];
			$ext = ".".strtolower(pathinfo($p_img, PATHINFO_EXTENSION));

			$b = $dir.$fn.$ext;

			$data = array("itemname" => $a,"itemimage" => $b,"itemtype" => $c,"isDIscount" => $d,"itemseal" => $e,"itemdesc" => $f,"isSet" => $g,"itemsetopt" => $h,"status" => $i,"counter" => 0);

			$this->load->model('admin_model');
			$do = $this->admin_model->insert_im($data);

			$config = array(
				'allowed_types'     => 'jpg|jpeg|gif|png',
				'max_size'          => 2048, //2MB max
				'upload_path'       => "./".$dir,
				'file_name'         => $fn,
				'overwrite'         => TRUE,
			);
			
			$this->load->library('upload', $config);

			if($this->upload->do_upload() && $do==TRUE){
				setFlashData('success', 'berhasil insert');
				redirect('adm/im_list');
			}else{
				setFlashData('error', 'terjadi error..');
				redirect('adm/new_im');
			}
		}
	}

	function go_update_im($im_id)
	{
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$a = $this->input->post('title',true);
			$c = $this->input->post('itemtype');
			$d = toggle_to_int($this->input->post('discount',true));
			$e = toggle_to_int($this->input->post('seal',true));				
			$f = $this->input->post('description');
			$g = toggle_to_int($this->input->post('set',true));		
			$h = $this->input->post('set_option');
			$i = toggle_to_int($this->input->post('status',true));

			$dir = "assets/frontpage/img/shop/item_mall/";
			$fn = title_to_url(strtolower($a));
			$p_img = $_FILES['userfile']['name'];
			// $ext = ".".strtolower(pathinfo($p_img, PATHINFO_EXTENSION));

			$data = array(
				"itemname" => $a,
				// "itemimage" => $b,
				"itemtype" => $c,
				"isDIscount" => $d,
				"itemseal" => $e,
				"itemdesc" => $f,
				"isSet" => $g,
				"itemsetopt" => $h,
				"status" => $i,
				"counter" => 0
			);

			$item_image = 'userfile';
			$on = "im.itemtype = ic.id";
			$cat = "ic.categoryname";
			$get_im = $this->db->query(
				"SELECT im.*, $cat as category FROM itemmall im  JOIN itemcategory ic on $on where ic.is_active='yes' and itemid='$im_id' ORDER BY itemid DESC"
			)->row_array();
			if(empty($get_im)){
				setFlashData('error', 'terjadi error..');
				redirect('adm/edit_im/'.$im_id);
			} 

			$image_name = false;
			if (!empty($_FILES[$item_image]['name'])) {
				if ($this->security->xss_clean($_FILES[$item_image], TRUE) === FALSE) {
					// file failed the XSS test
					setFlashData('error', 'file failed the security XSS test!');
					redirect('adm/edit_im/'.$im_id);
				}

				$config = array(
					'allowed_types'     => 'jpg|jpeg|gif|png',
					'max_size'          => 2048, //2MB max
					'upload_path'       => "./".$dir, 
					'overwrite'         => TRUE,
					'file_name'         => $fn,
				);
				$this->load->library('upload', $config);
					
				// if (count($get_im) > 0) {
				// 	$config['file_name'] = $get_im['itemimage'];
				// } else {
				// 	$config['encrypt_name'] = TRUE;
				// }

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload($item_image)) { 
					setFlashData('error', $this->upload->display_errors());
					redirect('adm/edit_im/'.$im_id);
				} else {
					$result = $this->upload->data();
					$image_name = $result['file_name'];
					$data['itemimage'] = $dir.$image_name; 
				}
			}

			$this->db = dbloader("default"); 
			$this->db->trans_begin();
			$do = $this->db->update('itemmall',$data,array(
				'itemid'=>$im_id
			));
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				setFlashData('error', 'terjadi error..');
				redirect('adm/edit_im/'.$im_id);
			}
			$this->db->trans_commit();

			if($do==TRUE){
				setFlashData('success', 'berhasil update');
				redirect('adm/im_list');
			}else{
				setFlashData('error', 'terjadi error..');
				redirect('adm/edit_im/'.$im_id);
			}
		}
	}

	function im_status_update($id,$stat)
    {
    	if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
	    	$this->load->model('admin_model');
	    	$do = $this->admin_model->update_im_stat($id,$stat);
	        json($do);
	    }
    }

	function donate_price_status_update($id,$stat)
    {
    	if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{ 
	    	$this->db = dbloader("default"); 
			$this->db->trans_begin();
			$do = $this->db->update('donate_price_list',array(
				'is_hidden'=>$stat
			),array(
				'id'=>$id
			));
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				json(false);
			}
			$this->db->trans_commit(); 
	        json($do);
	    }
    }

	function referral_delete($id)
    {
    	if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{ 
	    	$this->db = dbloader("default"); 
			$this->db->trans_begin();

			$this->db->where('id', $id);
			$g_referral = $this->db->get('referral_code')->row_array();

			if(empty($g_referral)){
				$this->db->trans_rollback();
				json(false);
			}

			$this->db->update('tbl_user',array(
				'referral_code'=>'',
			),array(
				'id'=>$g_referral['user_id']
			));
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				json(false);
			}

			$this->db->delete('referral_code',array(
				'id'=>$id
			));  
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				json(false);
			}

			$this->db->trans_commit(); 
	        json(true);
	    }
    }
	
	function donate_price_delete($id)
    {
    	if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{ 
	    	$this->db = dbloader("default"); 
			$this->db->trans_begin();
			$do = $this->db->delete('donate_price_list',array(
				'id'=>$id
			));
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				json(false);
			}
			$this->db->trans_commit(); 
	        json($do);
	    }
    }

    function im_delete($id)
    {
    	if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
    		$this->load->model('admin_model');
	    	$do = $this->admin_model->im_delete($id);
	        json($do);
	    }
    }

    function go_make_im_piece()
	{
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$a = $this->input->post('itemid',true);
			$b = $this->input->post('item_source',true);

			$dir = "assets/frontpage/img/shop/im_piece/";
			$d = $dir."b.png";

			$c = str_cleaner($this->input->post('name',true));
			$e = $this->input->post('point',true);
			$f = $this->input->post('item_opt',true);

			if ( ! empty($_FILES['userfile'])) {


				$p_img = $_FILES['userfile']['name'];
				$ext = ".".strtolower(pathinfo($p_img, PATHINFO_EXTENSION));

				$d = $dir.$b.$ext;

				$config = array(
					'allowed_types'     => 'jpg|jpeg|gif|png',
					'max_size'          => 2048, //2MB max
					'upload_path'       => "./".$dir,
					'file_name'         => $b,
					'overwrite'         => TRUE,
				);
				
				$this->load->library('upload', $config);
				$this->upload->do_upload();
			}

			$data = array("itemid" => $a,"bin_code" => $b,"name" => $c,"img" => $d,"price" => $e,"piece_opt" => $f);

			$this->load->model('admin_model');
			$do = $this->admin_model->insert_im_piece($data);

			if($do==TRUE){
				setFlashData('success', 'berhasil insert');
				redirect('adm/im_piece_list');
			}else{
				setFlashData('error', 'terjadi error..');
				redirect('adm/im_list');
			}
		}
	}

	function go_update_im_piece($id)
	{
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$a = $this->input->post('itemid',true);
			$b = $this->input->post('item_source',true);

			$dir = "assets/frontpage/img/shop/im_piece/";

			$c = str_cleaner($this->input->post('name',true));
			$e = $this->input->post('point',true);
			$f = $this->input->post('item_opt',true); 

			$data = array(
				"itemid" => $a,
				"bin_code" => $b,
				"name" => $c,
				// "img" => $d,
				"price" => $e,
				"piece_opt" => $f
			);

			$item_image = 'userfile';
			$on = "pc.itemid = im.itemid";
			$im_name = "im.itemname";
			$get_piece = $this->db->query(
				"SELECT pc.*, $im_name as itemname FROM itemmall_piece pc JOIN itemmall im on $on where id='$id' ORDER BY id DESC"
			)->row_array();
			if(empty($get_piece)){
				setFlashData('error', 'terjadi error..');
				redirect('adm/im_piece_edit/'.$id);
			} 

			$image_name = false;
			if (!empty($_FILES[$item_image]['name'])) {
				if ($this->security->xss_clean($_FILES[$item_image], TRUE) === FALSE) {
					// file failed the XSS test
					setFlashData('error', 'file failed the security XSS test!');
					redirect('adm/im_piece_edit/'.$id);
				}

				$config = array(
					'allowed_types'     => 'jpg|jpeg|gif|png',
					'max_size'          => 2048, //2MB max
					'file_name'         => $b,
					'upload_path'       => "./".$dir,
					'overwrite'         => TRUE,
				);
				$this->load->library('upload', $config);

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload($item_image)) { 
					setFlashData('error', $this->upload->display_errors());
					redirect('adm/im_piece_edit/'.$id);
				} else {
					$result = $this->upload->data();
					$image_name = $result['file_name'];
					$data['img'] = $dir.$image_name;
				}
			}

			$this->db = dbloader("default"); 
			$this->db->trans_begin();
			$do = $this->db->update('itemmall_piece',$data,array(
				'id'=>$id
			));
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				setFlashData('error', 'terjadi error..');
				redirect('adm/im_piece_edit/'.$id);
			}
			$this->db->trans_commit();   

			if($do==TRUE){
				setFlashData('success', 'berhasil update');
				redirect('adm/im_piece_list');
			}else{
				setFlashData('error', 'terjadi error..');
				redirect('adm/im_piece_edit/'.$id);
			}
		}
	}

	function im_piece_delete($id)
    {
    	if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
	    	$this->load->model('admin_model');
	    	$do = $this->admin_model->im_piece_delete($id);
	        json($do);
	    }
    }

    function go_send_item()
    {
    	if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$type = $this->input->post('type',true);
			$username = $this->input->post('username',true);
			$new_username = $this->input->post('new_username',true);
			$admin_id = $this->userId;

			$select_level = $this->input->post('select_level',true);
			$input_lvl = $this->input->post('input_lvl',true);

			$date_type = $this->input->post('date_type',true);
			$reg_date = $this->input->post('reg_date',true);
			$bin = $this->input->post('item_source',true);
			$qty = $this->input->post('jumlah',true);
			$description = $this->input->post('description',true);

			$item = explode(" | ", $bin);
			$bin_code = $item[0];
			$item_name = $item[1];
			
			$info = array('error','terjadi error..'); 
			$this->load->model(array('member_model','im_model')); 

			$fields_sl = array(
				'admin_id' => $admin_id, 
				'send_type' => $type,
				'item_name' => $item_name,
				'item_bin_code' => $bin_code,
				'item_qty' => $qty,  
				'description' => $description,  
			); 

			if($type=='single'){
				$user_idx = $this->member_model->select_member($username);
				$this->im_model->insert_item($bin_code,$user_idx,$qty);
				$info = array('success','sukses mengirim item ke '.$username);
				$fields_sl['username'] = $username;
				$fields_sl['user_id'] = $user_idx;

				if(!empty($new_username)){
					$info_user = $username;
					$this->db = dbloader("default"); 
					$this->db->trans_begin();
					foreach ($new_username as $idx => $val) {
						$new_user_id = $this->member_model->select_member($val);
						$this->im_model->insert_item($bin_code,$new_user_id,$qty);

						$fields_sl_multi = $fields_sl;
						$fields_sl_multi['username'] = $val;
						$fields_sl_multi['user_id'] = $new_user_id; 

						$this->db->insert('send_item_log',$fields_sl_multi);
						if($this->db->trans_status() === FALSE) {
							$this->db->trans_rollback();
							setFlashData('error', 'terjadi error..');
							redirect('adm/send_item');
						}
					}
					$this->db->trans_commit();
					$info_user .= ', ' . (implode(', ',$new_username));
					$info = array('success','sukses mengirim item ke '.$info_user);
				}
			}elseif($type=='all'){
				$date = '';	
				$fields_sl['register_date_type'] = $date_type;
				if($date_type=='range'){
					$date = explode(" to ", $reg_date);
					$fields_sl['register_range_start_date'] = $date[0];
					$fields_sl['register_range_end_date'] = $date[1];
				}

				$member_list = $this->member_model->select_aLLmember($date, $select_level, $input_lvl);
				foreach ($member_list as $val) {
					$user_idx = $val['propid'];
					$this->im_model->insert_item($bin_code,$user_idx,$qty);
				}
				$info = array('success', 'sukses mengirim item ke semua user.');

				$fields_sl['level_type'] = $select_level;
				if($select_level == 'specific'){
					$fields_sl['specific_level'] = $input_lvl;
				}
			}

			$this->db = dbloader("default"); 
			$this->db->trans_begin();

			$this->db->insert('send_item_log',$fields_sl);
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				setFlashData('error', 'terjadi error..');
				redirect('adm/send_item');
			}
			$this->db->trans_commit();

			setFlashData($info[0], $info[1]);
			redirect('adm/send_item');
		}
    }

	function my_profile(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$admin_id = $this->userId; 
			
			$input_nama = $this->input->post('input_nama',true);
			$input_password = $this->input->post('input_password',true);
			$input_new_password = $this->input->post('input_new_password',true); 
    		// $input_password = getHashedPassword($input_password);
    		$input_new_password = getHashedPassword($input_new_password); 

			$user_admin = $this->db->get_where('tbl_admin',array(
				'id'=>$admin_id, 
			))->row_array(); 

			if(!verifyHashedPassword($input_password, $user_admin['password'])){
				setFlashData('error', 'Current password tidak sesuai');
				redirect('adm/my_profile');
			} 

			$data_save = array( 
				'updateBy' => $admin_id, 
				'updatedDtm' => $GLOBALS['date_now'], 
				'nama' => $input_nama, 
				'password' => $input_new_password, 
			);

			$this->db = dbloader("default"); 
			$this->db->trans_begin(); 

			$this->db->update('tbl_admin',$data_save,array(
				'id'=>$admin_id
			));
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				setFlashData('error', 'terjadi error..');
				redirect('adm/my_profile');
			} 
			$this->db->trans_commit();
			// redirect('adm/my_profile'); 	
			setFlashData('success', 'berhasil ubah password');
			redirect( 'adm/logout' );
		}
	}

	function go_update_char(){ 
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$id = $this->input->post('id',true); 
			$input_email = $this->input->post('input_email',true);
			$input_pin = $this->input->post('input_pin',true);
			$input_password = $this->input->post('input_password',true);
			$admin_id = $this->userId;

			if(empty($id)){
				setFlashData('error', 'terjadi error (1)');
				redirect('adm/char_list');
			}

			$data_save = array();
			if(!empty($input_email)){
				$check_email = $this->db->get_where('tbl_user',array(
					'email'=>$input_email, 
				));
				$check_email = $check_email->result_array();
				if(count($check_email)>0){
					setFlashData('error', 'Email already exists');
					redirect('adm/char/'.$id);
				}

				$data_save['email'] = $input_email;
			}
			if(!empty($input_pin)){
				$data_save['pin_code'] = getHashedPassword($input_pin);
			}
			if(!empty($input_password)){
				$data_save['password'] = getHashedPassword($input_password);
			}

			$get_tbl_user = array(); 
			$get_tbl_user = $this->db->get_where('tbl_user',array(
				'id'=>$id
			))->row_array();
			if(empty($get_tbl_user)){
				setFlashData('error', 'User tidak ditemukan..');
				redirect('adm/char/'.$id);
			} 

			$this->db = dbloader("default"); 
			$this->db->trans_begin();
 
			$data_save['modified_date'] = $GLOBALS['date_now']; 
			$this->db->update('tbl_user',$data_save,array(
				'id'=>$id
			));
			if($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				setFlashData('error', 'terjadi error (2)');
				redirect('adm/char/'.$id); 
			}
			$this->db->trans_commit();
			
			if(empty($input_pin)){
				$this->db = dbloader("LUNA_MEMBERDB");
				$data_save = array();
				if(!empty($input_email)){
					$data_save['id_email'] = $input_email;
				} 
				if(!empty($input_password)){
					$data_save['id_passwd'] = $input_password;
				}
				$this->db->trans_begin(); 
				$this->db->update('chr_log_info',$data_save,array(
					'propid'=>$id
				)); 
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					setFlashData('error', 'terjadi error (3)');
					redirect('adm/char/'.$id); 
				}  
				$this->db->trans_commit(); 
			}

			if(!empty($input_email)){
				setFlashData('success', 'Berhasil Update Email');
			}
			if(!empty($input_pin)){
				setFlashData('success', 'Berhasil Update PIN');
			}
			if(!empty($input_password)){
				setFlashData('success', 'Berhasil Update Password');
			}
			redirect('adm/char/'.$id); 
		}
	}

	function go_make_media(){ 
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$id = $this->input->post('id',true); 
			$input_title = $this->input->post('input_title',true);
			$input_type = $this->input->post('input_type',true);
			$input_order = $this->input->post('input_order',true);
			$is_hidden = $this->input->post('is_hidden',true);  
			$item_image = 'input_image';  
			$admin_id = $this->userId;
			if(isset($is_hidden)){
				$is_hidden='yes';
			}else{
				$is_hidden='no';
			}
			$upload_path = "assets/frontpage/img/media";

			$data_save = array(
				'admin_id' => $admin_id, 
				'name' => $input_title,
				'type' => $input_type, 
				'no_order' => $input_order, 
				'is_hidden' => $is_hidden,
			);

			$get_media = array();
			if(isset($id) && !empty($id)){
				$get_media = $this->db->get_where('media',array(
					'id'=>$id
				))->row_array();
				if(empty($get_media)){
					setFlashData('error', 'Media tidak ditemukan..');
					redirect('adm/media');
				}
			}

			$image_name = false;
			if (!empty($_FILES[$item_image]['name'])) {
				if ($this->security->xss_clean($_FILES[$item_image], TRUE) === FALSE) {
					// file failed the XSS test
					setFlashData('error', 'file failed the security XSS test!');
					redirect('adm/new_media');
				}
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'gif|jpg|png'; 
					
				if (count($get_media) > 0) {
					$config['overwrite'] = TRUE;
					$config['file_name'] = $get_media['img'];
				} else {
					$config['encrypt_name'] = TRUE;
				}

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload($item_image)) { 
					setFlashData('error', $this->upload->display_errors());
					redirect('adm/new_media');
				} else {
					$result = $this->upload->data();
					$image_name = $result['file_name'];
					$data_save['img'] = $image_name;
				}
			}

			$this->db = dbloader("default"); 
			$this->db->trans_begin();

			if(isset($id) && !empty($id)){
				$data_save['modified_date'] = $GLOBALS['date_now'];

				$this->db->update('media',$data_save,array(
					'id'=>$id
				));
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					setFlashData('error', 'terjadi error..');
					redirect('adm/new_media');
				}
			}else{ 
				$data_save['created_date'] = $GLOBALS['date_now'];

				$this->db->insert('media',$data_save);
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					setFlashData('error', 'terjadi error..');
					redirect('adm/new_media');
				}
			}
			$this->db->trans_commit();
			setFlashData('success', 'berhasil insert');
			redirect('adm/media');
		}
	}

	function save_checkin_item(){ 
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{  
			$id = $this->input->post('input_id',true);
			$input_name = $this->input->post('input_name',true);
			$input_is_active = $this->input->post('input_is_active',true);
			$input_bin_code = $this->input->post('input_bin_code',true);
			$input_qty = $this->input->post('input_qty',true);
			$input_checkin_day = $this->input->post('input_checkin_day',true);
			$input_description = $this->input->post('input_description',true);
			$item_image = 'input_img';
			if(isset($input_is_active)){
				$input_is_active='yes';
			}else{
				$input_is_active='no';
			}
			$upload_path = "assets/frontpage/img/daily_checkin/items";

			$data_save = array( 
				'name' => $input_name,
				'is_active' => $input_is_active,
				'bin_code' => $input_bin_code,
				'qty' => $input_qty,
				'checkin_day' => $input_checkin_day,
				'description' => $input_description,
			);

			$get_checkin = array();
			if(isset($id) && !empty($id)){
				$get_checkin = $this->db->get_where('daily_checkin_item',array(
					'id'=>$id
				))->row_array();
				if(empty($get_checkin)){
					setFlashData('error', 'Daily Checkin Item is not found');
					redirect('adm/checkin_item/'.$id);
				}
			}

			$image_name = false;
			if (!empty($_FILES[$item_image]['name'])) {
				if ($this->security->xss_clean($_FILES[$item_image], TRUE) === FALSE) {
					// file failed the XSS test
					setFlashData('error', 'file failed the security XSS test!');
					redirect('adm/new_media');
				}
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'gif|jpg|png'; 
					
				if (count($get_checkin) > 0) {
					$config['overwrite'] = TRUE;
					$config['file_name'] = $get_checkin['img'];
				} else {
					$config['encrypt_name'] = TRUE;
				}

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload($item_image)) { 
					setFlashData('error', $this->upload->display_errors());
					if (count($get_checkin) > 0) {
						redirect('adm/checkin_item/'.$id);
					} else {
						redirect('adm/checkin_item');
					}
				} else {
					$result = $this->upload->data();
					$image_name = $result['file_name'];
					$data_save['img'] = $image_name;
				}
			}

			$this->db = dbloader("default"); 
			$this->db->trans_begin();

			if(isset($id) && !empty($id)){
				$data_save['modified_date'] = $GLOBALS['date_now'];

				$this->db->update('daily_checkin_item',$data_save,array(
					'id'=>$id
				));
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					setFlashData('error', 'terjadi error..');
					redirect('adm/checkin_item/'.$id);
				}
			}else{ 
				$data_save['created_date'] = $GLOBALS['date_now'];

				$this->db->insert('daily_checkin_item',$data_save);
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					setFlashData('error', 'terjadi error..');
					redirect('adm/checkin_item');
				}
			}
			$this->db->trans_commit();
			setFlashData('success', 'berhasil save');
			if (count($get_checkin) > 0) {
				redirect('adm/checkin_item/'.$id);
			} else {
				redirect('adm/checkin_item');
			}
		}
	}
	function checkin_item_status_update($id,$stat)
	{
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{ 
			$do = $this->db->update('daily_checkin_item',array(
				'is_active'=>$stat
			),array(
				'id'=>$id
			));
			json($do);
		}
	}

	function checkin_item_delete($id)
	{
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{ 
			$do = $this->db->delete('daily_checkin_item',array(
				'id'=>$id
			));
			json($do);
		}
	}

	function web_config(){ 
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$input_logo_img = 'input_logo_img';
			$input_favico_img = 'input_favico_img';
			$data_save = array();
			
			$upload_path = "assets/frontpage/img/web_config";
			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0755, TRUE);
			}
			
			$get_configweb = $this->getConfigWeb(); 
			if(empty($get_configweb)){
				setFlashData('error_webconfig', 'Web Config tidak ditemukan..');
				redirect('adm/web_config');
			} 

			if (!empty($_FILES[$input_logo_img]['name'])) {
				if ($this->security->xss_clean($_FILES[$input_logo_img], TRUE) === FALSE) {
					// file failed the XSS test
					setFlashData('error_webconfig', 'file failed the security XSS test!');
					redirect('adm/web_config');
				}
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'gif|jpg|png'; 
					
				if (!empty($get_configweb['logo_img'])) {
					unlink($upload_path.'/'.$get_configweb['logo_img']);
				    $config['file_name'] = $get_configweb['logo_img'];
				} else {
				    $config['encrypt_name'] = TRUE;
				}

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload($input_logo_img)) {
					setFlashData('error_webconfig', $this->upload->display_errors());
					redirect('adm/web_config');
				} else {
					$result = $this->upload->data();
					$data_save['logo_img'] = $result['file_name'];
				}
			}

			if (!empty($_FILES[$input_favico_img]['name'])) {
				if ($this->security->xss_clean($_FILES[$input_favico_img], TRUE) === FALSE) {
					// file failed the XSS test
					setFlashData('error_webconfig', 'file failed the security XSS test!');
					redirect('adm/web_config');
				}
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'gif|jpg|png|ico'; 
					
				if (!empty($get_configweb['favico_img'])) {
					unlink($upload_path.'/'.$get_configweb['favico_img']);
				    $config['file_name'] = $get_configweb['favico_img'];
				} else {
				    $config['encrypt_name'] = TRUE;
				}

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload($input_favico_img)) {
					setFlashData('error_webconfig', $this->upload->display_errors());
					redirect('adm/web_config');
				} else {
					$result = $this->upload->data();
					$data_save['favico_img'] = $result['file_name'];
				}
			}

			$this->db = dbloader("default"); 
			$this->db->trans_begin();
		
			// $data_save['modified_date'] = $GLOBALS['date_now'];
			if(!empty($data_save)){
				$this->db->update('web_config',$data_save,array(
					'id'=>$this->id_config_web
				));
				if($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					setFlashData('error_webconfig', 'terjadi error..');
					redirect('adm/web_config');
				}
				
				$this->db->trans_commit();
			}
			setFlashData('success_webconfig', true);
			redirect('adm/web_config');
		}
	}

	function go_make_article(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$a = $this->input->post('title',true);
			$b = $this->input->post('category',true);
			$c = $this->input->post('url_article',true);
			$d = $this->input->post('content');
			$d = str_replace('<p>', '<p align="justify">', $d);
			$f = date('Y-m-d');
			$dir = "assets/frontpage/img/notice/";
			$e = $dir."noimage.jpg";

			if ( ! empty($_FILES['userfile'])) {

				$p_img = $_FILES['userfile']['name'];
				$ext = ".".strtolower(pathinfo($p_img, PATHINFO_EXTENSION));

				$e = $dir.$c.$ext;

				$config = array(
					'allowed_types'     => 'jpg|jpeg|gif|png',
					'max_size'          => 2048, //2MB max
					'upload_path'       => "./".$dir,
					'file_name'         => $c,
					'overwrite'         => TRUE,
				);
				
				$this->load->library('upload', $config);
				$this->upload->do_upload();
			}
			if(empty($c)){
				$c = NULL;
			}
			$this->load->model('admin_model');
			$data = array('title' => $a, 'category' => $b, 'url' => $c, 'content' => $d, 'img' => $e, 'date' => $f);
			$do = $this->admin_model->insert_article($data);

			if($do){
				setFlashData('success', 'berhasil insert');
				redirect('adm/article_list');
			}else{
				setFlashData('error', 'terjadi error..');
				redirect('adm/dashboard');
			}
		}
	}

    function article_delete($id)
    {
    	if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
	    	$this->load->model('admin_model');
	    	$do = $this->admin_model->article_delete($id);
	        json($do);
	    }
    }

    function go_edit_article(){
    	if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{

			$a = $this->input->post('title',true);
			$b = $this->input->post('content');
			$b = str_replace('<p>', '<p align="justify">', $b);
			$c = $this->input->post('article_id',true);

			$dir = "assets/frontpage/img/notice/";
			$e = $dir."noimage.jpg";

			if ( ! empty($_FILES['userfile'])) {

				$p_img = $_FILES['userfile']['name'];
				$ext = ".".strtolower(pathinfo($p_img, PATHINFO_EXTENSION));

				$e = $dir.$c.$ext;

				$config = array(
					'allowed_types'     => 'jpg|jpeg|gif|png',
					'max_size'          => 2048, //2MB max
					'upload_path'       => "./".$dir,
					'file_name'         => $c,
					'overwrite'         => TRUE,
				);
				
				$this->load->library('upload', $config);
				$this->upload->do_upload();
			}

			$this->load->model('admin_model');
			$info = array('title' => $a,'content' => $b, 'img' => $e);
			
			$do = $this->admin_model->update_article($info,$c);

			if($do==true){
				setFlashData('success', 'berhasil update');
				redirect('adm/article_list');
			}else{
				setFlashData('error', 'terjadi error..');
				redirect('adm/article_list');
			}
		}
	}

    function go_add_account(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			$this->json(array('null'));
		}else{
			$this->load->model('admin_login_model');
			$info['nama'] = $this->input->post('name', TRUE);
			$info['email'] = $this->input->post('email', TRUE);
			$info['whatsapp'] = $this->input->post('whatsapp', TRUE);
			$info['password'] = getHashedPassword($this->input->post('password', TRUE));
			$info['createdBy'] = $this->session->userdata ( 'role' );
			$info['createdDtm'] = date('Y-m-d-H-i-s');

			$jabatan_id = $this->input->post('jabatan', TRUE);
			$data = preg_split('/,/', $jabatan_id);
			$info['roleId'] = $data[0];
			$info['jabatan'] = $data[1];

		  $check = $this->admin_login_model->checkEmailExist($info['email']);

		  if($check==true){
		  	    setFlashData('error', 'email sudah ada..');
	        	redirect('adm/account_list');
		  }else{
		  	  $do = $this->db->insert('tbl_admin', $info);
		      if($do){
		        	setFlashData('success', 'Seccess menambah account..');
		        	redirect('adm/account_list');
		      }else{
		      		setFlashData('error', 'terjadi error..');
		        	redirect('adm/account_list');
		      }

		  }
	  }
	}

	function go_edit_account(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			redirect('notfound');
		}else{
			$info['nama'] = $this->input->post('edit_nama', TRUE);
			$info['email'] = $this->input->post('edit_email', TRUE);
			$info['whatsapp'] = $this->input->post('edit_whatsapp', TRUE);
			
			$jabatan_id = $this->input->post('edit_jabatan', TRUE);
			$data = preg_split('/,/', $jabatan_id);
			$info['roleId'] = $data[0];
			$info['jabatan'] = $data[1];

			$new_password = $this->input->post('new_password', TRUE);

			if(!empty($new_password)){
				$info['password'] = getHashedPassword($new_password);
			}

            $this->db->where('email',$info['email']);
			$do = $this->db->update('tbl_admin', $info);
			if($do){
				setFlashData('success', 'berhasil update account');
				redirect('adm/account_list');
			}else{
				setFlashData('error', 'terjadi error..');
				redirect('adm/account_list');
			}
  		}
	}

	function go_del_account($a){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
			json(false);
		}else{
			$this->load->model('admin_model');
			if(empty($a)){
				json(false);
			}else{
				$do = $this->admin_model->del_web_admin($a);
				json($do);		
			}
  		}
	}


	function reg_game_member(){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            setFlashData('error', 'Please logout for register..');
            redirect(base_url('adm/g_account_list'));
		}else{
	        $this->load->model(array('admin_model', 'member_model'));	
    		$id_email = strtolower($this->input->post('id_email',true));
    		$id_loginid = $this->input->post('user_id',true);
    		$pin_code = $this->input->post('pin',true);
    		$id_passwd = $this->input->post('password',true);
    		$c_password = $this->input->post('c_password',true);
    		$user_level = $this->input->post('vy_rank!',true);

    		$this->load->library('form_validation');
            
            $this->form_validation->set_rules('id_email', 'id_email', 'required|valid_email|max_length[50]|trim');
            $this->form_validation->set_rules('user_id', 'user_id', 'required|min_length[4]|max_length[16]');
            $this->form_validation->set_rules('pin', 'pin', 'required|numeric|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[16]');
            $this->form_validation->set_rules('c_password', 'Password Confirmation', 'required|matches[password]');
            if($this->form_validation->run() == FALSE)
            {
            	setFlashData('error', 'Failed to registry, please make sure your information is valid.');
                redirect(base_url('adm/g_account_list'));
            }
            else
            {
                $test = $this->member_model->select_idx($id_loginid);
                if(!empty($test)){                    
                    setFlashData('error', 'Username is not avaliable..');
                    redirect(base_url('adm/g_account_list'));
                }else{
                    $this->load->helper('string');
                    $data = array($id_loginid, $id_email, $id_passwd, $pin_code,$user_level);
        			$do = $this->admin_model->insert_WebMember($data);
        			if($do==true){
        				setFlashData('success', 'You have successfully register..');
        				redirect(base_url('adm/g_account_list'));
        			}else{
                        setFlashData('error', 'Something error..');
        				redirect(base_url('adm/g_account_list'));
        			}
                }
    		}
    	}
	}

	function del_game_member($a,$b){
		if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            setFlashData('error', 'Something error..');
		}else{
			$this->load->model('member_model');
			if(empty($a) || empty($b)){
                setFlashData('error', 'Something error..');
			}else{
				$do = $this->member_model->del_member($a,$b);
				setFlashData('success', 'You have successfully delete..');
			}
  		}
	}

	function go_add_source(){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            $this->json(array('null'));
        }else{
            $a = $this->input->post('source');
            //$a = file_get_contents("assets/admin/i_source.txt");
            $b = explode("\r\n", $a);

            foreach ($b as $key => $val) {
                $d = explode("\t", $val);
                $k = $d[0];
                $t = str_replace('^s', ' ', $d[1]);
                $data = array('bin_source' => $k,'nama' => $t);
                $this->insert_recent_search($data);
            }
			setFlashData('success', 'sukses add cource..');
			redirect('adm/add_source');
        }
    }

    function insert_recent_search($data){
        if($this->checker(ROLE_DEVELOPER,DEV)==FALSE){
            $this->json(array('null'));
        }else{
            $this->db->trans_start();
            $insert_query = $this->db->insert_string('tbl_item', $data);
            $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
            $this->db->query($insert_query);
            $this->db->trans_complete();
        }
    }
}