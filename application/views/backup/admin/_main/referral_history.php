<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="col-md-12">
	<div class="card mb-3">
		<div class="card-header bg-white d-md-flex">
            <div class="col"><h4>REFERRAL HISTORY</h4></div> 
        </div>
		<div class="card-body">
            <?php $this->load->helper("form"); ?>
            <!-- <form id="topup_form" method="POST" action="">
            </form> -->
            <div class="table-responsive">
                <table id="referral_table" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr> 
                            <th scope="col">ID</th>
                            <th scope="col">Admin ID</th>
                            <th scope="col">Donate ID</th>
                            <th scope="col">From Username</th>
                            <th scope="col">To Username</th>
                            <th scope="col">Code</th>
                            <th scope="col">Silver</th>
                            <th scope="col">Created Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($referral_history_list as $key => $val) : ?>
                            <?php    
                            ?>
                            <tr> 
                                <td><?= $val['id']; ?></td>
                                <td><?= !empty($val['admin_id']) ? $val['admin_id'] : '<small>Not Yet</small>' ; ?></td>
                                <td><?= $val['donate_id']; ?></td>
                                <td><?= $val['from_username']; ?></td>
                                <td><?= $val['username']; ?></td>
                                <td><?= $val['referral_code']; ?></td>
                                <td><?= number_format($val['silver_point'],0,',','.'); ?></td>
                                <td><?= (!empty($val['created_date'])) ? date('d M Y H:i:s', strtotime($val['created_date'])) : '-- Empty --'; ?></td>
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
    var referral_table = $('#referral_table').DataTable( {
        lengthChange: true,
        info: true,
        aaSorting: [
            // [ 7, "asc" ],
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
                        return 'Detail for Refferal ID : '+data[0];
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
</script>
<style>
    .btn-black{
        background-color: #353333 !important;
    }
</style>