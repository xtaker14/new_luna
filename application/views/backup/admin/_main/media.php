<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="col-md-12">
	<div class="card mb-3">
		<div class="card-header bg-white d-md-flex">
            <div class="col"><h4>MEDIA</h4></div>
            <div class="col"><a class="btn btn-primary my-2 float-md-right" href="<?= base_url('adm/new_media') ?>">Make New MEDIA</a></div>
        </div>
		<div class="card-body">
            <?php $this->load->helper("form"); ?>
            <!-- <form id="topup_form" method="POST" action="">
            </form> -->
            <div class="table-responsive">
                <table id="media_table" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr> 
                            <th scope="col">ID</th>
                            <th scope="col">Admin ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">type</th>
                            <th scope="col">Order</th>
                            <th scope="col">Is Hidden?</th>
                            <th scope="col">Action</th>
                            <th scope="col">Created Date</th> 
                            <th scope="col">Modified Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($media_list as $key => $val) : ?>
                            <?php    
                            ?>
                            <tr> 
                                <td><?= $val['id']; ?></td>
                                <td><?= !empty($val['admin_id']) ? $val['admin_id'] : '<small>Not Yet</small>' ; ?></td>
                                <td><?= $val['name']; ?></td>
                                <td><?= $val['type']; ?></td>
                                <td><?= $val['no_order']; ?></td>
                                <td>
                                    <?php if($val['is_hidden'] == 'no'): ?>
                                        <button data-id="<?= $val['id']; ?>" onclick="setStatusHide($(this));" type="button" class="btn btn-sm btn-danger">
                                            No
                                        </button>
                                    <?php else: ?>
                                        <button data-id="<?= $val['id']; ?>" onclick="setStatusHide($(this));" type="button" class="btn btn-sm btn-success">
                                            Yes
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('adm/media_edit/'.$val['id']) ?>" type="button" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
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
    var media_table = $('#media_table').DataTable( {
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
}); 
function setStatusHide(t){
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
                    url: baseURL+"adm/set_status_media/",
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
                            t.text('No');
                            t.addClass('btn-danger').removeClass('btn-success');
                        }else{
                            t.text('Yes');
                            t.addClass('btn-success').removeClass('btn-danger');
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