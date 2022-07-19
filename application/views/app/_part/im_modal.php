<style type="text/css">

  [type=radio] { 

  opacity: 1;

  /* width: 0;

  height: 0; */

}



/* IMAGE STYLES */

[type=radio] + img {

  -webkit-transition: all 100ms ease-in;

     -moz-transition: all 100ms ease-in;

          transition: all 100ms ease-in;

  -webkit-filter: brightness(1.3) grayscale(0.5) opacity(.8);

     -moz-filter: brightness(1.3) grayscale(0.5) opacity(.8);

          filter: brightness(1.3) grayscale(0.5) opacity(.8);

}



/* CHECKED STYLES */

[type=radio]:checked + img {

    -webkit-filter: none;

       -moz-filter: none;

            filter: none;

}



ul#piece_list li:not(:last-child) .piece_item{

  /* border-bottom: 1px dashed #939fff; */

  border-bottom: 1px dashed #fff;

  margin-bottom: 15px;

} 



ul#piece_list li table.table td, 

ul#piece_list li table.table th{

  border-top: 1.5px dashed #3c840b;

}



#im_modal .modal-content{ 

  /* background-color: #fffde8; */

  background-color: #2a88ed;

  padding: .25rem !important;

  border-width: 3px;

  border-style: solid;

  border-color: #61551E;

  overflow: visible;

  box-shadow: 2px 2px 10px rgba(0,0,0,0.5)

}

#im_modal .modal-content #item-title{

  color: #fff;

}

</style>



<div id="im_modal" class="modal">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <i class="ibb"></i>

      <div style="position: absolute;top:-20px;right: -20px;z-index:100;">

        <button type="button" class="btn btn-danger rounded-circle" data-dismiss="modal"><i class="fas fa-times"></i></button>

      </div>

      <!-- <div class="modal-header">

        <h5 id="item-title"></h5>

      </div> -->

      <div class="modal-body" align="center">    

        <form id="im_form" action="<?= site_url('go_buy'); ?>" method="post" accept-charset="utf-8" >      

          <div class="form-row d-flex mb-2">

            <div class="col-md-12">

              <h5 id="item-title"></h5> 

            </div>

            <div class="col-md-6" style="margin:0 auto;max-height: 200px;overflow: hidden;display:flex;">

              <div class="item-set-image">

                <img id="item-img" src="<?= base_url('assets/frontpage/img/noimage.jpg') ?>" alt="item detail" class="float-left mx-auto" style="width: 150px;" >

              </div>

            </div>

            <div id="item-effect"></div>

          </div>

          <div class="d-block mb-3">

            <div id="item-desc" align="justify" style="text-align: left; color: #fff;"></div>

          </div>



          <?php if(isset($star_point)){ ?>

            <div style="text-align: left;">

              <label style="color: #fff;">Payment Type :</label>

            </div>

            <div style="text-align: left;margin-bottom:10px;">

              <label class="" style="color: #0a3994;">

                <input checked type="radio" name="payment_type" value="cash_point">
                <b>Diamonds : </b>
                <span>

                  <span class="star_point">

                    <?= $star_point; ?>

                  </span>

                  <i class="fas fa-gem" data-fa-transform="rotate-30"></i>

                </span>

              </label>

            </div>

          <?php } ?>



          <div style="text-align: left;">

            <label style="color: #fff;">Select One :</label>

          </div>



          <div class="d-block border mb-3 p-2" align="left">

            <ul id="piece_list" class="list_none"></ul>

          </div>

          <div id="buy_notice" class="d-block my-2"></div>

          <div id="btn-imBuy" class="d-block text-danger" align="center">

          </div>

          <input type="hidden" name="<?= $xepo_secure['name'] ?>" value="<?= $xepo_secure['hash'] ?>">

        </form>

      </div>

      <i class="iba"></i>

    </div>

  </div>

</div>

