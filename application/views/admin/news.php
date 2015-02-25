
	<div class="col-md-9">
					<div class="panel-group" id="accordion-test-2">
					<?php foreach ($newss as $news) { ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion-test-<?php echo $news->id; ?>" href="#collapseOne-<?php echo $news->id; ?>" class="collapsed">
									 <?php echo $news->title; ?>
									</a>
								</h4>
							</div>
							<div id="collapseOne-<?php echo $news->id; ?>" class="panel-collapse collapse" style="height: 0px;">
								<div class="panel-body">
									 <?php echo $news->message; ?>
									 <br/>
							<a class="btn btn-success pull-right" value="" href="<?php echo ADMINURL; ?>/editnews/?id=<?php echo $news->id; ?>">Edit news</a>
                            <a class="btn btn-danger pull-right" id="delete<?php echo $news->id;?>" value="">Delete news</a>
		   <script>
			document.getElementById('delete<?php echo $news->id;?>').onclick = function () {
			if (confirm('Are you sure?')) {
				parent.location='<?php echo ADMINURL."/deletenews/?id=" . $news->id; ?>';
			}
		};
		</script>
								 </div>
							</div>
						</div>
					<?php } ?>
					</div>
			
				</div> 