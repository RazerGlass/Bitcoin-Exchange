<div class="panel panel-default">
<h2 style="font-family: Inika; font-weight: 700;"><?php _ex("Developer Guide"); ?></h2>
  <div class="panel-body">
  
  <div class="panel panel-plain">
            <div class="panel-heading">
                <h3 class="panel-title">Field Descriptions</h3>
            </div>
            <table class="table table-striped">
                <tbody><tr>
                    <td><strong><?php _ex("Public Key"); ?></strong></td>
                    <td><?php _ex("This is the public key to identify your account"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php _ex("Secret Key"); ?></strong></td>
                    <td><?php _ex("A sha256 generated key for you to sign messages with"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php _ex("Message"); ?></strong></td>
                    <td><?php _ex("A value that will be encoded with the secret key "); ?></td>
                </tr>
                <tr>
                    <td><strong><?php _ex("API URL"); ?></strong></td>
                    <td><?php _ex("Depending on the API request depends on the URL"); ?></td>
                </tr>
            </tbody></table>
        </div>
  
    <h2 style="font-family: Inika; font-weight: 700;"><?php _ex("Price Ticker"); ?></h2>
	 <br/>
      
	  <?php _ex("Sample Response"); ?> <pre>{"BTC_USD":{"high":445,"low":384,"avg":414.5,"vol":1.0950625,"last":384,"buy": 397,"sell": 395}}</pre>
    

	<div class="panel panel-plain">
        <div class="panel-heading">
            <h3 class="panel-title"><?php _ex("Field Descriptions"); ?></h3>
        </div>
        <table class="table table-striped">
            <tbody>
				<tr>
                    <td><strong><?php _ex("btc_usd"); ?></strong></td>
                    <td><?php _ex("This is the market, you can replace that value with a valid market in our system"); ?>
					<a href="<?php echo URL;?>api/ticker?ticker=btc_usd"> <b>api/ticker?ticker=btc_usd</b> </a>
					</td>
                </tr>
                <tr>
                    <td><strong><?php _ex("btc_usd"); ?></strong></td>
                    <td><?php _ex("Highest completed trade in that market"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php _ex("Low"); ?></strong></td>
                    <td><?php _ex("Lowest completed trade in that market"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php _ex("AVG"); ?></strong></td>
                    <td><?php _ex("Average price of trades in that market"); ?></td>
                </tr>	
                <tr>
                    <td><strong><?php _ex("VOL"); ?></strong></td>
                    <td><?php _ex("Total volume of trades in that market"); ?></td>
					
                </tr>	
                <tr>
                    <td><strong><?php _ex("LAST"); ?></strong></td>
                    <td><?php _ex("Price of last trade"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php _ex("BUY"); ?></strong></td>
                    <td><?php _ex("Current buy price for that pair"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php _ex("Sell"); ?></strong></td>
                    <td><?php _ex("Current sell price for that pair"); ?></td>
                </tr>				
            </tbody>
		</table>
    </div>

		
    <h2 style="font-family: Inika; font-weight: 700;"><?php _ex("My Orders"); ?></h2>
	<br/>
    
	<?php _ex("Sample Response"); ?> 
	
	<pre>{"orders":[{"id":"135","market":"BTC_USD","amount":"0.48","cost":"109.6075","price":"219.215","buysell":"sell","beforefee":"0.5"}]}</pre> 

    <div class="panel panel-plain">
        <div class="panel-heading">
            <h3 class="panel-title"><?php _ex("Field Descriptions"); ?></h3>
        </div>
        <table class="table table-striped">
            <tbody>
			    <tr>
                    <td><strong><?php _ex("API URL"); ?></strong></td>
                    <td><?php _ex("Send a POST request to the corresponding URL "); ?>
					<a href="<?php echo URL;?>api/orders/"> <b>api/orders/</b> </a> </a></td>
					</td>
                </tr>
			    <tr>
                    <td><strong><?php _ex("Public Key"); ?></strong></td>
                    <td><?php _ex("Your public key "); ?></td>
					</td>
                </tr>
			    <tr>
                    <td><strong><?php _ex("Private Key"); ?></strong></td>
                    <td><?php _ex("Your message will need to be signed via SHA with your secret key"); ?></td>
					</td>
                </tr>
			    <tr>
                    <td><strong><?php _ex("Message"); ?></strong></td>
                    <td><?php _ex("Your message must be the number 1 to view all of your open orders"); ?></td>
					</td>
                </tr>
			</tbody>
		</table>
	</div>
	
    <h2 style="font-family: Inika; font-weight: 700;"><?php _ex("My Transactions"); ?></h2>
	<br/>
    
	<?php _ex("Sample Response"); ?> 
      
    <pre>{"transactions":[{"address":"1LNnnFnuLvaFZ7wnBzGri4FdfNEKqk3spD","txid":"fd57d8d0f7ec61de563da92f4e0ab0506fad5707ce3d146270829746ced82e25","amount":"0.02000000","type":"deposit","time":"1423176634"},}]}</pre> </div>
    
	<div class="panel panel-plain">
        <div class="panel-heading">
            <h3 class="panel-title"><?php _ex("Field Descriptions"); ?></h3>
        </div>
        <table class="table table-striped">
            <tbody>
			    <tr>
                    <td><strong><?php _ex("API URL"); ?></strong></td>
                    <td><?php _ex("Send a POST request to the corresponding URL "); ?>
					<a href="<?php echo URL;?>api/orders/"> <b>api/transactions/</b> </a> </a></td>
					</td>
                </tr>
				<tr>
                    <td><strong><?php _ex("Private Key"); ?></strong></td>
                    <td><?php _ex("Your message will need to be signed via SHA with your secret key"); ?></td>
					</td>
                </tr>
			    <tr>
                    <td><strong><?php _ex("Message"); ?></strong></td>
                    <td><?php _ex("Your message must be the number 1 to view all of your transactions"); ?></td>
					</td>
                </tr>
			</tbody>
		</table>
	</div>

    <h2 style="font-family: Inika; font-weight: 700;"><?php _ex("Delete an order"); ?></h2>
	<br/>
    
	<?php _ex("Sample Response"); ?> 
    <pre>{"result":[{"success":true,"deleted":"135"}]}</pre>
    
	<div class="panel panel-plain">
        <div class="panel-heading">
            <h3 class="panel-title"><?php _ex("Field Descriptions"); ?></h3>
        </div>
        <table class="table table-striped">
            <tbody>
			    <tr>
                    <td><strong><?php _ex("API URL"); ?></strong></td>
                    <td><?php _ex("Send a POST request to the corresponding URL "); ?>
					<a href="<?php echo URL;?>api/deleteorder/"> <b>api/deleteorder/</b> </a> </a></td>
					</td>
                </tr>
				<tr>
                    <td><strong><?php _ex("Private Key"); ?></strong></td>
                    <td><?php _ex("Your message will need to be signed via SHA with your secret key"); ?></td>
					</td>
                </tr>
			    <tr>
                    <td><strong><?php _ex("Message"); ?></strong></td>
                    <td><?php _ex("Your message must be the id of the order you wish to delete/cancel"); ?></td>
					</td>
                </tr>
			</tbody>
		</table>
	</div>	
	
	<h2 style="font-family: Inika; font-weight: 700;"><?php _ex("PHP Sample"); ?></h2>
	<br/>
	
	<pre>

        // User Public/Private Keys<br/>
        $private_key = 'fjeiwortjt94j3ifomwoe20r39tjgemof';<br/>
        $public_key = 'fwoe293rtjgemfor305t4-rgjmeo';<br/><br/>

        // Data to be submitted<br/>
        $data = '135';<br/><br/>

        // Generate content verification signature<br/>
        $sig = base64_encode(hash_hmac('sha1', $data, $private_key, TRUE));<br/>

        // Prepare json data to be submitted<br/>
        $json_data = json_encode(array('data'=>$data, 'sig'=>$sig, 'pubkey'=>$public_key));
        <br/><br/>
        // Finally submit to api end point<br/>
        echo urlencode($json_data);

	</pre>
	
  </div>
</div>