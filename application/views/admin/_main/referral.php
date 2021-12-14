<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="col-md-12">
	<div class="card mb-3">
		<div class="card-header bg-white d-md-flex">
            <div class="col"><h4>REFERRAL</h4></div>
            <div class="col"><a class="btn btn-primary my-2 float-md-right" href="<?= base_url('adm/new_referral') ?>">Make New Refferal Code</a></div>
        </div>
		<div class="card-body">
            <?php $this->load->helper("form"); ?>
            <!-- <form id="topup_form" method="POST" action="">
            </form> -->
            <div class="table-responsive">
                <table id="referral_table" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr> 
                            <th scope="col">ID</th>
                            <th scope="col">Admin ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Code</th>
                            <th scope="col">Point</th>
                            <th scope="col">Action</th>
                            <th scope="col">Created Date</th> 
                            <th scope="col">Modified Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($referral_list as $key => $val) : ?>
                            <?php    
                            ?>
                            <tr> 
                                <td><?= $val['id']; ?></td>
                                <td><?= !empty($val['admin_id']) ? $val['admin_id'] : '<small>Not Yet</small>' ; ?></td>
                                <td><?= $val['username']; ?></td>
                                <td><?= $val['referral_code']; ?></td>
                                <td><?= number_format($val['silver_point'],0,',','.'); ?></td>
                                <td>
                                    <?php if($val['is_deleted'] == 'yes'): ?>
                                        <button data-id="<?= $val['id']; ?>" onclick="setStatusRef($(this));" type="button" class="btn btn-sm btn-danger">
                                            Off
                                        </button>
                                    <?php else: ?>
                                        <button data-id="<?= $val['id']; ?>" onclick="setStatusRef($(this));" type="button" class="btn btn-sm btn-success">
                                            On
                                        </button>
                                    <?php endif; ?>
                                    <a href="<?= base_url('adm/edit_referral/'.$val['id']) ?>" type="button" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger delete_referral" type="button" data-id="<?= $val['id']; ?>"><i class="fa fa-trash"></i></button>
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
    var referral_table = $('#referral_table').DataTable( {
        lengthChange: true,
        info: true,
        aaSorting: [
            // [ 7, "asc" ],
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
                        return 'Detail for Refferal ID : '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                })
            }
        }
    });
    console.clear();

    $(document).on('click','.delete_referral',function(){
        var id = $(this).data("id"); 

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
                    $.getJSON(baseURL+"api/referral_delete/"+id, function(r){
                        window.location.reload(true);
                    });
                    break;
                }
        }); 
    });
}); 
function setStatusRef(t){
    swal("Warning",
        "Anda yakin ingin mengubah status?",
        "warning",
    {
        buttons: { 
            button_1: {text:'Cancel', className:'btn-black'},
            button_2: "Yes", 
        },
    })
    .then((value) => {
        switch (value) {
            case 'button_2':
                $.ajax({
                    url: baseURL+"adm/set_status_referral/",
                    method: "POST",
                    data: {
                        id: t.data('id'),                	
                    },
                    success: function(data) {
                        if(!data.result){
                            swal("Warning",
                                "Data tidak di temukan",
                                "warning",
                            {
                                buttons: { 
                                    button_1: "OK", 
                                },
                            })
                            .then((value) => {
                                switch (value) {
                                    default:
                                        break;
                                    }
                            });
                            return false;
                        }
                        if(data.result == 'no'){
                            t.text('On');
                            t.addClass('btn-success').removeClass('btn-danger');
                        }else{
                            t.text('Off');
                            t.addClass('btn-danger').removeClass('btn-success');
                        }
                        swal("Successfull",
                            "Berhasil di ubah",
                            "success",
                        {
                            buttons: { 
                                button_1: "OK", 
                            },
                        })
                        .then((value) => {
                            switch (value) {
                                default:
                                    break;
                                }
                        });
                    }
                });
                break;
            }
    });
}
</script>
<style>
    .btn-black{
        background-color: #353333 !important;
    }
</style>