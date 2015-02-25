<div class="col-sm-6 col-sm-offset-3 ">
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
								<input value="<?php echo htmlentities($email); ?>" name="email" type="hidden" />
								<input value="1" name="submit" type="hidden" />

								<div class="well well-sm">
								<?php echo $this->model->decrypt($user->security_question1); ?>
						     	</div>
								<div class="form-group">
									<input type="text" value="<?php if(isset($_POST['secanswer'])) echo htmlentities($this->model->decrypt($_POST['secanswer']),ENT_QUOTES); ?>" name="secanswer" class="form-control" size="25" placeholder="<?php _ex("Security Answer 1"); ?>">
								</div>
						        <div class="well well-sm">
								<?php echo $this->model->decrypt($user->security_question2); ?>
						     	</div>
								<div class="form-group">
									<input type="text" value="<?php if(isset($_POST['secanswer2'])) echo htmlentities($this->model->decrypt($_POST['secanswer2']),ENT_QUOTES); ?>" name="secanswer2" class="form-control" size="25" placeholder="<?php _ex("Security Answer 2"); ?>">
								</div>
							
								<div class="form-group">
									<button class="btn btn-secondary btn-single"><?php _ex("Reset Password"); ?></button>
								</div>
							</form>							
						</div>
					</div>
				
				</div>