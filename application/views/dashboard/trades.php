<script src="<?php echo URL; ?>js/datatables/tabletools/dataTables.tableTools.min.js" type="text/javascript"></script>
<link rel="stylesheet"  src="<?php echo URL; ?>js/datatables/tabletools/dataTables.tableTools.css">
<div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php  _ex("Completed trades"); ?></h3>
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
                    <script type="text/javascript">
                    jQuery(document).ready(function($)
                    {
                        $("#trades").dataTable({
						    "dom": 'T<"clear">lfrtip',
							"tableTools": {
								"sSwfPath": "<?php echo URL; ?>js/datatables/tabletools/copy_csv_xls_pdf.swf"
							}	
                        });
                    });
                    </script>
				
    <div id="trades_wrapper" class="table-responsive table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap no-footer"><table class="table table-bordered table-striped dataTable no-footer" id="trades" role="grid" aria-describedby="trades_info">
<thead>
<tr role="row">
<th class="sorting" tabindex="0" aria-controls="trades" rowspan="1" colspan="1" aria-label="<?php  _ex("Market"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 177px;"><?php  _ex("Market"); ?></th>
<th class="sorting" tabindex="0" aria-controls="trades" rowspan="1" colspan="1" aria-label="<?php  _ex("Amount"); ?>: <?php  _ex("activate to sort column ascending"); ?>" style="width: 111px;"><?php  _ex("Amount"); ?>
<th class="sorting" tabindex="0" aria-controls="trades" rowspan="1" colspan="1" aria-label="<?php  _ex("Total Cost"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 238px;"><?php  _ex("Cost"); ?></th>
<th class="sorting" tabindex="0" aria-controls="trades" rowspan="1" colspan="1" aria-label="<?php  _ex("Price"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Price"); ?></th>
<th class="sorting" tabindex="0" aria-controls="trades" rowspan="1" colspan="1" aria-label="<?php  _ex("Time"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Time"); ?></th>
<th class="sorting" tabindex="0" aria-controls="trades" rowspan="1" colspan="1" aria-label="<?php  _ex("Buy Or Sell"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Buy Or Sell"); ?>
<th class="sorting" tabindex="0" aria-controls="trades" rowspan="1" colspan="1" aria-label="<?php  _ex("Date"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Date"); ?>
<th class="sorting" tabindex="0" aria-controls="trades" rowspan="1" colspan="1" aria-label="<?php  _ex("Invoice"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Invoice"); ?>
</th>
</tr>
                        </thead>
                        <tbody class="middle-align">
                 <?php  foreach($trades as $r){ ?>     
             <tr role="row" class="odd">
                                <td><?php  echo $r->market; ?></td>
                                <td><?php  echo $r->amount; ?></td>
                                <td><?php  echo $r->cost; ?></td>
                                <td><?php  echo $r->price; ?></td>
                                <td><?php  echo $r->time; ?></td>
                                <td><?php  echo $r->buysell; ?></td>
								<td><?php  echo $r->date; ?></td>
								<td>                            
								<a  id="viewinvoice" href="<?php  echo URL.'dashboard/invoice?id='. $r->id; ?>" value="<?php  echo $r->id; ?>" class="btn btn-success btn-sm btn-icon icon-left">
                                <?php  _ex("View Invoice"); ?>
                                    </a></td>
                            </tr>
                     <?php  } ?>
                            </tbody>
                    </table>
                                    </div>
            </div>
			</div></div></div>
