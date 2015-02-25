<div class="panel panel-default">
				<div class="panel-heading hidden-print"><?php _ex("Invoice"); ?></div>
				<div class="panel-body">
					
					<section class="invoice-env">
					
						<!-- Invoice header -->
						<div class="invoice-header">
							
							<!-- Invoice Options Buttons -->
							<div class="invoice-options hidden-print">
								<a href="#" class="btn btn-block btn-gray btn-icon btn-icon-standalone btn-icon-standalone-right text-left">
									<i class="fa-envelope-o"></i>
									<span><?php _ex("Send"); ?></span>
								</a>
								
								<a href="#" onclick="window.print();" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right btn-single text-left">
									<i class="fa-print"></i>
									<span><?php _ex("Print"); ?></span>
								</a>
							</div>
							
							<!-- Invoice Data Header -->
							<div class="invoice-logo">
							
								<a href="#" class="logo">
									<img src="<?php echo URL; ?>img/logo.png" class="img-responsive">
								</a>
								
								<ul class="list-unstyled">
									<li class="upper"><?php _ex("Invoice No");?>. <strong>#<?php echo $invoice->id; ?></strong></li>
									<li><?php echo $invoice->date; ?></li>
								</ul>
								
							</div>
							
						</div>
						
						
						<!-- Client and Payment Details -->
						<div class="invoice-details">
							
							<div class="invoice-client-info">
								<strong><?php _ex("Client"); ?></strong>
								
								<ul class="list-unstyled">
									<li><?php echo htmlspecialchars($this->model->decrypt($username->firstname),ENT_QUOTES); ?> </li>
									<li><?php echo htmlspecialchars($this->model->decrypt($username->lastname),ENT_QUOTES); ?> </li>
								</ul>
								
								<ul class="list-unstyled">		
									<li><?php echo htmlspecialchars($this->model->decrypt($username->address1),ENT_QUOTES); ?> </li>
									<li><?php echo htmlspecialchars($this->model->decrypt($username->address2),ENT_QUOTES); ?> </li>
									<li><?php echo htmlspecialchars($this->model->decrypt($username->city),ENT_QUOTES); ?> </li>
									<li><?php echo htmlspecialchars($this->model->decrypt($username->zip),ENT_QUOTES); ?> </li>
								</ul>
							</div>
							
							<div class="invoice-payment-info">
								<strong><?php _ex("Company Details"); ?>:</strong>
								
								<ul class="list-unstyled">
									<li><?php _ex("Company Reg"); ?>: #<strong><?php echo htmlspecialchars($site->vat,ENT_QUOTES); ?></strong></li>
									<li><?php _ex("Website Name"); ?>: <strong><?php echo htmlspecialchars($site->sitename,ENT_QUOTES); ?></strong> </li>
									<li><?php _ex("Address"); ?>: </li>
									<li><strong><?php echo $site->address; ?></strong></li>
								</ul>
							</div>
							
						</div>
						
						
						<!-- Invoice Entries -->
						<table class="table table-bordered">
							<thead>
								<tr class="no-borders">
									<th class="text-center hidden-xs"><?php _ex("Market"); ?></th>
									<th class="text-center hidden-xs"><?php _ex("Quantity"); ?></th>
									<th class="text-center"><?php _ex("Price"); ?></th>
									<th class="text-center"><?php _ex("Date"); ?></th>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td class="text-center hidden-xs"><?php echo $invoice->market; ?></td>
									<td><?php echo $invoice->amount; ?></td>
									<td class="text-center hidden-xs"><?php echo $invoice->cost; ?></td>
									<td class="text-right text-primary text-bold"><?php echo $invoice->date; ?></td>
								</tr>
								
							</tbody>
						</table>
						
						<!-- Invoice Subtotals and Totals -->
						<div class="invoice-totals">
							
							<div class="invoice-subtotals-totals">
								<span>
									<?php _ex("Total amount (before fee)"); ?>:
									<strong></strong>
								</span>
								
								<span>
									<?php _ex("Fee Percentage"); ?>: 
									<strong><?php echo $site->fees; ?>%</strong>
								</span>
								<hr>
								
								<span>
									<?php _ex("Grand Total (after fee) "); ?>:
									<strong><?php echo $invoice->cost; ?></strong>
								</span>
							</div>
						
							
						</div>
						
					</section>
					
				</div>
			</div></div></div>