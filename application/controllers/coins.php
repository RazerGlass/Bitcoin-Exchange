<?php

class Coins extends Controller
{
	
	public function GenerateWallet($generate=null)
	{
		ob_start();
		//don't need this session, delete it :D
	    SESSION_START();
		$coin = isset($_GET['coin']) ? $_GET['coin'] : '';
		if($coin != ''){
		//check to make sure coin is on our site or throw an error
			switch($coin)
			{
				case 'btc':
				     $btc = $this->model->btccoin();
					 echo $this->model->wallet('btc',$btc,"generate");
					 header('location: ' . URL . 'dashboard/deposit/');
				break;
				case 'cxc':
					 $cxc = $this->model->cryptx();
					 echo $this->model->wallet('cxc',$cxc,"generate");
					 header('location: ' . URL . 'dashboard/deposit/');
				break;
				//more cases for more coins
			}
		}
	    header('location: ' . URL . 'dashboard/deposit/');

	}
	
	public function withdraw()
	{
	   SESSION_START();
	   //initiate the user
	   $username = $this->model->user();
	   $coin = isset($_GET['coin']) ? htmlentities($_GET['coin'],ENT_QUOTES) : '';
	   $amount = isset($_GET['amount']) ? $_GET['amount'] : '';
	   //get their withdraw address
	   $withdrawaddress = isset($_GET['wallet']) ? $_GET['wallet'] : '';
	   $openorders = $this->db->prepare("SELECT * FROM orders WHERE user=? AND maincoin=?");

		if($coin != ''){
			switch($coin)
			{
				case 'btc':
                $openorders->execute(array($username->username,'btc'));
				//set total price as 0 to loop through all open orders
				$total_coins = 0;
				while ($row = $openorders->fetch())
					{
						//add up all of their orders to check total orders
						$total_coins += $row->beforefee;
					}
					if($amount < 0.0003): header('location: ' . URL . '/transfer/withdraw?error=4'); exit(); endif;
				    if($amount < $total_coins): header('location: ' . URL . '/transfer/withdraw?error=1'); 
					exit();
					endif;
					//make sure they have enough balance to do this.
					if($username->btc < $amount): echo header('location: ' . URL . '/transfer/withdraw?error=2'); 
					die();
					endif;
					//initiate the btc wallet
					$btc = $this->model->btccoin();
					//generate them a new wallet 
					$this->model->wallet('btc',$btc,"generate");
					//send them the coins (y)
					$withdraw = $this->model->withdraw('btc',$btc,$amount,$withdrawaddress);
					//was it successful? 
					if($withdraw == true):
					header('location: ' . URL . 'dashboard/transactions?error=no');
					die();
					endif;	
					//header('location: ' . URL . 'dashboard/deposit/');
					die();
				break;
				case 'ltc':
                $openorders->execute(array($username->username,'ltc'));
				//set total price as 0 to loop through all open orders
				$total_coins = 0;
				while ($row = $openorders->fetch())
					{
						//add up all of their orders to check total orders
						$total_coins += $row->beforefee;
					}
				    if($amount < $total_coins): header('location: ' . URL . '/dashboard/deposit?error=1'); 
					die();
					endif;
					//make sure they have enough balance to do this.
					if($username->ltc < $amount): echo header('location: ' . URL . '/dashboard/deposit?error=2'); 
					die();
					endif;
					//initiate the ltc wallet
					$ltc = $this->model->btccoin();
					//generate them a new wallet 
					$this->model->wallet('ltc',$ltc,"generate");
					//send them the coins (y)
					$withdraw = $this->model->withdraw('ltc',$ltc,$amount,$withdrawaddress);
					//was it successful? 
					if($withdraw == true):
					header('location: ' . URL . 'dashboard/transactions?error=no');
					die();
					endif;	
					//header('location: ' . URL . 'dashboard/deposit/');
					die();
				break;
			}	
	        }
	}
}
?>