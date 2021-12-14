window[f_main.xssClean(function_setting_name)] = function(pars) {
    let t = pars[0];
    let url = pars[1];
    let post_data = f_main.objectifyForm(t.serializeArray());
    let username = $("input#username");
    let captcha_code = $("input#captcha_code");
    let pin_mall = $("input#pin_mall");
    let password = $("input#password");
    
    if($.trim(username.val()).length < 5){
        f_main.notifyDangerBox(username,'Enter 5-15 characters');
        return false;
    } 
    if($.trim(password.val()).length < 8){
        f_main.notifyDangerBox(password,'Enter 8-12 characters');
        return false;
    }
    if($.trim(captcha_code.val()).length < 6){
        f_main.notifyDangerBox(captcha_code,'Enter 6 characters');
        return false;
    }
    if($.trim(pin_mall.val()).length < 6 || typeof parseInt(pin_mall.val()) !== 'number'){
        f_main.notifyDangerBox(pin_mall,'Enter 6 characters & Numeric Only');
        return false;
    }

    if(post_data.username.trim().length===0){
        return swal("Warning",
            "Invalid Username",
            "warning",
            {
            buttons: { 
                button_1: "OK!", 
            },
        })
        .then((value) => {
            switch (value) {
                case "button_1":
                    return false
                    break;
            }
        });
    }

    f_main.loading(true);
    f_main.callAjax({
            data : post_data,
            [csrf['name']] : csrf['value'],
        },
        url,
        {
            type: "POST",
            dataType: "JSON",
        },
        {
            sc : function(jx_data){
                csrf.value=jx_data.v;
                f_main.loading(false,function(){
                    if(jx_data.result === true){
                        swal("Successfull",
                            "You have successfully logged in",
                            "success",
                        {
                            buttons: { 
                                button_1: "OK!", 
                            },
                        })
                        .then((value) => {
                            switch (value) {
                                case "button_1":
                                    f_main.mvLoc(f_main.urlPlus("our_rules"));
                                    break;
                                }
                        });
                    }else{
                        swal("Warning",
                            jx_data.result,
                            "warning",
                            {
                            buttons: { 
                                button_1: "OK!", 
                            },
                        })
                        .then((value) => {
                            switch (value) {
                                case "button_1":
                                    break;
                            }
                        });
                    }
                });
            },
            er : function(jx_data){
                f_main.loading(false,function(){
                    // f_main.dump(jx_data.responseText);
                    swal("Warning",
                        "Error / Not Allowed",
                        "warning",
                        {
                        buttons: { 
                            button_1: "OK!", 
                        },
                    })
                    .then((value) => {
                        switch (value) {
                            case "button_1":
                                break;
                        }
                    });
                });
            },
        }
    );
} 