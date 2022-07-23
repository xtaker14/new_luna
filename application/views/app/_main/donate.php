<!-- <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php //$midtrans_client_key; ?>"></script> -->

<div class="card p-1" data-aos="fade-left" data-aos-delay="0" style="height: 100%;"> 
	<div class="card-body" style="height: 100%; background: #2a88ed; border-radius:4px;">
    
		<div class="d-md-flex mb-2" style="padding-top: 0px !important; padding-bottom: 2px !important;"> 
			<div class="d-block" style="width: 100%;">
				<img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
				<h3 style="padding-bottom:5px;margin:0px;color:#fff;" class="border-bottom">Purchase Diamonds</h3>
			</div> 
		</div> 

        <div class="row">
            <div class="col-12"> 
                <!-- <h4 style="text-align: center; color: #fff; margin-top:15px;">--Coming Soon--</h4> -->
                <div class="form-group d-block border p-2" style="border: 2px solid black !important; background: #fff;">
                    <p>
                        <b>RULES:</b><br> 
                        <ul>
                            <li>
                                All payment options excluding <b><i>PayPal</i></b> are only available to <b>Indonesian</b> users. For international users, please choose <b><i>PayPal</i></b>.
                            </li>
                            <li>
                                <b>About Visa/Mastercard (credit card option):</b><br>
                                <b>Credit Card</b> payment option is only available for <b>Indonesian</b> Card, with a maximum of IDR 1.000.000 per transaction.<br>
                                For International <b>Credit Card</b> or transaction over IDR 1.000.000, please use <b>Credit Card</b> option through <b><i>PayPal</i></b>.
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>

        <div class="panel panel-primary" style="margin-top: 10px;">
            <div class="panel-body"> 

                <form id="form_donate" method="post" action="" method="post" accept-charset="utf-8">
                    <table class="table table-striped" align="center">
                        <tbody>
                            <tr>
                                <td class="alt2" style="font-size:12px; color: #fff;"><b>USERNAME</b></td>
                                <td class="alt1" style="font-size:13px; color: #fff;">
                                    <input type="hidden" class="form-control" name="input_username" id="input_username" value="<?= $id_loginid; ?>" hidden="">
                                    <?= $id_loginid; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="alt2" style="font-size:12px; color: #fff;"><b>EMAIL</b></td>
                                <td class="alt1" style="font-size:13px; color: #fff;">
                                    <?= $id_email; ?>
                                </td>
                            </tr>
                            <tr style="">
                                <td class="alt1" style="font-size:12px; color: #fff;">
                                    <b>REFERRAL CODE</b><br>
                                    <small>(Optional)</small>
                                </td>
                                <td class="alt1">
                                    <input type="text" name="input_referral_code" id="input_referral_code" class="form-control" placeholder="ENTER REFERRAL CODES">
                                </td>
                            </tr> 
                            <tr>
                                <td class="alt2" style="font-size:12px; color: #fff;"><b>PRICE LIST</b></td>
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
                                            <option value="<?= $val['id']; ?>">
                                                <?= $value.' Diamonds - '.$currency.' '.$price.' '.$descr; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr> 
                            <tr>
                                <td class="alt2" style="font-size:12px; color: #fff;"><b>PAYMENT METHOD</b></td>
                                <td class="alt1">
                                    <div id="parent_payment_method" style="color: #fff;">
                                        --Choose One Price List--
                                    </div>
                                </td>
                            </tr> 
                            <tr>
                                <td class="" colspan="2">
                                    <input type="hidden" name="<?=$xepo_secure['name'];?>" value="<?=$xepo_secure['hash'];?>" />
					                <input type="hidden" id="g_recaptcha" name="g-recaptcha-response">
                                    
                                    <button type="button" id="btn_purchase" class="btn-three">BUY DIAMONDS</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div> 
        
        <!-- <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #fff;">
                    HISTORY
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
                                $total_bill = $val['bill'];
                                if($currency === 'USD'){
                                    $float_num = 2; 
                                } 
                            ?>
                                <tr> 
                                    <td><?= $val['id']; ?></td>
                                    <td><?= $currency.' '.number_format($total_bill,$float_num,',','.'); ?></td>
                                    <td><?= number_format($val['donate_point'],0,',','.'); ?></td>
                                    <td>
                                        -
                                    </td> 
                                    <td>
                                        <?php 
                                            $cls_btn_status = 'btn-three';
                                            if($val['status'] == 'canceled' || $val['status'] == 'pending'){
                                                $cls_btn_status = 'btn-two';
                                            }
                                        ?>
                                        <button type="button" class="<?= $cls_btn_status; ?>" onclick="popCheckDonate('<?= $val['id']; ?>');">
                                            <?= strtoupper($val['status']); ?>
                                        </button> 
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table> 
                </div> 
            </div>
        </div>   -->
    </div>
</div>

<?php $this->load->view("app/_part/donate_js.php") ?>

<script type="text/javascript">
let xepo_secure_name = "<?=$xepo_secure['name'];?>";
let xepo_secure_value ="<?=$xepo_secure['hash'];?>";
var enable_payment = true;
var last_payment_price = 0;

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

    $("#input_amount").change(function(){
        let t = $(this);
        changeAmount(t);
    });

    setTimeout(() => {
        $("#input_amount").change();
    }, 400);

    $("#btn_purchase").click(function(ev){
        paymentDuitku();
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
            }, 
            tryCount : 0,
            retryLimit : 3,
            type : "POST",
            dataType : "json",
            success: function(res) {

                if(res.result){
                    if($("#res_bonus_items").length>0){
                        $("#res_bonus_items").remove();
                    }
                    f_main.loading(false,function(){
                        if(res.payment != false){ 
                            let payment_method = ``;
                            $.each(res.payment, function(idx,key){
                                let payment_fee = ``;
                                if(key.totalFee>0){
                                    payment_fee = `<br/><small><strong>(Fee : ${key.totalFee})</strong></small>`;
                                }
                                payment_method += `
                                    <div class="child_payment_method col-4">
                                        <label>
                                            <img src="${key.paymentImage}" style="visibility: visible;" />
                                            <span style="margin-top: auto;">
                                                <input required type="radio" name="input_payment" value="${key.paymentMethod}"/> ${key.paymentName}${payment_fee}
                                            </span>
                                        </label> 
                                    </div> 
                                `;
                            });
                            
                            $("#parent_payment_method").html(`
                                <div class="row">${payment_method}</div>
                            `);
                        }else{
                            $("#parent_payment_method").html(`--Choose One Price List--`);
                        }
                        
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
            },
            error : function(xhr, textStatus, errorThrown ) {
                if (textStatus == 'timeout') {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        //try again
                        $.ajax(this);
                        return;
                    }            
                    return;
                }
                if (xhr.status == 500) {
                    //handle error
                } else {
                    //handle error
                }
            }
        });
    } 

    function paymentDuitku() { 
        let input_amount = document.getElementById("input_amount").value;
        // let input_payment = document.getElementById("input_payment").value;
        let input_payment = $('input[name="input_payment"]:checked').val(); 
        let input_referral_code = document.getElementById("input_referral_code").value;
        let g_recaptcha = document.getElementById("g_recaptcha").value;
        // let input_product = document.getElementById("input_product").value;
        // let input_email = document.getElementById("input_email").value;
        // let input_phone = document.getElementById("input_phone").value;
        // var paymentUi = document.getElementById("paymentUi").value;

        if(input_amount.length == 0){
            swal("Warn:",
                'Please select a price in the price list',
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

        if(input_amount <= 0){
            swal("Warn:",
                'Please select a price in the price list',
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

        if(input_payment == undefined || input_payment.length == 0){
            swal("Warn:",
                'Please select a payment method',
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
                    // if(!enable_payment){
                    //     swal("Warn:",
                    //         'Session has expired, please reload/refresh this page',
                    //         "warning",
                    //     {
                    //         buttons: {  
                    //         button_1: "OK", 
                    //         },
                    //     })
                    //     .then((value) => {
                    //         switch (value) {
                    //             default:  
                    //                 break;
                    //         }
                    //     });
                        
                    //     return false;
                    // }

                    // if(enable_payment !== false && enable_payment !== true && last_payment_price == input_amount){
                    //     checkoutProcess(enable_payment);
                    //     return false;
                    // }

                    // enable_payment = false;
                    
                    f_main.loading(true);

                    $.ajax({
                        type: "POST",
                        data: {
                            // Parameter PaymentMethod is optional
                            // paymentMethod: '', // PaymentMethod list => https://docs.duitku.com/pop/id/#payment-method
                            input_amount: input_amount,
                            input_payment: input_payment,
                            input_referral_code: input_referral_code,
                            g_recaptcha: g_recaptcha,
                            [xepo_secure_name] : xepo_secure_value,
                        },
                        url: '<?= base_url(); ?>go_donate',
                        // url: 'CreateInvoice.php',
                        dataType: "json",
                        cache: false,
                        success: function (result) {
                            // console.log(result.reference);
                            // console.log(result, 'test'); 
                            xepo_secure_name = result.xepo_name;
                            xepo_secure_value = result.xepo_value; 

                            if(result.result !== true){
                                f_main.loading(false,function(){ 
                                    swal("Error",
                                        result.result,
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
                                });
                            }else{
                                last_payment_price = input_amount;

                                // if (paymentUi === "2") { // user redirect payment interface
                                //     window.location = result.paymentUrl;
                                // } 
                                
                                f_main.loading(false,function(){
                                    checkoutProcess(result.reference);
                                });
                            }
                        },
                    });
                    break;
                }
        }); 

    }
    
	$('html').removeClass('no-js');
}); 

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

// function popCheckDonate_backup(id){
//     let donate_popup = $("#donate_popup");
//     let status = 'check_status'; 

//     f_main.loading(true);
//     $.ajax({
//         type : "POST",
//         dataType : "json",
//         data : {
//             id : id,
//             [xepo_secure_name] : xepo_secure_value,
//         },
//         url : baseURL+"donate/popup/"+status,
//         success:function(res){
//             f_main.loading(false,function(){
//                 xepo_secure_name = res.xepo_name;
//                 xepo_secure_value = res.xepo_value;
                
//             });
//         }
//     });  

// } 

// let oldXHROpen = window.XMLHttpRequest.prototype.open;
// window.XMLHttpRequest.prototype.open = function(method, url, async, user, password) {
//     // do something with the method, url and etc.
//     this.addEventListener('load', function() {
//         // do something with the response text
//         console.log('load: ' + this.responseText);
//     });
//     return oldXHROpen.apply(this, arguments);
// }

// $(document).ajaxSuccess(function(e, xhr, settings) {
//     // console.log(e);
//     console.log(xhr);
//     // console.log(settings);
// });


// window.isTop = true;
// window.addEventListener("message", (event) => {
//     if (event.data &&
//         event.data.sender == "get_page_button1") {
//         if (window.isTop) {
//             alert("Main window alert");
//         } else {
//             alert("Frame window alert 1");
//         }
//     }
// });
// if (!window.isTop) {
//     window.addEventListener("message", (event) => {
//         if (event.data &&
//             event.data.sender == "get_page_button2") {
//             alert("Frame window alert 2");
//         }
//     });
// }

// window.document.addEventListener('readystatechange', () => {
//         if (window.document.readyState == 'complete') {
//             msgAddEventListener();
//         }
//     }
// );
// function msgAddEventListener(){
//     let urlButton = window.document.getElementById("get_page");
//     urlButton.addEventListener("click", () => {
//         let url = window.document.getElementById("page_url").value;
//         document.getElementById('duitku-payment').contentWindow.postMessage(
//             {
//                 sender: "get_page_button1",
//                 message: url
//             },
//             "*"
//         );
//         document.getElementById('duitku-payment').contentWindow.postMessage(
//             {
//                 sender: "get_page_button2",
//                 message: url
//             },
//             "*"
//         );
//     });
// } 

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