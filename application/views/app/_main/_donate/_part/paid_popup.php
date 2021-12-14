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
            $total_bill = $get_donate['total_bill']; 
            if($currency === 'USD'){
                $float_num = 2; 
            }
            $value = number_format($get_donate['donate_point'],0,',','.');
            $price = number_format($total_bill,$float_num,',','.');
            $descr = $get_donate['description'];
        ?>
        <?= $value.' Diamonds - '.$currency.' '.$price.' '.$descr; ?>
    </h4>

    <table class="table table-striped" style="margin-top: 15px;">  
        <tbody> 
            <tr>
                <td colspan="2">
                    <b>Transfer To :</b>
                </td> 
            </tr> 
            <?php if($currency === 'USD') : ?>
                <tr>
                    <td colspan="2">
                        <span class="text-success"><b><?= $account_tf['usd_payment_type']; ?></b></span>
                        
                    </td> 
                </tr>  
                <tr>
                    <td>
                        <b>Account Name</b>
                    </td>
                    <td>
                        <b>Email Account</b>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <span class="text-success"><?= $account_tf['usd_name']; ?></span>
                    </td>
                    <td>
                        <span class="text-success"><?= $account_tf['usd_account']; ?></span>
                    </td>
                </tr> 
            <?php else : ?>
                <tr>
                    <td>
                        <b>Bank Name</b>
                    </td>
                    <td>
                        <b>Code Bank</b>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <span class="text-success"><?= $account_tf['idr_payment_type']; ?></span>
                    </td>
                    <td>
                        <span class="text-success"><?= $account_tf['idr_code']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Account Name</b>
                    </td>
                    <td>
                        <b>Account Number</b>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <span class="text-success"><?= $account_tf['idr_name']; ?></span>
                    </td>
                    <td>
                        <span class="text-success"><?= $account_tf['idr_account']; ?></span>
                    </td>
                </tr> 
            <?php endif; ?>
        </tbody>
    </table>

    <table class="table table-striped" style="margin-top: 15px;">  
        
        <tbody> 
            <tr> 
                <td colspan="2">
                    <b>Transaction ID</b>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= $get_donate['id']; ?>
                </td> 
            </tr> 
            <tr>
                <td>
                    <b>Transaction Status</b>
                </td>
                <td>
                    <b>Transaction Time</b>
                </td>
            </tr>
            <tr>
                <td> 
                    <span class="text-success"><?= ucwords('paid'); ?></span>
                </td>
                <td>
                    <?= date('d M Y H:i:s', strtotime($get_donate['created_date'])); ?>
                </td>
            </tr> 

            <?php if($currency === 'USD') : ?>
                <tr>
                    <td>
                        <b>Transaction Account Name</b>
                    </td>
                    <td>
                        <b>Transaction Account Email</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="text-success"><?= $get_donate['cekmutasi_service_name']; ?></span>
                        <br>
                        <span>
                            <?= $get_donate['cekmutasi_paypal_name']; ?>
                        </span> 
                    </td>
                    <td> 
                        <span><?= $get_donate['cekmutasi_paypal_email']; ?></span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Transaction Amount</b>
                    </td>
                    <td>
                        <b>Transaction Payment Date</b>
                    </td>
                </tr>
                <tr>
                    <td> 
                        <span class="text-success"><?= $get_donate['currency'].' '.number_format($get_donate['cekmutasi_amount'],$float_num,',','.'); ?></span>
                    </td>
                    <td>
                        <?= date('d M Y H:i:s', strtotime($get_donate['cekmutasi_payment_date'])); ?>
                    </td>
                </tr> 
            <?php else : ?>
                <tr>
                    <td>
                        <b>Transaction Account Name</b>
                    </td>
                    <td>
                        <b>Transaction Account Number</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="text-success"><?= $get_donate['cekmutasi_service_name']; ?></span>
                        <br>
                        <span>
                            <?= $get_donate['cekmutasi_account_name']; ?>
                        </span> 
                    </td>
                    <td> 
                        <span><?= $get_donate['cekmutasi_account_number']; ?></span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Transaction Amount</b>
                    </td>
                    <td>
                        <b>Transaction Payment Date</b>
                    </td>
                </tr>
                <tr>
                    <td> 
                        <span class="text-success"><?= $get_donate['currency'].' '.number_format($get_donate['cekmutasi_amount'],$float_num,',','.'); ?></span>
                    </td>
                    <td>
                        <?= date('d M Y H:i:s', strtotime($get_donate['cekmutasi_payment_date'])); ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <b>Transaction Description</b>
                    </td> 
                </tr>
                <tr>
                    <td colspan="2"> 
                        <span><?= $get_donate['cekmutasi_description']; ?></span>
                    </td> 
                </tr>
            <?php endif; ?> 

            <?php if(!empty($get_donate['referral_code'])): ?> 
                <tr> 
                    <td colspan="2">
                        <b>Referral Code</b>
                    </td>
                    <td colspan="2">
                        <?= $get_donate['referral_code']; ?>
                    </td>
                </tr> 
            <?php endif; ?>
        </tbody>
    </table>
    <strong>
        <table>
            
            <tr>
                <td style="width: 20px; vertical-align:top; text-align:center;">
                    <span style="color:red;">*</span>
                </td>
                <td>Immediately complete the payment before <span style="color:orange;">23:00 (Server Time)</span> because at <span style="color:red;">24:00 (Server Time)</span> the data with the status of <span style="color:orange;">"Unpaid"</span> will be <span style="color:red;">deleted</span>.</td>
            </tr>  
            <tr>
                <td style="width: 20px; vertical-align:top; text-align:center;">
                    <span style="color:red;">*</span>
                </td>
                <td>BE CAREFUL WHEN TRANSFERRING, ONLY THE ABOVE ACCOUNT IS RESPONSIBLE</td>
            </tr> 
            <tr>
                <td style="width: 20px; vertical-align:top; text-align:center;">
                    <span style="color:red;">*</span>
                </td>
                <td>
                    Send the nominal money that matches the bill:<br>
                    <span style="color:red;">
                        <?= $get_donate['currency']; ?>
                        <?= number_format($total_bill, $float_num,',','.'); ?>
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