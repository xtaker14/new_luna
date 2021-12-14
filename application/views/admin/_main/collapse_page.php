<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
$upload_path = "assets/frontpage/img/web_config";
?>
<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white"><h5><b>Collapse Page</b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>

        <form id="form_collapse_page" method="POST" action="<?php print_r(site_url('adm/go_save_collapse_page')) ?>" enctype="multipart/form-data"> 
	        <div class="row">
                <div class="col-md-6 form-group"> 
                    <label for="input_title_page"><?= ucwords('Title Page'); ?></label>
                    <input type="text" class="form-control" placeholder="Title Page" name="input_title_page" id="input_title_page" value="<?= ''; ?>">
                </div> 
            </div>
            
            <div class="row">
                <div class="col-md-6 form-group">  
                    <label for="input_server_location"><?= ucwords('Server Location'); ?></label>
                    <input type="text" class="form-control" placeholder="Server Location" name="input_server_location" id="input_server_location" value="<?= $config_web['server_location']; ?>">
                </div>
                <div class="col-md-6 form-group">  
                    <label for="input_server_exp"><?= ucwords('Server EXP'); ?></label>
                    <input type="text" class="form-control" placeholder="Server EXP" name="input_server_exp" id="input_server_exp" value="<?= $config_web['server_exp']; ?>">
                </div>
            </div> 
            
            <div class="row">
                <div class="col-md-6 form-group">  
                    <label for="input_server_gold"><?= ucwords('Server GOLD'); ?></label>
                    <input type="text" class="form-control" placeholder="Server GOLD" name="input_server_gold" id="input_server_gold" value="<?= $config_web['server_gold']; ?>">
                </div>
                <div class="col-md-6 form-group">  
                    <label for="input_server_drop"><?= ucwords('Server DROP'); ?></label>
                    <input type="text" class="form-control" placeholder="Server DROP" name="input_server_drop" id="input_server_drop" value="<?= $config_web['server_drop']; ?>">
                </div>
            </div> 
            
            <div class="row">
                <div class="col-md-6 form-group">  
                    <label for="input_email_account_number"><?= ucwords('Email to receive messages'); ?></label>
                    <input type="text" class="form-control" placeholder="Email to receive messages" name="input_email_account_number" id="input_email_account_number" value="<?= $config_web['email_account_number']; ?>">
                </div>
                <div class="col-md-6 form-group"> 
                    <label for="input_widget_discord_link"><?= ucwords('Widget Discord Link'); ?></label>
                    <input type="text" class="form-control" placeholder="Widget Discord Link" name="input_widget_discord_link" id="input_widget_discord_link" value="<?= $config_web['widget_discord_link']; ?>">
                </div>
            </div> 

            <div class="row">
                <div class="col-md-6 form-group">  
                    <label for="input_admin_access_key"><?= ucwords('Admin Access Key'); ?></label>
                    <input type="text" class="form-control" placeholder="Admin Access Key" name="input_admin_access_key" id="input_admin_access_key" value="<?= $config_web['admin_access_key']; ?>"> 
                </div>
                <div class="col-md-6 form-group"> 
                    <label for="input_maintenance_access_key"><?= ucwords('Maintenance Access Key'); ?></label>
                    <input type="text" class="form-control" placeholder="Maintenance Access Key" name="input_maintenance_access_key" id="input_maintenance_access_key" value="<?= $config_web['maintenance_access_key']; ?>">
                </div>
            </div> 

            <div class="row">
                <div class="col-md-6 form-group">  
                    <label for="input_referral_bonus_points"><?= ucwords('Referral Bonus (%)'); ?></label>
                    <input type="text" class="form-control" placeholder="Referral Bonus (%)" name="input_referral_bonus_points" id="input_referral_bonus_points" value="<?= $config_web['referral_bonus_points']; ?>">
                </div>
                <div class="col-md-6 form-group"> 
                    <label for="input_is_maintenance"><?= ucwords('Is Maintenance for ALL?'); ?></label>
                    <select class="form-control" name="input_is_maintenance" id="input_is_maintenance">
                        <option <?= $config_web['is_maintenance'] == 'no' ? 'selected' : ''; ?> value="no">No</option>
                        <option <?= $config_web['is_maintenance'] == 'yes' ? 'selected' : ''; ?> value="yes">Yes</option>
                    </select>
                </div>
            </div>  
 
            <div class="form-group">
                <label for="input_other_maintenance">Maintenance per Link/Page</label>
                <div class="input-group">
                    <input name="input_other_maintenance" id="input_other_maintenance" type="text" class="form-control" value="" placeholder="Enter maintenance link">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btn_add_other_mt">Add</button>
                    </div>
                </div>
                <table class="table table-bordered" style="margin-top: 10px;" id="list_other_mt">
                    <thead>
                        <tr>
                            <th>Maintenance Link</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($config_web['other_maintenance'])){
                            $exp_mt = explode(',', str_replace(' ', '', $config_web['other_maintenance']));
                            foreach ($exp_mt as $key => $val) {
                                echo "
                                <tr>
                                    <td>$val</td>
                                    <td><button onclick='removeMt($(this));' type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>
                                </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div> 
            <div class="form-group">
                <label for="input_donate_type">Donate Account Information</label>
                <div class="input-group">
                    <select class="form-control" name="input_donate_type" id="input_donate_type">
                        <option selected value="bank">BANK</option> 
                        <option value="dana">DANA</option> 
                        <option value="paypal">PAYPAL</option> 
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btn_open_add_donate_form">Choose</button>
                    </div>
                </div>
            </div>
            <?php 
            $acc_number = $config_web['account_number'];
            ?>
            <div id="res_donate_form"></div>
            <div class="form-group">
                <table class="table table-bordered" style="margin-top: 10px;" id="list_bank_account_number">
                    <thead>
                        <tr>
                            <th colspan="5">
                                <i style="color:red;">*</i>
                                Bank Types cannot be the same<br>
                                <small>(if you want to stay the same use like: BNI 2 / BNI 3)</small>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5">BANK</th>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Acc. Number</th>
                            <th>Code</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($acc_number['BANK_TRANSFER'])){
                            foreach ($acc_number['BANK_TRANSFER'] as $key => $val) { 
                                echo "
                                <tr>
                                    <td>$key</td>
                                    <td>$val[owner_name]</td>
                                    <td>$val[acc_no]</td>
                                    <td>$val[bank_code]</td>
                                    <td><button onclick='removeDonateInfo($(this));' type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>
                                </tr>"; 
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <table class="table table-bordered" style="margin-top: 10px;" id="list_dana_account_number">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <i style="color:red;">*</i>
                                DANA Name & Acc. Number cannot be the same
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">DANA</th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>Acc. Number</th> 
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($acc_number['DANA'])){
                            foreach ($acc_number['DANA'] as $key => $val) { 
                                echo "
                                <tr>
                                    <td>$val</td> 
                                    <td>$key</td>
                                    <td><button onclick='removeDonateInfo($(this));' type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>
                                </tr>"; 
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <table class="table table-bordered" style="margin-top: 10px;" id="list_paypal_account_number">
                    <thead>
                        <tr>
                            <th colspan="2">
                                <i style="color:red;">*</i>
                                Paypal Name cannot be the same 
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">PAYPAL</th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($acc_number['PAYPAL'])){
                            foreach ($acc_number['PAYPAL'] as $key => $val) { 
                                echo "
                                <tr>
                                    <td>$val</td>
                                    <td><button onclick='removeDonateInfo($(this));' type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>
                                </tr>"; 
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
             
	        <button type="button" id="btn_save_web_config" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){

    <?php if($this->session->flashdata('success_webconfig')): ?>
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
                    window.location.reload();
                    break;
                }
        });
    <?php elseif($this->session->flashdata('error_webconfig')): ?>
        swal("Warning",
            "<?= $this->session->flashdata('error_webconfig'); ?>",
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
    <?php endif; ?>
        

    document.getElementById("input_logo_img").onchange = evt => {
        const [file] = document.getElementById("input_logo_img").files;

        if (file) {
            document.getElementById("img_logo_img").src = URL.createObjectURL(file);
        }
    }

    document.getElementById("input_favico_img").onchange = evt => {
        const [file] = document.getElementById("input_favico_img").files;

        if (file) {
            document.getElementById("img_favico_img").src = URL.createObjectURL(file);
        }
    }
    // img_logo_img
    // img_favico_img

    $("#btn_save_web_config").click(function(ev){
        let t_form = $("#form_web_config");
        let input_other_maintenance = '';
        let input_bank_account_number = [];
        let input_dana_account_number = [];
        let input_paypal_account_number = [];

        let post_data = f_main.objectifyForm(t_form.serializeArray()); 
        delete post_data['input_other_maintenance'];

        $.each($("#list_other_mt tbody tr"), function(idx,key){
            let t = $(this);
            input_other_maintenance += ($.trim(t.find('td').eq(0).text()))+',';
        });
        if(input_other_maintenance.length>0){
            input_other_maintenance = input_other_maintenance.substr(0,input_other_maintenance.length-1);
        }
        post_data.input_other_maintenance = input_other_maintenance;

        $.each($("#list_bank_account_number tbody tr"), function(idx,key){
            let t = $(this);
            let bank_type = f_main.xssClean($.trim(t.find('td').eq(0).text()));
            let bank_name = f_main.xssClean($.trim(t.find('td').eq(2).text()));
            let bank_acc_no = f_main.xssClean($.trim(t.find('td').eq(1).text()));
            let bank_code = f_main.xssClean($.trim(t.find('td').eq(3).text()));

            input_bank_account_number[bank_type] = {
                'acc_no' : bank_acc_no,
                'owner_name' : bank_name,
                'bank_code' : bank_code,
            };
        });
        input_bank_account_number = Object.assign({}, input_bank_account_number);

        $.each($("#list_dana_account_number tbody tr"), function(idx,key){
            let t = $(this);
            let dana_name = f_main.xssClean($.trim(t.find('td').eq(0).text()));
            let dana_acc_no = f_main.xssClean($.trim(t.find('td').eq(1).text()));

            input_dana_account_number[dana_acc_no] = dana_name;
        });
        input_dana_account_number = Object.assign({}, input_dana_account_number);

        $.each($("#list_paypal_account_number tbody tr"), function(idx,key){
            let t = $(this);
            let paypal_name = f_main.xssClean($.trim(t.find('td').eq(0).text()));

            input_paypal_account_number[idx] = paypal_name;
        });
        input_paypal_account_number = Object.assign({}, input_paypal_account_number);

        let account_number = {
            'BANK_TRANSFER' : input_bank_account_number,
            'DANA' : input_dana_account_number,
            'PAYPAL' : input_paypal_account_number
        };
        account_number = JSON.stringify(account_number);
        
        // ev.preventDefault();
        $.ajax({
            url: baseURL+"adm/go_save_web_config",
            method: "POST",
            data: {
                post_data : post_data,
                account_number : account_number
            },
            success: function(data) {
                if(data.result !== true){
                    swal("Warning",
                        data.result,
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
                $("#form_file_web_config").submit();
            }
        })
    });

    $("#btn_open_add_donate_form").click(function(){
        let res = $("#res_donate_form");
        let slc = $("#input_donate_type");

        switch(slc.val()){
            case "bank":
                res.html('');
                res.html(`
                    <div class="form-group">
                        <table class="table table-bordered" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th colspan="4" style="color:red;">
                                        FORM DONATE (${slc.find('option:selected').text().trim()})
                                    </th>
                                </tr>
                                <tr>
                                    <th><?= ucwords('Type'); ?></th>
                                    <th><?= ucwords('Name'); ?></th>
                                    <th><?= ucwords('Acc. Number'); ?></th>
                                    <th><?= ucwords('Code'); ?></th>
                                    <th style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="<?= ucwords('Type'); ?>" name="input_donate_type" id="input_donate_type" value="">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="<?= ucwords('Name'); ?>" name="input_donate_name" id="input_donate_name" value="">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="<?= ucwords('Acc. Number'); ?>" name="input_donate_number" id="input_donate_number" value="">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="<?= ucwords('Code'); ?>" name="input_donate_code" id="input_donate_code" value="">
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-primary" type="button" id="btn_add_new_donate">Add</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                `);
                break;

            case "dana":
                res.html('');
                res.html(`
                    <div class="form-group">
                        <table class="table table-bordered" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th colspan="3" style="color:red;">
                                        FORM DONATE (${slc.find('option:selected').text().trim()})
                                    </th>
                                </tr>
                                <tr>
                                    <th><?= ucwords('Name'); ?></th>
                                    <th><?= ucwords('Acc. Number'); ?></th> 
                                    <th style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="<?= ucwords('Name'); ?>" name="input_donate_name" id="input_donate_name" value="">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="<?= ucwords('Acc. Number'); ?>" name="input_donate_number" id="input_donate_number" value="">
                                    </td> 
                                    <td>
                                        <button class="btn btn-outline-primary" type="button" id="btn_add_new_donate">Add</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                `);
                break;

            case "paypal":
                res.html('');
                res.html(`
                    <div class="form-group">
                        <table class="table table-bordered" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th colspan="2" style="color:red;">
                                        FORM DONATE (${slc.find('option:selected').text().trim()})
                                    </th>
                                </tr>
                                <tr>
                                    <th><?= ucwords('Name'); ?></th> 
                                    <th style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="<?= ucwords('Name'); ?>" name="input_donate_name" id="input_donate_name" value="">
                                    </td> 
                                    <td>
                                        <button class="btn btn-outline-primary" type="button" id="btn_add_new_donate">Add</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                `);
                break;
        }
        $("#btn_add_new_donate").click(function(){
            let input_donate_type = $("input#input_donate_type");
            let input_donate_name = $("input#input_donate_name");
            let input_donate_number = $("input#input_donate_number");
            let input_donate_code = $("input#input_donate_code");

            switch(slc.val()){
                case "bank": 
                    let list_bank_account_number = $("#list_bank_account_number tbody");

                    list_bank_account_number.append(`
                        <tr>
                            <td>${$.trim(input_donate_type.val())}</td>
                            <td>${$.trim(input_donate_name.val())}</td>
                            <td>${$.trim(input_donate_number.val())}</td>
                            <td>${$.trim(input_donate_code.val())}</td>
                            <td><button onclick='removeDonateInfo($(this));' type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>
                        </tr>
                    `);
                    break;
                    
                case "dana": 
                    let list_dana_account_number = $("#list_dana_account_number tbody");

                    list_dana_account_number.append(`
                        <tr>
                            <td>${$.trim(input_donate_name.val())}</td>
                            <td>${$.trim(input_donate_number.val())}</td>
                            <td><button onclick='removeDonateInfo($(this));' type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>
                        </tr>
                    `);
                    break;
                    
                case "paypal":  
                    let list_paypal_account_number = $("#list_paypal_account_number tbody");

                    list_paypal_account_number.append(`
                        <tr>
                            <td>${$.trim(input_donate_name.val())}</td> 
                            <td><button onclick='removeDonateInfo($(this));' type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>
                        </tr>
                    `);
                    break;
            }
        });
    });

    $("#btn_add_other_mt").click(function() {
        let list_other_mt = $("#list_other_mt tbody");
        let input_other_maintenance = $("#input_other_maintenance");

        list_other_mt.append(`
            <tr>
                <td>${$.trim(input_other_maintenance.val())}</td>
                <td><button onclick='removeMt($(this));' type='button' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>
            </tr>
        `);
    });
	// $('.summernote').summernote({height: 250}); 
});
function removeDonateInfo(t){
    swal("Question",
        "Are you sure?",
        "warning",
        {
        buttons: { 
            button_1: "No", 
            button_2: "Yes", 
        },
    })
    .then((value) => {
        switch (value) {
            case "button_2":
                t.parents('tr').remove();
                break;
        }
    });
}
function removeMt(t){
    swal("Question",
        "Are you sure?",
        "warning",
        {
        buttons: { 
            button_1: "No", 
            button_2: "Yes", 
        },
    })
    .then((value) => {
        switch (value) {
            case "button_2":
                t.parents('tr').remove();
                break;
        }
    });
}
</script>