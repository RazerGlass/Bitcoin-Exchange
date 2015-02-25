 	<script src="<?php echo URL; ?>js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo URL; ?>js/jvectormap/regions/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo URL; ?>js/xenon-widgets.js"></script>

 <div class="panel col-sm-9 col-xs-12">
	<div class="panel-heading">
		 General information
	</div>
	<div class="panel-body">
		<div class="row">
		    <div class="col-xs-12">
			<div class="col-sm-4">
			    <div class="xe-widget xe-counter xe-counter-orange" data-count=".num" data-from="0" data-to="<?php echo round($totalbtc->total,4); ?>" data-suffix=" BTC" data-duration="3" data-easing="false">
				    <div class="xe-icon">
					<i class="fa-btc"></i>
					</div>
					<div class="xe-label">
					     <strong class="num"><?php echo round($totalbtc->total,4); ?></strong>
						 <span>Total BTC Trades</span>
						 </div>
				</div></div>
				<div class="col-sm-4">
			    <div class="xe-widget xe-counter xe-counter-gray" data-count=".num" data-from="0" data-to="<?php echo round($totalltc->total,4); ?>" data-suffix=" LTC" data-duration="2" data-easing="false">
				    <div class="xe-icon">
					<i class="fa-ltc"></i>
					</div>
					<div class="xe-label">
					     <strong class="num"><?php echo round($totalltc->total,4); ?></strong>
						 <span>Total LTC Trades</span>
						 </div>
				</div></div>	
				<div class="col-sm-4">
			    <div class="xe-widget xe-counter xe-counter-green" data-count=".num" data-from="0" data-to="<?php echo round($totalusd->total4); ?>" data-suffix=" USD" data-duration="2" data-easing="false">
				    <div class="xe-icon">
					<i class="fa-usd"></i>
					</div>
					<div class="xe-label">
					     <strong class="num"><?php echo round($totalusd->total4); ?></strong>
						 <span>Total USD Trades</span>
						 </div>
				</div></div>	
                <div class="col-sm-4">
			    <div class="xe-widget xe-counter xe-counter-blue" data-count=".num" data-from="0" data-to="<?php echo round($totalppc->total,4); ?>" data-suffix=" PPC" data-duration="2" data-easing="false">
				    <div class="xe-icon">
					<i class="fa-ppc"></i> 
					</div>
					<div class="xe-label">
					     <strong class="num"><?php echo round($totalppc->total,4); ?></strong>
						 <span>Total PPC Trades</span>
						 </div>
				</div></div>	
                <div class="col-sm-4">
			    <div class="xe-widget xe-counter xe-counter-turquoise" data-count=".num" data-from="0" data-to="<?php echo round($totalnmc->total,4); ?>" data-suffix=" NMC" data-duration="2" data-easing="false">
				    <div class="xe-icon">
					<i class="fa-nmc"></i>
					</div>
					<div class="xe-label">
					     <strong class="num"><?php echo round($totalnmc->total,4); ?></strong>
						 <span>Total NMC Trades</span>
						 </div>
				</div></div>
                <div class="col-sm-4">
			    <div class="xe-widget xe-counter xe-counter-turquoise" data-count=".num" data-from="0" data-to="<?php echo round($profit,4); ?>" data-suffix=" Profit" data-duration="2" data-easing="false">
				    <div class="xe-icon">
					<i class="fa-nmc"></i>
					</div>
					<div class="xe-label">
					     <strong class="num"><?php echo round($profit,4); ?></strong>
						 <span>Profit</span>
						 </div>
				</div></div>					
			</div>
		</div>
					
				</div>
</div>	
