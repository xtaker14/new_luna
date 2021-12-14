<?php 
if(!isset($part_ht_style_img) || empty($part_ht_style_img)){
    $part_ht_style_img = "width: 60px; height: 60px;";
}
if(!isset($part_ht_style_txt_large) || empty($part_ht_style_txt_large)){
    $part_ht_style_txt_large = "";
}
?> 

<div class="box_header_title" style="width: 100%;">
    <span></span>
    <span></span>
    <div class="content_header_title" style="display:flex;">
        <?php if(isset($part_ht_left_i) && !empty($part_ht_left_i)): ?>
            <i style="<?= $part_ht_style_i; ?>" class="<?= $part_ht_left_i; ?>"></i>
        <?php else: ?>
            <?php if(isset($part_ht_left_img) && !empty($part_ht_left_img)) : ?>
                <img class="mr-2" src="<?= $part_ht_left_img; ?>" style="<?= $part_ht_style_img; ?>">
            <?php endif; ?>
        <?php endif; ?>
        <div style="width: 100%; <?= $part_ht_style_txt_large; ?>"> 
            <?= $part_ht_txt_large; ?>
            <br>
            <small style="font-size:14px;color:#e2e0e5;">
                <i><?= $part_ht_txt_small; ?></i>
            </small>  
        </div>
        <?php if(isset($part_ht_right_i) && !empty($part_ht_right_i)): ?>
            <i style="<?= $part_ht_style_i; ?>" class="<?= $part_ht_right_i; ?>"></i>
        <?php else: ?>
            <?php if(isset($part_ht_right_img) && !empty($part_ht_right_img)) : ?>
                <img class="mr-2" src="<?= $part_ht_right_img; ?>" style="<?= $part_ht_style_img; ?>">
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>