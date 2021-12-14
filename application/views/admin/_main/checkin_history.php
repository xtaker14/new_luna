
<div class="container-fluid mb-4 mt-2">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-white d-md-flex"> 
                    <div class="col" style="padding:0;"><h4>Check-In History</h4></div> 
				</div>
				<div class="card-body col-xs-0">
					<table id="checkin_history_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
				        <thead>
				            <tr>
                                <th>Username</th>
                                <th>Item Name</th> 
                                <th>Year</th> 
				                <th>Month</th>
				                <th>Check-In Date</th>
				            </tr>
				        </thead>
				        <tbody>
                            <?php foreach ($checkin_history as $key => $val) : ?>
                            <?php
                                $check = "";
                                if($val['is_active']=='yes'){
                                    $check = "checked";
                                }
                            ?>
                                
                            <tr data-id="<?= $val['id']; ?>">
                                <td><?= $val['username']; ?></td>
                                <td><?= $val['item_name']; ?></td>
                                <td><?= $val['checkin_year']; ?></td>
                                <td><?= $val['checkin_month']; ?></td>
                                <td><?= (!empty($val['created_date'])) ? date('d M Y H:i:s', strtotime($val['created_date'])) : '-- Empty --'; ?></td>
                            </tr> 
                            <?php endforeach; ?>
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">    
	$(document).ready(function(){   
		var t = $('#checkin_history_list').DataTable({
			//aaSorting: [ [0,'desc'] ],
			lengthChange: true,
			info: false,
			columnDefs: [
				{ responsivePriority: 1, targets: 0},
				{ responsivePriority: 2, targets: 2},
				{ responsivePriority: 3, targets: -1},
				{ targets: 0, searchable: false},
				{ targets: 1, searchable: false},
				{ targets: -1, searchable: false},
			],
			responsive: {
				details: {
					display: $.fn.dataTable.Responsive.display.modal( {
						header: function ( row ) {
							var data = row.data();
							return data[2];
						}
					} ),
					renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
						tableClass: 'table'
					} )
				}
			}
		});
	}); 
</script>