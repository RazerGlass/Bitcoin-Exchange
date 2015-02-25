<link rel="stylesheet" href="<?php echo URL; ?>js/datatables/dataTables.bootstrap.css">
<script src="<?php echo URL; ?>js/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo URL; ?>js/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo URL; ?>js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
<script src="<?php echo URL; ?>js/datatables/tabletools/dataTables.tableTools.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($)
{
  $("#logininfo").dataTable(
  {
	responsive:true;
  });
});
jQuery(document).ready(function($)
{
  $("#ipwhitelists").dataTable(
  {
	responsive: true;
  });
});
</script>
<style>
#logininfo_wrapper 
{
    max-height: 350px;
    overflow: scroll;
}
#ipwhitelists_wrapper
{
    max-height: 250px;
    overflow: scroll;
}

</style>
<div class="col-sm-7 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("User Logins"); ?></h3>
      <div class="panel-options">
        <a href="#" data-toggle="panel">
          <span class="collapse-icon">–</span>
          <span class="expand-icon">+</span>
        </a>
        <a href="#" data-toggle="remove">×</a>
      </div>
    </div>
    <div class="panel-body">
      <div id="logininfo_wrapper" class="table-responsive dataTables_wrapper form-inline dt-bootstrap">
        <table id="logininfo" class="table-responsive table dt-responsive table-striped table-bordered dataTable" cellspacing="0" width="100%"  role="grid" aria-describedby="logininfo_info" style="width: 100%;">
          <thead>
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="logininfo" rowspan="1" colspan="1" aria-sort="ascending" aria-label="<?php _ex(" Date "); ?>: <?php _ex("activate to sort column ascending "); ?>" style="width: 142px;">
                <?php _ex( "Date"); ?>
              </th>
              <th class="sorting" tabindex="0" aria-controls="logininfo" rowspan="1" colspan="1" aria-label="<?php _ex(" IP Address "); ?>: <?php _ex("activate to sort column ascending "); ?>" style="width: 223px;">
                <?php _ex( "IP Address"); ?>
              </th>
              <th class="sorting" tabindex="0" aria-controls="logininfo" rowspan="1" colspan="1" aria-label="<?php _ex(" Status "); ?>: <?php _ex("activate to sort column ascending "); ?>" style="width: 110px;">
                <?php _ex( "Status"); ?>
              </th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th rowspan="1" colspan="1">
                <?php _ex( "Date"); ?>
              </th>
              <th rowspan="1" colspan="1">
                <?php _ex( "IP address"); ?>
              </th>
              <th rowspan="1" colspan="1">
                <?php _ex( "Status"); ?>
              </th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach($userlogins as $userlogin){ ?>
            <tr role="row" class="odd">
              <td class="sorting_1">
                <?php echo $userlogin->date; ?>
              </td>
              <td>
                <?php echo $userlogin->ip; ?>
              </td>
              <td>
                <?php echo $userlogin->status; ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-5 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("Whitelist IP Addresses"); ?></h3>

      <div class="panel-options">
        <a href="#" data-toggle="panel">
          <span class="collapse-icon">–</span>
          <span class="expand-icon">+</span>
        </a>
        <a href="#" data-toggle="remove">×</a>
      </div>
    </div>
    <div class="panel-body">
      <?php _ex( "If you add 1 or more whitelisted IP Addresses you will not be able to login with another
 non-whitelisted IP. You can add and remove IP addresses. It is not recommended for you
 to use if you have a dynamic IP"); ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-12 col-xs-12">
            <div class="form-group">
				<form action="<?php echo URL.'user/addwhitelistip';?>" method="POST">
                <div class="input-group"> 
				<span class="input-group-btn"> 
				<button class="btn btn-info" type="button">Add</button> 
				</span> 
				<input type="text" name="ipwhitelist" class="form-control no-left-border form-focus-info"> 
				</div>         
				</form>
            </div>
          
        <div id="example-2_wrapper" class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">
                  <table class=" table table-bordered table-striped dataTable no-footer" id="ipwhitelists" role="grid" aria-describedby="ipwhitelists_info">
                    <thead>
                <tr role="row">
                  <th class="no-sorting sorting_asc" rowspan="1" colspan="1" aria-label="
                   " style="width: 16px;">
                    <div class="cbr-replaced">
                      <div class="cbr-input">
                        <input type="checkbox" class="cbr cbr-done">
                      </div>
                      <div class="cbr-state"><span></span>
                      </div>
                    </div>
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="ipwhitelists" rowspan="1" colspan="1" aria-label="Student Name: <?php _ex(" activate to sort column ascending "); ?>" style="width: 177px;"><?php _ex("Whitelisted IP"); ?></th>
                  <th class="sorting" tabindex="0" aria-controls="ipwhitelists" rowspan="1" colspan="1" aria-label="Actions: <?php _ex(" activate to sort column ascending "); ?>" style="width: 191px;"><?php _ex("Actions"); ?></th>
                </tr>
              </thead>
              <tbody class="middle-align">

                <?php 
				$whitelistips= explode( ",",$whitelistips->ipwhitelist); 
				foreach ($whitelistips as $whitelistip){ 
				if($whitelistip > 0){ ?>
                <tr role="row" class="odd">
                  <td class="sorting_1">
                    <div class="cbr-replaced">
                      <div class="cbr-input">
                        <input type="checkbox" class="cbr cbr-done">
                      </div>
                      <div class="cbr-state"><span></span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <?php echo htmlentities($whitelistip,ENT_QUOTES); ?> </td>
                  <td>
                    <a href="<?php echo URL.'user/deleteipwhitelist/?ip='.$whitelistip; ?>" class="btn btn-danger btn-sm btn-icon icon-left"><?php _ex("Delete"); ?></a>
                  </td>
                </tr>
                <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
 