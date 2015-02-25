<script type="text/javascript">
function CopyToClipboard()
{
  document.getElementById('wallet').focus();
  document.getElementById('wallet').select();
}
jQuery(document).ready(function($)
{
  $("#transactions").dataTable(
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
    <h3 class="panel-title"><?php  _ex("Deposit");  echo ' '.$market;?></h3>
  </div>
  <div class="panel-body">

    <div class="col-sm-4 col-sm-offset-4">
      <img src="https://www.google.com/chart?cht=qr&chs=300x300&chl=<?php echo strtolower($market);?>%3A<?php echo $deposit;?>">
    </div>
    <div class="col-sm-6 col-sm-offset-3">
      <div class="input-group">
        <input type="text" value="<?php echo $deposit;?>" id="wallet" class="form-control">
        <span class="input-group-addon">
    <span onClick="CopyToClipboard(); return false" style="cursor: pointer; cursor: hand; "><?php _ex("Copy"); ?></span> </a>
      </div>
    </div>
    <p></p>
    <table class="table table-bordered table-striped dataTable no-footer" id="transactions" role="grid" aria-describedby="transactions_info">
      <thead>
        <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="transactions" rowspan="1" colspan="1" aria-label="<?php  _ex(" Address "); ?>: <?php  _ex("activate to sort column ascending "); ?>" style="width: 111px;">
              <?php _ex( "Address"); ?>
            </th>
            <th class="sorting" tabindex="0" aria-controls="transactions" rowspan="1" colspan="1" aria-label="<?php  _ex(" Transaction ID "); ?>: <?php  _ex("activate to sort column ascending "); ?>" style="width: 111px;">
              <?php _ex( "Transaction ID"); ?>
            </th>
            <th class="sorting" tabindex="0" aria-controls="transactions" rowspan="1" colspan="1" aria-label="<?php  _ex(" Amount "); ?>: <?php  _ex("activate to sort column ascending "); ?>" style="width: 55px;">
              <?php _ex( "Amount"); ?>
            </th>
            <th class="sorting" tabindex="0" aria-controls="transactions" rowspan="1" colspan="1" aria-label="<?php  _ex(" Date "); ?>:  <?php  _ex("activate to sort column ascending "); ?>" style="width: 81px;">
              <?php _ex( "Date"); ?>
            </th>
          </th>
        </tr>
      </thead>
      <tbody class="middle-align">
        <?php foreach($deposits as $r){ ?>
        <tr role="row" class="odd">
		<td>
            <?php echo $r->address; ?></td>
          <td>
            <?php echo $r->txid; ?></td>
          <td>
            <?php echo $r->amount; ?></td>
          <td>
            <?php echo $r->date; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>