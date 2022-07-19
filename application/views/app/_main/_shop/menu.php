<style type="text/css">

.category-menu{

    list-style: none;

    /* margin: 14px 0; */

    margin: 0;

    width: 100%;

    text-align: center;

    padding: 0;

}

.category-menu li{

    font-size: 12px;

    display: inline-block;

    width: 88px;

    /* height: 66px; */

    height: 78px;

    padding: 0;

    text-align: center;

    /* border: 0 solid #9b9b9b; */

    border: 0 solid #2a88ed;

}

.category-menu a{color: #7b7b7b;}

.category-menu a:hover{color: #cc7e30;}

.category-menu li.active{

    border-bottom-width: 4px;

    font-weight:bold;

}

.category-image{

    /* width: 55px;
    height: 42px; */

    width: 60px;
    height: 55px;
    
    /* width: 45px;
    height: 40px; */

    margin: 0 auto;

    /* background: url("<?= base_url('assets/frontpage/img/shop/im-category.png') ?>") no-repeat; */

}

.category-image.cat1{

    background: url("<?= base_url('assets/frontpage/img/shop/menu/equipments/3.png') ?>") no-repeat;

    background-size: contain;

    background-position: center;

    /* background-position: 0 -42px; */

}

.category-image.cat2{

    background: url("<?= base_url('assets/frontpage/img/shop/menu/costumes/4.png') ?>") no-repeat;

    background-size: contain;

    background-position: center;

    /* background-position: 0 -84px; */

}

.category-image.cat3{

    background: url("<?= base_url('assets/frontpage/img/shop/menu/accesories/4.png') ?>") no-repeat;

    background-size: contain;

    background-position: center;

    /* background-position: 0 -252px; */

}

.category-image.cat4{

    background: url("<?= base_url('assets/frontpage/img/shop/menu/consumables/11.png') ?>") no-repeat;

    background-size: contain;

    background-position: center;

    /* background-position: 0 -168px; */

}

.category-image.cat5{

    background: url("<?= base_url('assets/frontpage/img/shop/menu/cloaks/1.png') ?>") no-repeat;

    background-size: cover;

    background-position: center;

    /* background-position: 0 -210px; */

}

.category-image.cat6{

    background: url("<?= base_url('assets/frontpage/img/shop/menu/others/1.png') ?>") no-repeat;

    background-size: contain;

    background-position: center;

    /* background-position: 0 0; */

}



/* hover/active */

.category-menu li.active .category-image.cat1,

.category-menu li:hover .category-image.cat1{

    /* background-position: -55px -42px; */

}

.category-menu li.active .category-image.cat2,

.category-menu li:hover .category-image.cat2{

    /* background-position: -55px -84px; */

}

.category-menu li.active .category-image.cat3,

.category-menu li:hover .category-image.cat3{

    /* background-position: -54px -252px; */

}

.category-menu li.active .category-image.cat4,

.category-menu li:hover .category-image.cat4{

    /* background-position: -55px -168px; */

}

.category-menu li.active .category-image.cat5,

.category-menu li:hover .category-image.cat5{

    /* background-position: -54px -210px; */

}

.category-menu li.active .category-image.cat6,

.category-menu li:hover .category-image.cat6{

    /* background-position: -50.5px 0; */

}

#menu_cover ul.category-menu li.cat_icon {
    transition: 0.3s;
}

#menu_cover ul.category-menu li.cat_icon:hover {
    opacity: 0.6;
}

</style>



<div class="mt-2 mb-2"> 

    <ul class="category-menu">

        <?php 

        $im_cat_counter = 0;

        foreach($im_category as $key) :

        $im_cat_counter++;

        ?>

            <li class="cat_icon pointer <?= $im_cat_counter === 1 ? 'active' : ''; ?>" data-id="<?= $key['id']; ?>" data-category="<?= $key['categoryname']; ?>">
                <div class="category-image cat<?= $im_cat_counter; ?>" style="border: 2px solid black;border-radius: 3px;background-color: transparent;box-shadow: 0 2px 15px 1px rgba(14, 43, 69, 0.75);">
                </div>

                <?= $key['categoryname']; ?>

            </li>

        <?php 

        endforeach;

        ?> 

    </ul>

</div>