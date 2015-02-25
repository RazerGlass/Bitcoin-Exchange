<section class="mailbox-env">
				
				<div class="row">
					
					<!-- Inbox emails -->
					<div class="col-sm-9 col-xs-12 mailbox-right">
						
						<div class="mail-env">
						
							<script type="text/javascript">
								jQuery(document).ready(function($)
								{
									var $state = $(".mail-table thead input[type='checkbox'], .mail-table tfoot input[type='checkbox']"),
										$chcks = $(".mail-table tbody input[type='checkbox']");
									$state.on('change', function(ev)
									{
										if($state.is(':checked'))
										{
											$chcks.prop('checked', true).trigger('change');
										}
										else
										{
											$chcks.prop('checked', false).trigger('change');
										}
									});
									$chcks.each(function(i, el)
									{
										var $tr = $(el).closest('tr');
										
										$(this).on('change', function(ev)
										{
											$tr[$(this).is(':checked') ? 'addClass' : 'removeClass']('highlighted');
										});
									});

									$(".mail-table .star").on('click', function(ev)
									{
										ev.preventDefault();
										
										if( ! $(this).hasClass('starred'))
										{
											$(this).addClass('starred').find('i').attr('class', 'fa-star');
										}
										else
										{
											$(this).removeClass('starred').find('i').attr('class', 'fa-star-empty');
										}
									});
								});
							</script>
						
							<!-- mail table -->
							<table class="table mail-table">
							
								<!-- mail table header -->
								<thead>
									<tr>
										<th class="col-cb">
											<div class="cbr-replaced"><div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div><div class="cbr-state"><span></span></div></div>
										</th>
										<th colspan="4" class="col-header-options">
											
											<div class="mail-select-options"><?php _ex("Select all"); ?></div>
										</th>
									</tr>
								</thead>
							
								<!-- mail table footer -->
								<tfoot>
									<tr>
										<th class="col-cb">
											<div class="cbr-replaced"><div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div><div class="cbr-state"><span></span></div></div>
										</th>
										<th colspan="4" class="col-header-options">
											
											<div class="mail-select-options"><?php _ex("Select all"); ?></div>

										</th>
									</tr>
								</tfoot>
								
								<!-- email list -->
								<tbody>
									<?php foreach($messages as $message){ ?>
									<tr class="<?php echo $message->messageread; ?>">
										<td class="col-cb">
											<div class="checkbox checkbox-replace">
												<div class="cbr-replaced"><div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div><div class="cbr-state"><span></span></div></div>
											</div>
										</td>
										<td class="col-name">
											<a href="#" class="star">
												<i class="fa-star-empty"></i>
											</a>
											<a href="<?php echo URL; ?>user/message?message=<?php echo $message->id; ?>" class="col-name"><?php echo $message->whofrom; ?></a>
										</td>
										<td class="col-subject">
											<a href="<?php echo URL; ?>user/message?message=<?php echo $message->id; ?>">
												<?php echo $message->title; ?>
											</a>
										</td>
										<td class="col-options hidden-sm hidden-xs"></td>
										<td class="col-time"><?php echo $message->date; ?></td>
									</tr>
									<?php } ?>
								</tbody>
								
							</table>
							
						</div>
						
					</div>
					
					<!-- Mailbox Sidebar -->
					<div class="col-sm-3 col-xs-12 mailbox-left">
						
						<div class="mailbox-sidebar">

							<ul class="list-unstyled mailbox-list">
								<li>
									<a href="<?php echo URL; ?>/user/messages/">
										<?php _ex("All"); ?>
								<?php
								$this->model->messagecount();
								?>
									</a>
								</li>
								<li>
									<a href="<?php echo URL; ?>/user/messages?type=news">
										<?php _ex("News"); ?>
									</a>
								</li>
								<li>
									<a href="<?php echo URL ?>/user/messages?type=account">
										<?php _ex("Account"); ?>
									</a>
								</li>

							</ul>
							
							<div class="vspacer"></div>
							
						</div>
						
					</div>
					
				</div>
				
			</section>