<script src="<?php echo URL; ?>js/wysihtml5/lib/js/wysihtml5-0.3.0.js" id="script-resource-7"></script>
<script src="<?php echo URL; ?>js/wysihtml5/src/bootstrap-wysihtml5.js" id="script-resource-8"></script>
<link rel="stylesheet" href="<?php echo URL; ?>js/wysihtml5/src/bootstrap-wysihtml5.css" id="style-resource-1">

<section class="mailbox-env">
  <div class="row">
    <div class="col-sm-3 mailbox-left">
      <div class="mailbox-sidebar">
        <a href="<?php echo URL; ?>support/newticket" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
          <i class="fa fa-pencil"></i><span><?php _ex("Open Ticket"); ?></span> </a>
        <ul class="list-unstyled mailbox-list">
          <li class="active">
            <a href="<?php echo URL; ?>support/">
              <?php _ex( "All Tickets"); ?>
              <span class="pull-right"><?php echo $all; ?></span> </a>
          </li>
          <li>
            <a href="<?php echo URL; ?>support/?type=open">
              <?php _ex( "Open Tickets"); ?>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?>support/?type=closed">
              <?php _ex( "Closed Tickets"); ?>
            </a>
          </li>
          <?php if ($this->model->isstaff() == true): ?>
          <li>
            <a href="<?php echo URL; ?>support/admin">
              <?php _ex( "Admin"); ?>
            </a>
          </li>
          <?php endif; ?>
        </ul>
        <div class="vspacer"></div>
      </div>
    </div>
    <div class="col-sm-9 mailbox-right">
      <div class="mail-single">
        <!-- Email Title and Button Options -->
        <div class="mail-single-header">
          <h2><?php echo htmlentities($tickets->title,ENT_QUOTES); ?>
	  <span class="badge badge-success badge-roundless pull-right upper">
	  <?php echo htmlentities($tickets->category,ENT_QUOTES); ?></span>
	  <a href="<?php echo URL; ?>support" class="go-back">
	  <i class="fa-angle-left"></i>Go Back</a></h2>
        </div>
        <div class="mail-single-info">
          <div class="mail-single-info-user dropdown">
            <em class="time"><?php echo htmlentities($tickets->date,ENT_QUOTES); ?></em>
          </div>
        </div>
        <div class="mail-single-body">
          <?php echo strip_tags($tickets->message,'
          <br>
          <p>
            <a><img><span><b><i>'); ?>
        </div>
      </div>
    </div>
    <?php foreach ($ticketreply as $ticket): ?>

    <div class="col-sm-9 mailbox-right">
      <div class="mail-single">
        <div class="mail-single-info">
          <div class="mail-single-info-user dropdown">
            <em class="time"><?php echo htmlentities($ticket->date,ENT_QUOTES); ?></em> 
          </div>
        </div>
        <div class="mail-single-body">
          <?php echo strip_tags($ticket->message,'<br><p><a><img><span><b><i><h1><h2><h3><h4><h5><h6><li><ul>'); ?>
        </div>
      </div>
    </div>
	


<?php endforeach; if($tickets->status == 0): ?>
<div class="col-sm-9 mailbox-right">
<div class="form-group">
  <form role="form" action="<?php echo URL; ?>support/reply" method="post">
  <input type="hidden" name="check_submit" value="1">
  <!-- you can try to change this but if you don't own the ticket it won't work, nice try. !-->
  <input type="hidden" name="ticket" value="<?php echo $tickets->id; ?>">
      <textarea name="message" class="form-control wysihtml5">
<?php 
if ($this->model->isstaff() == true) : 
	echo '<br/><br/>Kind regards, <br/> '.$this->model->decrypt($user->firstname).' Cryptxe Support. <br/><img src="'.URL.'/img/logo.png">';
endif; ?> 
	  </textarea>
</div>
<div class="modal-footer clearfix">
    <button type="submit" class="btn btn-primary pull-left" style="background-color: #428bca;">
        <i class="fa fa-envelope"></i><?php _ex("Submit Ticket"); ?>
    </button>
	<?php if ($this->model->isstaff() == true): ?> 
	    <a href="<?php echo URL; ?>support/resolved?id=<?php echo $tickets->id; ?>&ticket=close" type="submit" class="btn btn-primary pull-right" style="background-color: #428bca;">
        <i class="fa fa-tick"></i><?php _ex("Ticket Resolved"); ?>
        </a>
	</div>
	<?php endif;?>
</form>
</div>
<?php endif; 
      if ($this->model->isstaff() == true && $tickets->status == 1): ?> 
	    <div class="col-sm-9 mailbox-right">
		<div class="modal-footer clearfix">
		<a href="<?php echo URL; ?>support/resolved?id=<?php echo $tickets->id; ?>&ticket=open" type="submit" class="btn btn-primary pull-right" style="background-color: #428bca;">
        <i class="fa fa-tick"></i><?php _ex("Open Ticket"); ?>
        </a>
		</div>
		</div>
		<?php endif; ?>