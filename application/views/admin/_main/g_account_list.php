<?php 
$view_list = '';
foreach ($account_list as $val) {
    $role = $val->UserLevel;
    $star = '<i class="fas fa-star text-warning"></i>';
    $rank = '';

    if($role==1){
        $rank = $star.$star.$star.$star.$star;
    }elseif($role==2){
        $rank = $star.$star.$star.$star;
    }elseif($role==3){
        $rank = $star.$star.$star;
    }elseif($role==4){
        $rank = $star.$star;
    }else{
        $rank = $star;
    }

    $view_list .='
    <tr class="user_'.$val->id_idx.'">
        <td >'.$val->id_loginid.'</td>
        <td >'.$val->title.'</td>
        <td >'.$rank.'</td>
        <td>
        <button class="account_delete btn btn-danger btm-tabel btn-sm" data-id="'.$val->id_idx.'" data-username="'.$val->id_loginid.'" ><i class="fas fa-times text-white"></i></button></td>
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
				                <th>User</th>
				                <th>Jabatan</th>
				                <th>Grade</th>
				                <th>Detail</th>
				            </tr>
				        </thead>
				        <tbody>
				            <?= $view_list; ?>
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/_main/_modal/modal_game_reg.php') ?>
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

    $(document).on('click','.add_account',function(){
    	$('#mod_register').modal('show');
    })

    $(document).on('click','.account_delete',function(){
        var id = $(this).data("id"),
        username = $(this).data("username");
        var r = confirm("Yakin delete article?");
        if (r == true) {
            $.ajax({
                type : "GET",
                dataType : "json",
                url : baseURL+"api/del_game_member/"+id+"/"+username,
            });
            setTimeout(function(){ window.location.href = baseURL+"adm/g_account_list"; }, 1500);            
        }
    })
});
</script>