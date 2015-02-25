<?php

class Dashboard extends Controller
{

    public function index()
    {
		//get the header file
        require APP . 'views/_templates/header.php';
       
		//check to see if the user is logged in
	    if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		
		
      
		//Use the function which checks what market the user is on to include the ticker
        $coin = isset($_GET['market']) ? strtoupper($_GET['market']) : 'BTC_USD';
        if ($this->model->coins($coin) == false):
            $coin = 'BTC_USD';
        endif;
        
		//get the coin
        $coin2 = explode('_', $coin);
        
		//get the user details
		$user = $this->model->user();
		
		//Get the data from tables orders and trades
        $buyOrder = $this->model->BuyorderDashboard($coin, $user);
        $sellOrder = $this->model->SellorderDashboard($coin, $user);
        $trade = $this->model->TradesDashboard($coin);
        
		//Get the coin's ticker to display prices
        if (file_exists("../tickers/" . strtolower($coin2[0]) . ".php")):
            include ("../tickers/" . strtolower($coin2[0]) . ".php");
        endif;
        
		//get the coin
        $coin2 = explode('_', $coin);
       
	    //$this->model->DashboardTicker($coin);
        
		// load views
        require APP . 'views/_templates/sidebar.php';
        //see if the user is verified.
        $user = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($user, $site);
		$this->model->isbanned($user, $site);		
        $this->model->isemailverified($user, $site);
		$this->model->sitenews($_GET['url']);
		$this->model->twofacverify($user);
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		$this->model->error($error);
        $detailverified = $this->model->userverified();
		require APP . 'views/dashboard/index.php';
        require APP . 'views/_templates/footer.php';
    }

    public function orders()
    {
        // load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        
		//check if the user is logged in
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
		
		//get the user's orders 
        $buyorders = $this->model->BuyOpenOrders($username->username);
        $sellorders = $this->model->SellOpenOrders($username->username);
        require APP . 'views/dashboard/orders.php';
        require APP . 'views/_templates/footer.php';
    }
    public function payees()
    {
        // load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        
		//check to see if the user is logged in
		if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
        
		//get the user's information
		$username = $this->model->user();
		
		//get the site's information
        $site = $this->model->site();
		$this->model->isverified($username, $site);
		$this->model->isbanned($username, $site);		
        $this->model->isemailverified($username, $site);
		$this->model->sitenews($_GET['url']);
		$this->model->twofacverify($username);
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		$this->model->error($error);
		
		$coin = isset($_POST['coin']) ? $_POST['coin'] : '';
		
		switch($coin):
			case 'Bitcoin':
				$coins = 'btc';
			break;
			case 'Litecoin':
				$coins = 'ltc';
			break;
		endswitch;
		
		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$address = isset($_POST['address']) ? $_POST['address'] : '';
		if(isset($_POST['add_payee'])):
			if(isset($name) && isset($address)):
				$date = date("y-m-d h:i:s");
				$addpayee = $this->db->prepare("INSERT INTO addresses(address,coin,name,type,date,username)
				VALUES(?,?,?,?,?,?)");
				$addpayee->execute(array($address,$coins,$name,'payee',$date,$username->username));
				header('location: ' . URL . '/dashboard/payees/?error=no');	
			endif;
		endif;
		
		$payees = $this->model->payees($username);
        require APP . 'views/dashboard/payee.php';
        require APP . 'views/_templates/footer.php';
    }
	
    public function trades()
    {
        // load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        
		//check to see if the user is logged in
		if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
        
		//get the user's information
		$username = $this->model->user();
		
		//get the site's information
        $site = $this->model->site();
		$this->model->isverified($username, $site);
		$this->model->isbanned($username, $site);		
        $this->model->isemailverified($username, $site);
		$this->model->sitenews($_GET['url']);
		$this->model->twofacverify($username);
        $trades = $this->model->CompletedOrders($username->username);
        require APP . 'views/dashboard/trades.php';
        require APP . 'views/_templates/footer.php';
    }

    public function invoice()
    {
        // load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        
		//check to see if the user is logged in
		if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
        endif;
		
		//get the user and site information
        $username = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($username, $site);
		$this->model->isbanned($username, $site);		
        $this->model->isemailverified($username, $site);
		$this->model->sitenews($_GET['url']);
		$this->model->twofacverify($username);
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $invoice = $this->model->invoice($username->username, $id);
		
		//if no invoude exists
        if (!$invoice)
        {
            header('location: ' . URL . 'dashboard/trades');
        }
        require APP . 'views/dashboard/invoice.php';
        require APP . 'views/_templates/footer.php';
    }

    public function deposit()
    {
        // load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        
		//check to see if the user is logged in
		if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
			exit();
        }
		
		//user and site information
        $user = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($user, $site);
		$this->model->isbanned($user, $site);		
        $this->model->isemailverified($user, $site);
		$this->model->sitenews($_GET['url']);
		$this->model->twofacverify($user);
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		$this->model->error($error);

		//initiate the wallets; going to find a better way to do it
	    $depositcoin = $this->model->depositcoin();
		//$btcdeposit = $this->model->btcwallet($user->username,'');
        $detailverified = $this->model->userverified();
        require APP . 'views/dashboard/deposit.php';
        require APP . 'views/_templates/footer.php';

    }

    public function deleteorders()
    {
        SESSION_START();
        $username = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($username, $site);
		$this->model->isbanned($username, $site);		
        $this->model->isemailverified($username, $site);
		
		//get the id of the order
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $order = isset($_GET['order']) ? $_GET['order'] : '';
        $belongstouser = $this->model->userownsorder($username->username, $id, $order);
        if (isset($id) && isset($order))
        {
            if ($belongstouser >= 1)
            {
                //switch between buy orders and sell orders
                switch ($order)
                {
                    case 'buy':
                        $deleteorder = $this->db->prepare("DELETE FROM orders WHERE id=? AND buysell='buy'");
                        $deleteorder->execute(array($id));
						$this->model->newtoken();
                        header("LOCATION: " . URL . "dashboard/?error=no");
                        break;
                    case 'sell':
                        $deleteorder = $this->db->prepare("DELETE FROM orders WHERE id=? AND buysell='sell'");
                        $deleteorder->execute(array($id));
						$this->model->newtoken();
                        header("LOCATION: " . URL . "dashboard/?error=no");
                        break;

                }
            } else
            {
                header("LOCATION: " . URL . "dashboard/orders");
            }
        } else
        {
            header("LOCATION: " . URL . "dashboard/orders");
        }
    }

    public function chartdata()
    {
        header('Content-type: text/plain'); //change to json whenever 
		//get the coin
        $coin = isset($_GET['market']) ? strtolower($_GET['market']) : 'btc_usd';
        $prefix = '';
        $result = $this->model->chartdata($coin);
        // Print out rows
        echo "[";
        foreach ($result as $row)
        {
            echo $prefix . "{\n";
            echo '  "date": "' . $row->date . '",' . "\r\n";
            echo '  "value1": "' . $row->price . '",' . "\n";
            echo '  "value2": "' . $row->amount . '"' . "\n";
            echo "}";
            $prefix = ", ";
        }
        echo "]";
    }


    public function buycoin()
    {
        session_start();
		if (!$this->model->isadmin() == true):
		    echo 'Trading disabled until new wallet is implemented'; 
		    die();
		endif;
		//grab site model to get rows from settings table
        $site = $this->model->site();
		$username = $this->model->user();
		
		//initiate gettext because we're not including the header
		$this->model->gettext();
		function _ex($text){
		   echo gettext($text);
		}
		$this->model->isverified($username, $site);
		$this->model->isbanned($username, $site);		
        $this->model->isemailverified($username, $site);
		
		//start the session because we aren't including the header
        //users IP.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARTDED_FOR'] !=
            '')
        {
            $userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else
        {
            $userip = $_SERVER['REMOTE_ADDR'];
        }
		
		//generate them a new token on order, to stop cross site forgery
		$this->model->newtoken();
        
		//do they want to buy or sell coins?
        $buysell = isset($_POST['buysell']) ? htmlspecialchars($_POST['buysell'],ENT_QUOTES) : '';

		//get coin
		$coin = isset($_POST['coin']) ? strtoupper($_POST['coin']) : 'btc_usd';
		if ($this->model->coins($coin) == false):
            echo 'Wrong market';
			die(); 
        endif;

        
		//currency they want to use
        $currency0 = explode('_', $coin);
		
		$currencynotifi = strtolower($currency0[0]);
		$currencynotifi1 = strtolower($currency0[1]);
        
		//get the price ticker
		if (file_exists("../tickers/" . strtolower($currency0[0]) . ".php")):
            include ("../tickers/" . strtolower($currency0[0]) . ".php");
        endif;
		//username
        $username = $this->model->user();
		

		$amount = isset($_POST['amount']) ? $this->model->exnumbers($_POST['amount']) : '0';
		
		//value of the coin
		$coinvalue = isset($_POST['price']) ? $this->model->exnumbers($_POST['price']) : $this->model->exnumbers($coinTicker->price(strtoupper
            ($currency0[1]), $order)); 
        
		/*
		* don't allow the user to put in a price of less than 30% of ticker value
		* This is to stop them fixing our price
		*/
		
		function is_positive_integer($str)
        {
            return (is_numeric($str) && $str > 0);
        }
		
		//edit certain varibles
        switch($buysell){
		  case 'buy':
		       $currency = strtolower($currency0[0]);
		       $currency1 = strtolower($currency0[1]);
			   $order = 'buy';
			   $order1 = 'sell';

          break;
		  case 'sell':
			   //idk why the fuck I've done this... let me debug code :trollface:
		       $currency = strtolower($currency0[1]);
		       $currency1 = strtolower($currency0[0]);
			   $order = 'sell';
			   $order1 = 'buy';
		  break;
		}
		
		$minvalue = $coinTicker->price(strtoupper($currency0[1]), $order) - ($coinTicker->price(strtoupper($currency0[1]), $order) * 0.1);
		if($coinvalue < $minvalue):_ex("Price is too low. Minimum price: "); echo $minvalue; die(); endif;
		//lowest amount possible 
		if($amount < 0.001): _ex("Order is too low. Minimum order is 0.002"); die(); endif;
		//make sure they're actually using numbers
		if(!is_numeric($coinvalue)): _ex("Numbers only, please!");die(); endif;
		if(!is_numeric($amount)): _ex("Numbers only, please!");die(); endif;
		
		//check open orders
        $openorders = $this->db->prepare("SELECT * FROM orders WHERE user=? AND buysell=?");
        $openorders->execute(array($username->username,$order));
                
		//set total price as 0 to loop through all open orders
		$total_price = 0;
		$total_coins = 0;
        while ($row = $openorders->fetch())
            {
				//add up all of their orders to check total orders
				$total_coins += $this->model->exnumbers($row->beforefee);
				$total_price += $this->model->exnumbers($row->cost);
				//echo $total_coins;
            }
				 
		//check if they have enough
	    switch($buysell){
	    case 'buy':
		//could put these in an || to free up some space, but need to free up model first
	    if ($total_price + ($this->model->exnumbers($amount) * $this->model->exnumbers($coinvalue))  > $this->model->exnumbers($username->{$currency1})):
		   _ex("You do not have enough to put in the orders");
            die();
        endif;
	    if ($this->model->exnumbers($username->{$currency1}) < 0):
		     _ex("Negative balance. System has been notified.");
             die();
        endif;
	    if ($this->model->exnumbers($username->{$currency1}) < $this->model->exnumbers($amount * $coinvalue)):
		    _ex("You do not have enough to put in the order");
             die();
        endif;
		break;
		case 'sell':
	    	  //make sure they have enough to put in the order
        if ($this->model->exnumbers($username->{$currency1}) < $this->model->exnumbers($total_coins + $amount)):
		    _ex("You do not have enough to put in the order");
			die();
        endif;
		if ($username->{$currency1} < 0):
		    _ex("Negative balance. System has been notified.");
            die();
		endif;
	    if ($this->model->exnumbers($username->{$currency1}) < $amount):
		    _ex("You do not have enough to put in the order");
             die();
	    endif;
		break;
		}	 
			
		//just create a variable, could probably use $amount but w/e
        $total = $amount;
				
	    //get the total value of the coin depending on the price
		$totalprice = ($amount * $coinvalue);
				
	    //total price of coin added to the user balance
        $total1 = ($amount * $coinvalue) + $username->{$currency1};
	
            
		//check to make sure it's an actual number
		if (!is_positive_integer($amount) && ($amount <= 0)):
		    _ex("Enter an amount before continuing");
			die();
		endif;
				
		//get the amount they are wanting to buy/sell round to 4 decimals
        $amount = $this->model->exnumbers($_POST['amount']);
				
        //if user hasn't set price value use default value from ticker
        $coinvalue = isset($_POST['price']) ? $this->model->exnumbers($_POST['price']) : $coinTicker->price(strtoupper
            ($currency), $order);

		//get the user's balance whatever the market
        $calculateba = $this->db->prepare("SELECT * FROM user WHERE username='" .
                       $username->username . "'");
        $calculateba->execute();
        $balance = $calculateba->fetch();
		
		//total minus our fees
        $totalwithfee = ($total) * (1 - $this->model->userfees());
        $totalwithfee1 = ($total1) * (1 - $this->model->userfees());
								
		//double check 
        if ($this->model->coins(strtoupper($coin)) == false):
		    _ex("Market does not exist");
			die();
		endif;
            
		//notify them that they've put in an order
	    echo 'You have put a '. $order .' order in with a total of ' . $amount . ' ' . strtoupper($currencynotifi) .
             ' ' . ' worth ' . $this->model->exnumbers($totalprice)  . ' ' . strtoupper($currencynotifi1) .
             ' and you will receive ' . $this->model->exnumbers($totalwithfee) . ' ' . strtoupper($currencynotifi);
             
			 
			 $totalwithfee = ($amount) * (1 - $this->model->userfees());


        //check to see if a selling order exists to buy, if not, we'll put this transaction
        //in the orders database
        $sellingorder = $this->db->prepare("SELECT * FROM orders WHERE price=? AND buysell=? AND user !=?");
        $sellingorder->execute(array($coinvalue,$order1,$username->username));
        $checksell = $sellingorder->fetch();
		///okay an order exists
		if($checksell){
		    $nowowned = $this->model->exnumbers($checksell->amount - $amount);
            if ($this->model->exnumbers($checksell->amount) >= $amount)
                { 

	    //person who already put in the order -- not you (the session guy)
		$buyuser = $this->db->prepare("SELECT * FROM user WHERE username=?");
        $buyuser->execute(array($checksell->user));
		$buyuserbalance = $buyuser->fetch();

		
        switch($buysell)
		    {
			case 'buy':
			     $newtotal = $this->model->exnumbers($checksell->price * $amount);
				 //other person
				 $buyersmoney = $this->model->exnumbers($buyuserbalance->{$currency1} + $newtotal);  
				 $buyersbalance = $this->model->exnumbers($buyuserbalance->{$currency} - $amount)  * (1 - $this->model->userfees());
				 //now update the sellers amount/balance
				 //get the new total to update their balance
				 $newbalance = $this->model->exnumbers($username->{$currency1} - $newtotal);
				 $sellersnewbalance = $this->model->exnumbers($username->{$currency} + $amount);
				 //check their wanting to buy coin amount and add owned coins
				 $ownedcoins = ($totalwithfee + $username->{$currency1}); 
			break;
			case 'sell':
				 $newtotal = $this->model->exnumbers($checksell->price * $amount);
				 //other person
				 $buyersmoney = $this->model->exnumbers($buyuserbalance->{$currency1} + $amount)  * (1 - $this->model->userfees());  
				 echo $buyersmoney;
				 $buyersbalance = $this->model->exnumbers($buyuserbalance->{$currency}) - $newtotal;
				 //now update the sellers amount/balance
				 //get the new total to update their balance
				 $newbalance = $this->model->exnumbers($username->{$currency1}) - $amount;
				 $sellersnewbalance = $this->model->exnumbers($username->{$currency}) + $newtotal;
				 //check their wanting to buy coin amount and add owned coins
				 $ownedcoins = $totalwithfee + $this->model->exnumbers($username->{$currency});
			break;
		}
		//check if there's a buy order in 
		if ($nowowned <= 0)
            {
            //update trades and the user acc
            $updatesell = $this->db->prepare("DELETE FROM orders WHERE id=? AND buysell=?");
            $updatesell->execute(array($checksell->id,$order1));
			
			$updateuser = $this->db->prepare("UPDATE user SET " . $currency . "=?,"
					. $currency1 . "=? WHERE username=?");
            $updateuser->execute(array($this->model->exnumbers($buyersbalance),$this->model->exnumbers($buyersmoney),$checksell->user));
							
			$insertbalance = $this->db->prepare("UPDATE user SET " . $currency . "=?, 
						 " . $currency1 . "=? WHERE username=?");
		    $insertbalance->execute(array($this->model->exnumbers($sellersnewbalance),$this->model->exnumbers($newbalance),$username->username));


            $epoch = strtotime("now");              
			//Add to the trade table 
            $tradehistory = $this->db->prepare("INSERT INTO trades(amount,market,cost,time,user,ip,price,buysell,date,maincoin,fee,charttime) 
						    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
            $tradehistory->execute(array($totalwithfee,$coin,$totalprice,date("y-m-d h:i:s"),
			$username->username,$userip,$coinvalue,$order,date("Y-m-d h:i:s"),$currencynotifi,$this->model->userfees(),$epoch));		
            $tradehistory->execute(array($totalwithfee,$coin,$totalprice,date("y-m-d h:i:s"),
			$checksell->user,$userip,$coinvalue,$order1,date("Y-m-d h:i:s"),$currencynotifi,''));
			

            } 
			else
            {
							
			//Update the order table to remove the amount the user bought
            $updatetotal = $this->db->prepare("UPDATE orders SET amount=? WHERE id=? AND buysell=?");
            $updatetotal->execute(array($this->model->exnumbers($nowowned), $checksell->id,$order1));
             
					
		    $nowowned = $checksell->amount - $amount;
			
			//update the sellers and the buyers balance(s)
		    $updateuser = $this->db->prepare("UPDATE user SET " . $currency . "=?,"
					. $currency1 . "=? WHERE username=?");
            $updateuser->execute(array($this->model->exnumbers($buyersbalance),$this->model->exnumbers($buyersmoney),$checksell->user));
			
            //the session user.			
			$insertbalance = $this->db->prepare("UPDATE user SET " . $currency . "=?, 
						 " . $currency1 . "=? WHERE username=?");
		    $insertbalance->execute(array($this->model->exnumbers($sellersnewbalance),$this->model->exnumbers($newbalance),$username->username));

			//add to trades
			$epoch = strtotime("now");
            $tradehistory = $this->db->prepare("INSERT INTO trades(amount,market,cost,time,user,ip,price,buysell,date,maincoin,fee,charttime) 
						    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
            $tradehistory->execute(array($totalwithfee,$coin,$totalprice,date("y-m-d h:i:s"),
			$username->username,$userip,$coinvalue,$order,date("Y-m-d h:i:s"),$currencynotifi,$this->model->userfees(),$epoch));		
            $tradehistory->execute(array($totalwithfee,$coin,$totalprice,date("y-m-d h:i:s"),
			$checksell->user,$userip,$coinvalue,$order1,date("Y-m-d h:i:s"),$currencynotifi,$epoch));
			}
     		}
            } 
				else
                {
				
            $tradehistory = $this->db->prepare("INSERT INTO orders
			(amount,market,cost,time,user,ip,price,buysell,maincoin,beforefee,fee)
			VALUES(?,?,?,?,?,?,?,?,?,?,?)");
            $tradehistory->execute(array($totalwithfee,$coin,$totalprice ,date("y-m-d h:i:s"),
			$username->username,$userip,$coinvalue,$order,$currencynotifi,$amount,$this->model->userfees()));		
                }
        }

	
	public function dashboardtrades()
	{
		
	     header('Content-type: text/plain');
		 
		 //get the market
		 $coin = isset($_GET['market']) ? strtoupper($_GET['market']) : 'BTC_USD';
         
		 //check to make sure market exists
		 if ($this->model->coins($coin) == false):
            $coin = 'BTC_USD';
         endif;
		 
        //get the coin
        $prefix = '';
        $result = $this->model->TradesDashboard($coin);
        
		// Print out rows
        echo "{";
		echo " \"data\": [";
        foreach ($result as $row)
        {
            echo $prefix . "[";
            echo '"'.$row->amount .'",';
            echo '"'.$row->market .'",';
            echo '"'.$row->cost .'",';
            echo '"'.$row->time .'",';
            echo '"'.$row->user .'",';
            echo '"'.$row->buysell.'"';			
            echo "]";
            $prefix = ", ";
        }
        echo "]}";
	}
	
	public function dashboardprice()
	{
		SESSION_START();
		
		//check to see if user is logged in
	    if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
        }
		
		//get the market
	    $coin = isset($_GET['market']) ? strtoupper($_GET['market']) : 'BTC_USD';
        $coin2 = explode('_', $coin);
		
		//buy or sell I guess, I'll double check
		$type = isset($_GET['type']) ? strtolower($_GET['type']) : '';
		if ($this->model->coins($coin) == false):
            $coin = 'BTC_USD';
        endif;
		if (file_exists("../tickers/" . strtolower($coin2[0]) . ".php")):
            include ("../tickers/" . strtolower($coin2[0]) . ".php");
        endif;
		//case to get buy or sell
		switch($type){
		    case 'buy':
			     echo $coinTicker->price($coin2[1] , 'buy');
			break;
		    case 'sell':
			echo $coinTicker->price($coin2[1] , 'sell');
			break;
	}
}
	
	public function transactions()
	{
		require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
			exit();
        }
        $user = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($user, $site);
		$this->model->isbanned($user, $site);		
        $this->model->isemailverified($user, $site);
		$this->model->sitenews($_GET['url']);
		$this->model->twofacverify($user);
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		$this->model->error($error);
		$transactions = $this->model->transactions($user);
        $detailverified = $this->model->userverified();
        require APP . 'views/dashboard/transactions.php';
        require APP . 'views/_templates/footer.php';
	}
	
	public function openorders()
	{
		SESSION_START();
		//check to see if the user is logged in
	    if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		//Use the function which checks what market the user is on to include the ticker
        $coin = isset($_GET['market']) ? strtoupper($_GET['market']) : '';
        if ($this->model->coins($coin) == false):
            $coin = 'BTC_USD';
        endif;
        
		//get the coin
        $coin2 = explode('_', $coin);
        
		//get the user details
		$user = $this->model->user();
		$type = isset($_GET['type']) ? $_GET['type'] : '';
	    switch($type)
		{
			case 'buy':
			     $order = $this->model->BuyorderDashboard($coin, $user);    
			break;
			case 'sell':
			     $order = $this->model->SellorderDashboard($coin, $user);
			break;
		}
		//Get the data from tables orders and trades
		$result = array();
        foreach($order as $Orders) { 
		array_push($result, array('price' => number_format($Orders->price,2),
		                           'amount' => number_format($Orders->amount,6), 
                                   'cost' => number_format($Orders->cost,2)));
		}						   
		echo json_encode(array("result" => $result));
        
	}
	
		public function myorders()
	{
		SESSION_START();
		//check to see if the user is logged in
	    if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		//Use the function which checks what market the user is on to include the ticker
        $coin = isset($_GET['market']) ? strtoupper($_GET['market']) : '';
        if ($this->model->coins($coin) == false):
            $coin = 'BTC_USD';
        endif;
        
		//get the coin
        $coin2 = explode('_', $coin);
        
		//get the user details
		$user = $this->model->user();
		$type = isset($_GET['type']) ? $_GET['type'] : '';
	    $order = $this->model->myorders($coin, $user);    

		//Get the data from tables orders and trades
		$result = array();
        foreach($order as $Orders) { 
		array_push($result, array('id' => $Orders->id,
		                          'amount' => number_format($Orders->amount,6),
		                          'cost' => number_format($Orders->cost,6), 
                                  'price' => number_format($Orders->price,2),
								  'time' => $Orders->time,
								  'buysell' => $Orders->buysell));
		}						   
		echo json_encode(array("result" => $result));
        
	}
}
