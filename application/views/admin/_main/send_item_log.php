
<div class="container-fluid mb-4 mt-2">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-white d-md-flex"> 
                    <div class="col" style="padding:0;"><h4>Sent Item Log</h4></div> 
				</div>
				<div class="card-body col-xs-0">
					<table id="tbl_send_item" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
				        <thead>
				            <tr>
                                <th>Admin</th>
				                <th>Item Name</th>
				                <th>Qty</th>
                                <th>Send Type</th> 
                                <th>Username</th> 
				                <th>Lvl Type</th>
				                <th>Specific Lvl</th>
				                <th>Register Date Type</th>
				                <th>Range Register Date</th> 
				                <th>Reason</th> 
				                <th>Created Date</th>
				            </tr>
				        </thead>
				        <tbody> 
                            <?php foreach ($send_item_log as $key => $val) : ?>
                            <?php
                                if(!empty($val['created_date'])){
                                    $val['created_date'] = date('d M Y H:i:s', strtotime($val['created_date']));
                                }else{
                                    $val['created_date'] = '-- Empty --';
                                }

                                $range_date = '-';
                                if(!empty($val['register_range_start_date'])){
                                    $val['register_range_start_date'] = date('d M Y', strtotime($val['register_range_start_date']));
                                    $range_date = $val['register_range_start_date'];
                                }else{
                                    $val['register_range_start_date'] = '';
                                }
                                if(!empty($val['register_range_end_date'])){
                                    $val['register_range_end_date'] = date('d M Y', strtotime($val['register_range_end_date']));
                                    $range_date .= ' to '.$val['register_range_end_date'];
                                }else{
                                    $val['register_range_end_date'] = '';
                                }

                                if(empty($val['username'])){
                                    $val['username'] = '-';
                                }
                                if(empty($val['level_type'])){
                                    $val['level_type'] = '-';
                                }
                                if(empty($val['specific_level'])){
                                    $val['specific_level'] = '-';
                                }
                                if(empty($val['register_date_type'])){
                                    $val['register_date_type'] = '-';
                                }
                            ?>
                                
                            <tr data-id="<?= $val['id']; ?>">
                                <td><?= $val['email_admin']; ?></td>
				                <th><?= $val['item_name']; ?></th>
				                <th><?= $val['item_qty']; ?></th>
                                <th><?= ucwords($val['send_type']); ?></th> 
                                <th><?= $val['username']; ?></th> 
				                <th><?= ucwords($val['level_type']); ?></th>
				                <th><?= $val['specific_level']; ?></th>
				                <th><?= ucwords($val['register_date_type']); ?></th>
				                <th><?= $range_date; ?></th>
                                <td><?= $val['description']; ?></td>
                                <td><?= $val['created_date']; ?></td>
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
		var t = $('#tbl_send_item').DataTable({ 
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
							return 'Detail Log';
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