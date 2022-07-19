<style type="text/css">
    .modal-confirm {        
        color: #636363;
        width: 325px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }
    .modal-confirm .modal-header {
        border-bottom: none;   
        position: relative;
    }
    .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
    }   
    .modal-confirm .icon-box {
        color: #fff;        
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #82ce34;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .modal-confirm.modal-dialog {
        margin-top: 80px;
    }
</style>
<?php
$stat = $this->session->flashdata('shop');
$popup_class = 'success';
$icon = 'Successfull';
if($stat=='error'){
   $popup_class = 'warning';
   $icon = 'Warning'; 
}
?>
<script>
    let swal_title = "<?= $icon; ?>";
    let swal_type = "<?= $popup_class; ?>";
    
    $(document).ready(function(){
        swal(swal_title,
            "<?= $this->session->flashdata('popup'); ?>",
            swal_type,
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

<!-- <div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box pointer bg-<?= $popup_class; ?>" data-dismiss="modal">
                    <i class="<?= $icon; ?> fa-4x"></i>
                </div>
            </div>
            <div class="modal-body my-4">
                <h5 class="text-center"><?= $this->session->flashdata('popup'); ?></h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-<?= $popup_class; ?> btn-block " data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div> -->
