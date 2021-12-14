 <div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white">
            <h5>
                <b>
                    Edit Char
                </b>
            </h5>
        </div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?> 
	        <div class="form-group"> 
	        	<label for="" >Username: </label>
	            <input type="text" class="form-control" placeholder="Username" name="input_username" id="input_username" value="<?= $tbl_user['username']; ?>" readonly>
	        </div> 

	        <div class="form-group">  
                <form method="POST" action="<?php print_r(site_url('adm/go_update_char')) ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $tbl_user['id']; ?>">
                    <label for="">
                        Email: 
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </label>
                    <input type="email" class="form-control" placeholder="Email" name="input_email" id="input_email" value="<?= $tbl_user['email']; ?>" required>
                </form>
	        </div>  

	        <div class="form-group">  
                <form method="POST" action="<?php print_r(site_url('adm/go_update_char')) ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $tbl_user['id']; ?>"> 
                    <label for="">
                        PIN: 
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </label>
                    <input type="text" class="form-control" placeholder="PIN" name="input_pin" id="input_pin" value="" required>
                </form>
	        </div> 

	        <div class="form-group"> 
                <form method="POST" action="<?php print_r(site_url('adm/go_update_char')) ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $tbl_user['id']; ?>">
                    <label for="">
                        Password: 
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </label>
                    <input type="password" class="form-control" placeholder="Password" name="input_password" id="input_password" value="" required>
                </form>
	        </div>  
            
	        <div class="form-group"> 
                <table id="tbl_char_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Char ID</th> 
                            <th>Char Name</th> 
                            <th>Gold</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $this->db = dbloader("LUNA_MEMBERDB");
                        $this->db->select('
                            cl.*
                        '); 
		                $this->db->where('cl.propid',$tbl_user['id']);
                        $get_char = $this->db->get("chr_log_info cl")->row_array();

                        $this->db = dbloader("LUNA_GAMEDB");
                        $this->db->select('
                            ct.*
                        '); 
                        $this->db->where('ct.USER_IDX',$get_char['id_idx']);
                        $get_res_char = $this->db->get("TB_CHARACTER ct")->result_array();

                        foreach($get_res_char as $key => $val) : 
                        ?>
                            <tr>
                                <th><?= $val['CHARACTER_IDX']; ?></th> 
                                <th><?= $val['CHARACTER_NAME']; ?></th> 
                                <th><?= number_format($val['CHARACTER_MONEY']); ?></th> 
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
    let id = "<?= empty($id) ? '0' : $id; ?>";

    let t = $('#tbl_char_list').DataTable({ 
        // aaSorting: [ [2,'desc'] ],
        lengthChange: true,
        info: false,
        columnDefs: [
            // { responsivePriority: 1, targets: 0},
            // { responsivePriority: 2, targets: 2},
            // { responsivePriority: 3, targets: -1},
            // { targets: 0, searchable: false},
            // { targets: 1, searchable: false},
            // { targets: -1, searchable: false},
        ],
        responsive: {
            details: {
                // display: $.fn.dataTable.Responsive.display.modal( {
                //     header: function ( row ) {
                //         var data = row.data();
                //         return data[2];
                //     }
                // } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    });
});
</script> 