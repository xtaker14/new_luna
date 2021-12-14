<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div id="srv_user" style="margin-top: 30px;" class="card shadow-sm mb-3 p-1" data-aos="fade-left" data-aos-delay="400">
    <?php $this->load->view("app/_part/header_title.php",array(
        'part_ht_txt_large'=> '<i class="fas fa-crown mb-1" data-fa-transform="rotate--30"></i>&nbsp;User Info',
        'part_ht_txt_small'=> '',
        'part_ht_left_i'=> '',
		'part_ht_right_i'=> '',
        // 'part_ht_left_img'=> CDN_IMG.('assets/frontpage/img/doge.png'),
        // 'part_ht_right_img'=> CDN_IMG.('assets/frontpage/img/doge.png'),
        'part_ht_left_img'=> '',
        'part_ht_right_img'=> '',
        'part_ht_style_img'=> 'width:50px;',
        'part_ht_style_txt_large'=> 'font-size:24px;',
    )); ?> 

	<div class="card-body pb-0">        
        <section class="tabs project-tab">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-referrallog-tab" data-toggle="tab" href="#tbl_referrallog_table" role="tab" aria-controls="nav-referrallog" aria-selected="true">Referral History</a>
                        </div>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tbl_referrallog_table" role="tabpanel" aria-labelledby="nav-referrallog-tab"> 

                            <div class="table-scroll">
                                <table id="referrallog_table" class="table table-striped table-sm mt-4 dt-responsive nowrap fl-table" style="width:100%">
                                    <thead>
                                        <tr>  
                                            <th scope="col">Donate ID</th>
                                            <th scope="col">From Username</th>
                                            <th scope="col">To Username</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Diamonds</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($referral_history_list as $key => $val) : ?> 
                                            <tr>  
                                                <td><?= $val['donate_id']; ?></td>
                                                <td><?= $val['from_username']; ?></td>
                                                <td><?= $val['username']; ?></td>
                                                <td><?= $val['referral_code']; ?></td>
                                                <td><?= number_format($val['silver_point'],0,',','.'); ?></td>
                                                <td><?= (!empty($val['created_date'])) ? date('d M Y H:i:s', strtotime($val['created_date'])) : '-- Empty --'; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </section>  
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var referrallog_table = $('#referrallog_table').DataTable( {
        pageLength: 50,
        lengthChange: true,
        info: true,
        bLengthChange: false,
        dom:' <"search"f><"top"l>rt<"bottom"ip><"clear">',
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 2 },
            // { searchable: false, targets: 0 },
            // { searchable: false, targets: 1 },
            // { searchable: false, targets: 3 },
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
                } )
            }
        }
    }); 

	$('html').removeClass('no-js');
})
</script>