<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div class="border_bg_tree" data-aos="fade-right" data-aos-delay="300" style="margin-top: 35px;">
<div id="overview_page" class="card shadow-sm mb-3 p-1" style="margin-top: 0px;">
    <?php $this->load->view("app/_part/header_title.php",array(
        'part_ht_txt_large'=> '<i class="far fa-newspaper"></i>&nbsp;Information',
        'part_ht_txt_small'=> '',
        'part_ht_left_i'=> '',
		'part_ht_right_i'=> '',
        // 'part_ht_left_img'=> CDN_IMG.('assets/frontpage/img/doge.png'),
        // 'part_ht_right_img'=> CDN_IMG.('assets/frontpage/img/doge.png'),
        'part_ht_left_img'=> '',
        'part_ht_right_img'=> '',
        'part_ht_style_img'=> 'width:50px;',
        'part_ht_style_txt_large'=> 'font-size:22px;',
    )); ?>

	<div class="card-body pb-0">        
        <section class="tabs project-tab">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <?php foreach ($data_overview as $key => $val) : ?>
                                <a class="nav-item nav-link <?= $key == 0 ? 'active' : ''; ?>" id="nav_<?= preg_replace('/\s+/', '_', strtolower($val['title'])); ?>_tab" data-toggle="tab" href="#parent_<?= preg_replace('/\s+/', '_', strtolower($val['title'])); ?>_tab" role="tab" aria-controls="nav_<?= preg_replace('/\s+/', '_', strtolower($val['title'])); ?>" aria-selected="true"><?= $val['title']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </nav>
                    <div class="tab-content">
                    <?php foreach ($data_overview as $key => $val) : ?>
                        <div class="tab-pane fade show <?= $key == 0 ? 'active' : ''; ?>" id="parent_<?= preg_replace('/\s+/', '_', strtolower($val['title'])); ?>_tab" role="tabpanel" aria-labelledby="nav_<?= preg_replace('/\s+/', '_', strtolower($val['title'])); ?>_tab" style="padding:15px;padding-top:30px;padding-bottom:30px;">
                            
                            <?php 
                            $exp_img = explode('/',$val['img']);
                            if(end($exp_img) !== '.'): 
                            ?>
                                <img src="<?= $val['img']; ?>" style="width: 100%;" alt="<?= $val['title']; ?>">
                            <?php endif; ?>
                            
                            <?= $val['content']; ?>

                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>  
	</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 

	$('html').removeClass('no-js');

    $('#overview_page .tab-content .tab-pane a').click(function(){
        let t = $(this);
        if(t.text().length>0){
            if(t.text()[0] === '#'){
                let a_target = t.text().trim().substring(1, t.text().trim().length);
                let target = $('.nav-tabs .nav-item#nav_'+ a_target.replace(/-/g,"_") +'_tab');
                target.click();
            }
        }
    });
})
</script>