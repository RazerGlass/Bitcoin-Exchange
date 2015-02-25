<?php
function _ex($text){
  echo gettext($text);
}
?>
<div class="col-sm-4 col-xs-12 col-sm-offset-1">
								
<!-- Live Ask  -->
<strong><?php _ex("Trades"); ?></strong>
									
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
			<th><?php _ex("Market"); ?></th>
			<th><?php _ex("Amount"); ?></th>
			<th><?php _ex("Price"); ?></th>
			<th><?php _ex("Buy/Sell"); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($trademarket as $trade){ ?>
			<tr>
			<td><?php echo $trade->market; ?></td>
			<td><?php echo $trade->amount; ?></td>
		    <td><?php echo $trade->price; ?></td>
			<td><?php if($trade->buysell == "buy"){ echo '<font color="green">Buy</font>';}else{ echo '<font color="red">Sell</font>';  } ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>							
</div>
<div class="col-sm-3 col-xs-12">
								
<!-- Live Ask  -->
<strong><?php _ex("Ask"); ?></strong>
									
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
			<th><?php _ex("Market"); ?></th>
			<th><?php _ex("Amount"); ?></th>
			<th><?php _ex("Price"); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($buymarket as $buy){ ?>
			<tr>
			<td><?php echo $buy->market; ?></td>
			<td><?php echo $buy->amount; ?></td>
		    <td><?php echo $buy->price; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>							
</div>

<div class="col-sm-3 col-xs-12">
								
<!-- Bordered + Striped Table -->
     <strong><?php _ex("Sell"); ?></strong>								
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
			<th><?php _ex("Market"); ?></th>
			<th><?php _ex("Amount"); ?></th>
			<th><?php _ex("Price"); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($sellmarket as $sell){ ?>
			<tr>
			<td><?php echo $sell->market; ?></td>
			<td><?php echo $sell->amount; ?></td>
		    <td><?php echo $sell->price; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>							
</div>
<div class="col-sm-offset-1"></div>
