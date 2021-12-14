<?php 
$view_list = '';
foreach ($account_list as $val) {
$role = $val->roleId;
$star = '<i class="fas fa-star text-warning"></i>';
if($role==1){
	$rank = $star.$star.$star;
}elseif($role==2){
	$rank = $star.$star;
}elseif($role==3){
	$rank = $star;
}else{
	$rank = '';
}
$view_list .='
<tr class="user_'.$val->id.'">
    <td >'.$val->nama.'</td>
    <td >'.$val->jabatan.'</td>
    <td >'.$rank.'</td>
    <td>
    <button class="account_detail btn btn-primary btm-tabel btn-sm mr-1" data-id="'.$val->id.'" ><i class="fas fa-search"></i></button>
    <button class="account_edit btn btn-primary btm-tabel btn-sm mr-1" data-id="'.$val->id.'" ><i class="far fa-edit"></i></button>
    <button class="account_delete btn btn-danger btm-tabel btn-sm" data-id="'.$val->id.'" ><i class="fas fa-times text-white"></i></button></td>
</tr>';
	}
?>

<div class="container-fluid mb-4 mt-2">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-white">
					<h4>Account List</h4>
				</div>
				<div class="card-body col-xs-0">
					<button class="add_account btn btn-primary float-right">Add Account</button>
					<table id="artikel" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
				        <thead>
				            <tr>
				                <th>Name</th>
				                <th>Jabatan</th>
				                <th>Grade</th>
				                <th>Detail</th>
				            </tr>
				        </thead>
				        <tbody>
				            <?php print_r($view_list); ?>
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/_main/_modal/new_account.php') ?>
<?php $this->load->view('admin/_main/_modal/account_detail.php') ?>
<?php $this->load->view('admin/_main/_modal/edit_account.php') ?>
<script type="text/javascript">
$(document).ready(function() {
	var t = $('#artikel').DataTable( {
        lengthChange: true,
        info: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 },
            { searchable: false, targets: 1 },
            { searchable: false, targets: 2 },
            { searchable: false, targets: 3 },
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail untuk '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    });

    $(document).on('click','.account_detail',function(){
    	var admin_id = $(this).data('id');

    	$.ajax({
			type : "POST",
			dataType : "json",
			data : { admin_id : admin_id},
			url : baseURL+"api/get_data_admin",
			success:function(hasil){
    			$('.account_nama').html(hasil.nama);
    			$('.account_jabatan').html(hasil.jabatan);
    			$('.account_email').html(hasil.email);
    			$('.account_whatsapp').html(hasil.whatsapp);
    			$('#account_detail_modal').modal('show');
			}
		})

    });

    $(document).on('click','.account_edit',function(){
    	var admin_id = $(this).data('id');
    	$.ajax({
			type : "POST",
			dataType : "json",
			data : { admin_id : admin_id},
			url : baseURL+"api/get_data_admin",
			success:function(hasil){
				var jbtn = hasil.roleId+','+hasil.jabatan;
				$('select[id=edit_jabatan]').val(jbtn);
				$('#edit_nama').val(hasil.nama);
    			$('#edit_email').val(hasil.email);
    			$('#edit_whatsapp').val(hasil.whatsapp);
    			$('#edit_account_modal').modal('show');
			}
		})
    })

    $(document).on('click','.account_delete',function(){
        var id = $(this).data("id");
        var r = confirm("Yakin delete article?");
        if (r == true) {
            $.ajax({
                type : "GET",
                dataType : "json",
                url : baseURL+"api/go_del_account/"+id,
                success:function(hasil){
                    if(hasil==true){
                        $("#user_"+id).remove();
                    }
                }
            })
        }
    })

    $(document).on('hidden.bs.modal','#edit_account_modal',function(){
    	$("#edit_account_form")[0].reset()
    	$('.form_update_password').hide();
    	$('.show_update_password').show();
	})

    $(document).on('click','.add_account',function(){
    	$('#new_account_modal').modal('show');
    })
});
</script>