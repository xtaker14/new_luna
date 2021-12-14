<tbody>
    <tr> 
        <td colspan="2">
            <b>Payment</b>
        </td>
    </tr>
    <tr> 
        <td colspan="2">
            <span class="text-success"><?= ucwords('MANDIRI'); ?></span>
        </td>
    </tr>
    <tr>
        <td>
            <b>Bill Key</b>
        </td>
        <td>
            <b>Biller Code</b>
        </td>
    </tr>
    <tr>
        <td>
            <span class="text-success"><?= $midtrans_status['bill_key']; ?></span>
        </td>
        <td>
            <span class="text-success"><?= $midtrans_status['biller_code']; ?></span>
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
<?php if(!empty($midtrans_status['payment_amounts'])): ?>
    <tr>   
        <td>
            <b>Amount</b>
        </td>
        <td>
            <b>Paid At</b>
        </td>
    </tr> 
    <tr>   
        <td>
            <span class="text-warning">
            <?= $midtrans_status['currency']; ?>
            <?php if($midtrans_status['currency'] === 'USD'): ?>
                <?= number_format($midtrans_status['payment_amounts'][0]->amount, 2,',','.'); ?>
            <?php else: ?>
                <?= number_format($midtrans_status['payment_amounts'][0]->amount, 0,',','.'); ?>
            <?php endif; ?>
            </span>
        </td>
        <td>
            <span class="text-warning">
            <?= $midtrans_status['payment_amounts'][0]->paid_at; ?>
            </span>
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