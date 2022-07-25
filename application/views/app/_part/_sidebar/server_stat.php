<div data-aos="fade-right" data-aos-delay="300" id="srv_status" class="card shadow-sm p-1" style="">
	<div class="card-body" style="padding-top: 10px; background: #2a88ed; border-radius:4px;">   
		<div class="d-md-flex p-2" style="padding-top: 0px !important; padding-bottom: 7px !important;"> 
			<div class="d-block" style="width: 100%;">
				<h3 style="padding-bottom:5px;margin:0px;color:#fff;" class="border-bottom">
					<img class="float-left mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 45px;height: 40px;margin-top:-9px;">    
					<b>Server Info</b>
				</h3>
			</div>
		</div>  
		
		<li class="list-group-item border-0 py-0" style="text-align: center;color:#fff;">
			<b><?= $config_web['server_location']; ?></b>
		</li> 
		<li class="list-group-item border-0 py-0">
			<hr style="border:1px dashed #D8D5C7;width:100%;max-width:100%;background-color:transparent;margin-top:10px;margin-bottom:10px;">
		</li> 
		<li class="list-group-item border-0 py-0" style="color: #06218d;">
			<?= $config_web['server_cap_lvl']; ?>
		</li>
		<li class="list-group-item border-0 py-0" style="color: #0b2eb6;">
			EXP Rate : 
			<span class="text-warning"><b><?= $config_web['server_exp']; ?></b></span>
		</li>
		<li class="list-group-item border-0 py-0" style="color: #0b2eb6;">
			Gold Rate : 
			<span class="text-warning"><b><?= $config_web['server_gold']; ?></b></span>
		</li>
		<li class="list-group-item border-0 py-0" style="color: #0b2eb6;">
			Drop Rate : 
			<span class="text-danger"><b><?= $config_web['server_drop']; ?></b></span>
		</li>
	
	</div>
</div> 