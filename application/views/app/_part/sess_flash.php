<!-- 
<?php
    // $this->load->helper('form');
    // $error = $this->session->flashdata('error');
    // if($error) :
?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php //echo $this->session->flashdata('error'); ?>                    
</div>
<?php //endif; ?>

<?php  
    // $success = $this->session->flashdata('success');
    // if($success) :
?>
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php //echo $this->session->flashdata('success'); ?>
</div>
<?php //endif; ?> 
-->

<!-- <div class="row">
    <div class="col-md-12 mb-2">
        <?php //echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
    </div>
</div> -->

<?php
// $this->load->helper('form');
$error = $this->session->flashdata('error');
if($error) :
?>
    <script>
        $(document).ready(function(){
            swal("Warning",
                "<?= $error; ?>",
                "warning",
            {
                buttons: { 
                    button_1: "OK!", 
                },
            })
            .then((value) => {
                switch (value) {
                    default:
                        break;
                    }
            });
        });
    </script>
<?php 
endif; 
?>

<?php  
$success = $this->session->flashdata('success');
if($success) :
?>
    <script>
        $(document).ready(function(){
            swal("Successfull",
                "<?= $success; ?>",
                "success",
            {
                buttons: { 
                    button_1: "OK!", 
                },
            })
            .then((value) => {
                switch (value) {
                    default:
                        break;
                    }
            });
        });
    </script>
<?php 
endif; 
?>
