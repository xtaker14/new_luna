
<div class="container-fluid mb-4 mt-2">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-white d-md-flex"> 
                    <div class="col" style="padding:0;"><h4>Char List</h4></div> 
				</div>
				<div class="card-body col-xs-0">
					<table id="tbl_char_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
				        <thead>
				            <tr>
                                <th>Username</th> 
                                <th>Email</th>  
                                <th>Point</th>  
				                <th>Action</th>
				            </tr>
				        </thead>
				        <tbody>
                            <?php foreach($tbl_user as $key => $val) : ?>
								<tr>
									<th><?= $val['username']; ?></th> 
									<th><?= $val['email']; ?></th>  
									<th><?= number_format($val['star_point'],0,',','.'); ?></th>  
									<th>
										<a target="_blank" href="<?= base_url('adm/char/'.$val['id']) ?>" class="btn btn-sm btn-primary">
											<i class="fa fa-edit"></i> Edit
										</a>
									</th>
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
		var t = $('#tbl_char_list').DataTable({ 
			aaSorting: [ [0,'desc'] ],
			lengthChange: true,
			info: false,
			columnDefs: [
				// { responsivePriority: 1, targets: 0},
				// { responsivePriority: 2, targets: 2},
				// { responsivePriority: 3, targets: -1},
				// { targets: 0, searchable: false},
				// { targets: 1, searchable: false},
				// { targets: -1, searchable: false},
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