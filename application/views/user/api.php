<style>
#example-2_wrapper
{
    max-height: 300px;
    overflow: scroll;
}
</style>
<div class="col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("Generate API"); ?></h3>
      <div class="panel-options">
        <a href="#" data-toggle="panel">
          <span class="collapse-icon">–</span>
          <span class="expand-icon">+</span>
        </a>
        <a href="#" data-toggle="remove">×</a>
      </div>
    </div>
    <div class="panel-body">
      <div class="panel panel-default">
        <div class="panel-body">
          <form action="<?php echo URL.'user/generateapi';?>" method="POST" class="form-inline">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION["token"], ENT_QUOTES); ?>">
			<div class="form-group">
              <div class="input-group">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" id="" placeholder="<?php _ex(" Enter Name "); ?>">
                </div>
                <div class="form-group">
                  <input type="submit" value="<?php _ex("Generate API"); ?>" name="submit" class="btn btn-success pull-right">
                </div>
              </div>
          </form>
          </div>
        </div>
        <div id="example-2_wrapper" class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">
          <table class="table table-bordered table-striped dataTable no-footer" id="apidetails" role="grid" aria-describedby="apidetails_info">
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
                <th class="sorting" tabindex="0" aria-controls="apidetails" rowspan="1" colspan="1" aria-label="<?php _ex(" Name "); ?>: <?php _ex(" activate to sort column ascending "); ?>" style="width: 177px;">
                  <?php _ex( "Name"); ?>
                </th>
                <th class="sorting" tabindex="0" aria-controls="apidetails" rowspan="1" colspan="1" aria-label="<?php _ex(" Key "); ?>: <?php _ex(" activate to sort column ascending "); ?>" style="width: 177px;">
                  <?php _ex( "Key"); ?>
                </th>
                <th class="sorting" tabindex="0" aria-controls="apidetails" rowspan="1" colspan="1" aria-label="<?php _ex(" Secret "); ?>: <?php _ex(" activate to sort column ascending "); ?>" style="width: 191px;">
                  <?php _ex( "Secret"); ?>
                </th>
                <th class="sorting" tabindex="0" aria-controls="apidetails" rowspan="1" colspan="1" aria-label="<?php _ex(" Actions "); ?>: <?php _ex(" activate to sort column ascending "); ?>" style="width: 191px;">
                  <?php _ex( "Actions"); ?>
                </th>
              </tr>
            </thead>
            <tbody class="middle-align">
              <?php foreach($apis as $uapi){ ?>
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
                  <?php echo htmlspecialchars($uapi->name,ENT_QUOTES); ?>
                </td>
                <td>
                  <?php echo $uapi->pubkey; ?>
                </td>
                <td>
                  <?php echo $uapi->secret; ?>
                </td>
                <td>
                  <a href="<?php echo URL.'user/deleteapi/?api='.$uapi->id; ?>" class="btn btn-danger btn-sm btn-icon icon-left"><?php _ex("Delete"); ?></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>