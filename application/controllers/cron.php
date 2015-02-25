<?php
class Cron extends Controller
{
    public function btccronjob()
	{
		$btc = $this->model->btccoin();
		//check deposits
            print_r($btc->listtransactions('',2000));
			$transaction = $btc->listtransactions('',2000);
			$checkdeposits = $this->db->prepare("SELECT * FROM transactions WHERE txid=? AND transaction='deposit' AND status='1'");
           	$i= 0;
			$total = count($transaction);
			while ($i < $total){
		    //foreach transaction
			$checkdeposits->execute(array($transaction['transactions'][$i]['txid']));
			$checkdeps = $checkdeposits->fetch();
			if(str_replace("-","",$transaction['transactions'][$i]['confirmations']) >= 2){  
			if(!$checkdeps)
			{
				$date = date("y-m-d h:i:s");
				//get the username of the person who deposited (y)
				$getusername = $this->db->prepare("SELECT * FROM addresses WHERE address=? ORDER BY date DESC");
				$getusername->execute(array($transaction['transactions'][$i]['address']));
				$username = $getusername->fetch();
				$getuserbalance = $this->db->prepare("SELECT btc FROM user WHERE username=?");
				$getuserbalance->execute(array($username->username));
				$user = $getuserbalance->fetch();
				$newamount = $user->btc + $transaction['transactions'][$i]['amount'];
				$adddeposit = $this->db->prepare("INSERT INTO 
				transactions(address,username,confirmations,txid,amount,time,date,transaction,status,market) 
				VALUES(?,?,?,?,?,?,?,'deposit',?,'btc')");
				$adddeposit->execute(array($transaction['transactions'][$i]['address'],
				$username->username,
				str_replace("-","",$transaction['transactions'][$i]['confirmations']),
                $transaction['transactions'][$i]['txid'],
				number_format($transaction['transactions'][$i]['amount'],6),
				$transaction['transactions'][$i]['time'],
				$date,
				'1'));
				if($adddeposit){
				$updateuser = $this->db->prepare("UPDATE user SET btc=? WHERE username=?");
				$updateuser->execute(array(number_format($newamount,6),$username->username));
				}
			}
		}
		$i++;
		}
	}
	
	public function checkneg()
	{
		/* 
		 * in the event of a user account going in to the negative balance
		 * which I'm sure will NEVER happen, but if it somehow managed to
		 * Disable the account, and notify me and then I can check the account 
		 * and check if it was a mistake or a hack, and then fix it 
	    */
		
	}
}	
?>