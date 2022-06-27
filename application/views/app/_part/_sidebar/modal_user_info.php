<style>
  #mod_userpanel .modal-content{
    background-color: #2a88ed;
    padding: .25rem !important;
    border-width: 3px;
    border-style: solid;
    border-color: #61551E;
    overflow: visible;
    box-shadow: 2px 2px 10px rgba(0,0,0,0.5)
  }
</style>
<div id="mod_userpanel" class="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="position: absolute;top:-20px;right: -20px;z-index:100;">
        <button type="button" class="btn btn-danger rounded-circle" data-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>

      <div class="modal-body" align="center">
           
          <div class="d-md-flex p-2" style="padding-top: 0px !important; padding-bottom: 7px !important;"> 
            <div class="d-block" style="width: 100%;">
              <h3 style="padding-bottom:5px;margin:0px;text-align:center;color:#fff;" class="border-bottom">
                <img class="mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 40px; height: 35px; margin-top:-15px;margin-left:-10px;">    
                <b>SERVICES</b>
              </h3>
            </div>
          </div>

          <ul class="list_none">
            <!-- <li class="pb-2">
              <a href="<?= base_url('daily_login') ?>" class="btn-three btn-block">Daily <b>Login</b></a>
              <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:2px;"> 
            </li> -->
            <li class="pb-2">
              <a href="<?= base_url('teleport') ?>" class="btn-three btn-block">Change <b>Map</b></a>
              <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:2px;"> 
            </li>
            <!-- <li class="pb-2">
              <a href="<?= base_url('history') ?>" class="btn-three btn-block">Top-up History</a>
            </li> -->
            <li class="pb-2">
              <a href="<?= base_url('change_pwd') ?>" class="btn-three btn-block">Change <b>Password</b></a>
              <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:2px;"> 
            </li>
            <li class="pb-2">
              <a href="<?= base_url('pin_req') ?>" class="btn-three btn-block">Change <b>PIN</b></a>
              <hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:2px;"> 
            </li>
            <li class="pb-2">
              <a href="<?= base_url('change_email') ?>" class="btn-three btn-block">Change <b>Email</b></a>
            </li>
          </ul>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn-hover btn color-red w-50" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
