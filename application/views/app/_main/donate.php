 
<div class="card" style="margin-top: 30px;" data-aos="fade-left" data-aos-delay="400">
	<div class="card-header bg-white"> 
		<div class="box_header_title" style="">
			<span></span>
			<span></span> 
			<div class="content_header_title">
				<h2> 
				    DONATE<i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i>
				</h2> 
			</div>
		</div>

		<small class="text-secondary">
            <i>
                <span style="color: red;">*</span> Get free Silver
                <i style="color: #b1c0d5 !important;" class="fas fa-coins ml-1" data-fa-transform="rotate-30"></i>
                from REFERRAL CODE
            </i>
        </small>
	</div>


	<div class="card-body">  
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">DONATION FORM</h3>
            </div>
            <div class="panel-body">
                <form id="form_donate" method="post" action="<?= site_url('go_donate'); ?>" method="post" accept-charset="utf-8">
                    <table class="table table-striped" align="center">
                        <tbody>
                            <tr>
                                <td class="alt2" style="font-size:12px">USERNAME</td>
                                <td class="alt1" style="font-size:13px">
                                    <input type="hidden" class="form-control" name="input_username" value="<?= $id_loginid; ?>" hidden="">
                                    <?= $id_loginid; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="alt2" style="font-size:12px">DONATION TYPES</td>
                                <td class="alt1">
                                    <select class="form-control" name="input_amount">
                                        <?php foreach ($donate_price_list as $key => $val) : ?>
                                            <?php 
                                                $value = number_format($val['value'],0,',','.');
                                                $currency = $val['currency'];
                                                $price = number_format($val['price'],0,',','.');
                                                $descr = $val['description'];
                                            ?>
                                            <option value="<?= $val['id'].'|'.$val['value']; ?>">
                                                <?= $value.' Diamonds - '.$currency.' '.$price.' '.$descr; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr> 
                            <tr>
                                <td class="alt1" style="font-size:12px">REFERRAL CODE</td>
                                <td class="alt1">
                                    <input type="text" name="input_referral_code" class="form-control" placeholder="ENTER REFERRAL CODES">
                                </td>
                            </tr> 
                            <tr>
                                <td class="" colspan="2">
                                    <input type="hidden" name="<?=$xepo_secure['name'];?>" value="<?=$xepo_secure['hash'];?>" />
					                <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
                                    <input type="button" id="btn_donate_now" class="btn-hover btn color-blue w-50 mt-1 float-right" name="btn_donate_now" value="BUY NOW">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <div class="panel panel-primary" style="margin-top: 30px;">
            <div class="panel-heading">
                <h3 class="panel-title">DONATION LIST</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="donate_table" class="table table-striped table-sm mt-4 dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr> 
                                <th scope="col">ID</th>
                                <th scope="col">Bill</th>
                                <th scope="col">Diamonds</th>
                                <th scope="col">Referral</th> 
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($donate_list as $key => $val) : ?>
                                <tr> 
                                    <td><?= $val['id']; ?></td>
                                    <td><?= number_format($val['bill'],0,',','.'); ?></td>
                                    <td><?= number_format($val['donate_price'],0,',','.'); ?></td>
                                    <td>
                                        <?php 
                                            if(empty($val['referral_code'])){
                                                echo '-';
                                            }else{
                                                echo $val['referral_code'];
                                            }
                                        ?>
                                    </td> 
                                    <td>
                                        <?php if($val['status'] == 'pending'): ?>
                                            <button onclick="popPendingDonate(<?= $val['id']; ?>);" class="btn-hover btn color-orange" type="button">
                                                <?= ucwords($val['status']); ?>
                                            </button>
                                        <?php endif; ?>

                                        <?php if($val['status'] == 'paid'): ?>
                                            <button onclick="popPaidDonate(<?= $val['id']; ?>);" class="btn-hover btn color-blue" type="button">
                                                <?= ucwords($val['status']); ?>
                                            </button>
                                        <?php endif; ?>

                                        <?php if($val['status'] == 'complete'): ?>
                                            <button class="btn-hover btn color-green" type="button">
                                                <?= ucwords($val['status']); ?>
                                            </button>
                                        <?php endif; ?>

                                        <?php if($val['status'] == 'canceled'): ?>
                                            <button class="btn-hover btn color-darkred" type="button">
                                                <?= ucwords($val['status']); ?>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
        
	</div>
</div>


<script type="text/javascript">
let xepo_secure_name = "<?=$xepo_secure['name'];?>";
let xepo_secure_value ="<?=$xepo_secure['hash'];?>";

$(document).ready(function(){
    var donate_table = $('#donate_table').DataTable( {
        lengthChange: true,
        info: true,
        aaSorting: [],
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
                })
            }
        }
    });

    $("#btn_donate_now").click(function(ev){
        let t = $(this);
        swal("Question",
            "Are you sure?",
            "warning",
        {
            buttons: { 
                button_1: {text:'No', className:'btn-black'},
                button_2: "Yes", 
            },
        })
        .then((value) => {
            switch (value) {
                case 'button_2':
                    f_main.loading(true);
                    $("#form_donate").submit();
                    break;
                }
        });
    });

    $('#donate_popup #form_donate_status').submit(function(ev){
        f_main.loading(true);
        // f_main.loading(false,function(){});
    });
    
	$('html').removeClass('no-js');
}); 

function popPendingDonate(id){
    let donate_popup = $("#donate_popup");
    let status = 'pending';
    donate_popup.find('#form_donate_status').attr('action',baseURL+"donate/submit/"+status);

    f_main.loading(true);
    $.ajax({
        type : "POST",
        dataType : "json",
        data : {
            id : id,
            [xepo_secure_name] : xepo_secure_value,
        },
        url : baseURL+"donate/popup/"+status,
        success:function(res){
            f_main.loading(false,function(){
                xepo_secure_name = res.xepo_name;
                xepo_secure_value = res.xepo_value;
                donate_popup.find("#form_donate_status").html(res.result);
                donate_popup.modal("show");
            });
        }
    }); 
}

function popPaidDonate(id){
    let donate_popup = $("#donate_popup");
    let status = 'paid';
    donate_popup.find('#form_donate_status').attr('action',baseURL+"donate/submit/"+status);

    f_main.loading(true);
    $.ajax({
        type : "POST",
        dataType : "json",
        data : {
            id : id,
            [xepo_secure_name] : xepo_secure_value,
        },
        url : baseURL+"donate/popup/"+status,
        success:function(res){
            f_main.loading(false,function(){
                xepo_secure_name = res.xepo_name;
                xepo_secure_value = res.xepo_value;
                donate_popup.find("#form_donate_status").html(res.result);
                donate_popup.modal("show");
            });
        }
    }); 
}

</script>