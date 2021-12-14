<div id="mod_userpanel" class="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" align="center">
          <div class="box_header_title">
            <span></span>
            <span></span> 
            <div class="content_header_title">
              <h2><i class="fas fa-user-cog mr-2"></i>User Panel</h2> 
            </div>
          </div>
          <ul class="list_none">
            <li class="pb-2"><a href="<?= base_url('daily_login') ?>" class="btn-hover btn color-blue btn-block">Daily Login</a></li>
            <li class="pb-2"><a href="<?= base_url('teleport') ?>" class="btn-hover btn color-blue btn-block">Change Map</a></li>
            <!-- <li class="pb-2"><a href="<?= base_url('history') ?>" class="btn-hover btn color-blue btn-block">Top-up History</a></li> -->
            <li class="pb-2"><a href="<?= base_url('change_pwd') ?>" class="btn-hover btn color-blue btn-block">Change Password</a></li>
            <li class="pb-2"><a href="<?= base_url('pin_req') ?>" class="btn-hover btn color-blue btn-block">Change PIN</a></li>
            <li class="pb-2"><a href="<?= base_url('change_email') ?>" class="btn-hover btn color-blue btn-block">Change Email</a></li>
          </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-hover btn color-red w-50" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
