<?php
    $id = ''; 
    $id_config = ''; 
    if(!empty($config_web)){
        $id_config = $config_web['id']; 
    }
?>
<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white"><h5><b>
            <?= 'My Profile'; ?>
        </b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="form_mp" method="POST" action="<?php print_r(site_url('adm/go_save_my_profile')) ?>" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $id; ?>"> 

	        <div class="row">
                <div class="col-6">
                    <div class="form-group"> 
                        <label for="input_email">Email</label>
                        <input required readonly type="email" class="form-control" placeholder="Input Email" value="<?= $user_admin['email']; ?>" name="input_email" id="input_email">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group"> 
                        <label for="input_nama">Nama</label>
                        <input required type="text" class="form-control" placeholder="Input Nama" value="<?= $user_admin['nama']; ?>" name="input_nama" id="input_nama">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group show_password"> 
                        <label for="input_password">
                            Current Password
                            &nbsp;
                            <button type="button" class="btn_show_password btn btn-sm btn-success">
                                <i class="fa fa-eye"></i>
                            </button>
                        </label>
                        <input required type="password" class="form-control" placeholder="Input Password" value="" name="input_password" id="input_password">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group show_password"> 
                        <label for="input_new_password">
                            New Password
                            &nbsp;
                            <button type="button" class="btn_show_password btn btn-sm btn-success">
                                <i class="fa fa-eye"></i>
                            </button>
                        </label>
                        <input required type="password" class="form-control" placeholder="Input New Password" value="" name="input_new_password" id="input_new_password">
                    </div>
                </div>
            </div> 
			 
	        <div class="form-group m-1"> 
                <button type="submit" class="btn btn-primary">Submit</button>
	        </div>

        </form>
      </div>
	</div>
</div>
<!-- <textarea type="text" class="summernote form-control required" rows="6" placeholder="item set option" id="set_option" name="set_option"></textarea> -->

<script type="text/javascript">
$(document).ready(function(){
	// $('.summernote').summernote({height: 250});
    $(".btn_show_password").click(function(){
        let t = $(this);
        let inp_pass = t.parents('.show_password').find('input');

        if(inp_pass.attr('type') === 'password'){
            t.addClass('btn-danger').removeClass('btn-success');
            t.find('.fa').addClass('fa-eye-slash').removeClass('fa-eye');
            inp_pass.attr('type','text');
        }else{
            t.addClass('btn-success').removeClass('btn-danger');
            t.find('.fa').addClass('fa-eye').removeClass('fa-eye-slash');
            inp_pass.attr('type','password');
        }
    }); 
    console.clear();
})
</script>