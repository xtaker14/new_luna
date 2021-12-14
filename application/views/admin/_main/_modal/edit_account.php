<div id="edit_account_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
          <h5>Edit Account | <small>Edit this information form</small></h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Modal Form-->
        <?php $this->load->helper("form"); ?>
        <form id="edit_account_form" method="POST" action="<?php print_r(site_url('adm/go_edit_account')) ?>">
        <div class="form-group">   
            <input type="text" class="form-control required" placeholder="nama" name="edit_nama" id="edit_nama">
        </div>        
        <div class="form-row">   
          <div class="col-md-6 form-group">   
              <input type="email" class="form-control required" placeholder="email" name="edit_email" id="edit_email">
          </div>
          <div class="col-md-6 form-group">   
              <input type="text" class="form-control required" placeholder="whatsapp number" name="edit_whatsapp" id="edit_whatsapp">
          </div>
          <div class="col-md-6 form-group">           
            <select class="selectpicker form-control required" data-style="bg-white border" data-live-search="true"  id="edit_jabatan" name="edit_jabatan" title="Pilih Jabatan">
            <option value="1,Developer">Developer</option>
            <option value="2,Admin">Admin</option>
            <!-- <option value="3,Moderator Artikel">Moderator Artikel</option>
            <option value="3,Moderator Comment">Moderator Comment</option> -->
            </select>
          </div>
          <div class="col-md-6 form-group pt-1">   
              <p><b>NOTE :</b> jabatan untuk manage Admin Panel</p>
          </div>
        </div>
        <button type="button" class="show_update_password btn btn-sm btn-danger mb-3">Edit Password</button>
        <div class="form_update_password form-row" style="display: none;">
          <div class="col-md-12 form-group">
              <input type="password" class="form-control" placeholder="new password" name="new_password" id="new_password">
          </div>
        </div>
        <button type="submit" class="btn-block btn btn-primary">Update Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    $(document).on('click','.show_update_password',function(){

      var check = confirm("Yakin edit password?");
      if(check){
        $('.form_update_password').show();
        $(this).hide();
      }

    })

$("#edit_account_form").validate({
  rules:{
    nama : { required : true},
    email : { required : true},
    whatsapp : { required : true},
    jabatan : { required : true},
  },
  messages:{
    nama : { required : "isi nama" },
    email : { required : "isi email yang valid" },
    whatsapp : { required : "isi nomer whatsapp" },
    jabatan : { required : "pilih jabatan" },
  }
});
})
</script>
