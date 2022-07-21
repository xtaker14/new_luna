<div data-aos="fade-right" data-aos-delay="500" id="srv_rank" class="card shadow-sm mb-3" style="" align="center">
	<div class="card-body">
		<!-- <h4 class="text-secondary"><b><img src="<?= base_url('assets/frontpage/img/icon/cute3.png'); ?>" width="40" height="40">Player Ranking</b></h4> -->
		
		<div class="d-md-flex p-2" style="padding-top: 0px !important; padding-bottom: 7px !important;"> 
			<div class="d-block" style="width: 100%;">
				<h3 style="padding-bottom:5px;margin:0px;" class="text-primary border-bottom">
				  <img class="mr-2" src="<?= CDN_IMG.('assets/frontpage/img/nav/wing.png'); ?>" style="width: 40px; height: 35px; margin-top:-15px;margin-left:-10px;">    
					<b>Level Rank</b>
				</h3>
			</div>
		</div> 

		<div class="table-responsive">
			<table class="table table-responsive-md table-sm table_global_level_rank">
				<thead>
					<tr style="background: #2a88ed;color: #fff;">
						<!-- <th scope="col">#</th> -->
						<th scope="col">Job</th>
						<th scope="col">Nickname</th>
						<th scope="col">Level</th> 
						<!-- <th scope="col">Exp</th> -->
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<div class="d-block p-2" align="center">
			<a href="<?= base_url('rank') ?>" class="btn-one" style="width:100% !important; position: relative; display: block;">View All</a>
		</div>
	</div>
</div>
