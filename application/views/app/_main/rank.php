<div id="srv_rank" class="card shadow-sm mb-3 p-1 mt-3" data-aos="fade-left" data-aos-delay="400">
	<div class="card-body pb-0">
        <div class="box_header_title" style="">
            <span></span>
            <span></span> 
            <div class="content_header_title">
                <h2> 
                    <i class="fas fa-crown text-warning mb-2" data-fa-transform="rotate--30"></i>&nbsp;Rank
                </h2> 
            </div>
        </div>
        

	    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        <section id="tabs" class="project-tab">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-level-rank-tab" data-toggle="tab" href="#tbl_level_rank_table" role="tab" aria-controls="nav-level-rank" aria-selected="true">Level Rank</a>
                            <a class="nav-item nav-link" id="nav-guild-rank-tab" data-toggle="tab" href="#tbl_guild_rank_table" role="tab" aria-controls="nav-guild-rank" aria-selected="false">Guild Rank</a>
                            <a class="nav-item nav-link" id="nav-cs-rank-tab" data-toggle="tab" href="#tbl_cs_rank_table" role="tab" aria-controls="nav-cs-rank" aria-selected="false">CS Rank</a>
                        </div>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tbl_level_rank_table" role="tabpanel" aria-labelledby="nav-level-rank-tab">

                        <div class="table-responsive table-scroll">
                            <table id="level_rank_table" class="table table-striped table-sm mt-4 dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Job</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Exp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($level_rank as $key => $val) :
                                    $job = '';    

                                    if($val['c4'] > 0 && $val['c5'] == 0)
                                    {
                                        if($val['c1'] == 4)
                                        {
                                            $job = 'Master';
                                        }
                                        else
                                        {
                                            $kw = intval($val['c1'].$val['c4']);
                                            $job = luna_job4($kw);
                                        }
                                    }
                                    elseif($val['c5'] > 0  && $val['c6'] == 0)
                                    {
                                        if($val['c1'] == 4)
                                        {
                                            $job = 'Expand Road';
                                        }
                                        else
                                        {
                                            $kw = intval($val['c1'].$val['c5']);
                                            $job = luna_job5($kw);
                                        }
                                    }
                                    elseif($val['c6'] > 0)
                                    {
                                        if($val['c1'] == 4)
                                        {
                                            $job = 'Tyrant';
                                        }
                                        else
                                        {
                                            $kw = intval($val['c1'].$val['c6']);
                                            $job = luna_job6($kw);
                                        }
                                    }
                                    $no = $key+1;
                                ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <?php if($no==1): ?>
                                                <img src="<?= base_url('assets/frontpage/img/medal_1st.png'); ?>" style="width:24px;" alt="">
                                            <?php elseif($no==2): ?>
                                                <img src="<?= base_url('assets/frontpage/img/medal_2nd.png'); ?>" style="width:24px;" alt="">
                                            <?php elseif($no==3): ?>
                                                <img src="<?= base_url('assets/frontpage/img/medal_3rd.png'); ?>" style="width:24px;" alt="">
                                            <?php else: ?>
                                                <?= $no; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(is_array($job)): ?>
                                                <?php if($job[0]=='fighter'): ?>
                                                    <span class="pointer" role="button" title="<?= $job[1]; ?>" data-toggle="tooltip" data-placement="bottom">
                                                        <img src="<?= base_url('assets/frontpage/img/basic_job_fighter.png'); ?>" style="width:24px;" alt="">
                                                    </span>
                                                <?php elseif($job[0]=='rogue'): ?>
                                                    <span class="pointer" role="button" title="<?= $job[1]; ?>" data-toggle="tooltip" data-placement="bottom">
                                                        <img src="<?= base_url('assets/frontpage/img/basic_job_rogue.png'); ?>" style="width:24px;" alt="">
                                                    </span>
                                                <?php elseif($job[0]=='mage'): ?>
                                                    <span class="pointer" role="button" title="<?= $job[1]; ?>" data-toggle="tooltip" data-placement="bottom">
                                                        <img src="<?= base_url('assets/frontpage/img/basic_job_mage.png'); ?>" style="width:24px;" alt="">
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="pointer" role="button" title="<?= $job; ?>" data-toggle="tooltip" data-placement="bottom">
                                                    <i class="fab fa-earlybirds"></i>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $val['a']; ?></td>
                                        <td><?= $val['b']; ?></td>
                                        <td><?= number_format($val['exp'],0,',','.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
                        </div>

                        </div>
                        <div class="tab-pane fade" id="tbl_guild_rank_table" role="tabpanel" aria-labelledby="nav-guild-rank-tab">

                        <div class="table-responsive table-scroll">
                            <table id="guild_rank_table" class="table table-striped table-sm mt-4 dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Guild Name</th>
                                    <th scope="col">Master Name</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Create Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($guld_rank as $key => $val) : 
                                    $no = $key+1; 
                                ?>
                                    <tr>
                                        <td>
                                            <?php if($no==1): ?>
                                                <img src="<?= base_url('assets/frontpage/img/medal_1st.png'); ?>" style="width:24px;" alt="">
                                            <?php elseif($no==2): ?>
                                                <img src="<?= base_url('assets/frontpage/img/medal_2nd.png'); ?>" style="width:24px;" alt="">
                                            <?php elseif($no==3): ?>
                                                <img src="<?= base_url('assets/frontpage/img/medal_3rd.png'); ?>" style="width:24px;" alt="">
                                            <?php else: ?>
                                                <?= $no; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $val['GuildName']; ?></td>
                                        <td><?= $val['MasterName']; ?></td>
                                        <td><?= $val['GuildLevel']; ?></td>
                                        <td><?= $val['CreateDate']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
                        </div>

                        </div>
                        <div class="tab-pane fade" id="tbl_cs_rank_table" role="tabpanel" aria-labelledby="nav-cs-rank-tab">
                        
                        <!-- <div class="table-responsive table-scroll">
                            <h2 style="text-align:center;">-- Coming Soon --</h2>
                        </div> -->
                        <div class="table-responsive table-scroll">
                            <table id="cs_rank_table" class="table table-striped table-sm mt-4 dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr> 
                                    <th scope="col" colspan="2" style="text-align:center;">Map Name</th>
                                    <th scope="col" style="text-align:center;">Guild Name</th>
                                    <th scope="col" style="text-align:center;">Master Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cs_rank as $key => $val) : 
                                    $no = $key+1; 
                                ?>
                                    <tr>
                                        <td style="width: 15%; text-align:right;">
                                            <?php if($val['MAPTYPE'] == 3): ?>
                                                <!-- 3 lushen -->
                                                <img src="<?= base_url('assets/frontpage/img/flag_lushen.png'); ?>" style="width:24px;" alt="">
                                            <?php elseif($val['MAPTYPE'] == 2): ?>
                                                <!-- 2 zevyn -->
                                                <img src="<?= base_url('assets/frontpage/img/flag_zevyn.png'); ?>" style="width:24px;" alt="">
                                            <?php endif; ?>
                                        </td>
                                        <td style="width: 20%;">
                                            <?php if($val['MAPTYPE'] == 3): ?>
                                                Lushen
                                            <?php elseif($val['MAPTYPE'] == 2): ?>
                                                Zevyn
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align:center;"><?= $val['GuildName']; ?></td>
                                        <td style="text-align:center;"><?= $val['MasterName']; ?></td>
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
	var level_rank_table = $('#level_rank_table').DataTable( {
        pageLength: 50,
        lengthChange: true,
        info: true,
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
    
	var guild_rank_table = $('#guild_rank_table').DataTable( {
        pageLength: 50,
        lengthChange: true,
        info: true,
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
    
	var cs_rank_table = $('#cs_rank_table').DataTable( {
        pageLength: 50,
        lengthChange: true,
        info: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
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