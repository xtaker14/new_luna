<?php 
$recheck_date = date('d M Y',strtotime($get_donate['recheck_date']));
$recheck_again_date = date('d M Y',strtotime($get_donate['recheck_again_date']));
$date_now = date('d M Y');
$color_recheck = 'green';
$color_recheck_again = 'red';
if($date_now == $recheck_again_date){
    $color_recheck_again = 'green';
}
?>
<div class="modal-header">
    <div class="box_header_title" style="width: 100%;">
        <span></span>
        <span></span> 
        <div class="content_header_title">
            <h2><i class="fas fa-question-circle"></i>&nbsp;Paid To Complete</h2> 
        </div>
    </div>
</div>
<div class="modal-body">
    Transfers from you are being checked by our staff, <br>
    Please check your destination account number, is it correct? <br>
    If it is correct and it is still not processed by our staff, you can check it by pressing the Recheck button below

    <table class="table table-striped" style="margin-top: 15px;">
        <tbody>
            <?php 
            $no=-1;
            foreach($account_number as $key => $val): 
                $no++;
            ?> 
                <tr style="height: 1px;">
                    <td style="vertical-align: middle;height: 100%;">
                        <label style="display: flex;align-items:center;min-height: 100%;height: auto !important;height: 100%;"> 
                            <?= $key; ?>
                        </label>
                    </td>
                    <td>
                        No. & Owner Name<br>
                        <?= $val['no_owner_name']; ?><br>
                        Bank Code : <?= $val['bank_code']; ?>
                    </td>
                </tr> 
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <div>
        <?php if(empty($get_donate['recheck_date'])): ?>
            <div style="color:green; text-align:center;margin-top:10px;">-- Never submitted a recheck --</div>
        <?php else: ?>
            <div style="text-align:center;margin-top:10px;">Wait until the date below to recheck again:</div>
            <h3 style="color:<?= $color_recheck_again; ?>; text-align:center;">
                <i class="far fa-clock"></i>
                <?= $recheck_again_date; ?> 
            </h3>
            <div style="text-align:center;margin-top:10px;">Last recheck request:</div>
            <h3 style="color:green; text-align:center;">
                <i class="fas fa-history"></i>
                <?= $recheck_date; ?> 
            </h3>
        <?php endif; ?>
    </div>
</div>
<div class="modal-footer">
    <input type="hidden" name="donate_id" value="<?= $get_donate['id']; ?>">
    <input type="hidden" name="<?=$xepo_name;?>" value="<?=$xepo_value;?>" />

    <button class="btn btn-block btn-hover btn color-red" data-dismiss="modal">No Thanks</button>
    <button <?= ($date_now !== $recheck_again_date && !empty($get_donate['recheck_date'])) ? 'disabled style="margin-top:0; cursor:not-allowed;"' : 'style="margin-top:0;"'; ?> class="btn btn-block btn-hover btn color-blue" type="submit">Recheck</button>
</div>