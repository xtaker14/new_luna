<tbody>
    <tr>
        <td>
            <b>Card Type</b>
        </td>
        <td>
            <b>Card Number</b>
        </td>
    </tr>
    <tr>
        <td>
            <span class="text-success">
                <?php 
                if(isset($midtrans_status['bank'])){
                    echo strtoupper($midtrans_status['bank']).'&nbsp;';
                }
                echo strtoupper($midtrans_status['card_type']); 
                ?>
            </span>
        </td>
        <td>
            <span class="text-success"><?= $midtrans_status['masked_card']; ?></span>
        </td>
    </tr>
    <tr> 
        <td colspan="2">
            <b>Transaction ID</b>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?= $midtrans_status['transaction_id']; ?>
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
            <?php // $midtrans_status['transaction_status']; ?>
            <span class="<?= $midtrans_renew['status_class_color']; ?>"><?= ucwords($midtrans_renew['status_text']); ?></span>
        </td>
        <td>
            <?= $midtrans_status['transaction_time']; ?>
        </td>
    </tr>
    <tr>   
        <td colspan="2">
            <b>Amount</b>
        </td> 
    </tr> 
    <tr>   
        <td colspan="2">
            <span class="text-warning">
            <?= $midtrans_status['currency']; ?>
            <?php if($midtrans_status['currency'] === 'USD'): ?>
                <?= number_format($midtrans_status['gross_amount'], 2,',','.'); ?>
            <?php else: ?>
                <?= number_format($midtrans_status['gross_amount'], 0,',','.'); ?>
            <?php endif; ?>
            </span>
        </td>
    </tr>
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