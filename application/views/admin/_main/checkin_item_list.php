
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="container-fluid mb-4 mt-2">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-white d-md-flex"> 
                    <div class="col" style="padding:0;"><h4>Check-In Item List</h4></div>
                    <div class="col" style="padding:0;"><a class="btn btn-primary my-2 float-md-right" href="<?= base_url('adm/checkin_item') ?>">New Check-In Item</a></div> 
				</div>
				<div class="card-body col-xs-0">
					<table id="checkin_item_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
				        <thead>
				            <tr>
                                <th>Day(Hidden)</th>
                                <th>Day</th>
                                <th>Name</th> 
                                <th>Qty</th> 
				                <th>Is Active?</th>
				                <th>Action</th>
				                <th>Created Date</th>
				                <th>Modified Date</th>
				            </tr>
				        </thead>
				        <tbody>
                            <?php foreach ($checkin_item_list as $key => $val) : ?>
                            <?php
                                $check = "";
                                if($val['is_active']=='yes'){
                                    $check = "checked";
                                }
                            ?>
                                
                            <tr data-id="<?= $val['id']; ?>">
                                <td><?= $val['checkin_day']; ?></td>
                                <td>
									<input data-id="<?= $val['id']; ?>" min="1" class="form-control input_checkin_day" style="width:100px;" type="text" value="<?= $val['checkin_day']; ?>">
									<b>Month: </b><?= getListMonth($val['checkin_month']); ?><br>
									<b>Year: </b><?= $val['checkin_year']; ?><br>
								</td>
                                <td><?= $val['name']; ?></td>
                                <td><?= $val['qty']; ?>x</td> 
                                <td>
                                    <input type="checkbox" class="input_is_active" data-toggle="toggle" data-on="<i class=`fa fa-check`></i> Yes" data-off="<i class=`fa fa-times`></i> No" data-onstyle="success" data-offstyle="danger" data-size="xs" data-id="<?= $val['id']; ?>" <?= $check; ?>>
                                </td>
                                <td> 
                                    <a target="_BLANK" class="btn btn-primary btm-tabel btn-sm" href="<?= base_url('adm/checkin_item/'.$val['id']); ?>" ><i class="fas fa-edit text-white"></i></a>
                                    <button class="checkin_item_delete btn btn-danger btm-tabel btn-sm" data-id="<?= $val['id']; ?>" ><i class="fas fa-times text-white"></i></button>
                                </td>
                                <td><?= (!empty($val['created_date'])) ? date('d M Y H:i:s', strtotime($val['created_date'])) : '-- Empty --'; ?></td>
                                <td><?= (!empty($val['modified_date'])) ? date('d M Y H:i:s', strtotime($val['modified_date'])) : '-- Empty --'; ?></td>
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
	const delayCallEvent = (callback, ms) => {
		var timer = 0;
		return function () {
			var context = this, args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
				callback.apply(context, args);
			}, ms || 0);
		};
	}  

	$(document).ready(function(){   
		var table = $('#checkin_item_list').DataTable({
			//aaSorting: [ [0,'desc'] ],
			lengthChange: true,
			info: false,
			columnDefs: [
				{
					"targets": [ 0 ],
					"visible": false
				},
				{
					"targets": 3, 
					"searchable": false
				},
				{
					"targets": 4, 
					"searchable": false
				},
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
			},
			fnDrawCallback: function( oSettings ) {
				$("#checkin_item_list td input[type=checkbox][data-toggle=toggle]").bootstrapToggle();
			}
		});

		$('.input_checkin_day').on('keyup', delayCallEvent(function (e) { 
			let t = $(this); 
			let t_id = t.data('id'); 
			let t_tr = t.parents('tr[data-id="'+t_id+'"]'); 

			if(t.val().trim() < 1){
				t.val(1);
			}
			if(t.val().trim() > 0){ 
				$('.input_checkin_day').attr('readonly',true);
				$.ajax({
					url: baseURL+"adm/update_checkin_day/",
					method: "POST",
					data: {
						id: t_id,            	
						value: t.val().trim(),    
					},
					success: function(data) {
						if(data.result){
        					f_main.notifyDangerBox(t, 'Update Success',false,2000);
							t_tr.find('td').eq(6).text(data.modified_date);
							console.log('Update Success');
						}else{
							if(data.msg != undefined){
								f_main.notifyDangerBox(t, data.msg,false,4000);
								console.log(data.msg);
							}else{
								f_main.notifyDangerBox(t, 'Update Failed',false,4000);
								console.log('Update Failed');
							}
						}
						$('.input_checkin_day').attr('readonly',false);
					}
				});
			} 
		}, 300)); 

		f_main.setInputFilter($(".input_checkin_day"), function(value) {
			return /^-?\d*$/.test(value); 
		});
	});

	$(document).on('change','.input_is_active',function(){
        var im_id = $(this).data("id"),stat;

		if(this.checked) {
			stat = 'yes';
		}else{
			stat = 'no';             
		}

		$.getJSON(baseURL+"api/checkin_item_status_update/"+im_id+"/"+stat, function(r){
			console.log(r);
		});
    });

    $(document).on('click','.checkin_item_delete',function(){
		swal("Question",
            "Are you sure?",
            "warning",
        {
            buttons: { 
                button_1: {text:'Yes', className:'btn-success'}, 
                button_2: {text:'No', className:'btn-danger'},   
            },
        })
        .then((value) => {
            switch (value) {
                case 'button_1':
                    let im_id = $(this).data("id");
					$.getJSON(baseURL+"api/checkin_item_delete/"+im_id, function(r){
						window.location.reload(true);
					});
                    break;
                }
        }); 
    });
</script>