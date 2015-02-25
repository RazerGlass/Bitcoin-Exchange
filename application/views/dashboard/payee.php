<script type="text/javascript">
jQuery(document).ready(function($)
{
  $("#payees").dataTable(
  {
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"]
    ]
  });
});
</script>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php  _ex("Manage Payees");?></h3>
  </div>
  <div class="panel-body">
  <form action="" method="POST">
  <input type="hidden" name="add_payee" value="1">
      <div class="col-xs-12">
        <div class="input-group">
          <span class="input-group-addon"><?php _ex("Payee Address"); ?></span>
          <input type="text" id="address" name="address" class="form-control">
        </div>
		<br/>
		 <div class="input-group">
          <span class="input-group-addon"><?php _ex("Payee Name"); ?></span>
          <input type="text" id="name" name="name" class="form-control">
        </div>
        <br/>
		<div class="input-group">
          <span class="input-group-addon"><?php _ex("Coin Type"); ?></span>
          <select name="coin" class="form-control"><option value="Bitcoin">Bitcoin</option><option value="Litecoin">Litecoin</option></select>
        </div>
		<br/>
        <p class="tandc">IMPORTANT NOTE: Please ensure that all information given above is accurate and complete as any error or incomplete information may result in the transaction being delayed, lost or not being processed. Cryptxe accepts no responsibility for any loss or damage suffered by any person arising out of this transaction.
        </p>
        <br/>
        <div class="form-submit col-md-offset-1 col-md-10 pull-right">
          <input class="btn btn-info btn-lg" type="submit" value="Submit">
        </div>
      </div>
	  </form>
      <br/>
      <br/>
      <table class="table table-bordered table-striped dataTable no-footer" id="payees" role="grid" aria-describedby="payees_info">
        <thead>
          <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="payees" rowspan="1" colspan="1" aria-label="<?php  _ex(" Address "); ?>: <?php  _ex("activate to sort column ascending "); ?>" style="width: 111px;">
              <?php _ex( "Address"); ?>
            </th>
            <th class="sorting" tabindex="0" aria-controls="payees" rowspan="1" colspan="1" aria-label="<?php  _ex(" Payee Name "); ?>: <?php  _ex("activate to sort column ascending "); ?>" style="width: 111px;">
              <?php _ex( "Payee Name"); ?>
            </th>
			<th class="sorting" tabindex="0" aria-controls="payees" rowspan="1" colspan="1" aria-label="<?php  _ex("Coin"); ?>: <?php  _ex("activate to sort column ascending "); ?>" style="width: 111px;">
              <?php _ex("Coin"); ?>
            </th>
            </th>
          </tr>
        </thead>
        <tbody class="middle-align">
          <?php foreach($payees as $payee){ ?>
          <tr role="row" class="odd">
		  <td>
            <?php echo htmlentities($payee->address,ENT_QUOTES); ?></td>
            <td>
              <?php echo htmlentities($payee->name,ENT_QUOTES); ?></td>
			<td>
              <?php echo htmlentities($payee->coin,ENT_QUOTES); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
  </div>
</div>
</div>
</div>
</div>