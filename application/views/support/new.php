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
            <li class="active"> <a href="<?php echo URL; ?>support/"><?php _ex("All Tickets"); ?>
	        <span class="pull-right"><?php echo $all; ?></span> </a> </li>
            <li> <a href="<?php echo URL; ?>support/?type=open"><?php _ex("Open Tickets"); ?></a> </li>
			<li> <a href="<?php echo URL; ?>support/?type=closed"><?php _ex("Closed Tickets"); ?></a> </li>
          </ul>
          <div class="vspacer"></div>
        </div>
      </div>
      <div class="col-sm-9 mailbox-right panel">
<div class="modal-body">
  <div class="form-group">
  <form role="form" method="post">
  <input type="hidden" name="check_submit" value="1">
    <label for="title"><?php _ex("Title"); ?>:</label>
    <input class="form-control" name="title" type="text" id="title">
  </div>
  <div class="form-group">
    <label for="client"><?php _ex("Category"); ?>:</label>
    <select name="category" class="form-control">
      <option value="account"><?php _ex("Account"); ?></option>
      <option value="general"><?php _ex("General Enquiries"); ?></option>
	  <option value="technical"><?php _ex("Technical Department"); ?></option>
    </select>
  </div>

  <div class="form-group">
    <label for="status"><?php _ex("Status"); ?>:</label>
    <select name="status" class="form-control">
      <option value="basic"><?php _ex("Basic"); ?></option>
      <option value="medium"><?php _ex("Medium"); ?></option>
	  <option value="urgent"><?php _ex("Urgent"); ?></option>
    </select>
  </div>
  <div class="form-group">
    <textarea class="form-control wysihtml5" name="message"></textarea>
  </div>
<div class="modal-footer clearfix">
    <button type="button" class="btn btn-danger" data-dismiss="modal">
	<i class="fa fa-times"></i>Discard
    </button>
    <button type="submit" class="btn btn-primary pull-left" style="background-color: #428bca;">
	<i class="fa fa-envelope"></i>Submit Ticket
    </button>
	</form>
</div>
<br />