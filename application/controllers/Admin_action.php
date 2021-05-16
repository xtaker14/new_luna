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
			$p = $this->input->post('point',true);
			$cp = $this->input->post('costume_point',true);

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
					$info = array("username" => $usr,"user_idx" => $propid,"star_point" => $p,"admin_idx" => $admin_idx,"date" => date('Y-m-d H:i:s'));
					$this->im_model->insert_topup_log($info);
					setFlashData('success', 'berhasil topup');
					redirect('adm/topup_log');
				}else{
					setFlashData('error', 'terjadi error..');
					redirect('adm/topup');
				}
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
			$silver_point = toggle_to_int($this->input->post('silver_point',true)); 
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

			$this->db->where('referral_code', $referral_code);
			$this->db->or_where('user_id', $data_user['id']);
			$data_referral = $this->db->get('referral_code')->row_array();
			if(count($data_referral)>0){
				setFlashData('error', 'terjadi error, username / refferal code sudah pernah di buat..');
				redirect('adm/new_referral');
			}
			
			if(isset($id) && !empty($id)){
				$data = array(
					'is_deleted'=>$is_deleted,
					'referral_code'=>$referral_code,
					'silver_point'=>$silver_point,
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
					'silver_point'=>$silver_point,
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
					'silver_point'=>$silver_point,
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
					'silver_point'=>$silver_point,
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
			$date_type = $this->input->post('date_type',true);
			$reg_date = $this->input->post('reg_date',true);
			$bin = $this->input->post('item_source',true);
			$qty = $this->input->post('jumlah',true);

			$item = explode(" | ", $bin);
			$bin_code = $item[0];
			
			$info = array('error','something error..');
			
			$this->load->model(array('member_model','im_model'));

			if($type=='single'){
				$user_idx = $this->member_model->select_member($username);
				$this->im_model->insert_item($bin_code,$user_idx,$qty);
				$info = array('success','sukses mengirim item ke '.$username);
			}elseif($type=='all'){
				$date = '';	
				if($date_type=='range'){
					$date = explode(" to ", $reg_date);
				}

				$member_list = $this->member_model->select_aLLmember($date);
				foreach ($member_list as $val) {
					$user_idx = $val['propid'];
					$this->im_model->insert_item($bin_code,$user_idx,$qty);
				}
				$info = array('success', 'sukses mengirim item ke semua user.');
			}

			setFlashData($info[0], $info[1]);
			redirect('adm/send_item');
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

			$this->load->model('admin_model');
			$info = array('title' => $a,'content' => $b);
			$do = $this->admin_model->update_aticle($info,$c);

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