<div data-aos="fade-right" data-aos-delay="500" id="srv_rank" class="card shadow-sm mb-3 p-1" style="margin-top: 30px;">
	<div class="card-body pb-0">
		<!-- <h4 class="text-secondary"><b><img src="<?= base_url('assets/frontpage/img/icon/cute3.png'); ?>" width="40" height="40">Player Ranking</b></h4> -->
		
		<div class="box_header_title">
			<span></span>
			<span></span> 
			<div class="content_header_title">
				<h2><img src="<?= base_url('assets/frontpage/img/icon/cute3.png'); ?>" width="30">&nbsp;Player Ranking</h2> 
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-responsive-md table-sm">
				<thead>
					<tr>
					<th scope="col">Rank</th>
					<th scope="col">Name</th>
					<th scope="col">Level</th> 
					</tr>
				</thead>
				<tbody id="side_rank"></tbody>
			</table>
		</div>
		<div class="d-block p-2" align="center">
			<a href="<?= base_url('rank') ?>" class="btn btn-sm btn-hover color-blue" >View all</a>
		</div>
	</div>
</div>
