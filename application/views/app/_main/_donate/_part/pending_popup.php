<div class="modal-header">
    <div class="box_header_title" style="width: 100%;">
        <span></span>
        <span></span> 
        <div class="content_header_title">
            <h2><i class="fas fa-question-circle"></i>&nbsp;Pending To Paid</h2> 
        </div>
    </div>
</div>
<div class="modal-body">
    If you have transferred to the account listed below, <br>
    Please change your status to Paid by clicking the Paid Button <br>

    <table class="table table-striped" style="margin-top: 15px;">
        <tbody>
            <?php 
            $no=-1;
            foreach($account_number as $key => $val):
            ?>
                <?php if($key == 'BANK_TRANSFER'): ?>
                    <?php foreach($val as $key2 => $val2): $no++; ?>
                        <tr style="height: 1px;">
                            <td style="vertical-align: middle;height: 100%;">
                                <label style="display: flex;align-items:center;min-height: 100%;height: auto !important;height: 100%;"> 
                                    <input style="margin-right: 5px;" <?= ($no==0) ? 'checked' : ''; ?> type="radio" data-type="<?= $key; ?>" class="popup_input_account_number" name="input_account_number" value="<?= $key.'|'.$key2; ?>"> <?= $key2; ?>
                                </label>
                            </td>
                            <td>
                                No. & Owner Name<br>
                                <?= $val2['no_owner_name']; ?><br>
                                Bank Code : <?= $val2['bank_code']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php elseif($key == 'DANA'): ?>
                    <?php foreach($val as $key2 => $val2): $no++; ?>
                        <tr style="height: 1px;">
                            <td style="vertical-align: middle;height: 100%;">
                                <label style="display: flex;align-items:center;min-height: 100%;height: auto !important;height: 100%;"> 
                                    <input style="margin-right: 5px;" <?= ($no==0) ? 'checked' : ''; ?> type="radio" data-type="<?= $key; ?>" class="popup_input_account_number" name="input_account_number" value="<?= $key.'|'.$key2; ?>"> <?= $key; ?>
                                </label>
                            </td>
                            <td>
                                No. <?= $key2; ?><br>
                                Acc Name. <?= $val2; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?> 
            <?php endforeach; ?>
        </tbody>
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
                <td>Send the nominal money that matches the bill:<br><span style="color:red;"><?= $get_donate['currency'].' '.number_format($get_donate['bill'],0,',','.'); ?></span></td>
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

    <button class="btn btn-block btn-hover btn color-red" data-dismiss="modal">Not Yet</button>
    <button class="btn btn-block btn-hover btn color-blue" type="submit" style="margin-top:0;">Paid</button>
</div>
<style>
    .popup_res_desc_tf{
        display: none;
    }
</style>
<script>
    $(document).ready(function(){
        $("input.popup_input_account_number").click(function(){
            let t = $(this);
            let type = t.data('type');
            if(t.is(':checked')){
                if(type == 'BANK_TRANSFER'){
                    $('.popup_res_desc_tf').css({
                        'display':'contents'
                    });
                    $('.popup_res_desc_tf td').eq(1).html(`
                        When transferring please enter the news/description/notes as follows: <span style="color:red;">DONATE - <?= $get_donate['donate_price']; ?> Diamonds</span>
                    `);
                }else{
                    $('.popup_res_desc_tf').hide();
                    $('.popup_res_desc_tf td').eq(1).html('');
                } 
            }
        });
        $.each($("input.popup_input_account_number"), function(idx,key){
            if($(this).is(':checked')){
                $(this).click();
            }
        });
    });
</script>