<?php 
if(!isset($part_bb_attr_plus) || empty($part_bb_attr_plus)){
    $part_bb_attr_plus = '';
} 
if(!isset($part_bb_style) || empty($part_bb_style)){
    $part_bb_style = '';
} 
if(!isset($part_bb_class) || empty($part_bb_class)){
    $part_bb_class = '';
} 
if(!isset($part_bb_type) || empty($part_bb_type)){
    $part_bb_type = '';
}
if(!isset($part_bb_href) || empty($part_bb_href)){
    $part_bb_href = '';
} 
if(!isset($part_bb_t_id) || empty($part_bb_t_id)){
    $part_bb_t_id = "id=''";
}else{
    $part_bb_t_id = "id='$part_bb_t_id'";
}
if(!isset($part_bb_t_name) || empty($part_bb_t_name)){
    $part_bb_t_name = "name=''";
}else{
    $part_bb_t_name = "name='$part_bb_t_name'";
}
?>
<?php if($part_bb_element == 'button') : ?>
    <button style="<?= $part_bb_style; ?>" <?= $part_bb_t_id.' '.$part_bb_t_name.' '.$part_bb_attr_plus; ?> class="<?= $part_bb_class; ?>" type="<?= $part_bb_type; ?>">
        <!-- <i class="ibb"></i> -->
        <?= $part_bb_txt; ?>
        <!-- <i class="iba"></i> -->
    </button>
<?php elseif($part_bb_element == 'a') : ?>
    <a style="<?= $part_bb_style; ?>" <?= $part_bb_t_id.' '.$part_bb_t_name.' '.$part_bb_attr_plus; ?> class="<?= $part_bb_class; ?>" href="<?= $part_bb_href; ?>">
        <!-- <i class="ibb"></i> -->
        <?= $part_bb_txt; ?>
        <!-- <i class="iba"></i> -->
    </a>
<?php else: ?>
<?php endif; ?>