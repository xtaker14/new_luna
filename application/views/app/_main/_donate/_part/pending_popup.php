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
                $no++;
            ?> 
                <tr style="height: 1px;">
                    <td style="vertical-align: middle;height: 100%;">
                        <label style="display: flex;align-items:center;min-height: 100%;height: auto !important;height: 100%;"> 
                            <input style="margin-right: 5px;" <?= ($no==0) ? 'checked' : ''; ?> type="radio" name="input_account_number" value="<?= $key; ?>"> <?= $key; ?>
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
            <tr>
                <td style="width: 20px; vertical-align:top; text-align:center;">
                    <span style="color:red;">*</span>
                </td>
                <td>When transferring please enter the news/description/notes as follows: <span style="color:red;">DONATE - <?= $get_donate['donate_price']; ?> Diamonds</span></td>
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