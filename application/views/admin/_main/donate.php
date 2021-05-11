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
                            <th scope="col">Admin ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Bill</th>
                            <th scope="col">Diamonds</th>
                            <th scope="col">Referral</th> 
                            <th scope="col">Referral</th> 
                            <th scope="col">Status</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Paid Date</th>
                            <th scope="col">Recheck Date</th>
                            <th scope="col">Complete Date</th>
                            <th scope="col">Canceled Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($donate_list as $key => $val) : ?>
                            <?php 
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
                            ?>
                            <tr> 
                                <td><?= $val['id']; ?></td>
                                <td><?= $val['admin_id']; ?></td>
                                <td><?= $val['username']; ?></td>
                                <td><?= number_format($val['bill'],0,',','.'); ?></td>
                                <td><?= number_format($val['donate_price'],0,',','.'); ?></td>
                                <td>
                                    <?php 
                                        if(empty($val['referral_code'])){
                                            echo '-';
                                        }else{
                                            $val['referral_code'];
                                        }
                                    ?>
                                </td> 
                                <td><?= $val['payment_method']; ?></td>
                                <td data-order="<?= $order_status; ?>">
                                    <?php if($val['status'] == 'pending'): ?>
                                        <span style="color:cadetblue;"><?= ucwords($val['status']); ?></span>
                                    <?php endif; ?>

                                    <?php if($val['status'] == 'paid'): ?>
                                        <button onclick="popPaidDonate(<?= $val['id']; ?>);" class="btn-sm btn btn-primary" type="button">
                                            <?= ucwords($val['status']); ?>
                                        </button>
                                    <?php endif; ?>

                                    <?php if($val['status'] == 'complete'): ?>
                                        <span style="color:green;"><?= ucwords($val['status']); ?></span>
                                    <?php endif; ?>

                                    <?php if($val['status'] == 'canceled'): ?>
                                        <span style="color:red;"><?= ucwords($val['status']); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d M Y H:i:s', strtotime($val['created_date'])); ?></td>
                                <td><?= date('d M Y H:i:s', strtotime($val['paid_date'])); ?></td>
                                <td><?= date('d M Y H:i:s', strtotime($val['recheck_date'])); ?></td>
                                <td><?= date('d M Y H:i:s', strtotime($val['complete_date'])); ?></td>
                                <td><?= date('d M Y H:i:s', strtotime($val['canceled_date'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
    let status = 'paid'; 

    // f_main.loading(true);
    swal("Question",
        "Do you want to change the status to Complete?",
        "warning",
    {
        buttons: { 
            button_1: "No", 
            button_2: "Yes", 
        },
    })
    .then((value) => {
        switch (value) {
            case 'button_2':  
                $.ajax({
                    type : "POST",
                    dataType : "json",
                    data : {
                        donate_id : id, 
                    },
                    url : baseURL+"adm/donate_process/"+status,
                    success:function(res){  
                        if(res.result){
                            swal("Successfull",
                                "Successfully sending Diamonds and changing status to Complete",
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
                break;
            }
    }); 
}

</script>