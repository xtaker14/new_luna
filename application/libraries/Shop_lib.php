<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class Shop_lib extends MY_Controller {
    protected $ci;

	function __construct() {
        $this->ci = &get_instance();    
	}

	public function im_maker($val,$badge){
		$this->ci->load->model("im_model");

        if(!empty($badge)){
            $badge = '<div class="featured-item featured-'.$badge.'"></div>';
        }
        $itemlist = $this->ci->im_model->piece_list($val['itemid']); 

        $ar_price = array();
        $price = '';
        $silver_price = '';
        
        foreach ($itemlist as $key => $value) {
            $price = $value['price'];
            $silver_price = $value['silver_price'];
            $ar_price[] = [
                'price'=>$price,
                'silver_price'=>$silver_price,
            ];
        }
        if($val['itemtype'] == 4 && $val['isDiscount'] == 1 ){
            $dis = $this->ci->im_model->discount_list();
            foreach ($dis as $value) {
                $p = $price * $value['qty'];
                $sp = $silver_price * $value['qty'];
                $total_price = $p - ($p * $value['value'] / 100);
                $total_silver_price = $sp - ($sp * $value['value'] / 100);
                $ar_price[] = [
                    'price'=>$total_price,
                    'silver_price'=>$total_silver_price,
                ];
            }
        }
        $price_min = min(array_column($ar_price, 'price'));
        $price_max = max(array_column($ar_price, 'price'));
        $price_min = number_format($price_min,0, ',', '.');
        $price_max = number_format($price_max,0, ',', '.');
        if(empty($price_min) && empty($price_max)){
            return '';
        }
        $price_range = $price_min;
        if($price_min != $price_max){
            // $price_range .= ' <i class="fas fa-angle-right" style="padding-top:2px;"></i> '. $price_max;
            $price_range .= ' - '. $price_max;
        }

        $silver_price_min = min(array_column($ar_price, 'silver_price'));
        $silver_price_max = max(array_column($ar_price, 'silver_price'));
        $silver_price_min = number_format($silver_price_min,0, ',', '.');
        $silver_price_max = number_format($silver_price_max,0, ',', '.');
        $silver_price_range = $silver_price_min;
        if($silver_price_min != $silver_price_max){
            $silver_price_range .= ' <i class="fas fa-angle-right" style="padding-top:2px;"></i> '. $silver_price_max;
        }

        $append_btn = $this->ci->load->view("app/_part/button_border.php",array(
            // 'part_bb_txt'=> '<b>BUY NOW</b>',
            'part_bb_txt'=> '<b>'.$price_range.'<i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i></b>',
            'part_bb_element'=> 'button',
            'part_bb_type'=> 'button',
            'part_bb_style'=> 'width:100%; margin-top:10px; height: 45px; font-size: 12px;',
            'part_bb_class'=> 'view_detail btn-buy-item btn-one btn-darker',
            'part_bb_attr_plus'=> "data-itemid=\"".$val['itemid']."\"",
        ),true);
        
        return '
            <div class="col-md-3 mb-2 p-1 im_list_item">
                <div class="im_card card border border pb-2" align="center" style="background: #fffde8;">
                    '.$badge.'
                    <div class="im_imgcover d-block">
                        <img class="card-img rounded" style="width:150px;height:auto;" src="'.CDN_IMG.$val['itemimage'].'" alt="--No Image--" >
                    </div>
                    <div class="d-block">
                        <div title="'.$val['itemname'].'" class="d-block" style="height:30px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; padding-left: 10px; padding-right: 10px;">
                            <small class="text-primary">'.$val['itemname'].'</small>
                        </div>
                        <!-- 
                        <div class="d-block">
                            <span style="font-size: 14px; color:#3c840b !important; font-family:Tahoma, sans-serif;">'.$price_range.'<i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i></span>
                        </div> 
                        -->
                        '.$append_btn.'
                    </div>
                </div> 
            </div>
        ';
    } 
}
