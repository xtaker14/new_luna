<?php 
$list = '';
foreach ($im_list as $key => $val) {
	$no = $key+1;
	$id = $val['itemid'];
	$name = $val['itemname'];
	$category = $val['category'];
	$edit_url = base_url('adm/im_edit/'.$id);
	$check = "";
	if($val['status']==1){
		$check = "checked";
	}
$list .='
<tr id="parent_'.$id.'">
    <td>'.$no.'</td>
    <td>'.$id.'</td>
    <td>'.$name.'</td>
    <td>'.$category.'</td>
    <td><input type="checkbox" class="status" data-toggle="toggle" data-on="<i class=`fa fa-check`></i> Publish" data-off="<i class=`fa fa-times`></i> Draft" data-onstyle="success" data-offstyle="danger" data-size="xs" data-id="'.$id.'" '.$check.'></td>
    <td>
    <a target="_BLANK" class="btn btn-primary btm-tabel btn-sm" href="'.base_url('adm/new_im_piece/'.$id).'" ><i class="fas fa-puzzle-piece text-white"></i></a>
    <a target="_BLANK" class="btn btn-primary btm-tabel btn-sm" href="'.$edit_url.'" ><i class="fas fa-edit text-white"></i></a>
    <button class="im_delete btn btn-danger btm-tabel btn-sm" data-id="'.$id.'" ><i class="fas fa-times text-white"></i></button>
    </td>
</tr>';
	}
?>
<div class="container-fluid mb-4 mt-2">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-white d-md-flex">
					<div class="col"><h4>Item Mall List</h4></div>
					<div class="col"><a class="btn btn-primary my-2 float-md-right" href="<?= base_url('adm/new_im') ?>">Make New IM</a></div>
				</div>
				<div class="card-body col-xs-0">
					<table id="im_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
				        <thead>
				            <tr>
                                <th>#</th>
                                <th>ID</th> 
                                <th>Name</th> 
				                <th>Category</th>
				                <th>Status</th>
				                <th>Option</th>
				            </tr>
				        </thead>
				        <tbody>
				            <?= $list ?>
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">    
	$(document).ready(function(){   
		var t = $('#im_list').DataTable({
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
			},
			fnDrawCallback: function( oSettings ) {
				$("#im_list td input[type=checkbox][data-toggle=toggle]").bootstrapToggle();
			}
		});
	});

	$(document).on('change','.status',function(){
        var im_id = $(this).data("id"),stat;

		if(this.checked) {
			stat = 1;
		}else{
			stat = 0;             
		}

		$.getJSON(baseURL+"api/im_status_update/"+im_id+"/"+stat, function(r){
			console.log(r);
		});
    });

    $(document).on('click','.im_delete',function(){
    	var result = confirm("Want to delete?");
		if (result) {
	        var im_id = $(this).data("id");
			$.getJSON(baseURL+"api/im_delete/"+im_id, function(r){
				if(r==true){
					$("#parent_"+im_id).remove();
				}
			});
		}
    });
</script>