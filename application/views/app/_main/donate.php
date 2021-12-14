<!-- <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $midtrans_client_key; ?>"></script> -->

<div class="card" style="margin-top: 30px;" data-aos="fade-left" data-aos-delay="400">
    <div class="card-header bg-white">
        <div class="box_header_title" style="">
            <span></span>
            <span></span>
            <div class="content_header_title">
                <h2>
                    DONATE 
                    <i class="fas fa-gem ml-1" data-fa-transform="rotate-30"></i>
                </h2>
            </div>
        </div>

        <small class="text-secondary">
            <i>
                Don't Donate/Top-Up at <span style="color: red;">23.00 - 24.00 (Server Time)</span> because at <span style="color: red;">24:00 (Server Time)</span> yesterday's <span style="color: red;">"Unpaid Donation"</span> data will be <span style="color: red;">deleted</span>.
            </i>
        </small>  
    </div>


    <div class="card-body">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    DONATION FORM
                </h3>
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
                                    <select class="form-control" name="input_amount" id="input_amount">
                                        <?php foreach ($donate_price_list as $key => $val) : ?>
                                            <?php 
                                                if($val['is_hidden'] == 'yes'){
                                                    continue;
                                                }
                                                $currency = $val['currency'];
                                                $float_num = 0;
                                                if($currency === 'USD'){
                                                    $float_num = 2;
                                                }
                                                $value = number_format($val['value'],0,',','.');
                                                $price = number_format($val['price'],$float_num,',','.');
                                                $descr = $val['description'];
                                            ?>
                                            <option value="<?= $val['id'].'|'.$val['value']; ?>">
                                                <?= $value.' Diamonds - '.$currency.' '.$price.' '.$descr; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr> 
                            <tr style="">
                                <td class="alt1" style="font-size:12px">REFERRAL CODE</td>
                                <td class="alt1">
                                    <input type="text" name="input_referral_code" class="form-control" placeholder="ENTER REFERRAL CODES">
                                </td>
                            </tr> 
                            <tr>
                                <td class="" colspan="2">
                                    <input type="hidden" name="<?=$xepo_secure['name'];?>" value="<?=$xepo_secure['hash'];?>" />
					                <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
                                    <?php $this->load->view("app/_part/button_border.php",array(
                                        'part_bb_txt'=> 'BUY NOW',
                                        'part_bb_element'=> 'button',
                                        'part_bb_type'=> 'button',
                                        'part_bb_class'=>'btn-hover color-blue m-1', 
                                        'part_bb_t_id'=>'btn_donate_now', 
                                        'part_bb_t_name'=>'btn_donate_now', 
                                        'part_bb_style'=> 'width:100%; font-size:1rem; letter-spacing:2px;margin-bottom:0px;',
                                    )); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div> 
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    DONATION LIST
                </h3>
            </div>
            <div class="panel-body"> 
                <div class="table-responsive">
                    <table id="donate_table" class="fl-table table fl-not-responsive-table table-striped table-sm mt-4 dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr> 
                                <th scope="col">ID</th>
                                <th scope="col">Bill</th>
                                <th scope="col">Diamonds</th>
                                <th scope="col">Payment</th> 
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($donate_list as $key => $val) : ?>
                            <?php 
                                $currency = $val['currency'];
                                $float_num = 0;
                                $total_bill = $val['total_bill'];
                                if($currency === 'USD'){
                                    $float_num = 2; 
                                } 
                            ?>
                                <tr> 
                                    <td><?= $val['id']; ?></td>
                                    <td><?= $currency.' '.number_format($total_bill,$float_num,',','.'); ?></td>
                                    <td><?= number_format($val['donate_point'],0,',','.'); ?></td>
                                    <td>
                                        <?php if($val['payment_method']==='qris') : ?>
                                            ShopeePay
                                        <?php elseif($val['payment_method']==='bank_transfer') : ?>
                                            Bank 
                                            <?php if(!empty($val['midtrans_va_bank'])) : ?>
                                            (<?= strtoupper($val['midtrans_va_bank']); ?>)
                                            <?php endif; ?>
                                        <?php elseif($val['payment_method']==='gopay') : ?>
                                            Gopay
                                        <?php elseif($val['payment_method']==='echannel') : ?>
                                            Bank (MANDIRI)
                                        <?php elseif($val['payment_method']==='credit_card') : ?>
                                            Credit Card
                                        <?php else: ?>
                                            <?php 
                                                echo $val['payment_method']; 
                                                if(!empty($val['cekmutasi_service_name'])){
                                                    echo '<br> With '.$val['cekmutasi_service_name']; 
                                                }
                                            ?>
                                        <?php endif; ?>
                                    </td> 
                                    <td>
                                        <?php 
                                            if($val['status'] == 'canceled'){
                                                $this->load->view("app/_part/button_border.php",array(
                                                    'part_bb_txt'=> '<i class="fas fa-hourglass-half"></i>&nbsp;'.strtoupper('cancelled'),
                                                    'part_bb_element'=> 'button',
                                                    'part_bb_type'=> 'button',
                                                    'part_bb_attr_plus'=> 'onclick="popCheckDonate('.$val['id'].');"',
                                                    'part_bb_class'=>'btn-hover color-red', 
                                                    'part_bb_style'=> 'width:100%; font-size:0.80rem; letter-spacing:2px;margin-bottom:0px;',
                                                )); 
                                            }else{
                                                $this->load->view("app/_part/button_border.php",array(
                                                    'part_bb_txt'=> '<i class="fas fa-hourglass-half"></i>&nbsp;'.strtoupper($val['status']),
                                                    'part_bb_element'=> 'button',
                                                    'part_bb_type'=> 'button',
                                                    'part_bb_attr_plus'=> 'onclick="popCheckDonate('.$val['id'].');"',
                                                    'part_bb_class'=>'btn-hover color-blue', 
                                                    'part_bb_style'=> 'width:100%; font-size:0.80rem; letter-spacing:2px;margin-bottom:0px;',
                                                )); 
                                            }
                                        ?>
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
        pageLength: 10,
        lengthChange: true,
        info: true,
        bLengthChange: false,
        dom:' <"search"f><"top"l>rt<"bottom"ip><"clear">',
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

    $("#input_amount").change(function(){
        let t = $(this);
        changeAmount(t);
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
                    donateNow(t);
                    break;
                }
        });
    }); 
    
	$('html').removeClass('no-js');
}); 

function changeAmount(t){
    let exp_val = t.val().split('|');
    let id_donate_price = exp_val[0];
    let tr = t.parents('tr');

    f_main.loading(true); 
    $.ajax({
        url: '<?= base_url(); ?>donate/get_bonus_items',
        data : {
            id_donate_price : id_donate_price,
            [xepo_secure_name] : xepo_secure_value,
        },
        type : "POST",
        dataType : "json",
        success: function(res) {
            xepo_secure_name = res.xepo_name;
            xepo_secure_value = res.xepo_value;

            if(res.result){
                if($("#res_bonus_items").length>0){
                    $("#res_bonus_items").remove();
                }
                f_main.loading(false,function(){
                    if(res.data != undefined){ 
                        let bonus_items = ``;
                        $.each(res.data, function(idx,key){
                            bonus_items += `<li>x${key.items_qty} ${key.items_name}</li>`;
                        });

                        tr.after(`
                            <tr id="res_bonus_items">
                                <td class="alt1" style="font-size:12px">BONUS ITEMS</td>
                                <td class="alt1">
                                    <ul>
                                        ${bonus_items}
                                    </ul>
                                </td>
                            </tr>
                        `);
                    }
                });
            } 
        }
    });
}

function donateNow(t){
    let data_donate = $("#form_donate").serializeObject();
    data_donate[xepo_secure_name] = xepo_secure_value;
    $.ajax({
        url: '<?= base_url(); ?>go_donate',
        data : data_donate,
        type : "POST",
        dataType : "json",
        success: function(data) {
            f_main.loading(false,function(){
                xepo_secure_name = data.xepo_name;
                xepo_secure_value = data.xepo_value; 
                if(data.result !== true){
                    swal("Error",
                        data.result,
                        "warning",
                    {
                        buttons: { 
                            button_1: {text:'OK', className:'btn-black'},
                        },
                    })
                    .then((value) => {
                        switch (value) {
                            default: 
                                window.location.reload();
                                break;
                            }
                    });
                }else{
                    swal("Success",
                        "Successfully made a donate request, please make a payment to complete the donate process",
                        "success",
                    {
                        buttons: { 
                            // button_1: {text:'No', className:'btn-black'},
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
                }
            });
        }
    }); 
}

function popCheckDonate(id){
    let donate_popup = $("#donate_popup");
    let status = 'check'; 

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
// function _backup_donateNow(t){
//     let data_donate = $("#form_donate").serializeObject();
//     data_donate[xepo_secure_name] = xepo_secure_value;
//     $.ajax({
//         url: '<?= base_url(); ?>go_donate',
//         data : data_donate,
//         type : "POST",
//         dataType : "json",
//         success: function(data) {
//             if(data.result !== true){
//                 swal("Error",
//                     data.result,
//                     "warning",
//                 {
//                     buttons: { 
//                         button_1: {text:'OK', className:'btn-black'},
//                     },
//                 })
//                 .then((value) => {
//                     switch (value) {
//                         default: 
//                             window.location.reload();
//                             break;
//                         }
//                 });
//             }else{
//                 xepo_secure_name = data.xepo_name;
//                 xepo_secure_value = data.xepo_value;
//                 let order_id = data.data.order_id;
//                 let donate_id = data.data.donate_id;

//                 $.ajax({
//                     url: '<?= base_url(); ?>donate/get_token_donate?donate_id='+donate_id+'&order_id='+order_id,
//                     cache: false,
//                     success: function(data) {
//                         f_main.loading(false);
//                         // console.log('token = '+data);

//                         function changeResult(type,res_data){
//                             console.log(type, res_data, JSON.stringify(res_data));
//                             processPayment(data, type, res_data, donate_id, order_id);
//                         }

//                         snap.pay(data, { 
//                             onSuccess: function(result){
//                                 changeResult('success', result);
//                             },
//                             onPending: function(result){
//                                 changeResult('pending', result);
//                             },
//                             onError: function(result){
//                                 changeResult('error', result);
//                             }
//                         });
//                     },
//                     error: function (xhr, ajaxOptions, thrownError) {
//                         deleteTempOrder(donate_id,xepo_secure_name,xepo_secure_value);
//                         // alert(xhr.status);
//                         // alert(thrownError);
//                     }
//                 });

//                 function processPayment(token, type, res_data, donate_id, order_id){
//                     $.ajax({
//                         url: '<?= base_url(); ?>donate/process_payment',
//                         data : {
//                             donate_id : donate_id, 
//                             order_id : order_id, 
//                             token : token, 
//                             type : type, 
//                             res_data : res_data,
//                             [xepo_secure_name] : xepo_secure_value,
//                         },
//                         type : "POST",
//                         dataType : "json",
//                         success: function(data) {
//                             xepo_secure_name = data.xepo_name;
//                             xepo_secure_value = data.xepo_value;
//                             if(type === 'success'){
//                                 swal("Success",
//                                     "Donate successfully",
//                                     "success",
//                                 {
//                                     buttons: { 
//                                         button_1: "OK",
//                                     },
//                                 })
//                                 .then((value) => {
//                                     switch (value) {
//                                         default: 
//                                             window.location.reload();
//                                             break;
//                                         }
//                                 });
//                             }
//                             if(type === 'pending'){
//                                 swal("Success",
//                                     "Successfully made a donate request, please make a payment to complete the donate process",
//                                     "success",
//                                 {
//                                     buttons: { 
//                                         // button_1: {text:'No', className:'btn-black'},
//                                         button_1: "OK", 
//                                     },
//                                 })
//                                 .then((value) => {
//                                     switch (value) {
//                                         default: 
//                                             window.location.reload();
//                                             break;
//                                         }
//                                 });
//                             }
//                             if(type === 'error'){
//                                 swal("Warning",
//                                     "Failed to make a donation request, please refresh the page and try again later or ask the staff about the problem on discord/fanspage",
//                                     "warning",
//                                 {
//                                     buttons: { 
//                                         button_1: {text:'OK', className:'btn-black'},
//                                     },
//                                 })
//                                 .then((value) => {
//                                     switch (value) {
//                                         default: 
//                                             window.location.reload();
//                                             break;
//                                         }
//                                 });
//                             }
//                         },
//                         error: function (xhr, ajaxOptions, thrownError) {
//                             deleteTempOrder(donate_id,xepo_secure_name,xepo_secure_value);
//                             // alert(xhr.status);
//                             // alert(thrownError);
//                         }
//                     });
//                 }
//             }
//         }
//     });
// }

// function deleteTempOrder(donate_id,xepo_secure_name,xepo_secure_value){
//     $.ajax({
//         url: '<?= base_url(); ?>donate/delete_temp_order',
//         data : {
//             donate_id : donate_id,
//             [xepo_secure_name] : xepo_secure_value,
//         },
//         type : "POST",
//         dataType : "json",
//         success: function(data) {
//             xepo_secure_name = data.xepo_name;
//             xepo_secure_value = data.xepo_value;
//             console.log('success delete temp order');
//         }
//     });
// }

</script>