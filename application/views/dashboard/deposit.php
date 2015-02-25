<style>
#example-2_wrapper {
  max-height: 600px;
  overflow: scroll;
}
</style>
<script>
$(function()
{
  $("#bitcoindecrement").click(function()
  {
    $("input#withdrawbitcoinfee").val($("input#withdrawbitcoin").val());
  });
});
$(function()
{
  $("#bitcoinincrement").click(function()
  {
    $("input#withdrawbitcoinfee").val($("input#withdrawbitcoin").val());
  });
});
</script>

<div class="col-xs-12 ">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("Depositing and Withdrawing"); ?></h3>
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

        <table class="table table-bordered table-striped dataTable no-footer" id="example-2" role="grid" aria-describedby="example-2_info">
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
              <th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php _ex(" Currency "); ?>: <?php _ex("activate to sort column ascending "); ?>" style="width: 177px;">
                <?php _ex( "Currency"); ?>
              </th>
              <th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php _ex(" Balance "); ?>: <?php _ex("activate to sort column ascending "); ?>" style="width: 111px;">
                <?php _ex( "Balance"); ?>
              </th>
              <th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php _ex(" Market Description "); ?>: <?php _ex("activate to sort column ascending "); ?>" style="width: 238px;">
                <?php _ex( "Description"); ?>
              </th>
              <th class="sorting" tabindex="0" aria-controls="example-2" rowspan="1" colspan="1" aria-label="<?php _ex(" Actions "); ?>: <?php _ex("activate to sort column ascending "); ?>" style="width: 191px;">
                <?php _ex( "Actions"); ?>
              </th>
            </tr>
          </thead>
          <tbody class="middle-align">
            <?php foreach ($depositcoin as $dcoin){?>
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
                <?php echo $dcoin->title; ?></td>
              <td>
                <?php echo $user->{$dcoin->coin}; ?></td>
              <td>
                <?php echo $dcoin->description; ?>
                <td>
                  <a href="<?php echo URL;?>/transfer/withdraw/?market=<?php echo $dcoin->coin; ?>" class="btn btn-secondary btn-sm btn-icon icon-left">
                    <?php _ex( 'Withdraw'); ?>
                  </a>
                  <a href="<?php echo URL;?>/transfer/deposit/?market=<?php echo $dcoin->coin; ?>" class="btn btn-danger btn-sm btn-icon icon-left pull-right">
                    <?php _ex( 'Deposit'); ?>
                  </a>
                </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- Modal 1 (Basic)-->
    </div>
  </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="modal-gbpdeposit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php _ex("Depositing"); ?> GBP</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="https://www.okpay.com/process.html">
          <input type="hidden" name="ok_receiver" value="OK838779305" />
          <input type="hidden" name="ok_item_1_name" value="Exchange" />
          <input type="hidden" name="ok_currency" value="GBP" />
          <input type="hidden" name="ok_item_1_type" value="service" />
          <input type="hidden" name="ok_item_1_name" value="Deposit to E#<?php  echo $user->id; ?>">
          <input type="hidden" name="ok_fees" value="1" />
          <input type="image" name="submit" alt="OKPAY Payment" src="https://www.okpay.com/img/buttons/en/top-up/t17b186x54en.png" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- deposit usd-->
<div class="modal fade" id="modal-usddeposit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php _ex("Depositing"); ?> USD</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="https://www.okpay.com/process.html">
          <input type="hidden" name="ok_receiver" value="OK838779305" />
          <input type="hidden" name="ok_item_1_name" value="Exchange" />
          <input type="hidden" name="ok_currency" value="USD" />
          <input type="hidden" name="ok_item_1_type" value="service" />
          <input type="hidden" name="ok_item_1_name" value="Deposit to E#<?php  echo $user->id; ?>">
          <input type="hidden" name="ok_fees" value="1" />
          <input type="image" name="submit" alt="OKPAY Payment" src="https://www.okpay.com/img/buttons/en/top-up/t17b186x54en.png" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">
          <?php _ex( "Close"); ?>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- deposit bitcoins-->
<div class="modal fade" id="modal-cxcdeposit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php  _ex('Deposit your CryptxCoins to the address below'); ?></h4>
      </div>
      <pre><?php  _ex('Deposit Wallet Address'); ?>: <?php echo $cxcdeposit; ?></pre>
      <div class="modal-footer">
        <form action="<?php echo URL;?>coins/GenerateWallet">
          <input type="hidden" name="coin" value="cxc">
          <input type="submit" value="<?php _ex(" Generate New Address "); ?>" class="btn btn-white">
        </form>
        <button type="button" class="btn btn-white" data-dismiss="modal">
          <?php _ex( "Close"); ?>
        </button>
      </div>
    </div>
  </div>
</div>