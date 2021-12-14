<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="col-md-12">
	<div class="card mb-3">
		<div class="card-header bg-white d-md-flex">
            <div class="col"><h4>Donate Price List</h4></div>
            <div class="col">
                <a class="btn btn-primary my-2 float-md-right" href="<?= base_url('adm/new_donate_price') ?>">Make New Donate Price</a>
            </div>
        </div>
		<div class="card-body">
            <?php $this->load->helper("form"); ?>
            <!-- <form id="topup_form" method="POST" action="">
            </form> -->
            <div class="table-responsive">
                <table id="donate_price_table" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr> 
                            <th scope="col">ID</th> 
                            <th scope="col">Point</th>
                            <th scope="col">Total Items</th>
                            <th scope="col">Price</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Action</th> 
                            <th scope="col">Created Date</th> 
                            <th scope="col">Modified Date</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($donate_price_list as $key => $val) : ?>
                            <?php 
                                $currency = $val['currency'];
                                $float_num = 0;
                                if($currency === 'USD'){
                                    $float_num = 2;
                                }
                                $items = json_decode($val['items'], true);  
                                $edit_url = base_url('adm/edit_donate_price/'.$val['id']);
                                $check = "";
                                if($val['is_hidden']=='no'){
                                    $check = "checked";
                                }
                            ?>
                            <tr> 
                                <td><?= $val['id']; ?></td> 
                                <td><?= number_format($val['value'],0,',','.'); ?></td>
                                <td><?= count($items); ?></td> 
                                <td><?= number_format($val['price'],$float_num,',','.'); ?></td>
                                <td>
                                    <?php 
                                        echo $currency;
                                    ?>
                                </td> 
                                <td>
                                    <a target="_BLANK" class="btn btn-primary btm-tabel btn-sm" href="<?= $edit_url; ?>" ><i class="fas fa-edit text-white"></i></a>
                                    <input type="checkbox" class="status_hidden" data-toggle="toggle" data-on="<i class=`fa fa-check`></i> Publish" data-off="<i class=`fa fa-times`></i> Draft" data-onstyle="success" data-offstyle="danger" data-size="xs" data-id="<?= $val['id']; ?>" <?= $check; ?>>
                                    <button class="btn btn-sm btn-danger delete_dp" type="button" data-id="<?= $val['id']; ?>"><i class="fa fa-trash"></i></button>
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

<script type="text/javascript"> 

$(document).ready(function(){
    var donate_price_table = $('#donate_price_table').DataTable( {
        lengthChange: true,
        info: true,
        aaSorting: [
            [ 7, "asc" ],
        ],
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 2 },
            // { searchable: false, targets: 0 },
            // { searchable: false, targets: 1 }, 
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail for Donate ID : '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                })
            }
        },
        fnDrawCallback: function( oSettings ) {
            $("#donate_price_table td input[type=checkbox][data-toggle=toggle]").bootstrapToggle();
        }
    });  

	$(document).on('change','.status_hidden',function(){
        var dp_id = $(this).data("id"),stat;

		if(this.checked) {
			stat = 'no';
		}else{
			stat = 'yes';             
		}

		$.getJSON(baseURL+"api/donate_price_status_update/"+dp_id+"/"+stat, function(r){
			console.log(r);
		});
    });

	$(document).on('click','.delete_dp',function(){
        var dp_id = $(this).data("id"); 

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
                    $.getJSON(baseURL+"api/donate_price_delete/"+dp_id, function(r){
                        window.location.reload(true);
                    });
                    break;
                }
        }); 
    });
    console.clear();
});
</script>

<style>
    .btn-black{
        background-color: #353333 !important;
    }
</style>