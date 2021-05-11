<?php
$list = '';
foreach ($his as $key => $val) {
    $no = $key+1;
    $date = date('F, d Y', strtotime($val['date']));
$list .='<tr><td>'.$no.'</td><td><label class="text-primary"><span class="star_point">'.$val['star_point'].'</span><i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i></label></td><td>'.$date.'</td></tr>';
}
?>
<div id="srv_rank" class="card shadow-sm mb-3 p-1" style="margin-top: 30px;">
    <div class="card-header bg-white">
		<div class="box_header_title" style="">
			<span></span>
			<span></span> 
			<div class="content_header_title">
				<h2> 
				    <i class="fas fa-history text-primary mr-2"></i>Top-Up History
				</h2> 
			</div>
		</div>
    </div>
	<div class="card-body pb-0"> 

		<table id="topup_history" class="table table-striped table-sm mt-4 dt-responsive nowrap" style="width:100%">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Moon point</th>
		      <th scope="col">Date</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?= $list ?>
		  </tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var t = $('#topup_history').DataTable( {
        lengthChange: false,
        info: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
            { searchable: false, targets: 0 },
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail for '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
	$('html').removeClass('no-js');
})
</script>