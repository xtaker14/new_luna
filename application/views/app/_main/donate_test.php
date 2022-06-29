
<!-- <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">  -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script src="https://app-sandbox.duitku.com/lib/js/duitku.js"></script> 

<div class="bg-light p-4 border shadow">
    <!-- Form -->
    <form>

        <center>
            <h4>Duitku Pop</h4>
        </center>
        <br>

        <div class="mb-2">
            <label>Amount</label>
            <input required id="amount" min="1" value="10000" type="number" class="form-control"
                placeholder="10000">
        </div>

        <div class="mb-2">
            <label>Product Detail</label>
            <input required id="productDetail" value="Sepatu Trendy" type="text" class="form-control"
                placeholder="Sepatu Trendy">
        </div>

        <div class="mb-2">
            <label>Email</label>
            <input required id="email" value="customer@duitku.com" type="text" class="form-control"
                placeholder="customer@duitku.com">
        </div>

        <div class="mb-2">
            <label>Phone Number</label>
            <input required id="phoneNumber" value="08123456789" type="number" class="form-control"
                placeholder="08123456789">
        </div>

        <div class="mb-2">
            <label>Payment Interface</label>
            <select id="paymentUi" class="form-control">
                <option value="1">PopUp UI </option>
                <option value="2">Redirect UI</option>
            </select>
        </div>

        <button type="button" id="submit" class="btn btn-primary w-100 my-2 shadow"
            onClick="payment();">Purchase</button>

    </form>
    <!-- Form -->
</div>

<!-- Request to backend with ajax (example)  -->
<script type="text/javascript">
    let xepo_secure_name = "<?=$xepo_secure['name'];?>";
    let xepo_secure_value ="<?=$xepo_secure['hash'];?>";

    function payment() {
        var amount = document.getElementById("amount").value;
        var productDetail = document.getElementById("productDetail").value;
        var email = document.getElementById("email").value;
        var phoneNumber = document.getElementById("phoneNumber").value;
        var paymentUi = document.getElementById("paymentUi").value;

        $.ajax({
            type: "POST",
            data: {
                // Parameter PaymentMethod is optional
                // paymentMethod: '', // PaymentMethod list => https://docs.duitku.com/pop/id/#payment-method
                paymentAmount: amount,
                productDetail: productDetail,
                email: email,
                phoneNumber: phoneNumber,
                [xepo_secure_name] : xepo_secure_value,
            },
            url: '<?= base_url(); ?>go_donate',
            // url: 'CreateInvoice.php',
            dataType: "json",
            cache: false,
            success: function (result) {
                // console.log(result.reference);
                console.log(result, 'test 2');

                xepo_secure_name = result.xepo_name;
                xepo_secure_value = result.xepo_value; 

                if (paymentUi === "2") { // user redirect payment interface
                    window.location = result.paymentUrl;
                }

                checkout.process(result.reference, {
                    successEvent: function (result) {
                        // begin your code here
                        // console.log('success');
                        console.log(result); 
                        
                        swal("Success",
                            "Payment Success",
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
                    },
                    pendingEvent: function (result) {
                        // begin your code here
                        // console.log('pending');
                        console.log(result);

                        swal("Error:",
                            'Payment Pending',
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
                    },
                    errorEvent: function (result) {
                        // begin your code here
                        // console.log('error');
                        console.log(result);

                        swal("Error:",
                            'Payment Error',
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
                    },
                    closeEvent: function (result) {
                        // begin your code here 
                        console.log(result); 

                        swal("Error:",
                            'You have canceled the transaction',
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
                    }
                });

            },
        });

    }
</script> 