<script>
jQuery(document).ready(function($)
{
  $("#deleteorderb").click(function()
  {
    $("#deleteorder").attr('href', '<?php echo URL;?>dashboard/deleteorders/?id=' + $('#deleteorderb').attr('value') + '&order=buy');
  });
  $("#deleteorders").click(function()
  {
    $("#deleteordersl").attr('href', '<?php echo URL;?>dashboard/deleteorders/?id=' + $('#deleteorders').attr('value') + '&order=sell');
  });
});
</script>

<div class="panel panel-default ">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php  _ex("Open Buying Orders"); ?></h3>
                    <div class="panel-options">
                        <a href="#" data-toggle="panel">
                            <span class="collapse-icon">-</span>
                            <span class="expand-icon">+</span>
                        </a>
                        <a href="#" data-toggle="remove">
                            x
                        </a>
                    </div>
                </div>
                <div class="panel-body">
    <div id="example-2_wrapper" class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">
	<table class="table table-bordered table-striped dataTable no-footer " id="example-2" role="grid" aria-describedby="example-2_info">
<thead>
<tr role="row">
<th class="no-sorting sorting_asc" rowspan="1" colspan="1" aria-label="" style="width: 16px;">
<div class="cbr-replaced">
<div class="cbr-input">
<input type="checkbox" class="cbr cbr-done">
</div>
<div class="cbr-state">
<span>
</span>
</div>
</div>
</th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Market"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 177px;"><?php  _ex("Market"); ?></th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Amount"); ?>: <?php  _ex("activate to sort column ascending"); ?>" style="width: 111px;"><?php  _ex("Amount"); ?>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Total Cost"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 238px;"><?php  _ex("Cost"); ?></th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Price"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Price"); ?></th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Time"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Time"); ?></th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Actions"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Actions"); ?>
</th>
</tr>
                        </thead>
                        <tbody class="middle-align">
<?php  foreach($buyorders as $r){ ?>     
             <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <div class="cbr-replaced"><div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div><div class="cbr-state"><span></span></div></div>
                                </td>
                                <td><?php  echo $r->market; ?></td>
                                <td><?php  echo $r->amount; ?></td>
                                <td><?php  echo $r->cost; ?></td>
                                <td><?php  echo $r->price; ?></td>
                                <td><?php  echo $r->time; ?></td>
                                <td>
                             <a onclick="jQuery('#modal-2').modal('show');" id="deleteorderb" name="deleteorderb" value="<?php echo $r->id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                                     <?php  _ex("Cancel"); ?>
                                    </a>
                                </td>
                            </tr>
                     <?php  } ?>
                            </tbody>
                    </table>
                                    </div>
            </div>
			</div>
                        <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php  _ex("Open Selling Orders"); ?></h3>
                    <div class="panel-options">
                        <a href="#" data-toggle="panel">
                            <span class="collapse-icon">-</span>
                            <span class="expand-icon">+</span>
                        </a>
                        <a href="#" data-toggle="remove">
                            x
                        </a>
                    </div>
                </div>
                <div class="panel-body">
    <div id="buyingorders_wrapper" class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer"><table class="table table-bordered table-striped dataTable no-footer" id="example-2" role="grid" aria-describedby="buyingorders_info">
<thead>
<tr role="row">
<th class="no-sorting sorting_asc" rowspan="1" colspan="1" aria-label="" style="width: 16px;">
<div class="cbr-replaced">
<div class="cbr-input">
<input type="checkbox" class="cbr cbr-done">
</div>
<div class="cbr-state">
<span>
</span>
</div>
</div>
</th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Market"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 177px;"><?php  _ex("Market"); ?></th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Amount"); ?>: <?php  _ex("activate to sort column ascending"); ?>" style="width: 111px;"><?php  _ex("Amount"); ?>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Total Cost"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 238px;"><?php  _ex("Cost"); ?></th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Price"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Price"); ?></th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Time"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Time"); ?></th>
<th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php  _ex("Actions"); ?>:  <?php  _ex("activate to sort column ascending"); ?>" style="width: 191px;"><?php  _ex("Actions"); ?>
</th>
</tr>
                        </thead>
                        <tbody class="middle-align">
<?php 
	foreach ($sellorders as $r){
?>
                        <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <div class="cbr-replaced"><div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div><div class="cbr-state"><span></span></div></div>
                                </td>
                                <td><?php  echo $r->market; ?></td>
                                <td><?php  echo $r->amount; ?></td>
                                <td><?php  echo $r->cost; ?></td>
                                <td><?php  echo $r->price; ?></td>
                                <td><?php  echo $r->time; ?></td>
                                <td>
                             <a onclick="jQuery('#modal-1').modal('show');" id="deleteorders" name="deleteorders" value="<?php  echo $r->id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                                    <?php  _ex("Cancel"); ?>
                                    </a>
                                </td>
                            </tr>
                         <?php  } ?>
                            </tbody>
                    </table>
</div></div></div></div></div> 
    <!-- Modal 2 (Custom Width)-->
    <div class="modal fade custom-width" id="modal-1">
        <div class="modal-dialog" style="width: 20%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php  _ex("Deleting Order"); ?></h4>
                </div>
                <div class="modal-body">        
                <?php  _ex("Are you sure you want to delete your order?"); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal"><?php  _ex("Close"); ?></button>
                    <button type="button" class="btn btn-info"><a id="deleteordersl" href="<?php echo URL; ?>dashboard/deleteorders/?id=0&buysell=buy"><?php  _ex("Delete Order"); ?></a></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 2 (Custom Width)-->
    <div class="modal fade custom-width" id="modal-2">
        <div class="modal-dialog" style="width: 20%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php  _ex("Deleting order"); ?></h4>
                </div>
                <div class="modal-body">
                <?php  _ex("Are you sure you want to delete your order?"); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal"><?php  _ex("Close"); ?></button>
                    <button type="button" class="btn btn-info"><a id="deleteorder" href="<?php echo URL; ?>dashboard/deleteorders/?id=0&buysell=sell">Delete Order</a></button>
                </div>
            </div>
        </div>
    </div>