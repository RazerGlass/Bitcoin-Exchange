		<div class="col-md-9">
			
					<div class="panel-group" id="accordion-test-2">
					<?php foreach ($faqs as $faq) { ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion-test-<?php echo $faq->id; ?>" href="#collapseOne-<?php echo $faq->id; ?>" class="collapsed">
									 <?php echo $faq->title; ?>
									</a>
								</h4>
							</div>
							<div id="collapseOne-<?php echo $faq->id; ?>" class="panel-collapse collapse" style="height: 0px;">
								<div class="panel-body">
									 <?php echo $faq->faq; ?>
									 <br/>
		   <script>
		   $( document ).ready(function() {
			document.getElementById('delete<?php echo $faq->id;?>').onclick = function () {
			if (confirm('Are you sure?')) {
				parent.location='<?php echo ADMINURL."/deletefaq/?id=" . $faq->id; ?>';
			}
		};
		});
		</script>									 
									 <a class="btn btn-danger pull-right" id="delete<?php echo $faq->id; ?>">Delete FAQ</a>
									 <a class="btn btn-success pull-right" value="" href="<?php echo ADMINURL; ?>/editfaq/?id=<?php echo $faq->id; ?>">Edit FAQ</a>
                                     	</div>
							</div>
						</div>
					<?php } ?>
					</div>
			
				</div> 