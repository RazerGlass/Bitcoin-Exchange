<section class="mailbox-env">

  <div class="row">

    <!-- Email Single -->
    <div class="col-sm-9 mailbox-right">

      <div class="mail-single">

        <!-- Email Title and Button Options -->
        <div class="mail-single-header">
          <h2>
<?php echo $messages->title; ?>
<span class="badge badge-success badge-roundless pull-right upper"><?php echo $messages->type; ?></span>

<a href="<?php echo URL;?>user/messages/" class="go-back">
<i class="fa-angle-left"></i>
Go Back
</a>
</h2>

          <div class="mail-single-header-options">

            <a href="<?php echo URL;?>user/deletemessage?message=<?php echo $messages->id; ?>" class="btn btn-gray btn-icon">
              <i class="fa-trash"></i>
            </a>
          </div>
        </div>

        <!-- Email Info From/Reply -->
        <div class="mail-single-info">

          <div class="mail-single-info-user dropdown">
            <a href="#" data-toggle="dropdown">
              <span><?php echo $messages->whofrom; ?></span> <?php echo $site->email; ?> to <span>me</span>
              <em class="time"><?php echo $messages->date; ?></em>
            </a>

          </div>

          <div class="mail-single-info-options">
            <a href="#" class="star starred">
              <i class="fa-star-empty"></i>
            </a>
            <a href="#">
              <i class="linecons-attach"></i>
            </a>
          </div>

        </div>

        <!-- Email Body -->
        <div class="mail-single-body">
		<?php echo strip_tags($messages->message,'<br><p><a><img><span><b><i>'); ?>
               </div>
      </div>

    </div>

<div class="col-sm-3 mailbox-left">
						
						<div class="mailbox-sidebar">

							<ul class="list-unstyled mailbox-list">
								<li>
									<a href="<?php echo URL; ?>/user/messages/">
								<?php _ex("All");
								$this->model->messagecount();
								?>
									</a>
								</li>
								<li>
									<a href="<?php echo URL; ?>/user/messages?type=news">
									<?php _ex("News");?>	
									</a>
								</li>
								<li>
									<a href="<?php echo URL ?>/user/messages?type=account">
										<?php _ex("Account");?>
									</a>
								</li>

							</ul>
							
							<div class="vspacer"></div>
							
						</div>
						
					</div>
					
				</div>
				
			</section>