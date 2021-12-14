<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="col-md-12">
	<div class="card mb-3">
		<div class="card-header bg-white d-md-flex">
            <div class="col"><h4>Purchase Item Mall Log</h4></div>
        </div>
		<div class="card-body">
            <?php $this->load->helper("form"); ?>
            <!-- <form id="topup_form" method="POST" action="">
            </form> -->
            <div class="table-responsive">
                <table id="im_log_total" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>  
                            <th scope="col">Item Name</th>
                            <th scope="col">Total Qty</th>
                            <th scope="col">Total All Price</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($im_log_total_list as $key => $val) : ?> 
                            <tr>  
                                <td><?= $val['itemname']; ?></td> 
                                <td><?= number_format($val['total_qty'],0,',','.'); ?></td> 
                                <td><?= number_format($val['total_all_price'],0,',','.'); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br><br>
            
            <div class="table-responsive">
                <table id="im_log" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr> 
                            <th scope="col">ID</th> 
                            <th scope="col">Username</th>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Discount</th> 
                            <th scope="col">Total Price</th>  
                            <th scope="col">Date</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($im_log_list as $key => $val) : ?> 
                            <tr> 
                                <td><?= $val['id']; ?></td>
                                <td><?= $val['username']; ?></td>
                                <td><?= $val['itemid']; ?></td>
                                <td><?= $val['itemname']; ?></td>
                                <td><?= number_format($val['price'],0,',','.'); ?></td>
                                <td><?= number_format($val['qty'],0,',','.'); ?></td>
                                <td><?= $val['disc']; ?></td>
                                <td><?= number_format($val['total_price'],0,',','.'); ?></td>
                                <td><?= (!empty($val['date'])) ? date('d M Y H:i:s', strtotime($val['date'])) : '-- Empty --'; ?></td> 
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
    var im_log = $('#im_log').DataTable( {
        lengthChange: true,
        info: true,
        aaSorting: [],
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
                        return 'Detail for IM Log : '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                })
            }
        },
        fnDrawCallback: function( oSettings ) {
            
        }
    }); 

    var im_log_total = $('#im_log_total').DataTable( {
        lengthChange: true,
        info: true,
        aaSorting: [],
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
                        return 'Detail for IM Log : '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                })
            }
        },
        fnDrawCallback: function( oSettings ) {
            
        }
    }); 
    console.clear();
});
</script>

<style>
    .btn-black{
        background-color: #353333 !important;
    }
</style>