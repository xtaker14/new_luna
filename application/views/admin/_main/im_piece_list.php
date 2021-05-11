<?php 
$list = '';
foreach ($piece_list as $key => $val) {
	$no = $key+1;
	$id = $val['id'];
	$item_name = $val['itemname'];
	$piece_name = $val['name'];
	$price = $val['price'];
	$price = '<label class="text-primary"><span class="star_point">'.$price.'</span><i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i></label>';
	$edit_url = base_url('adm/im_piece_edit/'.$id);

$list .='
<tr id="parent_'.$id.'">
    <td>'.$no.'</td>
    <td>'.$item_name.'</td>
    <td>'.$piece_name.'</td>
    <td>'.$price.'</td>
    <td>
    <a class="btn btn-primary btm-tabel btn-sm" href="'.$edit_url.'" ><i class="fas fa-edit text-white"></i></a>
    <button class="im_piece_delete btn btn-danger btm-tabel btn-sm" data-id="'.$id.'" ><i class="fas fa-times text-white"></i></button>
    </td>
</tr>';
	}
?>
<div class="container-fluid mb-4 mt-2">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-white">
					<h4>IM Piece List</h4>
				</div>
				<div class="card-body col-xs-0">
					<table id="im_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
				        <thead>
				            <tr>
                                <th>#</th>
                                <th>IM Name</th> 
                                <th>Piece Name</th> 
				                <th>Price</th>
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
$(document).ready(function() {   
	    var t = $('#im_list').DataTable( {
        //aaSorting: [ [0,'desc'] ],
        lengthChange: true,
        info: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0, searchable: false },
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 3, targets: -1, searchable: false},
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

    $(document).on('click','.im_piece_delete',function(){
    	var result = confirm("Want to delete?");
		if (result) {
	        var im_id = $(this).data("id");
			$.getJSON(baseURL+"api/im_piece_delete/"+im_id, function(r){
				if(r==true){
					$("#parent_"+im_id).remove();
				}
			});
		}
    })

});
</script>