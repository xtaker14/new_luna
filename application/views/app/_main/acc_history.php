<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div id="acc_history" class="card shadow-sm p-1" data-aos="fade-left" data-aos-delay="400" style="">
	<div class="card-body p-1" style=""> 

        <div class="d-md-flex p-2 mb-2" style="padding-top: 10px !important; padding-bottom: 2px !important;"> 
            <div class="d-block" style="width: 100%;">
                <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    
                <h3 style="padding-bottom:5px;margin:0px;" class="text-primary border-bottom">Account History</h3>
            </div>
        </div>
        
        <div style="background: #2a88ed; border-radius: 4px; height: 100%;"> 
            <section id="tabs" class="project-tab">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-donate-history-tab" data-toggle="tab" href="#tbl_donate_history_table" role="tab" aria-controls="nav-donate-history" aria-selected="true">Donate</a>

                                <a class="nav-item nav-link" id="nav-test-history-tab" data-toggle="tab" href="#tbl_test_history_table" role="tab" aria-controls="nav-test-history" aria-selected="false">Coming Soon</a>
                            </div>
                        </nav>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tbl_donate_history_table" role="tabpanel" aria-labelledby="nav-donate-history-tab">

                                <div class="table-responsive table-scroll">
                                    <table id="donate_history_table" class="table table-striped table-sm mt-2 dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="">Ref</th>
                                                <th scope="col">Price</th>
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
                                                    <td style="word-wrap: break-word; word-break: break-all; white-space: normal;">
                                                        <?= $val['reference']; ?>
                                                        <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:5px;margin-bottom:5px;"> 
                                                        <?= date('H:m, d M Y', strtotime($val['created_date'])); ?>
                                                    </td>
                                                    <td><?= $currency.' '.number_format($total_bill,$float_num,',','.'); ?></td>
                                                    <td><?= number_format($val['donate_point'],0,',','.'); ?></td>
                                                    <td>
                                                        <?= $val['payment_name']; ?>
                                                    </td>  
                                                    <td>
                                                        <?php 
                                                            $cls_btn_status = 'btn-three';
                                                            if($val['status'] == 'canceled' || $val['status'] == 'pending'){
                                                                $cls_btn_status = 'btn-two';
                                                            }
                                                        ?>
                                                        <button type="button" class="btn_donate_status <?= $cls_btn_status; ?>" data-id="<?= $val['id']; ?>">
                                                            <?= strtoupper($val['status']); ?>
                                                        </button> 
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="tbl_test_history_table" role="tabpanel" aria-labelledby="nav-test-history-tab">

                                <div class="table-responsive table-scroll">
                                    <h4 style="text-align: center; color: #fff;">--Coming Soon--</h4>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </section>  
        </div>

	</div>
</div>

<?php $this->load->view("app/_part/donate_js.php") ?>

<script type="text/javascript">
let xepo_secure_name = "<?=$xepo_secure['name'];?>";
let xepo_secure_value ="<?=$xepo_secure['hash'];?>";

$(document).ready(function(){ 
    $(".btn_donate_status").click(function(ev){
        let t = $(this);
        let t_id = t.data('id'); 
        popCheckDonate(t_id);
    });

    function popCheckDonate(id){ 
        f_main.loading(true);
        $.ajax({
            type : "POST",
            dataType : "json", 
            tryCount : 0,
            retryLimit : 3,
            data : {
                id : id,
                [xepo_secure_name] : xepo_secure_value,
            },
            url : baseURL+"donate/popup/check_status",
            success:function(res){
                xepo_secure_name = res.xepo_name;
                xepo_secure_value = res.xepo_value;

                f_main.loading(false,function(){
                    checkoutProcess(res.result.reference); 
                });
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
	$('html').removeClass('no-js');
})
</script>