<!-- <link href="<?= 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'; ?>"></link>  -->
<!-- <link href="<?= 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css'; ?>"></link>  -->
<!-- <link href="<?= base_url('assets/admin/css/bootstrap-datepicker.min.css'); ?>"></link> -->

<!-- <script src="<?= 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'; ?>"></script> -->
<!-- <script src="<?= 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js'; ?>"></script> -->
<!-- <script src="<?= base_url('assets/admin/js/bootstrap-datepicker.min.js'); ?>"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css"> -->

<style> 
</style>

<div class="col-md-12">
	<div class="card mb-3">
		<div class="card-header bg-white"><h5><b>TOP DONATE</b></h5></div>
		<div class="card-body">
            <?php $this->load->helper("form"); ?>
            <!-- <form id="topup_form" method="POST" action="">
            </form> -->
            <div class="row" style="margin-bottom:15px;">
                <div class="col-2">
                    Pilih Kategori
                </div>
                <div class="col-3">
                    <select id="input_kategori" class="form-control">
                        <option value="">--Pilih--</option>
                        <option <?= $category == 'today' ? 'selected' : ''; ?> value="this_day">Hari ini</option>
                        <option <?= $category == 'week' ? 'selected' : ''; ?> value="this_week">Minggu ini</option>
                        <option <?= $category == 'month' ? 'selected' : ''; ?> value="this_month">Bulan ini</option>
                        <option <?= $category == 'year' ? 'selected' : ''; ?> value="this_year">Tahun ini</option>
                        <option <?= $category == 's_range' ? 'selected' : ''; ?> value="specific_range_date">Spesifik Jarak Tanggal</option>
                        <option <?= $category == 's_day' ? 'selected' : ''; ?> value="specific_day">Spesifik Hari</option>
                        <option <?= $category == 's_week' ? 'selected' : ''; ?> value="specific_week">Spesifik Minggu</option>
                        <option <?= $category == 's_month' ? 'selected' : ''; ?> value="specific_month">Spesifik Bulan</option>
                        <option <?= $category == 's_year' ? 'selected' : ''; ?> value="specific_year">Spesifik Tahun</option>
                    </select>
                </div>
                <div class="col-3">
                    <button id="btn_search_kategori" type="button" class="btn btn-success">
                        Search
                    </button>
                </div>
            </div>

            <div id="res_kategori" class="row" style="margin-bottom:15px;display:none;">
                <?php 
                $val_s_day = ''; 
                $val_from_date = ''; 
                $val_to_date = ''; 
                $val_s_week = ''; 
                $val_s_month = ''; 
                $val_s_year = ''; 

                if($category == 's_range'){
                    $val_from_date = $t_val1;
                    $val_to_date = $t_val2;
                }
                if($category == 's_day'){
                    $val_s_day = $t_val1;
                }
                if($category == 's_week'){
                    $val_s_week = $t_val1.' - '.$t_val2;
                }
                if($category == 's_month'){
                    $val_s_year = $t_val1;
                    $val_s_month = $t_val2;
                }
                if($category == 's_year'){
                    $val_s_year = $t_val1;
                }
                ?>
                <div class="col-2">
                </div>
                <div class="col-3">
                    <input placeholder="--Pilih Tanggal--" id="input_spesifik_hari" type="text" class="form-control" style="display:none;" value="<?= $val_s_day; ?>"> 

                    <div class="form-group" id="parent_range_date" style="display:none;">
                        <label for="">From</label> 
                        <input placeholder="--Pilih Tanggal--" id="input_spesifik_from_date" type="text" class="form-control" value="<?= $val_from_date; ?>">
                        <label for="">To</label> 
                        <input placeholder="--Pilih Tanggal--" id="input_spesifik_to_date" type="text" class="form-control" value="<?= $val_to_date; ?>">
                    </div> 

                    <div class="form-group" id="week-picker-wrapper" style="display:none;"> 
                        <div style="margin-bottom:10px;" class="week-picker"></div>
                        <input placeholder="--Pilih Tanggal Diatas--" type="text" id="input_spesifik_minggu" class="form-control" readonly value="<?= $val_s_week; ?>">
                    </div>

                    <input placeholder="--Input Tahun--" id="input_spesifik_tahun" type="text" class="form-control" style="display:none;" value="<?= $val_s_year; ?>">
                    <select id="input_spesifik_bulan" class="form-control" style="display:none;margin-top:10px;">
                        <option value="">--Pilih Bulan--</option>
                        <?php foreach($list_month as $idx => $val) : ?>
                            <option <?= $val_s_month == $idx ? 'selected' : ''; ?> value="<?= $idx; ?>"><?= $val; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div> 
            
            <table class="table" style="margin-top:25px;"> 
                <tbody>
                    <tr>
                        <th style="width:150px;">
                            Total Point
                        </th>
                        <th style="width:15px;">
                            :
                        </th>
                        <td>
                            <?= number_format($total_point_donate['point'],0,',','.'); ?>
                        </td>
                    </tr>
                    <?php foreach($total_price_donate as $idx => $val): ?>
                        <?php if($val['currency'] == 'IDR'): ?>
                            <tr>
                                <th>
                                    Total IDR
                                </th>
                                <th>
                                    :
                                </th>
                                <td>
                                    <?= 'Rp '.number_format($val['price'],0,',','.'); ?>
                                </td>
                            </tr> 
                        <?php elseif($val['currency'] == 'USD'): ?>
                            <tr>
                                <th>
                                    Total USD
                                </th>
                                <th>
                                    :
                                </th>
                                <td>
                                    <?= '$ '.number_format($val['price'],2,',','.'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            
            <h4>Akumulasi Top Donate</h4>
            <div class="table-responsive" style="margin-bottom:30px;">
                <table id="acc_donate_table" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>    
                            <th scope="col">Username</th> 
                            <th scope="col">Points</th>    
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($accumulation_donate_list as $key => $val) : ?> 
                            <tr>  
                                <td><?= $val['username']; ?></td> 
                                <td><?= number_format($val['donate_point'],0,',','.'); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <h4>Detail Top Donate</h4>
            <div class="table-responsive">
                <table id="donate_table" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>    
                            <th scope="col">Username</th>
                            <th scope="col">Bill</th>
                            <th scope="col">Points</th>   
                            <th scope="col">Transaction Time</th> 
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
                                <td><?= $val['username']; ?></td>
                                <td><?= $currency.' '.number_format($total_bill,$float_num,',','.'); ?></td>
                                <td><?= number_format($val['donate_point'],0,',','.'); ?></td> 
                                <td><?= (!empty($val['created_date'])) ? date('d M Y', strtotime($val['created_date'])) : '-- Empty --'; ?></td> 
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
    var week_start_date;
    var week_end_date;

    var selectCurrentWeek = function() {
        window.setTimeout(function () {
            $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
        }, 1);
    }

    $('.week-picker').datepicker( {
        dateFormat:'yy-mm-dd',
        showOtherMonths: true,
        selectOtherMonths: true,
        onSelect: function(dateText, inst) { 
            var date = $(this).datepicker('getDate');
            week_start_date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            week_end_date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
            let res_start_date = $.datepicker.formatDate( dateFormat, week_start_date, inst.settings );
            let res_end_date = $.datepicker.formatDate( dateFormat, week_end_date, inst.settings );

            $("#input_spesifik_minggu").val(res_start_date + ' - ' + res_end_date);
            
            selectCurrentWeek();
        },
        beforeShowDay: function(date) {
            var cssClass = '';
            if(date >= week_start_date && date <= week_end_date)
                cssClass = 'ui-datepicker-current-day';
            return [true, cssClass];
        },
        onChangeMonthYear: function(year, month, inst) {
            selectCurrentWeek();
        }
    });

    $('.week-picker .ui-datepicker-calendar tr').on('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
    $('.week-picker .ui-datepicker-calendar tr').on('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });

    $('#input_spesifik_hari').datepicker({
        dateFormat:'yy-mm-dd',
    });
    $('#input_spesifik_from_date').datepicker({
        dateFormat:'yy-mm-dd',
    });
    $('#input_spesifik_to_date').datepicker({
        dateFormat:'yy-mm-dd',
    }); 
    
    f_main.setInputFilter($("#input_spesifik_tahun"), function(value) {
        return /^-?\d*$/.test(value); 
    });

    $('#input_kategori').change(function(){
        let t = $(this);
        let res_kategori = $('#res_kategori');
        let input_spesifik_hari = $('#input_spesifik_hari'); 
        let input_spesifik_from_date = $('#input_spesifik_from_date'); 
        let input_spesifik_to_date = $('#input_spesifik_to_date'); 
        let parent_range_date = $('#parent_range_date');
        let week_picker_wrapper = $('#week-picker-wrapper');
        let input_spesifik_bulan = $('#input_spesifik_bulan');
        let input_spesifik_tahun = $('#input_spesifik_tahun'); 

        res_kategori.hide();
        input_spesifik_hari.hide();
        parent_range_date.hide(); 
        week_picker_wrapper.hide();
        input_spesifik_bulan.hide();
        input_spesifik_tahun.hide();

        switch (t.val()) {  
            case 'specific_day':
                res_kategori.show();
                input_spesifik_hari.show();
                break; 
            case 'specific_range_date':
                res_kategori.show();
                parent_range_date.show();
                break;
            case 'specific_week':
                res_kategori.show();
                week_picker_wrapper.show();
                break;
            case 'specific_month':
                res_kategori.show();
                input_spesifik_tahun.show();
                input_spesifik_bulan.show();
                break;
            case 'specific_year':
                res_kategori.show();
                input_spesifik_tahun.show();
                break; 
        }
    }).change();

    $('#btn_search_kategori').click(function(){
        let t = $(this);
        let kategori = $('#input_kategori').val();
        let input_spesifik_hari = $('#input_spesifik_hari'); 
        let input_spesifik_minggu = $('#input_spesifik_minggu');
        let input_spesifik_bulan = $('#input_spesifik_bulan');
        let input_spesifik_tahun = $('#input_spesifik_tahun');
        let input_spesifik_from_date = $('#input_spesifik_from_date'); 
        let input_spesifik_to_date = $('#input_spesifik_to_date'); 

        let exp_week = input_spesifik_minggu.val().split(' - ');
        let start_week = exp_week[0];
        let end_week = exp_week[1];

        switch (kategori) { 
            case 'this_day':
                window.location.href="/adm/top_donate/today";
                break;
            case 'this_week':
                window.location.href="/adm/top_donate/week";
                break;
            case 'this_month':
                window.location.href="/adm/top_donate/month";
                break;
            case 'this_year':
                window.location.href="/adm/top_donate/year";
                break; 

            case 'specific_day':
                if(input_spesifik_hari.val().trim() == ''){ 
                    swal("Warning",
                        "Input hari yang di inginkan!",
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
                window.location.href="/adm/top_donate/s_day/"+input_spesifik_hari.val().trim();
                break;
            case 'specific_range_date':
                if(input_spesifik_from_date.val().trim() == '' || input_spesifik_to_date.val().trim() == ''){ 
                    swal("Warning",
                        "Input jarak tanggal yang di inginkan!",
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
                window.location.href="/adm/top_donate/s_range/"+input_spesifik_from_date.val().trim()+"/"+input_spesifik_to_date.val().trim();   
                break;
            case 'specific_week':
                if(start_week == '' || end_week == ''){ 
                    swal("Warning",
                        "Input tanggal minggu yang di inginkan!",
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
                window.location.href="/adm/top_donate/s_week/"+start_week+"/"+end_week; 
                break;
            case 'specific_month':
                if(input_spesifik_tahun.val().trim() == ''){ 
                    swal("Warning",
                        "Input tahun yang di inginkan!",
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
                
                if(input_spesifik_bulan.val().trim() == ''){ 
                    swal("Warning",
                        "Input bulan yang di inginkan!",
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
                window.location.href="/adm/top_donate/s_month/"+input_spesifik_tahun.val().trim()+"/"+input_spesifik_bulan.val().trim();  
                break;
            case 'specific_year':
                if(input_spesifik_tahun.val().trim() == ''){ 
                    swal("Warning",
                        "Input tahun yang di inginkan!",
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

                window.location.href="/adm/top_donate/s_year/"+input_spesifik_tahun.val().trim(); 
                break;
        }
    });

    var donate_table = $('#donate_table').DataTable( {
        lengthChange: true,
        info: true,
        aaSorting: [
            // [ 7, "asc" ],
        ],
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 2 },
            // { searchable: false, targets: 0 },
            // { searchable: false, targets: 1 }, 
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail for Donate ID : '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                })
            }
        }
    });
    
    var acc_donate_table = $('#acc_donate_table').DataTable( {
        lengthChange: true,
        info: true,
        aaSorting: [
            // [ 7, "asc" ],
        ],
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            // { responsivePriority: 2, targets: 2 },
            // { searchable: false, targets: 0 },
            // { searchable: false, targets: 1 }, 
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail for Donate ID : '+data[0];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                })
            }
        }
    });
      
    console.clear();
});   
</script>
<style>
    .btn-black{
        background-color: #353333 !important;
    } 
</style>