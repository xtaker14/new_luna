<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="col-md-12">
	<div class="card mb-3">
		<div class="card-header bg-white"><h5><b>DONATE</b></h5></div>
		<div class="card-body">
            <?php $this->load->helper("form"); ?>
            <!-- <form id="topup_form" method="POST" action="">
            </form> -->
            <div class="table-responsive">
                <table id="donate_table" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr> 
                            <th scope="col">ID</th> 
                            <th scope="col">ByAdmin?</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Username</th>
                            <th scope="col">Bill</th>
                            <th scope="col">Points</th>
                            <th scope="col">Referral</th> 
                            <th scope="col">Payment</th> 
                            <th scope="col">Status</th>
                            <th scope="col">Transaction Time</th>
                            <th scope="col">Paid Date</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($donate_list as $key => $val) : ?>
                            <?php 
                                $currency = $val['currency'];
                                $float_num = 0;
                                $total_bill = $val['total_bill'];
                                if($currency === 'USD'){
                                    $float_num = 2; 
                                } 
                                $order_status = 0;
                                switch ($val['status']) {
                                    case 'paid':
                                        $order_status = 1;
                                        break;
                                    case 'pending':
                                        $order_status = 2;
                                        break;
                                    case 'complete':
                                        $order_status = 3;
                                        break;
                                    case 'canceled':
                                        $order_status = 4;
                                        break;
                                }  
                                
                                $byadmin_color = 'green';
                                if($val['is_acc_by_admin'] == 'no'){
                                    $byadmin_color = 'red';
                                }
                            ?>
                            <tr> 
                                <td><?= $val['id']; ?></td> 
                                <td>
                                    <span style="color:<?= $byadmin_color; ?>;"><?= ucwords($val['is_acc_by_admin']); ?></span>
                                </td> 
                                <td><?= $val['admin_description']; ?></td>
                                <td><?= $val['username']; ?></td>
                                <td><?= $currency.' '.number_format($total_bill,$float_num,',','.'); ?></td>
                                <td><?= number_format($val['donate_point'],0,',','.'); ?></td>
                                <td>
                                    <?php 
                                        if(empty($val['referral_code'])){
                                            echo '-';
                                        }else{
                                            echo $val['referral_code'];
                                        }
                                    ?>
                                </td> 
                                <td>
                                    <?php if($val['payment_method']==='qris') : ?>
                                        ShopeePay
                                    <?php elseif($val['payment_method']==='bank_transfer') : ?>
                                        Bank 
                                        <?php if(!empty($val['midtrans_va_bank'])) : ?>
                                        (<?= strtoupper($val['midtrans_va_bank']); ?>)
                                        <?php endif; ?>
                                    <?php elseif($val['payment_method']==='gopay') : ?>
                                        Gopay
                                    <?php elseif($val['payment_method']==='echannel') : ?>
                                        Bank (MANDIRI)
                                    <?php elseif($val['payment_method']==='credit_card') : ?>
                                        Credit Card
                                    <?php else: ?>
                                        <?php 
                                            echo $val['payment_method']; 
                                            if(!empty($val['cekmutasi_service_name'])){
                                                echo '<br> With '.$val['cekmutasi_service_name']; 
                                            }
                                        ?>
                                    <?php endif; ?>
                                </td>
                                <td data-order="<?= $order_status; ?>"> 
                                    <?php if($val['status'] == 'unpaid'): ?>
                                        <button onclick="popPaidDonate(<?= $val['id']; ?>);" class="btn-sm btn btn-primary" type="button">
                                            <?= ucwords($val['status']); ?>
                                        </button>
                                    <?php endif; ?>

                                    <?php if($val['status'] == 'paid'): ?>
                                        <span style="color:green;"><?= ucwords($val['status']); ?></span>
                                    <?php endif; ?>

                                    <?php if($val['status'] == 'canceled'): ?>
                                        <span style="color:red;"><?= ucwords($val['status']); ?></span>
                                    <?php endif; ?>
                                    
                                    <?php if($val['midtrans_fraud_status'] == 'challenge'): ?>
                                        <small style="color:red;">Challenge by FDS</small>
                                    <?php endif; ?>
                                </td>
                                <td><?= (!empty($val['created_date'])) ? date('d M Y H:i:s', strtotime($val['created_date'])) : '-- Empty --'; ?></td>
                                <td>
                                    <?php
                                    if($val['is_acc_by_admin'] == 'no'){
                                        echo (!empty($val['cekmutasi_payment_date'])) ? date('d M Y H:i:s', strtotime($val['cekmutasi_payment_date'])) : '-- Empty --';
                                    } else {
                                        echo (!empty($val['complete_date'])) ? date('d M Y H:i:s', strtotime($val['complete_date'])) : '-- Empty --';
                                    }
                                    ?>
                                </td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>

<div class="modal fade" id="modal_donate_description" tabindex="-1" role="dialog" aria-labelledby="modal_donate_description_title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_donate_description_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Catatan (Optional)</label>
                <textarea name="input_description" id="input_description" class="form-control" rows="10"></textarea>
            </div>
            <div class="modal-footer"> 
                <button type="button" id="btn_submit_description" class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"> 

$(document).ready(function(){
    var donate_table = $('#donate_table').DataTable( {
        lengthChange: true,
        info: true,
        aaSorting: [
            [ 7, "asc" ],
        ],
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 2 },
            // { searchable: false, targets: 0 },
            // { searchable: false, targets: 1 }, 
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail for Donate ID : '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                })
            }
        }
    });  
    console.clear();
}); 

function popPaidDonate(id){
    let donate_popup = $("#donate_popup"); 
    let to_status = '';

    // f_main.loading(true);
    swal("Question",
        "Please choose what status you want to be!",
        "warning",
    {
        buttons: { 
            button_1: {text:'Close Modal', className:'btn-black'}, 
            button_2: {text:'Canceled', className:'btn-danger'}, 
            button_3: {text:'Paid', className:'btn-success'}, 
        },
    })
    .then((value) => {
        switch (value) {
            case 'button_2':  
                $("#modal_donate_description_title").text("Cancel");
                $("#modal_donate_description").modal('show');

                $("#btn_submit_description").off('click');
                $("#btn_submit_description").click(function(){
                    let descr = $("#modal_donate_description #input_description").val().trim();
                    
                    to_status = 'canceled';
                    $.ajax({
                        type : "POST",
                        dataType : "json",
                        data : {
                            donate_id : id, 
                            to_status : to_status,
                            description : descr,
                        },
                        url : baseURL+"adm/donate_process",
                        success:function(res){  
                            if(res.result){
                                swal("Successfull",
                                    "Successfully changing status to "+to_status,
                                    "success",
                                {
                                    buttons: { 
                                        button_1: "OK", 
                                    },
                                })
                                .then((value) => {
                                    switch (value) {
                                        default:
                                            window.location.reload();
                                            break;
                                        }
                                }); 
                            } 
                        }
                    });
                }); 
                
                break;
            case 'button_3': 
                $("#modal_donate_description_title").text("Paid");
                $("#modal_donate_description").modal('show');

                $("#btn_submit_description").off('click');
                $("#btn_submit_description").click(function(){
                    let descr = $("#modal_donate_description #input_description").val().trim();
                    to_status = 'paid';

                    $.ajax({
                        type : "POST",
                        dataType : "json",
                        data : {
                            donate_id : id, 
                            to_status : to_status,
                            description : descr,
                        },
                        url : baseURL+"adm/donate_process",
                        success:function(res){  
                            if(res.result){
                                swal("Successfull",
                                    "Successfully sending Diamonds and changing status to "+to_status,
                                    "success",
                                {
                                    buttons: { 
                                        button_1: "OK", 
                                    },
                                })
                                .then((value) => {
                                    switch (value) {
                                        default:
                                            window.location.reload();
                                            break;
                                        }
                                }); 
                            } 
                        }
                    });
                }); 
                break;
            }
    }); 
}

</script>
<style>
    .btn-black{
        background-color: #353333 !important;
    }
</style>