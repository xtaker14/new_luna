<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/FrontLib.php';
class Json_Controller extends FrontLib {
	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model("im_model");
      $this->is_login();
	}

   function im_list($id){
   		if(!empty($id)){
   			$a = "";
   			if($id==6){

   				$new = $this->im_model->new_im(8);
   				foreach ($new as $val) {
   					$a .= $this->im_maker($val,"new");
   				}

   				$hot = $this->im_model->hot_im(8);
   				foreach ($hot as $val) {
   					$a .= $this->im_maker($val,"hot");
   				}

   			}else{

   				$list = $this->im_model->im_byCategory($id);
   				$get_new = $this->im_model->new_im(8);
   				$new = array_column($get_new, "itemid");
   				$get_hot = $this->im_model->hot_im(8);
   				$hot = array_column($get_hot, "itemid");

   				foreach ($list as $val) {
   					$b = "";
   					$id = $val['itemid'];
   					if(in_array($id, $hot)){ $b = "hot"; }elseif(in_array($id, $new)){ $b = "new"; }
   					$a .= $this->im_maker($val,$b);
   				}
   			}
   			$arr = array('result' => $a, 'id' => $id);
			json($arr);
   		}
   	}


   	function im_maker($val,$badge){

   		if(!empty($badge)){
   			$badge = '<div class="featured-item featured-'.$badge.'"></div>';
   		}
         
   		return '
            <div class="col-md-3 mb-2 p-1">
               <div class="im_card card border border pb-2" align="center">
                  '.$badge.'
                  <div class="im_imgcover d-block">
                     <img class="card-img rounded" style="width:150px;height:auto;" src="'.base_url('assets/upload/'.$val['itemimage']).'" alt="--No Image--" >
                  </div>
                  <div class="d-block">
                     <div class="d-block" style="height:50px;"><small class="text-primary">'.$val['itemname'].'</small></div>
                     <button data-itemid="'.$val['itemid'].'" class="view_detail btn-buy-item btn-hover btn color-blue w-50"><b>BUY NOW</b></button>
                  </div>
               </div>
            </div>
         ';
   	}

   function im_detail($im_id){
      if(!empty($im_id)){
         $im = $this->im_model->im_detail($im_id);
         $title = $im['itemname'];
         $img = base_url('assets/upload/'.$im['itemimage']);
         $desc = $im['itemdesc'];
         $effect = "";
         if(!empty($im['itemsetopt'])){
            $effect = '
            <!-- <label>Effect : </label><br> -->
            <div class="opt-box p-2">
            '.nl2br($im['itemsetopt']).'
            </div>';

         }
         
         $button = '<label><b>Please login to buy this item..</b></label>';

         if(!empty($this->usr_session)){
           $button = '<button type="submit" class="btn btn-sm btn-primary btn-block mt-3" ><i class="fas fa-check mr-2"></i>Buy now</button>';
         }

         $piece_list = $this->item_piece($im_id,$im);

         $info = array('title' => $title, 'image' => $img, 'desc' => $desc, 'effect' => $effect, 'piece_list' =>$piece_list, 'button' =>$button);
         json($info);
      }
   }

   function item_piece($im_id,$im){
      $do = $this->im_model->piece_list($im_id);
      $p_list = '';

      $id = '';
      $price = '';

      foreach ($do as $key => $v) {
         $checked = '';
         if ($key==0) { $checked = 'checked'; }

         $id = $v['id'];
         $price = $v['price'];
         $name = $v['name'];
         $piece_opt = '';
         if(!empty($v['piece_opt'])){
            $piece_opt = '<small class="text-success ml-2">'.$v['piece_opt'].'</small>';
         }
         $img = base_url('assets/upload/'.$v['img']);
         $nor_id = $id.'|0';

         $p_list .= $this->piece_html($nor_id,$name,$price,$img,$checked,$piece_opt);
      }

      if($im['itemtype'] == 4 && $im['isDiscount'] == 1 ){
         $dis = $this->im_model->discount_list();
         foreach ($dis as $val) {

            $p = $price * $val['qty'];
            $total_price = $p - ($p * $val['value'] / 100);
            $n = 'X'.$val['qty'].' Deal <small class="text-success ml-1">'.$val['name'].'</small>';
            $img = base_url('assets/upload/discount/'.$val['img']);
            $dis_id = $id.'|'.$val['id'];

            $p_list .= $this->piece_html($dis_id,$n,$total_price,$img,'','');
         }
      }

      return $p_list;
   }

   function piece_html($id,$name,$price,$img,$checked,$piece_opt){      
      return '
         <li>
            <label class="piece_item pointer d-block">
               <input type="radio" id="piece_radio" name="piece_item" value="'.$id.'" '.$checked.'>
               <img src="'.$img.'">
               <span>'.$name.$piece_opt.'</span>
               <small><span class="text-primary float-right p-1">'.$price.'<i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i></span></small>
            </label>
         </li>
      ';
   }
}