<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



<div id="srv_rank" class="card shadow-sm p-1" data-aos="fade-left" data-aos-delay="400" style="">

	<div class="card-body p-1" style=""> 



        <div class="d-md-flex p-2 mb-2" style="padding-top: 10px !important; padding-bottom: 2px !important;"> 

            <div class="d-block" style="width: 100%;">

                <img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 50px;height: 45px;margin-top:-10px;">    

                <h3 style="padding-bottom:5px;margin:0px;" class="text-primary border-bottom">Rank</h3>

            </div>

        </div>

        

        <div style="background: #2a88ed; border-radius: 4px; height: 100%;"> 

            <section id="tabs" class="project-tab">

                <div class="row">

                    <div class="col-md-12">

                        <nav>

                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                                <a class="nav-item nav-link active" id="nav-level-rank-tab" data-toggle="tab" href="#tbl_level_rank_table" role="tab" aria-controls="nav-level-rank" aria-selected="true">Level</a>

                                <a class="nav-item nav-link" id="nav-guild-rank-tab" data-toggle="tab" href="#tbl_guild_rank_table" role="tab" aria-controls="nav-guild-rank" aria-selected="false">Guild</a>

                                <!-- <a class="nav-item nav-link" id="nav-cs-rank-tab" data-toggle="tab" href="#tbl_cs_rank_table" role="tab" aria-controls="nav-cs-rank" aria-selected="false">CS</a> -->

                            </div>

                        </nav>

                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tbl_level_rank_table" role="tabpanel" aria-labelledby="nav-level-rank-tab">



                            <div class="table-responsive table-scroll">

                                <table id="level_rank_table" class="table table-striped table-sm mt-2 dt-responsive nowrap" style="width:100%">

                                <thead>

                                    <tr>

                                        <th scope="col" style="width: 60px; text-align: center;">No.</th>

                                        <th scope="col" style="">Job</th>

                                        <th scope="col" style="">Name</th>

                                        <th scope="col" style="">Level</th>

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

                                                    <img src="<?= base_url('assets/frontpage/img/rank_1.png'); ?>" style="" alt="">

                                                <?php elseif($no==2): ?>

                                                    <img src="<?= base_url('assets/frontpage/img/rank_2.png'); ?>" style="" alt="">

                                                <?php elseif($no==3): ?>

                                                    <img src="<?= base_url('assets/frontpage/img/rank_3.png'); ?>" style="" alt="">

                                                <?php else: ?>

                                                    <?= $no; ?>

                                                <?php endif; ?>

                                            </td>

                                            <td>

                                                <?php if(is_array($job)): ?>

                                                    <!-- <?php if($job[0]=='fighter'): ?>

                                                        <span class="pointer" role="button" title="<?= $job[1]; ?>" data-toggle="tooltip" data-placement="bottom">

                                                            <img src="<?= base_url('assets/frontpage/img/class/fighter/Job 1/fighter.png'); ?>" style="width:24px;" alt="">

                                                        </span>

                                                    <?php elseif($job[0]=='rogue'): ?>

                                                        <span class="pointer" role="button" title="<?= $job[1]; ?>" data-toggle="tooltip" data-placement="bottom">

                                                            <img src="<?= base_url('assets/frontpage/img/class/rogue/Job 1/rogue.png'); ?>" style="width:24px;" alt="">

                                                        </span>

                                                    <?php elseif($job[0]=='mage'): ?>

                                                        <span class="pointer" role="button" title="<?= $job[1]; ?>" data-toggle="tooltip" data-placement="bottom">

                                                            <img src="<?= base_url('assets/frontpage/img/class/mage/Job 1/mage.png'); ?>" style="width:24px;" alt="">

                                                        </span>

                                                    <?php endif; ?> -->



                                                    <span class="pointer" role="button" title="<?= $job[1]; ?>" data-toggle="tooltip" data-placement="bottom">

                                                        <img src="<?= base_url('assets/frontpage/img/class/'.$job[0].'/'.$job[1].'.png'); ?>" style="width:24px;" alt="">

                                                    </span>

                                                    <?= $job[1]; ?> 
                                                <?php else: ?>

                                                    <!-- <span class="pointer" role="button" title="<?= $job; ?>" data-toggle="tooltip" data-placement="bottom">

                                                        <i class="fab fa-earlybirds"></i>

                                                    </span> -->

                                                <?php endif; ?>
                                                
                                                <?= '<hr>'.$test_a; ?>
                                            </td>

                                            <td><?= $val['a']; ?></td>

                                            <td><?= $val['b']; ?></td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                                </table>

                            </div>



                            </div>

                            <div class="tab-pane fade" id="tbl_guild_rank_table" role="tabpanel" aria-labelledby="nav-guild-rank-tab">



                            <div class="table-responsive table-scroll">

                                <table id="guild_rank_table" class="table table-striped table-sm mt-2 dt-responsive nowrap" style="width:100%">

                                <thead>

                                    <tr>

                                        <th scope="col" style="width: 60px; text-align: center;">No.</th>

                                        <th scope="col" style="">Guild Name</th>

                                        <th scope="col" style="">Guild Leader</th>

                                        <th scope="col" style="">Level</th>

                                        <th scope="col" style="">Created Date</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php foreach ($guld_rank as $key => $val) : 

                                        $no = $key+1; 

                                        $key_cs = array_search($val['GuildName'], array_column($cs_rank, 'GuildName'));

                                        $get_cs = array();

                                        if($key_cs !== false){

                                            $get_cs = $cs_rank[$key_cs];

                                        }

                                    ?>

                                        <tr>

                                            <td style="text-align: center;">

                                                <?php if($no==1): ?>

                                                    <img src="<?= base_url('assets/frontpage/img/rank_1.png'); ?>" style="" alt="">

                                                <?php elseif($no==2): ?>

                                                    <img src="<?= base_url('assets/frontpage/img/rank_2.png'); ?>" style="" alt="">

                                                <?php elseif($no==3): ?>

                                                    <img src="<?= base_url('assets/frontpage/img/rank_3.png'); ?>" style="" alt="">

                                                <?php else: ?>

                                                    <?= $no; ?>

                                                <?php endif; ?>

                                            </td>

                                            <td>

                                                <?php 

                                                    if(!empty($get_cs) && $get_cs['MAPTYPE'] == 3){

                                                        echo '

                                                        <div style="cursor: pointer;color: #000;border: 2px solid black;padding: 2px;border-radius: 3px;display: inline-block;background:#e5f4f4;">

                                                            <img src="'.base_url('assets/frontpage/img/flag_gg.png').'" style="width: 20px;">

                                                            Lushen

                                                        </div><br>';

                                                    }    

                                                    else if(!empty($get_cs) && $get_cs['MAPTYPE'] == 2){

                                                        echo '

                                                        <div style="cursor: pointer;color: #000;border: 2px solid black;padding: 2px;border-radius: 3px;display: inline-block;background:#e5f4f4;">

                                                            <img src="'.base_url('assets/frontpage/img/flag_gg.png').'" style="width: 20px;">

                                                            Zevyn

                                                        </div><br>'; 

                                                    } 

                                                    echo $val['GuildName'];  

                                                ?>

                                            </td>

                                            <td><?= $val['MasterName']; ?></td>

                                            <td><?= $val['GuildLevel']; ?></td>

                                            <td><?= date('d M Y', strtotime($val['CreateDate'])); ?></td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                                </table>

                            </div>



                            </div>



                            <!-- <div class="tab-pane fade" id="tbl_cs_rank_table" role="tabpanel" aria-labelledby="nav-cs-rank-tab"> 

                            <div class="table-responsive table-scroll">

                                <table id="cs_rank_table" class="table table-striped table-sm mt-2 dt-responsive nowrap" style="width:100%">

                                <thead>

                                    <tr> 

                                        <th scope="col" colspan="2" style="text-align:center;">Map Name</th>

                                        <th scope="col" style="text-align:center;">Guild Name</th>

                                        <th scope="col" style="text-align:center;">Guild Leader</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php foreach ($cs_rank as $key => $val) : 

                                        $no = $key+1; 

                                    ?>

                                        <tr>

                                            <td style="width: 15%; text-align:right;">

                                                <?php if($val['MAPTYPE'] == 3): ?>

                                                    #3 lushen

                                                    <img src="<?= base_url('assets/frontpage/img/flag_lushen.png'); ?>" style="width:24px;" alt="">

                                                <?php elseif($val['MAPTYPE'] == 2): ?>

                                                    #2 zevyn

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

                            </div> -->



                        </div>

                    </div>

                </div>

            </section>  

        </div>



	</div>

</div>



<script type="text/javascript">

$(document).ready(function(){

	// var level_rank_table = $('#level_rank_table').DataTable( {

    //     pageLength: 15,

    //     lengthChange: true,

    //     searching: false, 

    //     paging: false, 

    //     info: false,

    //     columnDefs: [

    //         { responsivePriority: 1, targets: 0 },

    //         { responsivePriority: 2, targets: 2 },

    //         // { searchable: false, targets: 0 },

    //         // { searchable: false, targets: 1 },

    //         // { searchable: false, targets: 3 },

    //     ],

    //     responsive: {

    //         details: {

    //             display: $.fn.dataTable.Responsive.display.modal( {

    //                 header: function ( row ) {

    //                     var data = row.data();

    //                     return 'Detail for '+data[0];

    //                 }

    //             } ),

    //             renderer: $.fn.dataTable.Responsive.renderer.tableAll( {

    //                 tableClass: 'table'

    //             } )

    //         }

    //     }

    // });

    

	// var guild_rank_table = $('#guild_rank_table').DataTable( {

    //     pageLength: 15,

    //     lengthChange: true,

    //     info: true,

    //     columnDefs: [

    //         { responsivePriority: 1, targets: 0 },

    //         { responsivePriority: 2, targets: 2 },

    //         // { searchable: false, targets: 0 },

    //         // { searchable: false, targets: 1 },

    //         // { searchable: false, targets: 3 },

    //     ],

    //     responsive: {

    //         details: {

    //             display: $.fn.dataTable.Responsive.display.modal( {

    //                 header: function ( row ) {

    //                     var data = row.data();

    //                     return 'Detail for '+data[0];

    //                 }

    //             } ),

    //             renderer: $.fn.dataTable.Responsive.renderer.tableAll( {

    //                 tableClass: 'table'

    //             } )

    //         }

    //     }

    // }); 

    

	// var cs_rank_table = $('#cs_rank_table').DataTable( {

    //     pageLength: 15,

    //     lengthChange: true,

    //     info: true,

    //     columnDefs: [

    //         { responsivePriority: 1, targets: 0 },

    //         { responsivePriority: 2, targets: 1 },

    //         // { searchable: false, targets: 0 },

    //         // { searchable: false, targets: 1 },

    //         // { searchable: false, targets: 3 },

    //     ],

    //     responsive: {

    //         details: {

    //             display: $.fn.dataTable.Responsive.display.modal( {

    //                 header: function ( row ) {

    //                     var data = row.data();

    //                     return 'Detail for '+data[0];

    //                 }

    //             } ),

    //             renderer: $.fn.dataTable.Responsive.renderer.tableAll( {

    //                 tableClass: 'table'

    //             } )

    //         }

    //     }

    // }); 



	$('html').removeClass('no-js');

})

</script>