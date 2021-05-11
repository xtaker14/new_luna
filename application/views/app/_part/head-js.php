<script type="text/javascript">
var baseURL = "<?php print_r(base_url()) ?>";
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/js/all.js" integrity="sha256-aLNFps+os5n+KfcuxSD1/vOz7c/4tAq+Cnpspw9ZGYc=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type='text/javascript' src='<?= base_url(); ?>assets/plugins/revslider/public/assets/js/rbtools.min.js?ver=6.0.4' id='tp-tools-js'></script>
<script type='text/javascript' src='<?= base_url(); ?>assets/plugins/revslider/public/assets/js/rs6.min.js?ver=6.2.8' id='revmin-js'></script> 

<?php
$php_list1 = array('usr_login','usr_register','pin_req','change_pin','change_pwd','teleport','homepage','shop');
if(in_array($php_name, $php_list1)){ ?>
<script src="https://www.google.com/recaptcha/api.js?render=6LfVWswZAAAAAFVNNtg4ypyYFIClSRKoe4uSs6jG"></script>
<script type="text/javascript">
<?php
  $php_list2 = array('usr_login','usr_register','pin_req','change_pin','change_pwd','teleport');
  if(in_array($php_name, $php_list2)){ print_r('grecaptcha_callback();'); }
?>
  function grecaptcha_callback(){
      grecaptcha.ready(function() {
          grecaptcha.execute('6LfVWswZAAAAAFVNNtg4ypyYFIClSRKoe4uSs6jG', {action: 'homepage'}).then(function(token) {
            //console.log(token);
            document.getElementById("g_recaptcha").value = token;
        });
      });
  }
  </script>
<?php } ?>