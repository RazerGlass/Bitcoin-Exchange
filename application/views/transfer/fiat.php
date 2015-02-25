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

	<?php switch(strtolower($market)):
	case 'usd':
	echo '
	   <div class="col-sm-4 col-sm-offset-4">
	   <form  method="post" action="https://www.okpay.com/process.html" target="_blank">
	   <input type="hidden" name="ok_receiver" value="OK896242887"/>
	   <input type="hidden" name="ok_item_1_name" value="Cryptxe Deposit '.$user->id.'"/>
	   <input type="hidden" name="ok_item_1_type" value="donation">
	   <input type="hidden" name="ok_currency" value="USD"/>
	   <input type="hidden" name="ok_fees" value="1"/>
	   <!-- Do not edit this unless you want someone else to get your payment!-->
	   <input type="hidden" name="ok_item_1_custom_1_value" value="'.$user->username.'"/>
	   <input type="hidden" name="invoice" value="'.uniqid().'"/>
	   <input type="image" name="submit" alt="OKPAY Payment" src="https://dev.okpay.com/img/buttons/en/buy/b23b186x54en.png"/>
	</form>
    </div>';
	break;
	case 'gbp':
	echo '
	   <div class="col-sm-4 col-sm-offset-4">
	   <form  method="post" action="https://www.okpay.com/process.html" target="_blank">
	   <input type="hidden" name="ok_receiver" value="OK896242887"/>
	   <input type="hidden" name="ok_item_1_name" value="Cryptxe Deposit #'.$user->id.'"/>
	   <input type="hidden" name="ok_item_1_type" value="donation">
	   <input type="hidden" name="ok_currency" value="GBP"/>
	   <input type="hidden" name="ok_fees" value="1"/>
	   <!-- Do not edit this unless you want someone else to get your payment!-->
	   <input type="hidden" name="ok_item_1_custom_1_value" value="'.$user->username.'"/>
	   <input type="hidden" name="invoice" value="'.uniqid().'"/>
	   <input type="image" name="submit" alt="OKPAY Payment" src="https://dev.okpay.com/img/buttons/en/buy/b23b186x54en.png"/>
	</form>
    </div>';
    break;
	case 'eur':
	echo '
	   <div class="col-sm-4 col-sm-offset-4">
	   <form  method="post" action="https://www.okpay.com/process.html" target="_blank">
	   <input type="hidden" name="ok_receiver" value="OK896242887"/>
	   <input type="hidden" name="ok_item_1_name" value="Cryptxe Deposit #'.$user->id.'"/>
	   <input type="hidden" name="ok_item_1_type" value="donation">
	   <input type="hidden" name="ok_currency" value="EUR"/>
	   <input type="hidden" name="ok_fees" value="1"/>
	   <!-- Do not edit this unless you want someone else to get your payment!-->
	   <input type="hidden" name="ok_item_1_custom_1_value" value="'.$user->username.'"/>
	   <input type="hidden" name="invoice" value="'.uniqid().'"/>
	   <input type="image" name="submit" alt="OKPAY Payment" src="https://dev.okpay.com/img/buttons/en/buy/b23b186x54en.png"/>
	</form>
    </div>';
	break;
	endswitch; ?>
  
    <p></p>
    <table class="table table-bordered table-striped dataTable no-footer" id="transactions" role="grid" aria-describedby="transactions_info">
      <thead>
        <tr role="row">
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