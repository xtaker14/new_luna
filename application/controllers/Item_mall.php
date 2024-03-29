<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';
class Item_mall extends FrontLib {

	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model("im_model");
        $this->is_login();
        $this->xepo_secure();
        $this->load->library('form_validation');
	}

    function im_list($id){
        if(!empty($id)){
            $this->load->library('shop_lib');
            
            $a = "";
            // if($id==6){
            //     // id 6 (featured) for all items
            //     $new = $this->im_model->im_list_by(8,'itemid');
            //     foreach ($new as $val) {
            //         $a .= $this->shop_lib->im_maker($val,"new");
            //     }
            //     $hot = $this->im_model->im_list_by(8,'counter');
            //     foreach ($hot as $val) {
            //         $a .= $this->shop_lib->im_maker($val,"hot");
            //     }
            // }else{
            //     $list = $this->im_model->im_byCategory($id);
            //     $get_new = $this->im_model->im_list_by(8,'itemid');
            //     $new = array_column($get_new, "itemid");
            //     $get_hot = $this->im_model->im_list_by(8,'counter');
            //     $hot = array_column($get_hot, "itemid");

            //     foreach ($list as $val) {
            //         $b = "";
            //         $id = $val['itemid'];
            //         if(in_array($id, $hot)){ $b = "hot"; }elseif(in_array($id, $new)){ $b = "new"; }
            //         $a .= $this->shop_lib->im_maker($val,$b);
            //     }
            // } 

            $list = $this->im_model->im_byCategory($id);
            $get_new = $this->im_model->im_list_by(3,'itemid',array(
                'itemtype'=>$id
            ));
            $new = array_column($get_new, "itemid");
            $get_hot = $this->im_model->im_list_by(3,'counter',array(
                'itemtype'=>$id
            ));
            $hot = array_column($get_hot, "itemid");

            foreach ($list as $val) {
                $b = "";
                $id = $val['itemid'];
                if(in_array($id, $hot)){ $b = "hot"; }elseif(in_array($id, $new)){ $b = "new"; }
                $a .= $this->shop_lib->im_maker($val,$b);
            }
            
            $arr = array('result' => $a, 'id' => $id);
            json($arr);
        }
    }

    function im_detail($im_id){
        if(!empty($im_id)){
            $im = $this->im_model->im_detail($im_id);
            $title = $im['itemname'];
            $img = CDN_IMG.$im['itemimage'];
            $desc = $im['itemdesc'];
            $effect = "";
            if(!empty($im['itemsetopt'])){
                $effect = '
                <!-- <label>Effect : </label><br> -->
                <div class="opt-box p-2">
                '.nl2br($im['itemsetopt']).'
                </div>';
            }

            $button = '<label style="color: #f1a6a6; text-shadow: 2px 2px 4px #464343;"><b>Login First To Buy!</b></label>';
            $stat = false;
            if(!empty($this->usr_session)){
                $append_btn = $this->load->view("app/_part/button_border.php",array(
                    'part_bb_txt'=> 'BUY <b>NOW</b>',
                    'part_bb_element'=> 'button',
                    'part_bb_type'=> 'submit',
                    'part_bb_style'=> 'width:100%; margin-top:10px; height: 45px; font-size: 14px;',
                    'part_bb_class'=> 'view_detail btn-buy-item btn-one btn-darker', 
                ),true);

                $button = '
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input class="form-control" type="text" name="pin" pattern="[0-9]{6}" title="number 6 digits" placeholder="PIN Code" minlength="6" maxlength="6" required>
                    </div>

                    <small style="color: #f1a6a6; text-shadow: 2px 2px 4px #464343;"><b>*6 digits number only, for buy item mall</b></small>

                </div>
                <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
                '.$append_btn;
                $stat = true;
            }

            $piece_list = $this->item_piece($im_id,$im);

            // $img = base_url('assets/frontpage/img/help.png');
            $info = array('title' => $title, 'image' => $img, 'desc' => $desc, 'effect' => $effect, 'piece_list' =>$piece_list, 'button' =>$button, 'stat' =>$stat);
            json($info);
        }
    }

    function item_piece($im_id,$im){
        $do = $this->im_model->piece_list($im_id);
        $p_list = '';

        $id = '';
        $price = '';
        $silver_price = '';

        foreach ($do as $key => $v) {
            $checked = '';
            if ($key==0) { $checked = 'checked'; }

            $id = $v['id'];
            $price = $v['price'];
            $silver_price = $v['silver_price'];
            $name = $v['name'];
            $piece_opt = '';
            if(!empty($v['piece_opt'])){
                $piece_opt = '<small class="text-success ml-2">'.$v['piece_opt'].'</small>';
            }

            $img = base_url('assets/frontpage/img/shop/box.png');
            if(!empty($v['img'])){
                $img = base_url($v['img']);
            }

            $nor_id = $id.'|0';

            $p_list .= $this->piece_html($nor_id,$name,$price,$silver_price,$img,$checked,$piece_opt);
        }

        if($im['itemtype'] == 4 && $im['isDiscount'] == 1 ){
            $dis = $this->im_model->discount_list();
            foreach ($dis as $val) {
                $p = $price * $val['qty'];
                $sp = $silver_price * $val['qty'];
                $total_price = $p - ($p * $val['value'] / 100);
                $total_silver_price = $sp - ($sp * $val['value'] / 100);
                $n = 'X'.$val['qty'].' Deal <small class="text-success ml-1">'.$val['name'].'</small>';
                $img = CDN_IMG.$val['img'];
                $dis_id = $id.'|'.$val['id'];

                $p_list .= $this->piece_html($dis_id,$n,$total_price,$total_silver_price,$img,'','');
            }
        }

        return $p_list;
    }

    function piece_html($id,$name,$price,$silver_price,$img,$checked,$piece_opt){  
        // if(empty($piece_opt)){
        //     $piece_opt = '<small style="color:silver;">-- Empty --</small>';
        // }
    //     return '
    //         <li>
    //             <label class="piece_item pointer d-block">
    //                 <table class="table">
    //                     <tr>
    //                         <td style="border-top:none; vertical-align:middle; width:50px;" rowspan="3">
    //                             <input type="radio" id="piece_radio" name="piece_item" value="'.$id.'" '.$checked.'>
    //                         </td>
    //                         <td style="border-top:none;">
    //                             <img src="'.$img.'">
    //                             <span>&nbsp;'.$name.'</span>
    //                         </td>
    //                     </tr>
    //                     <tr>
    //                         <td>
    //                             <span>Attributes : '.$piece_opt.'</span>
    //                         </td>
    //                     </tr>
    //                     <tr>
    //                         <td>
    //                             Price : <br>
    //                             <span class="text-primary ">'.$price.'<i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i></span>
    //                             <br>
    //                             <span class="">'.$silver_price.'<i class="fa fa-coins ml-1" data-fa-transform="rotate-30"></i></span>
    //                         </td>
    //                     </tr>
    //                 </table>
    //             </label>
    //         </li>
    //   ';

        // $img = base_url('assets/frontpage/img/help.png');

        $attrs = '';
        if(!empty($piece_opt)){
            $attrs = '
            <tr>
                <td style="padding-left: 0px;">
                    <div class="opt-box p-2">
                        <span>Attributes : '.$piece_opt.'</span>
                    </div>
                </td>
            </tr>';
        }

        return '
            <li>
                <label class="piece_item pointer d-block">
                    <table class="table" style="border:1px solid silver; background: #fffde8;">
                        <tr>
                            <td style="border-top:none; vertical-align:middle; width:50px;" rowspan="3">
                                <input type="radio" id="piece_radio" name="piece_item" value="'.$id.'" '.$checked.'>
                            </td>
                            <td style="padding-left: 0px; border-top:none;">
                                <img src="'.$img.'">
                                <span>&nbsp;'.$name.'</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 0px;">
                                Price : 
                                <span class="text-primary" style="font-size: 14px; color:#3c840b !important; font-family:Tahoma, sans-serif;">'.number_format($price,0, ',', '.').'<i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i></span>
                            </td>
                        </tr>
                        '.$attrs.'
                    </table>
                </label>
            </li>
        ';
    }

    function buy() {
        $check = $this->google_verify();
        if($check == true){
            $arr = array('popup' => 'failed to buy item, try again..','shop' => 'error' );
            multi_flash($arr,'shop');
            die;
        }else{
            $user_idx = $this->propid;
            $usr_code = $this->usr_code;
            $pin_code = $this->input->post('pin',true);
            $payment_type = $this->input->post('payment_type',true);
            $piece_item = $this->input->post('piece_item',true);

            // start for disable silver point
            $payment_type = 'cash_point';
            // end for disable silver point

            $this->form_validation->set_rules('pin', 'pin', 'required|numeric|min_length[6]|max_length[6]|regex_match[/^[0-9]+$/]');
            $this->form_validation->set_rules('piece_item', 'piece_item', 'trim|required');

            if ($this->form_validation->run() == false) {
                $arr = array('popup' => 'something error','shop' => 'error' );
                multi_flash($arr,'shop');
                die;
            }else{
                if(empty($user_idx) || empty($usr_code)){
                    $arr = array('popup' => 'You must login..','shop' => 'error' );
                    multi_flash($arr,'shop');
                    die;
                }else{
                    $get = $this->im_model->get_IDPoint($usr_code,$user_idx,$pin_code); 

                    $user_point = $get['star_point'];
                    $user_silver_point = $get['silver_point'];

                    if($get['status'] == false){
                        $arr = array('popup' => 'PIN incorrect or error.','shop' => 'error' );
                        multi_flash($arr,'shop');
                        die;
                    }elseif($get['status'] == true){
                        $item = explode("|", $piece_item);
                        $piece_id = intval($item[0]);
                        $dis_id = intval($item[1]);
                        $qty = 1;

                        $p_i = $this->im_model->itemid_byPiece($piece_id);

                        $price = $p_i['price'];
                        $silver_price = $p_i['silver_price'];
                        $bin_code = $p_i['bin_code'];
                        $im_type = $this->im_model->im_type($p_i['itemid']);
                        $total_price = 0;
                        $total_silver_price = 0;
                        if($im_type == 4 && $dis_id > 0){
                            $d = $this->im_model->discount_byId($dis_id);
                            $qty = $d['qty'];//change quantity from discount_tbl;

                            $total_price = $price*$qty;
                            $total_price = $total_price - ($total_price * $d['value'] / 100);

                            $total_silver_price = $silver_price*$qty;
                            $total_silver_price = $total_silver_price - ($total_silver_price * $d['value'] / 100);
                        }else{
                            $total_price = $price*$qty;
                            $total_silver_price = $silver_price*$qty;
                        }

                        $cost_item = 0;
                        $my_point = 0;

                        if($payment_type == 'cash_point'){
                            $cost_item = $total_price;
                            $my_point = $user_point;
                        }
                        elseif($payment_type == 'silver'){
                            $cost_item = $total_silver_price;
                            $my_point = $user_silver_point;
                        }else{
                            $arr = array('popup' => 'Error: undefined Payment Type.','shop' => 'error' );
                            multi_flash($arr,'shop');
                            die;
                        }

                        // if($user_point < $total_price){
                        if($my_point < $cost_item){
                            $arr = array('popup' => 'Your balance is not enough..','shop' => 'error' );
                            multi_flash($arr,'shop');
                            die;
                        }else{
                            $qty = $im_type == 4 ? $qty : 1;
                            $insert = $this->im_model->insert_item($bin_code,$user_idx,$qty); 
                            if($insert== TRUE){
                                $last_point = 0;
                                if($payment_type == 'cash_point'){
                                    $this->im_model->update_idPoint($usr_code,$user_idx,$cost_item,'star_point');
    
                                    $get = $this->im_model->get_IDPoint($usr_code,$user_idx,$pin_code);
                                    $last_point = $get['star_point'];
                                }
                                elseif($payment_type == 'silver'){
                                    $this->im_model->update_idPoint($usr_code,$user_idx,$cost_item,'silver_point');
    
                                    $get = $this->im_model->get_IDPoint($usr_code,$user_idx,$pin_code);
                                    $last_point = $get['silver_point'];
                                }else{
                                    $arr = array('popup' => 'Error: undefined Payment Type.','shop' => 'error' );
                                    multi_flash($arr,'shop');
                                    die;
                                }

                                $info = array(
                                    "itemid" => $p_i['itemid'],
                                    "resourceid" => $bin_code,
                                    // "price" => $price,
                                    "qty" => $qty,
                                    "discount_id" => $dis_id,
                                    "total_price" => $cost_item,
                                    "payment_type" => $payment_type,
                                    "user_idx" => $user_idx,
                                    "account_balance" => $my_point,
                                    "last_balance" => $last_point,
                                    "date" => date('Y-m-d H:i:s')
                                );
                                
                                //popup
                                if($payment_type == 'cash_point'){
                                    $info['price'] = $price;
                                    $this->im_model->insert_IMlog($info,'counter');
                                    $this->session->set_userdata('star_point',$last_point);
                                }
                                elseif($payment_type == 'silver'){
                                    $info['price'] = $silver_price;
                                    $this->im_model->insert_IMlog($info,'silver_counter');
                                    $this->session->set_userdata('silver_point',$last_point);
                                }else{
                                    $arr = array('popup' => 'Error: undefined Payment Type.','shop' => 'error' );
                                    multi_flash($arr,'shop');
                                    die;
                                }                       
                                $arr = array(
                                    'popup' => 'Success, check your item mall storage in game.',
                                    'shop' => 'success'
                                );
                                multi_flash($arr,'shop');
                                die;
                            }else{
                                $arr = array('popup' => 'something error','shop' => 'error' );
                                multi_flash($arr,'shop');
                                die;
                            }
                        }
                    }
                }
            }
        }
    }
}