 <div class="col-md-9">
				
					<div class="panel-group panel-group-joined" id="accordion-test">
					<?php foreach ($guides as $guide) { ?>		
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
										<a href="<?php echo ADMINURL. '/editguide/?gurl='.$guide->url; ?>"><?php echo $guide->title; ?></a>
									</a>
								</h4>
							</div>
							</div>
							<?php } ?>
						

</div></div>