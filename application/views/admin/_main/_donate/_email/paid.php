<div style="max-width:600px;display:block;
		border-collapse:collapse;
		margin:0 auto;border:1px solid #e7e7e7;
		font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;">
	<table style="max-width:100%;border-spacing:0;
		width:100%;background-color:transparent;
		margin:0;padding:20px;" bgcolor="transparent">
		<tbody>
			<tr style="margin:0;padding:0">
				<td>
					<a href="#" style="color:#0e8ce4;line-height: 21px;text-decoration: none;">
		                <span style="">
		                  Luna &#8729;
		                </span><br>
		                <span style="font-size: 25px;">
		                  Zone
		                </span> 
		            </a>
				</td>
			</tr>
			<tr>
				<td style="text-align:center">
					<img src="https://i.ibb.co/z4d7KjN/email-person.png">
				</td>
			</tr>
			<tr style="margin:0;padding:0">
                <td style="margin:0;padding:0" colspan="2">
                    <h5 style="line-height:32px;color:#666;
					font-weight:900;font-size:24px;
					margin:0 0 16px;
					padding:0;">
						Pembayaran Donate telah di kirim
					</h5>
                    <p style="font-weight:500;color:#666;
					font-size:14px;line-height:1.6;
					margin:0;padding:0;"> 
                        Silahkan Admin/Staff check uang yang di claim sudah di transfer oleh user 
                    </p>
                </td>
            </tr>
		</tbody>
	</table>

	<table style="width:100%;margin-bottom:24px;
		padding:0 20px;">
		<thead>
			<tr>
				<td style="width:40%">
                    <span style="font-size:12px;color:#999;font-weight:normal;
					word-break:break-word;">Total Pembayaran</span>
				</td>
				<td style="width:30%">
                    <span style="font-size:12px;color:#999;font-weight:normal;
					word-break:break-word;">Status</span>
				</td>
				<td style="width:30%">
                    <span style="font-size:12px;color:#999;font-weight:normal;word-break:break-word;">Metode Pembayaran</span>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<span style="font-size:24px;color:#666;font-weight:600;
					word-break:break-word;">
						<?= $get_donate['currency'].' '.number_format($get_donate['bill'],0,',','.'); ?>  
					</span>
				</td>
				<td style="vertical-align:top">
                    <span style="font-size:16px;color:#666;
					word-break:break-word; ">
                    	<?= ucwords($get_donate['status']); ?>
                    </span>
				</td>
				<td style="vertical-align:top">
                    <span style="font-size:16px;color:#666;
					word-break:break-word; ">
                    	<?= $get_donate['payment_method']; ?>
                    </span>
				</td>
			</tr>
		</tbody>
	</table>

    <div style="padding:0 0 0 20px">
        <div style="border-top:1px solid #e0e0e0;padding:8px 0">
            <h2 style="font-size:14px;font-weight:normal;color:#666">Detail Pemesanan</h2>
            <span style="width:24px;border:2px solid #ff5722;display:inline-block;margin-left:0;"></span>
        </div>
        
        <table style="width:100%;max-width:600px;padding-bottom:18px;padding:10px 20px 10px 0">
            <tbody>
                <tr>
                    <td style="vertical-align:top">
                        <p style="font-size:14px;color:#666;font-weight:bold;padding:0;margin:0">
                        	Donate Package
                        </p>
                    </td>
                    <td style="vertical-align:top;text-align:right;width:120px">
                        <p style="float:right;font-size:14px;color:#666;margin:0;font-weight:bold">
                        	<?= number_format($get_donate['donate_point'],0,',','.'); ?> Diamonds
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>

	<div style="padding:0 20px;margin-bottom:16px;margin-top:8px">
        <div style="font-size:14px;line-height:20px;text-align:center;color:#999;padding:16px 24px;border:1px solid rgb(255,227,143);border-radius:4px;background:#fff7d7">Pastikan dengan benar dan jika sudah silahkan selesaikan proses Donate dengan cara mengubah status <span style="color:blue;">Paid</span> Donate ke <span style="color:green;">Complete</span> di <i style="color:red;">Panel Admin Luna Zone</i> </div>
    </div> 

    <div style="padding:0 20px">
        <p style="font-size:14px;color:#999;padding:16px 0;margin:0;border-top:1px solid #e0e0e0">
            Email dibuat secara otomatis.
        </p>
    </div>
    
	<table align="center">
		<tbody>
			<tr style="margin:0;padding:0 0 0 0">
				<td style="display:block!important;width:600px!important;clear:both!important;margin:0 auto;padding:0">
					<table style="border-collapse:collapse;background-color:#f7f7f7;font-size:13px;color:#999999;border-top:1px solid #dddddd" width="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody>
                            <tr>
                                <td style="padding:30px 20px 0" width="600" align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 20px 30px" width="600" align="center">
                                    &#x24B8;<?= date('Y'); ?> Luna Zone
                                </td>
                            </tr>
					    </tbody>
                    </table>
				</td>
			</tr>
		</tbody>
	</table>
</div>