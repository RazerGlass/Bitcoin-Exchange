
<div class="col-sm-6 col-sm-offset-3 col-xs-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><?php _ex("Password Reset"); ?></h3>
							<div class="panel-options">
								<a href="#" data-toggle="panel"> 
									<span class="collapse-icon">–</span>
									<span class="expand-icon">+</span>
								</a>
								<a href="#" data-toggle="remove">
									×
								</a>
							</div>
						</div>
						<div class="panel-body">
							
							<form method="POST" action="<?php echo URL; ?>user/passreset" role="form">
								<input value="1" name="check_submit" type="hidden" />
								<div class="form-group">
									<input type="text" value="<?php if(isset($_POST['email'])) echo htmlentities($this->model->decrypt($_POST['email'])); ?>" name="email" class="form-control" size="25" placeholder="<?php _ex("Email"); ?>">
								</div>
								<div class="form-group">
									<button class="btn btn-secondary btn-single"><?php _ex("Reset Password"); ?></button>
								</div>
							</form>							
						</div>
					</div>
				
				</div>