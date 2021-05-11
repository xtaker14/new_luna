<div id="new_account_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
          <h5>New Account | <small>Complete this information form</small></h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Modal Form-->
        <?php $this->load->helper("form"); ?>
        <form id="add_account_form" method="POST" action="<?php print_r(site_url('adm/go_add_account')) ?>">
        <div class="form-group">   
            <input type="text" class="form-control required" placeholder="name" name="name" id="name">
        </div>        
        <div class="form-row">   
          <div class="col-md-6 form-group">   
              <input type="email" class="form-control required" placeholder="email" name="email" id="email">
          </div>
          <div class="col-md-6 form-group">   
              <input type="text" class="form-control required" placeholder="whatsapp number" name="whatsapp" id="whatsapp">
          </div>
          <div class="col-md-6 form-group">           
            <select class="selectpicker form-control required" data-style="bg-white border" data-live-search="true"  id="jabatan" name="jabatan" title="Pilih Jabatan">
            <option value="1,Developer">Developer</option>
            <option value="2,Admin">Admin</option>
            <option value="3,Moderator Artikel">Moderator Artikel</option>
            <option value="3,Moderator Comment">Moderator Comment</option>
            </select>
          </div>
          <div class="col-md-6 form-group pt-1">   
              <p><b>NOTE :</b> jabatan untuk manage Admin Panel</p>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 form-group">   
              <input type="password" class="form-control required" placeholder="password" name="password" id="password">
          </div>
          <div class="col-md-6 form-group">   
              <input type="password" class="form-control required" placeholder="Comfirm password" name="c_password" id="c_password">
          </div>
        </div>
        <button type="submit" class="btn-block btn btn-primary">Add Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

$("#add_account_form").validate({
  rules:{
    name : { required : true},
    email : { required : true},
    whatsapp : { required : true},
    jabatan : { required : true},
    password : { required : true},
    c_password : { required : true, equalTo : password}
  },
  messages:{
    name : { required : "isi nama" },
    email : { required : "isi email yang valid" },
    whatsapp : { required : "isi nomer whatsapp" },
    jabatan : { required : "pilih jabatan" },
    password : { required : "isi password" },
    c_password : { required : "konfirmasi password", equalTo :"password harus sama!" }
  }
});
})
</script>
