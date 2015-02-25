<div class="panel col-sm-9">
   <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("Coins"); ?></h3>
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
		<script type="text/javascript">
					jQuery(document).ready(function($)
					{
					   $("#coins-2").dataTable(
					   {
					   aLengthMenu: [
					   [10, 25, 50, 100, -1],
					   [10, 25, 50, 100, "5"]
					   ]
					   });
						$("#coins-1").dataTable({
							dom: "t" + "<'row'<'col-xs-6'i><'col-xs-6'p>>",
							aoColumns: [
								{bSortable: false},
								null,
								null,
								null,
								null
							],
						});

					
					});
					</script>
					<table class="table table-bordered table-striped" id="coins-2">      
	  <thead>
               <tr role="row">
                  <th class="no-sorting sorting_asc" rowspan="1" colspan="1" aria-label="
                     " style="width: 16px;">
                     <div class="cbr-replaced">
                        <div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div>
                        <div class="cbr-state"><span></span></div>
                     </div>
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="coins-1" rowspan="1" colspan="1" aria-label="<?php _ex("Coin"); ?>: activate to sort column ascending" style="width: 176px;"><?php _ex("Coin"); ?></th>
                  <th class="sorting" tabindex="0" aria-controls="coins-1" rowspan="1" colspan="1" aria-label="<?php _ex("Description"); ?> activate to sort column ascending" style="width: 113px;"><?php _ex("Description"); ?></th>
				  <th class="sorting" tabindex="0" aria-controls="coins-1" rowspan="1" colspan="1" aria-label="<?php _ex("Title"); ?>: activate to sort column ascending" style="width: 191px;"><?php _ex("Title"); ?></th>
				  <th class="sorting" tabindex="0" aria-controls="coins-1" rowspan="1" colspan="1" aria-label="<?php _ex("Enabled"); ?>: activate to sort column ascending" style="width: 191px;"><?php _ex("Enabled"); ?></th>
				    <th class="sorting" tabindex="0" aria-controls="coins-1" rowspan="1" colspan="1" aria-label="<?php _ex("Actions"); ?>: activate to sort column ascending" style="width: 191px;"><?php _ex("Actions"); ?></th>

				  </tr>
            </thead>
            <tbody class="middle-align">
			<?php foreach ($coin as $coins){ ?>
               <tr role="row" class="odd">
                  <td class="sorting_1">
                     <div class="cbr-replaced">
                        <div class="cbr-input"><input type="checkbox" class="cbr cbr-done"></div>
                        <div class="cbr-state"><span></span></div>
                     </div>
                  </td>
                  <td><?php echo $coins->coin; ?></td>
                  <td><?php echo $coins->description; ?></td>
				  <td><?php echo $coins->title; ?></td>
				  <td>
				  <?php if($coins->enabled == 0){ echo '<font color="red">Disabled</font>';}else{ echo '<font color="green">Enabled</font>';}  ?>
				  </td>
                  <td>
                     <a href="<?php echo ADMINURL.'/editcoin/?id='. $coins->id; ?>" class="btn btn-secondary btn-sm btn-icon icon-left">
                     Edit
                     </a>
                     <a href="<?php echo ADMINURL.'/deletecoin/?id='. $coins->id .'&coin='.$coins->coin; ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                     Delete
                     </a>
                  </td>
               </tr>
			   <?php } ?>
               </tr>
            </tbody>
         </table>
      </div>
	  </div>
	  
	  
	  
 