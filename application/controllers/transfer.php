<?php

class Transfer extends Controller
{
	
	public function deposit()
	{
		//get the header file
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		//check to see if the user is logged in
	    if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		//get the user details
		$username = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($username, $site);
		$this->model->isbanned($username, $site);		
        $this->model->isemailverified($username, $site);
		$this->model->sitenews($_GET['url']);
		$this->model->twofacverify($username);
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		$this->model->error($error);
		$coin = isset($_GET['market']) ? strtolower($_GET['market']) : 'btc';
		$currency = explode('_', $coin);
		$deposits = $this->model->deposits($username,strtolower($currency[0]));
		switch(strtolower($currency[0])){
			case 'btc':
			     $market = 'Bitcoin';
				 $btc = $this->model->btccoin();
		         $deposit = $this->model->wallet('btc',$btc,""); 
				 require APP . 'views/transfer/deposit.php';
			break;
			case 'ltc':
			     $market = 'Litecoin';
				 $ltc = $this->model->ltccoin();
		         $deposit = $this->model->wallet('ltc',$ltc,""); 
				 require APP . 'views/transfer/deposit.php';
			break;
			case 'usd':
				 $market = 'USD';
				 require APP . 'views/transfer/fiat.php';
			break; 
			case 'gbp':
				 $market = 'GBP';
				 require APP . 'views/transfer/fiat.php';
			break;
			case 'eur':
				 $market = 'EUR';
				 require APP . 'views/transfer/fiat.php';
			break; 			
			default:
			      header('location: ' . URL . 'transfer/deposit/?market=btc');
			      exit();
		}

        require APP . 'views/_templates/footer.php';		
	}


    public function withdraw()
	{
		//get the header file
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		//check to see if the user is logged in
	    if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		//get the user details
		$username = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($username, $site);
		$this->model->isbanned($username, $site);		
        $this->model->isemailverified($username, $site);
		$this->model->sitenews($_GET['url']);
		$this->model->twofacverify($username);
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		$this->model->error($error);
		$coin = isset($_GET['market']) ? strtolower($_GET['market']) : 'btc';
		$currency = explode('_', $coin);
		$withdraw = $this->model->withdraws($username,$coin);
		switch($coin):
			case 'btc':
			    $market = 'Bitcoin';
				$coin = 'btc';
				$payees = $this->model->payees($username," AND coin='btc'");
				require APP . 'views/transfer/withdraw.php';
			break;
			case 'ltc':
				$market = 'Litecoin';
				$coin = 'ltc';
				$payees = $this->model->payees($username," AND coin='ltc'");
				require APP . 'views/transfer/withdraw.php';
			break;
			default:
			    header('location: ' . URL . 'transfer/withdraw/?market=btc');
		endswitch;
        require APP . 'views/_templates/footer.php';		
	}	
	
	public function payment()
	{
		$market = isset($_POST['ok_txn_currency']) ? strtolower($_POST['ok_txn_currency']) : '';
		$amount = isset($_POST['ok_txn_net']) ? $_POST['ok_txn_net'] : '';
		$username = isset($_POST['ok_item_1_custom_1_value']) ? $_POST['ok_item_1_custom_1_value'] : '';
		$status = isset($_POST['ok_txn_status']) ? $_POST['ok_txn_status'] : '';
		$txid = isset($_POST['ok_txn_id']) ? $_POST['ok_txn_id'] : '';
		$firstname = isset($_POST['ok_payer_first_name']) ? $_POST['ok_payer_first_name'] : '';
		$lastname = isset($_POST['ok_payer_last_name']) ? $_POST['ok_payer_last_name'] : '';
		$email = isset($_POST['ok_payer_email']) ? $_POST['ok_payer_email'] : '';
		$country = isset($_POST['ok_payer_country']) ? $_POST['ok_payer_country'] : '';
		$state = isset($_POST['ok_payer_state']) ? $_POST['ok_payer_state'] : '';
		$street = isset($_POST['ok_payer_street']) ? $_POST['ok_payer_street'] : '';
		
		
		// Read the post from OKPAY and add 'ok_verify' 
		$req = 'ok_verify=true'; 
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		// Post back to OKPAY to validate 
		$header .= "POST /ipn-verify.html HTTP/1.0\r\n"; 
		$header .= "Host: www.okpay.com\r\n"; 
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n"; 
		$fp = fsockopen ('www.okpay.com', 80, $errno, $errstr, 30); 
		 
		if (!$fp)
		{
			exit('Error postback');
		}
		fputs ($fp, $header . $req); 
		while (!feof($fp))
			$res = fgets ($fp, 1024); 
		fclose ($fp);
		if ($res != "VERIFIED")
		{
			exit('Not verified');
		}

		if($_POST['ok_txn_status'] !== 'completed')
			exit('Invalid ok_txn_status');


			$checktx = $this->db->prepare("SELECT * FROM transactions WHERE txid=? LIMIT 1");
			$checktx->execute(array($txid));
			$result = $checktx->fetch();
			//if(!$result):
				if(isset($market) && isset($amount)):
				$date = date("y-m-d h:i:s");
				//insert into transactions and update balance
				$transaction = $this->db->prepare("INSERT INTO transactions(market,amount,
				username,txid,transaction,status,date,firstname,lastname,email,country,
				state,street) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$transaction->execute(array($market,$amount,$username,$txid,'deposit','1',
				$date,$firstname,$lastname,$email,$country,$state,$street));
				if($transaction):
					//get the user and their balance
					$getuserbalance = $this->db->prepare("SELECT * FROM user WHERE username=?");
					$getuserbalance->execute(array($username));
					$userbalance = $getuserbalance->fetch();
					//this is their new balance
					$newbalance = $amount + $userbalance->{$market};
					$updateuser = $this->db->prepare("UPDATE user SET ".htmlentities($market)."=? WHERE username=?");
					$updateuser->execute(array($newbalance,$username));
				endif;
			endif;
		//endif;
	}
	
}
?>