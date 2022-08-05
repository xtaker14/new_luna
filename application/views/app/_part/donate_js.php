<!-- <script src="https://app-sandbox.duitku.com/lib/js/duitku.js"></script>  -->
<script src="https://app-prod.duitku.com/lib/js/duitku.js"></script> 

<script>
    function checkoutProcess(reference, is_check=false) { 
        checkout.process(reference, {
            successEvent: function (result_2) {
                // enable_payment = true;
                // begin your code here
                // console.log('success');
                console.log(result_2); 
                
                if(!is_check){
                    swal("Status:",
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
                                window.location.href = '<?= base_url(); ?>acc_history';
                                break;
                            }
                    });
                }
            },
            pendingEvent: function (result_2) {
                // enable_payment = reference;
                // begin your code here
                // console.log('pending');
                console.log(result_2);

                if(!is_check){
                    swal("Status:",
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
                                window.location.href = '<?= base_url(); ?>acc_history';
                                break;
                        }
                    });
                }
            },
            errorEvent: function (result_2) {
                // enable_payment = true;
                // begin your code here
                // console.log('error');
                console.log(result_2);

                if(result_2.resultCode == '02'){
                    if(!is_check){
                        swal("Status:",
                            'Payment Expired',
                            "warning",
                        {
                            buttons: {  
                            button_1: "OK", 
                            },
                        })
                        .then((value) => {
                            switch (value) {
                                default:  
                                    window.location.href = '<?= base_url(); ?>acc_history';
                                    break;
                            }
                        });
                    }
                }else{
                    swal("Status:",
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
                                window.location.href = '<?= base_url(); ?>acc_history';
                                break;
                        }
                    });
                }
            },
            closeEvent: function (result_2) {
                // enable_payment = reference;
                // begin your code here 
                console.log(result_2); 

                if(!is_check){
                    swal("Status:",
                        'You close the popup payment, check history in this URL (<?= base_url(); ?>acc_history)',
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
            }
        });

        // console.clear();
        // console.log(checkout.process);
    } 
</script>