<div data-aos="fade-right" data-aos-delay="300" id="srv_status" class="card shadow-sm mb-3 p-1" style="margin-top: 30px;">
  <div class="card-body bg-light text-dark">   

	<div class="box_header_title">
		<span></span>
		<span></span> 
		<div class="content_header_title">
			<h2><img src="<?= base_url('assets/frontpage/img/icon/ichigo.png'); ?>" width="30">&nbsp;Server Information</h2> 
		</div>
	</div>
    
	<!--<li class="list-group-item border-top-1 border-right-1 border-left-1 "></li>--> 
	<li class="list-group-item border-0 py-0">
		<div class="clock-container">
			<div class="clock-col">
				<p class="clock-day clock-timer">
				</p>
				<p class="clock-label">
				Day
				</p>
			</div>
			<div class="clock-connector"><p>:</p></div>
			<div class="clock-col">
				<p class="clock-hours clock-timer">
				</p>
				<p class="clock-label">
				Hrs
				</p>
			</div>
			<div class="clock-connector"><p>:</p></div>
			<div class="clock-col">
				<p class="clock-minutes clock-timer">
				</p>
				<p class="clock-label">
				Mins
				</p>
			</div>
			<div class="clock-connector"><p>:</p></div>
			<div class="clock-col">
				<p class="clock-seconds clock-timer">
				</p>
				<p class="clock-label">
				Secs
				</p>
			</div>
		</div>  
	</li>
	<li class="list-group-item border-0 py-2">
		<h4 style="margin-bottom: 0px; margin-top: 5px; text-align:center; background: -webkit-linear-gradient(#90aef0, #36d1dc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"><?= date('d M Y'); ?></h4>
	</li>
	<li class="list-group-item border-0 py-2"><hr></li>
	<li class="list-group-item border-0 py-0">Server status : <span class="text-success"><b>Online</b></span></li>
	<li class="list-group-item border-0 py-2">Player Online : <span class="p_online">1000</span></li>
	<li class="list-group-item border-0 py-2"><hr></li>
	<!--<li class="list-group-item border-top-1 border-right-1 border-left-1 "></li>-->
	<!--<li class="list-group-item border-0 py-0 ">Registered : <span class="account_reg">1000</span></li>-->
	<!--<li class="list-group-item border-0 py-0">Characters :<span class="char_count">1000</span></li> -->
	<li class="list-group-item border-0 py-0">EXP Rate : 40x</li>
	<li class="list-group-item border-0 py-0">Gold Rate : 50x </li>
	<li class="list-group-item border-0 py-0">Drop Rate : 10x </li>
  </div>
</div> 