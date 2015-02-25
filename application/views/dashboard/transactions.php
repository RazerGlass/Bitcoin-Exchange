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
    <div id="transactions_wrapper" class="table-responsive table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap no-footer">
	<table class="table table-bordered table-striped dataTable no-footer" id="transactions" role="grid" aria-describedby="transactions_info">
<thead>
<tr role="row">
<th class="sorting" tabindex="0" aria-controls="transactions" rowspan="1" colspan="1" aria-label="<?php  _ex("Type"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 177px;"><?php  _ex("Type"); ?></th>
<th class="sorting" tabindex="0" aria-controls="transactions" rowspan="1" colspan="1" aria-label="<?php  _ex("Address"); ?>: <?php  _ex("activate to sort column ascending"); ?>" style="width: 111px;"><?php  _ex("Address"); ?></th>
<th class="sorting" tabindex="0" aria-controls="transactions" rowspan="1" colspan="1" aria-label="<?php  _ex("Transaction ID"); ?>: <?php  _ex("activate to sort column ascending"); ?>" style="width: 111px;"><?php  _ex("Transaction ID"); ?></th>
<th class="sorting" tabindex="0" aria-controls="transactions" rowspan="1" colspan="1" aria-label="<?php  _ex("Amount"); ?>: <?php  _ex("activate to sort column ascending"); ?>" style="width: 111px;"><?php  _ex("Amount"); ?></th>
<th class="sorting" tabindex="0" aria-controls="transactions" rowspan="1" colspan="1" aria-label="<?php  _ex("Date"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Date"); ?></th>
</th>
</tr>
                        </thead>
                        <tbody class="middle-align">
                 <?php  foreach($transactions as $r){ ?>     
             <tr role="row" class="odd">
                                <td><?php if($r->transaction == 'deposit'){ echo '<font color="green">'.ucwords($r->transaction).'</font>'; }else{ echo '<font color="red">'.ucwords($r->transaction).'</font>';}?></td>
                                <td><?php  echo $r->address; ?></td>
								<td><?php  echo $r->txid; ?></td>
								<td><?php  echo $r->amount; ?></td>								
                                <td><?php  echo $r->date; ?></td>
                            </tr>
                     <?php  } ?>
                            </tbody>
                    </table>
</div>
</div>
</div>
</div>
</div>
