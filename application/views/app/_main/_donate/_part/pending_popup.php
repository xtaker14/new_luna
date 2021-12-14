<div class="modal-header">
    <?php $this->load->view("app/_part/header_title.php",array(
        'part_ht_txt_large'=> 'Donate <i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i>',
        'part_ht_txt_small'=> '',
        // 'part_ht_left_i'=> 'far fa-images ml-2',
        // 'part_ht_right_i'=> 'far fa-images ml-2',
        // 'part_ht_style_i'=> 'font-size:25px;',
        'part_ht_style_txt_large'=> 'font-size:24px;',
    )); ?>
</div>
<div class="modal-body"> 
    <h4 class="text-success">
        <?php 
            $currency = $get_donate['currency'];
            $float_num = 0;
            if($currency === 'USD'){
                $float_num = 2;
            }
            $value = number_format($get_donate['donate_point'],0,',','.');
            $price = number_format($get_donate['midtrans_gross_amount'],$float_num,',','.');
            $descr = $get_donate['description'];

            $midtrans_renew['donate_title'] = $value.' Diamonds - '.$currency.' '.$price.' '.$descr;
            $midtrans_renew['status_text'] = 'pending';
            $midtrans_renew['status_class_color'] = 'text-warning';
        ?>
        <?= $value.' Diamonds - '.$currency.' '.$price.' '.$descr; ?>
    </h4>
    <table class="table table-striped" style="margin-top: 15px;">  
        
        <?php if($midtrans_status['payment_type'] == 'qris'): ?> 
	        <?php $this->load->view("app/_main/_donate/_part/_include/shopee.php", array('midtrans_renew'=>$midtrans_renew)) ?> 
        <?php endif; ?>
        
        <?php if($midtrans_status['payment_type'] == 'gopay'): ?> 
	        <?php $this->load->view("app/_main/_donate/_part/_include/gopay.php", array('midtrans_renew'=>$midtrans_renew)) ?> 
        <?php endif; ?>
        
        <?php if($midtrans_status['payment_type'] == 'bank_transfer'): ?> 
	        <?php $this->load->view("app/_main/_donate/_part/_include/bank_transfer.php", array('midtrans_renew'=>$midtrans_renew)) ?> 
        <?php endif; ?>
        
        <?php if($midtrans_status['payment_type'] == 'echannel'): ?> 
	        <?php $this->load->view("app/_main/_donate/_part/_include/echannel.php", array('midtrans_renew'=>$midtrans_renew)) ?> 
        <?php endif; ?>

        <?php if($midtrans_status['payment_type'] == 'credit_card'): ?>  
	        <?php $this->load->view("app/_main/_donate/_part/_include/credit_card.php", array('midtrans_renew'=>$midtrans_renew)) ?>
        <?php endif; ?>
    </table>
    <strong>
        <table>
            <tr>
                <td style="width: 20px; vertical-align:top; text-align:center;">
                    <span style="color:red;">*</span>
                </td>
                <td>BE CAREFUL WHEN TRANSFERING, ONLY THE ABOVE ACCOUNT IS RESPONSIBLE</td>
            </tr> 
            <tr>
                <td style="width: 20px; vertical-align:top; text-align:center;">
                    <span style="color:red;">*</span>
                </td>
                <td>
                    Send the nominal money that matches the bill:<br>
                    <span style="color:red;">
                        <?= $get_donate['currency']; ?>
                        <?php if($get_donate['currency'] === 'USD'): ?>
                            <?= number_format($get_donate['bill'], 2,',','.'); ?>
                        <?php else: ?>
                            <?= number_format($get_donate['bill'], 0,',','.'); ?>
                        <?php endif; ?>
                    </span>
                </td>
            </tr>
            <tr class="popup_res_desc_tf">
                <td style="width: 20px; vertical-align:top; text-align:center;">
                    <span style="color:red;">*</span>
                </td>
                <td></td>
            </tr>
        </table>
    </strong>
</div>
<div class="modal-footer">
    <input type="hidden" name="donate_id" value="<?= $get_donate['id']; ?>">
    <input type="hidden" name="<?=$xepo_name;?>" value="<?=$xepo_value;?>" />
 
    <?php $this->load->view("app/_part/button_border.php",array(
        'part_bb_txt'=> '<i class="fas fa-times"></i>&nbsp;CLOSE',
        'part_bb_element'=> 'button',
        'part_bb_type'=> 'button',
        'part_bb_attr_plus'=> 'data-dismiss="modal"',
        'part_bb_class'=>'btn-hover color-red', 
        'part_bb_style'=> 'width:50%; font-size:1rem; letter-spacing:2px;margin-bottom:0px;',
    )); ?> 
</div>
<style>
    .popup_res_desc_tf{
        display: none;
    }
    .popup_res_desc_tf td:first-child{
        border-left: 1px solid #bab9bb;
        border-bottom: 1px solid #bab9bb;
    }
    .popup_res_desc_tf td:last-child{
        border-right: 1px solid #bab9bb;
        border-bottom: 1px solid #bab9bb;
    }
</style>
<script>
    $(document).ready(function(){
        $("input.popup_input_account_number").click(function(){
            let t = $(this);
            let type = t.data('type');
            if(t.is(':checked')){  
            }
        }); 
    });
</script>