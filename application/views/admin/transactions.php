					<script type="text/javascript">
					jQuery(document).ready(function($)
					{
						$("#transactions").dataTable({
						
							aLengthMenu: [
								[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
							]
						});
					});
					</script>

<div class="col-sm-9 col-xs-12">
<div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php  _ex("Transactions"); ?></h3>
                    <div class="panel-options">
                        <a href="#" data-toggle="panel">
                            <span class="collapse-icon">-</span>
                            <span class="expand-icon">+</span>
                        </a>
                        <a href="#" data-toggle="remove">
                            x
                        </a>
                    </div>
                </div>
                <div class="panel-body">
				<div class="table-responsive">
   <table class="table table-bordered dataTable no-footer" id="transactions">
<thead>
<th><?php  _ex("Type"); ?></th>
<th><?php  _ex("Address"); ?></th>
<th><?php  _ex("Transaction ID"); ?></th>
<th><?php  _ex("Amount"); ?></th>
<th><?php  _ex("Date"); ?></th>
</th>

                        </thead>
                        <tbody class="middle-align">
                 <?php  foreach($transactions as $r){ ?>     
             <tr role="row" class="odd">
                                <td nowrap><?php if($r->transaction == 'deposit'){ echo '<font color="green">'.ucwords($r->transaction).'</font>'; }else{ echo '<font color="red">'.ucwords($r->transaction).'</font>';}?></td>
                                <td><?php  echo $r->address; ?></td>
								<td><?php  echo $r->txid; ?></td>
								<td><?php  echo round($r->amount,6); ?></td>								
                                <td><?php  echo $r->date; ?></td>
                            </tr>
                     <?php  } ?>
                            </tbody>
                    </table></div>
</div>
</div>
</div>

