<?php 
$list = '';
foreach ($adm_list as $key => $v) {
  $id = $v->usr_role;
  $title = $v->title;
  $list .= '<option value="'.$id.'">'.$title.'</option>';
}
 ?>
<div id="mod_register" class="modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body row">
        <div class="col-md-6 mb-2 mb-sm-0">
          <h5><b><u>Account Register</u></b></h5>
          <form id="reg_form" action="<?= site_url('adm/reg_game_member')?>" method="post" accept-charset="utf-8" >
            <div class="form-group">
              <label for="UserLevel">Jabatan :</label>
              <select class="form-control" id="vy_rank!" name="vy_rank!" required>
                <?= $list; ?>
              </select>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-user-circle"></i>
                    </div>
                  </div>
                <input class="form-control" type="text" name="user_id" placeholder="User id" minlength="4" maxlength="16" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-envelope"></i>
                    </div>
                  </div>
                <input class="form-control" type="email" name="id_email" placeholder="Email" maxlength="128"  required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </div>
                  </div>
                <input class="form-control" type="password" name="password" placeholder="Password" minlength="6" maxlength="16" required>
              </div>      
            </div>
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </div>
                  </div>
                <input class="form-control" type="password" name="c_password" placeholder="Comfirm Password" minlength="6" maxlength="12" required>
              </div>      
            </div>
            <hr>
            <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </div>
                  </div>
                <input class="form-control" type="" name="pin" pattern="[0-9]{6}" placeholder="Pin code" minlength="6" maxlength="6" required>
              </div>
              <small><b>* 6 digits number only, for buy item mall</b></small>     
            </div>
            <div class="form-group" align="left">
                <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-check mr-2"></i>Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
        <div class="col-md-6 border-left mb-2 mb-sm-0" align="left">
          <h5><b><u>Privacy Police</u></b></h5>
          <ul class="mb-3">
            <li class="p-1">
              <i class="fas fa-check-circle text-success"></i>
              <small><span>All of data is only for Game Reqruitment.</span></small>
            </li>
            <li class="p-1">
              <i class="fas fa-check-circle text-success"></i>
              <small><span>We never use your data for our personal goals.</span></small>
            </li>
            <li class="p-1">
              <i class="fas fa-check-circle text-success"></i>
              <small><span>Your email and password is keep secret.</span></small>
            </li>
            <li class="p-1">
              <i class="fas fa-check-circle text-success"></i>
              <small><span>You are accept all of our term and condition.</span></small>
            </li>
          </ul>
          <div class="d-block border p-2">
            <p><b>TIPS : </b> Don't share your account information to other user.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  /*
  $(document).on("submit", "#reg_form", function(e){

        e.preventDefault();     
        $('button[type="submit"]',this).prop('disabled', true).html('<i class="fas fa-sync fa-spin mr-2"></i> Wait..'); 

        var form =  $(this);

        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            dataType: "JSON",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data, status)
            {
              $('button[type="submit"]',form).html('<i class="fas fa-check mr-2"></i> Success..').addClass('btn-success');
              //$("#mod_register").modal("hide");
              window.location.href = baseURL+"adm/g_account_list";
            },
            error: function (xhr, desc, err)
            {
              $('button[type="submit"]',form).html('<i class="fas fa-times-circle mr-2"></i> Error..').addClass('btn-danger'); 
            }
        });
    });
    */
    $("#mod_register").on('hidden.bs.modal', function(){
      var form = $("#reg_form");
      form.trigger("reset");
      $('button[type="submit"]',form).prop('disabled', false).addClass('btn-primary').html('<i class="fas fa-check mr-2"></i>Submit').removeClass('btn-danger').removeClass('btn-success');
    });
})
</script>