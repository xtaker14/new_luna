<?php
$list = '';
foreach ($rank as $key => $val)
{
    $job = '';    

    if($val['c4'] > 0 && $val['c5'] == 0)
    {
        if($val['c1'] == 4)
        {
            $job = 'Master';
        }
        else
        {
            $kw = intval($val['c1'].$val['c4']);
            $job = luna_job4($kw);
        }
    }
    elseif($val['c5'] > 0  && $val['c6'] == 0)
    {
        if($val['c1'] == 4)
        {
            $job = 'Expand Road';
        }
        else
        {
            $kw = intval($val['c1'].$val['c5']);
            $job = luna_job5($kw);
        }
    }
    elseif($val['c6'] > 0)
    {
        if($val['c1'] == 4)
        {
            $job = 'Tyrant';
        }
        else
        {
            $kw = intval($val['c1'].$val['c6']);
            $job = luna_job6($kw);
        }
    }
    $no = $key+1;
$list .='<tr><td>'.$no.'</td><td><span class="pointer" role="button" title="'.$job.'" data-toggle="tooltip" data-placement="bottom"><i class="fab fa-earlybirds" ></i></span></td><td>'.$val['a'].'</td><td>'.$val['b'].'</td><td>'.$val['k'].'</td></tr>';
}
?>
<div id="srv_rank" class="card shadow-sm mb-3 p-1 mt-3">
	<div class="card-body pb-0">
        <div class="box_header_title" style="">
            <span></span>
            <span></span> 
            <div class="content_header_title">
                <h2> 
                    <i class="fas fa-crown text-warning mb-2" data-fa-transform="rotate--30"></i>&nbsp;Player Ranking
                </h2> 
            </div>
        </div>

		<table id="rank_table" class="table table-striped table-sm mt-4 dt-responsive nowrap" style="width:100%">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Job</th>
		      <th scope="col">Name</th>
               <th scope="col">Level</th>
		      <th scope="col">PVP Kill</th>
		    </tr>
		  </thead>
		  <tbody id="side_rank">
		  	<?= $list ?>
		  </tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var t = $('#rank_table').DataTable( {
        lengthChange: true,
        info: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 2 },
            { searchable: false, targets: 0 },
            { searchable: false, targets: 1 },
            { searchable: false, targets: 3 },
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