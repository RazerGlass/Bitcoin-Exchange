<script type="text/javascript">
jQuery(document).ready(function($){	
$("#tickets").dataTable({	
aLengthMenu: [	[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]	]
});	});
</script>
<section class="mailbox-env">
  <div class="row ">
      <div class="col-sm-3 mailbox-left">
        <div class="mailbox-sidebar">
          <a href="<?php echo URL; ?>support/newticket" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
            <i class="fa fa-pencil"></i><span><?php _ex("Open Ticket"); ?></span> </a>
          <ul class="list-unstyled mailbox-list">
            <li class="active"> <a href="<?php echo URL; ?>support/"><?php _ex("All Tickets"); ?>
	        <span class="pull-right"><?php echo $all; ?></span> </a> </li>
            <li> <a href="<?php echo URL; ?>support/?type=open"><?php _ex("Open Tickets"); ?></a> </li>
			<li> <a href="<?php echo URL; ?>support/?type=closed"><?php _ex("Closed Tickets"); ?></a> </li>
         <?php if ($this->model->isstaff() == true): ?> <li> <a href="<?php echo URL; ?>support/admin"><?php _ex("Admin"); ?></a> </li> <?php endif; ?>
		 </ul>
          <div class="vspacer"></div>
        </div>
      </div>
      <div class="col-sm-9 mailbox-right panel">
        <table class="table table-bordered dataTable no-footer" id="tickets">
          <thead>
            <td>
              <?php _ex( "ID"); ?>
            </td>
            <td>
              <?php _ex( "Title"); ?>
            </td>
			<?php if ($this->model->isstaff() == true): ?> 
			<td>
              <?php _ex("User"); ?>
            </td>
			<?php endif;?>
            <td>
              <?php _ex( "Status"); ?>
            </td>
            <td>
              <?php _ex( "Last update"); ?>
            </td>
          </thead>
          <tbody>
			<?php foreach ($tickets as $ticket): ?>
			<tr>
			<td><?php echo $ticket->id; ?></td>
			<td><?php echo '<a href="'.URL.'support/ticket/?id='.$ticket->id.'">'.htmlspecialchars($ticket->title,ENT_QUOTES) .'</a>'; ?></td>
			<?php if ($this->model->isstaff() == true): ?> 
			<td><?php echo $ticket->user; ?></td>
			<?php endif;?>
			<td><?php if($ticket->status == 0){ echo '<span class="label label-success">Open</span>'; }else{ echo '<span class="label label-danger">closed</span>'; } ?></td>
			<td><?php echo $ticket->lastupdate; ?></td>
			</tr>
			<?php endforeach; ?>
          </tbody>
        </table>
      </div>
  </div>
</section>