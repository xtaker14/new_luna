<style>
	.parent_dynamic_page hr{
		background-color: #fff;
	}
</style>
<div class="card p-1" data-aos="fade-right" style="height: 100%;">
	<div class="card-body parent_dynamic_page" style="height: 100%; background: #09262e; border-radius:4px;">
		<?= $data['content'] ?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('html').removeClass('no-js');
})
</script>