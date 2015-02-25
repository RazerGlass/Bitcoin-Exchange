		<div class="col-md-9">
			
					<div class="panel-group" id="accordion-test-2">
					<?php foreach ($pages as $page) { ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion-test-<?php echo $page->id; ?>" href="#collapseOne-<?php echo $page->id; ?>" class="collapsed">
									 <?php echo $page->title; ?>
									</a>
								</h4>
							</div>
							<div id="collapseOne-<?php echo $page->id; ?>" class="panel-collapse collapse" style="height: 0px;">
								<div class="panel-body">
									 <?php echo $page->body; ?>
									 <br/><a class="btn btn-danger pull-right" value="" href="<?php echo ADMINURL; ?>/editpage/?id=<?php echo $page->id; ?>">Edit page</a>
                                     	</div>
							</div>
						</div>
					<?php } ?>
					</div>
			
				</div> 