<?php

class Model
{

    function __construct($db)
    {
        try
        {
            $this->db = $db;
        }
        catch (PDOException $e)
        {
            exit('Database connection could not be established.');
        }
    }
	
	    public function btccoin()
	{
	    //require APP . 'libs/easybitcoin.php';
        require APP . 'libs/jsonRPCClient.php';
		$bitcoin = new jsonRPCClient("");
	   
	    return $bitcoin;	
	}
	
	    public function ltccoin()
	{
        require APP . 'libs/ltcclient.php';
		$ltc = new ltc("");
	    return $ltc;	
	}	
    
    public function site()
    {
        $sql = $this->db->prepare("SELECT * from settings");
        $sql->execute();
        return $sql->fetch();
    }
	
	public function totaluserbalance()
	{
		$balance = $this->db->prepare("SELECT sum(btc) as total FROM user");
		$balance->execute();
		return $balance->fetch();
	}
	
	/*
	* encrypt some of our users info, better than plain text. think of our reputation
	* if somehow our database gets dumped and our shit is in plain data LOLOLOLOLOL
	*/
	public function encrypt($string)
	{
		$key = md5('cryptxelimited');
		$string = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string,MCRYPT_MODE_ECB)));
		return $string;
	}
	
	public function decrypt($string)
	{
	    $key = md5('cryptxelimited');
		$string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,base64_decode($string),MCRYPT_MODE_ECB));
		return $string;
	}
	
	public function exnumbers($str)
	{
	    return str_replace(",","",$str);
		//number_format(str_replace(",",".",$str), 6);
	}
	public function numbers($str)
	{
		return number_format($str, 6, '.', ',');
	}
	
	public function error($error)
	{
		//IDK what to do with these errors. Maybe use _ex to translate
		$errors = array(1 => 'Your open order total exceeds your total withdraw amount',
		                2 => 'Your withdraw amount is more than your total balance',
					    3 => 'The wallet address you supplied is not a valid address',
					    4 => 'The minimum amount you can withdraw is 0.0003',
						5 => 'Your security token does not match. Try again',
						6 => 'The input cannot be empty. Please submit again',
						8 => 'That ticket does not belong to you. Try again');
		if($error == 'no'):  
            echo '
				<div class="row row-centered">
                <div class="col-md-4 col-md-offset-4">
			    <div class="alert alert-success">
			    Congratulations. You have successfully performed the action
				</div>
				</div>
				</div>';
		endif;		
	    if($error > 0):
		//error in another file idk
	 		echo '
				<div class="row row-centered">
                <div class="col-md-4 col-md-offset-4">
			    <div class="alert alert-danger">
			    '.$errors[$error].'
				</div>
				</div>
				</div>';
		endif;
	}
	
    public function coins($coin)
    {
	    $sql = $this->db->prepare("SELECT * from settings");
        $sql->execute();
        $coins = $sql->fetch();
	    $coins = explode(",",$coins->coins);
		return in_array($coin, $coins);
    }

	public function sanatisesource()
	{
		function sanitize_output($buffer) {

		$search = array(
			'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
			'/[^\S ]+\</s',  // strip whitespaces before tags, except space
			'/(\s)+/s'       // shorten multiple whitespace sequences
		);

		$replace = array(
			'>',
			'<',
			'\\1'
		);

		$buffer = preg_replace($search, $replace, $buffer);

		return $buffer;
    }
	    ob_start("sanitize_output");
	}
	
	public function myorders($coin,$user)
    {
        $query = $this->db->prepare("SELECT * FROM orders WHERE market='" .
            $coin . "' AND user=?");
        $query->execute(array($user->username));
        return $query->fetchAll();
    }

    public function SellorderDashboard($coin,$user)
    {
        $query = $this->db->prepare("SELECT id,amount,market,cost,price FROM orders WHERE market='" .
            $coin . "' AND user !=? AND buysell='sell'");
        $query->execute(array($user->username));
        return $query->fetchAll();
    }

    /**
     * Model::BuyorderDashboard()
     * 
     * @param mixed $coin
     * @return
     */
    public function BuyorderDashboard($coin,$user)
    {
        $sql = "SELECT id,amount,market,cost,price FROM orders WHERE market=? AND user !=? AND buysell='buy'";
        $query = $this->db->prepare($sql);
        $query->execute(array($coin,$user->username));
        return $query->fetchAll();
    }

    public function TradesDashboard($coin)
    {
        $sql = "SELECT * FROM trades WHERE market=?";
        $query = $this->db->prepare($sql);
        $query->execute(array(strtolower($coin)));
        return $query->fetchAll();
    }

    public function UserCheck($email)
    {
        $sql = $this->db->prepare("SELECT * FROM user WHERE email=?");
        $sql->execute(array($email));
        return $sql->fetchAll();
    }

    public function CheckifUserExists($username)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) FROM 'user' WHERE 'username'=?");
        $sql->execute(array($username));
        return $sql->fetchAll();
    }

    public function registercheckuser($username, $email)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) FROM `user` WHERE `username`=? OR `email`=?");
        $sql->execute(array($username, $email));
        return $sql->fetchColumn();
    }

    public function registeruser($username, $password, $passwordsalt, $email, 
	$security_question1, $security_answer1, $security_question2, $security_answer2,$referer)
    {
        $sql = "INSERT INTO `user` (`username`, `password`, `passwordsalt`, `email`,
		`security_question1`, `security_answer1`, `security_question2`, `security_answer2`,`referer`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            $username,
            $password,
            $passwordsalt,
            $email,
            $security_question1,
            $security_answer1,
            $security_question2,
            $security_answer2,
			$referer));
    }
	
	public function emailactivation($code,$email)
	{
		$email = isset($email) ? $email : '';
		$date = date("y-d-m");
		
		$emailcode = $this->db->prepare("INSERT INTO emailactivate (email,code,date) 
		VALUE(?,?,?)");
		$emailcode->execute(array($email,$code,$date));
	}
	
	public function activatecode($code,$user)
	{
		$checkemails = $this->db->prepare("SELECT * FROM emailactivate WHERE email=? AND code=? ");
		$checkemails->execute(array($user,$code));
		if($checkemails)
		{
			$updateuser = $this->db->prepare("UPDATE user SET emailverified=1 WHERE email=?");
			$updateuser->execute(array($user));
			$deleteactivation = $this->db->prepare("DELETE FROM emailactivate WHERE email=? AND code=? ");
		    $deleteactivation->execute(array($user,$code));
			header('location: ' . URL . '/dashboard');
		}
		header('location: ' . URL . '/dashboard');
	}	
	 
	public function isbanned($user,$site)
	{	
		$checkbanlist = $this->db->prepare("SELECT * FROM banlist WHERE username=?");
		$checkbanlist->execute(array($user->username));
		$banneduser = $checkbanlist->fetch();
		if($banneduser){
		    echo  '
				  <div class="row row-centered">
				  <div class="col-md-3"></div>
                  <div class="col-md-5">
			      <div class="alert alert-danger">
			      <strong>';
				  _ex("Oh snap!");
		    echo '</strong> ';
			      _ex("You are banned."); 
		    echo '<b><u> ';
			      _ex("Do not");
		    echo '</u></b> ';
			      _ex("register another account"); 
		    echo '<br>';
			      _ex("Reason you are banned:");  
		    echo '<b><u>'.$banneduser->reason.'</u></b>
				  </div>
				  </div>
				  </div>';
		    
			require APP . 'views/_templates/footer.php';
			die;
		}
	}	 
	 
	public function isemailverified($user,$site)
	{	
	   if($site->emailverify == 1){
		if($user->emailverified == 0)
		{
		    echo '
				  <div class="row row-centered">
				  <div class="col-md-3"></div>
                  <div class="col-md-5">
			      <div class="alert alert-danger">
			      <strong>';
				  _ex("Oh snap!");
			echo '</strong>';
        		  _ex("Please verify your email");
			echo '</div>
				  </div>
				  </div>';
		require APP . 'views/_templates/footer.php';
			die;
		}
	  }
	}
	
	public function twofacverify($user)
	{	

		if($user->twofactor == 0)
		{
		    echo '
				  <div class="row row-centered">
                  <div class="col-md-4 col-md-offset-4">
			      <div class="alert alert-info">
			      <strong>';
				  _ex("Secure account. Enable Two factor Authentication");
			echo  '<a href="'.URL.'user/twofactor"> ';
			      _ex("Here");
			echo '</a></strong>
				  </div>
				  </div>
				  </div>';
	  }
	}

	public function isverified($user,$site)
	{	
	   if($site->userverify == 1){
		if($user->detailverified == 0 && $user->detailssubmitted == 0)
		{
			require APP . 'views/user/verify.php';
		    require APP . 'views/_templates/footer.php';
			die();
		}else if($user->detailssubmitted == 1 && $user->detailverified == 0) {
			  echo '<div class="col-md-6 col-xs-offset-3">
		      <div class="alert alert-success">
			  <strong>';
			  _ex("Details Submitted!");
	    echo  '</strong>';
         	  _ex("Please wait for our team to verify your details");
		echo '</div> 
		      </div>';
			  die();
		}
	  }
	}
	
    public function isloggedin()
    {
        if (isset($_SESSION['user']))
        {
            return true;
        } else
        {
            return false;
        }
    }

    public function user()
    {
        $username = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        if (isset($username))
        {
            $sql = $this->db->prepare("SELECT * FROM user WHERE username=?");
            $sql->execute(array($username));
            return $sql->fetch();
        }
    }
	
	public function newtoken()
	{
	    $_SESSION['token'] = md5(uniqid(rand(), true));
	}

    public function userfees()
	{
		$gettrades = $this->db->prepare("SELECT sum(cost) as total FROM trades WHERE user=?");
		$gettrades->execute(array($_SESSION['user']));
		$nofee = $this->db->prepare("SELECT nofees FROM user WHERE username=?");
		$nofee->execute(array($_SESSION['user']));
		$nofees = $nofee->fetch();
		$total = $gettrades->fetch();
		if($nofees->nofees == 1){ 
		return 0; 
		}else if(round($total->total,4) >= 10000){
			//0.35%
			return 0.035;
		}else if (round($total->total,4) >= 750000){
			//0.30%
			return 0.030;
		}else if (round($total->total,4) >= 2500000){
			//0.25%
			return 0.025;
		}else if(round($total->total,4) >= 1000000){
			//0.15%
			return 0.015;
		}else{
		    //0.40%
			return 0.04;
		}
	}
	 
	//user roles, admin,mod, support etc

    public function isadmin()
    {
		if(session_status() == PHP_SESSION_NONE): SESSION_START(); endif;
        $sql = $this->db->prepare("SELECT admin FROM user WHERE username=?");
        $sql->execute(array($_SESSION['user']));
        $checkadmin = $sql->fetch();
        if ($checkadmin->admin == '1')
        {
            return true;
        }
    }

    public function isstaff()
    {
		if(session_status() == PHP_SESSION_NONE): SESSION_START(); endif;
        $sql = $this->db->prepare("SELECT staff FROM user WHERE username=?");
        $sql->execute(array($_SESSION['user']));
        $checksupport = $sql->fetch();
        if ($checksupport->staff == '1')
        {
            return true;
        }
    }	
    public function userverified()
    {
        $sql = $this->db->prepare("SELECT detailverified FROM user WHERE username=?");
        $sql->execute(array($_SESSION['user']));
        return $sql->fetch();
    }

    public function edituser($id)
    {
        $sql = $this->db->prepare("SELECT * FROM user WHERE username=?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    public function updateprofile($email, $password)
    {
       
    }
    public function updatewhitelist($user,$ips)
    {
       $updateips = $this->db->prepare("UPDATE user SET ipwhitelist=? WHERE username=?");
       $updateips->execute(array($ips,$user->username));
    }

	public function updatenewwhitelist($user,$newwhitelist)
    {
       $updateips = $this->db->prepare("UPDATE user SET ipwhitelist=? WHERE username=?");
       $updateips->execute(array($newwhitelist,$user->username));
    }

    public function timeline($username)
    {
        $query = $this->db->prepare("SELECT amount,market,cost,time,ip,buysell FROM trades WHERE user=?");
        $query->execute(array($username));
        return $query->fetchAll();
    }

    public function BuyOpenOrders($username)
    {
        $getorder = $this->db->prepare("SELECT * FROM orders WHERE user=? AND buysell='buy'");
        $getorder->execute(array($username));
        return $getorder->fetchAll();
    }
	
    public function SellOpenOrders($username)
    {
 
        $getorder = $this->db->prepare("SELECT * FROM orders WHERE user=? AND buysell='sell'");
        $getorder->execute(array($username));
        return $getorder->fetchAll();
    }

	public function CompletedOrders($username)
    {
        $getorder = $this->db->prepare("SELECT * FROM trades WHERE user=?");
        $getorder->execute(array($username));
        return $getorder->fetchAll();
    }
	
		public function invoice($username,$id)
    {
        $getorder = $this->db->prepare("SELECT * FROM trades WHERE user=? AND id=?");
        $getorder->execute(array($username,$id));
        return $getorder->fetch();
    }

    public function userownsorder($username, $id, $buysell)
    {
        switch ($buysell)
        {
            case 'buy':
                $checkfield = $this->db->prepare("SELECT count(*) FROM orders WHERE id=? AND user=? AND buysell='buy'");
                $checkfield->execute(array($id, $username));
                return $checkfield->fetchColumn();

                break;
            case 'sell':
                $checkfield = $this->db->prepare("SELECT count(*) FROM orders WHERE id=? AND user=? AND buysell='sell'");
                $checkfield->execute(array($id, $username));
                return $checkfield->fetchColumn();
                break;
        }
    }

    public function chartdata($coin)
    {
        $coin = isset($_GET['market']) ? strtolower($_GET['market']) : 'BTC_USD';
        $coin = isset($_GET['market']) ? strtolower($_GET['market']) : 'BTC_USD';
        $chartdata = $this->db->prepare("
		SELECT date, sum(amount) AS amount, time, avg(price) AS price, 
		EXTRACT(YEAR from date) AS year,
		EXTRACT(MONTH from date) AS month,
		EXTRACT(DAY from date) AS day,
		EXTRACT(HOUR from date) AS hour,
		EXTRACT(MINUTE from date) AS minute
		FROM trades WHERE market=? GROUP BY year, month, day, hour, minute;");
        $chartdata->execute(array($coin));
        return $chartdata->fetchAll();
    }


    public function grabmarket($coin, $time)
    {
    }


    public function addguide($title, $message, $url)
    {
        if (preg_match('/^[-a-zA-Z ]+$/', $url))
        {
            $date = strtotime("now");
            $addguide = $this->db->prepare("INSERT INTO userguides(title,message,date,url) VALUES(?,?,?,?)");
            $addguide->execute(array(
                $title,
                $message,
                $date,
                $url));
            header('location: ' .ADMINURL.'/guides/');
        } else
        {
            header('location: ' .ADMINURL.'/addguide');
        }
    }
	
	public function addcoin($coinname, $cointitle, $coindescription,$enabled)
    {
            $date = strtotime("now");
            $addcoin = $this->db->prepare("INSERT INTO coins(coin,description,title,enabled) VALUES(?,?,?,?)");
            $addcoin->execute(array(
                $coinname, 
				$cointitle, 
				$coindescription,
				$enabled));
				//create new col in database for their balance 
				//http://us3.php.net/manual/en/book.pdo.php#69304 -- need to secure the varible
			$addcol = $this->db->prepare("ALTER TABLE user ADD ".htmlentities($coinname)." VARCHAR( 25 ) NOT NULL AFTER btc");
			$addcol->execute();
			//add wallet code to model file -- shitty way to do it but w/e
			$depositfile = APP .'model/model.php';
			$deposit = file_get_contents($depositfile);
			$deposit = str_replace("
				public function btccoin()
				{
					 require APP . 'libs/easybitcoin.php';
					//require APP . 'libs/jsonRPCClient.php';
					//\$bitcoin\ = new jsonRPCClient(\"http://cryptxe:corkish1@81.156.8.189:8332/\");
					 \$bitcoin\ = new Bitcoin('cryptxe','corkish1','81.156.8.189','8332', true);
					 return \$bitcoin\;
					//print_r(\$bitcoin\->getinfo());
				}","
				    public function btccoin()
					{
						 require APP . 'libs/easybitcoin.php';
						//require APP . 'libs/jsonRPCClient.php';
						//\$bitcoin\ = new jsonRPCClient(\"http://cryptxe:corkish1@81.156.8.189:8332/\");
						 \$bitcoin\ = new Bitcoin('cryptxe','corkish1','81.156.8.189','8332', true);
						 return \$bitcoin\;
						//print_r(\$bitcoin\->getinfo());
					}
				public function ".$coinname."coin()
				{
					require APP . 'libs/jsonRPCClient.php';
					$".strtolower($cointitle)." = new ".$cointitle."('".$rpc."');
					return $".strtolower($cointitle).";
				}",$deposit);
				
			file_put_contents($depositfile,$deposit);
            header('location: ' .ADMINURL.'/coins/');
    }

    public function editguide($url)
    {
        if (preg_match('/^[-a-zA-Z ]+$/', $url))
        {
            $getguide = $this->db->prepare("SELECT message FROM userguides WHERE url=?");
            $getguide->execute(array($url));
            return $getguide->fetch();
        } else
        {
            header('location: ' .ADMINURL.'/editguide/?url=depositing-and-withdrawing');
        }
    }

    public function updateguide($url, $message)
    {
        if (preg_match('/^[-a-zA-Z ]+$/', $url))
        {
            $getguide = $this->db->prepare("UPDATE userguides SET message=? WHERE url=?");
            $getguide->execute(array($message, $url));
            header('LOCATION: '.ADMINURL.'/editguide/?url='.$url);
        }
    }

    
    public function helpguides()
    {
        $getguide = $this->db->prepare("SELECT title,url FROM userguides");
        $getguide->execute();
        return $getguide->fetchAll();
    }

    public function Getguides($url)
    {
        if (preg_match('/^[-a-zA-Z ]+$/', $url))
        {
            $getguide = $this->db->prepare("SELECT message FROM userguides WHERE url=?");
            $getguide->execute(array($url));
            return $getguide->fetch();
        }
    }

    public function viewguide($url)
    {
        if (isset($url))
        {
            $url = isset($_GET['guideurl']) ? $_GET['guideurl'] : '';
            $getguide = $this->db->prepare("SELECT message,url,title FROM userguides WHERE url=?");
            $getguide->execute(array($url));
            return $getguide->fetch();
        }
    }

    /**
     * Model::userlogins()
     * 
     * @param mixed $email
     * @return
     */
    public function userlogins($email)
    {
        $sql = $this->db->prepare("SELECT * FROM logins WHERE email=? ORDER BY date DESC");
        $sql->execute(array($email));
        return $sql->fetchAll();
    }

    /**
     * Model::whitelistips()
     * 
     * @return
     */
    public function whitelistips($email)
    {
        $getips = $this->db->prepare("SELECT ipwhitelist FROM user WHERE email=?");
        $getips->execute(array($email));
        return $getips->fetch();
    }

    /**
     * Model::adminusers()
     * 
     * @return
     */
    public function adminusers()
    {
        $users = $this->db->prepare("SELECT * FROM user");
        $users->execute();
        return $users->fetchAll();
    }

    /**
     * Model::useridverify()
     * 
     * @return
     */
    public function useridverify()
    {
        $users = $this->db->prepare("SELECT * FROM user WHERE detailverified=0 AND invalidid=0");
        $users->execute();
        return $users->fetchAll();
    }

    /**
     * Model::adminsettings()
     * 
     * @return
     */
    public function adminsettings()
    {
        $settings = $this->db->prepare("SELECT * FROM settings");
        $settings->execute();
        return $settings->fetchAll();
    }
	
    public function updatesettings($sitename, $siteslogan, $siteurl, $sitekeywords,
		$sitedescription, $sitecoins, $sitefee, $vat, $address,$phonenumber,$email,$emailverify,$idverify,$maintenance)
    {
        $settings = $this->db->prepare("UPDATE settings SET sitename=?,slogan=?, 
		siteurl=?,keywords=?,description=?,coins=?,fees=?,vat=?,address=?,phonenumber=?,
		email=?,emailverify=?,userverify=?,maintenance=?");
        $settings->execute(array($sitename, $siteslogan,$siteurl,$sitekeywords,$sitedescription,
		$sitecoins,$sitefee,$vat,$address,$phonenumber,$email,$emailverify,$idverify,$maintenance));
		header('location: ' .ADMINURL.'/settings');
}

    /**
     * Model::faqs()
     * 
     * @return
     */
    public function faqs()
    {
        $faqs = $this->db->prepare("SELECT * FROM faq");
        $faqs->execute();
        return $faqs->fetchAll();
    }
    /**
     * Model::addfaq()
     * 
     * @param mixed $title
     * @param mixed $message
     * @return
     */
    public function addfaq($title, $message)
    {
        $date = strtotime("now");
        $addfaq = $this->db->prepare("INSERT INTO faq(title,faq,date) VALUES(?,?,?)");
        $addfaq->execute(array(
            $title,
            $message,
            $date));
        header('location: ' .ADMINURL.'/faqs/');
    }

    /**
     * Model::editfaq()
     * 
     * @param mixed $id
     * @return
     */
    public function editfaq($id)
    {
        $getfaq = $this->db->prepare("SELECT faq FROM faq WHERE id=?");
        $getfaq->execute(array($id));
        return $getfaq->fetch();
    }

    /**
     * Model::updatefaq()
     * 
     * @param mixed $id
     * @param mixed $message
     * @return
     */
    public function updatefaq($id, $message)
    {

        $getfaq = $this->db->prepare("UPDATE faq SET faq=? WHERE id=?");
        $getfaq->execute(array($message, $id));
        header('location: ' .ADMINURL.'/editfaq/?id=' . $id);
    }

    //edit, add and view pages
    /**
     * Model::pages()
     * 
     * @return
     */
    public function pages()
    {
        $pages = $this->db->prepare("SELECT * FROM pages");
        $pages->execute();
        return $pages->fetchAll();
    }
    /**
     * Model::addpage()
     * 
     * @param mixed $title
     * @param mixed $message
     * @return
     */
    public function addpage($title, $message,$purl)
    {
        $date = strtotime("now");
        $addpage = $this->db->prepare("INSERT INTO pages(title,body,url,date) VALUES(?,?,?,?)");
        $addpage->execute(array(
            $title,
            $message,
			$purl,
            $date));
        
    }

    /**
     * Model::editpage()
     * 
     * @param mixed $id
     * @return
     */
    public function editpage($id)
    {
        $getpage = $this->db->prepare("SELECT body FROM pages WHERE id=?");
        $getpage->execute(array($id));
        return $getpage->fetch();
    }

    /**
     * Model::updatepage()
     * 
     * @param mixed $id
     * @param mixed $message
     * @return
     */
    public function updatepage($id, $message)
    {

        $getpage = $this->db->prepare("UPDATE pages SET body=? WHERE id=?");
        $getpage->execute(array($message, $id));
        header('location: ' .ADMINURL.'/editpage/?id=' . $id);
    }

    /**
     * Model::viewpage()
     * 
     * @param mixed $id
     * @return
     */
    public function viewpage($id)
    {
        $getpage = $this->db->prepare("SELECT body,title FROM pages WHERE url=?");
        $getpage->execute(array($id));
        if ($getpage !== false)
        {
            return $getpage->fetch();
        }
    }

    /**
     * Model::invalidid()
     * 
     * @param mixed $user
     * @return
     */
    public function invalidid($user)
    {
        $invalidid = $this->db->prepare("UPDATE user SET invalidid=1 WHERE username=?");
        $invalidid->execute(array($user));
    }

    /**
     * Model::validid()
     * 
     * @param mixed $user
     * @return
     */
    public function validid($user)
    {
        $invalidid = $this->db->prepare("UPDATE user SET detailverified=1 WHERE username=?");
        $invalidid->execute(array($user));
    }

	/**
	 * coinlinks()
	 * 
	 * @return
	 */
	public function coinlinks()
	{
		$coinmarket = $this->db->prepare("SELECT * FROM coins");
		$coinmarket->execute();
		return $coinmarket->fetchAll();
	}
	
	public function editcoin($id)
	{
		$editcoin = $this->db->prepare("SELECT * FROM coins WHERE id=?");
		$editcoin->execute(array($id));
		return $editcoin->fetch();
	}
	
	 /**
	  * messages()
	  * 
	  * @param mixed $username
	  * @param mixed $type
	  * @return
	  */
	 public function messages($username,$type)
    {
		if(!empty($type)){
        $messages = $this->db->prepare("SELECT * FROM messages WHERE user=? AND type=? ORDER BY DATE DESC");
        $messages->execute(array($username->username,$type));
		}else{
        $messages = $this->db->prepare("SELECT * FROM messages WHERE user=? ORDER BY DATE DESC");
        $messages->execute(array($username->username));		
		}
        return $messages->fetchAll();
    }
	
	 /**
	  * message()
	  * 
	  * @param mixed $username
	  * @param mixed $messageid
	  * @return
	  */
	 public function message($username,$messageid)
    {
		if(!empty($messageid)){
        $message = $this->db->prepare("SELECT * FROM messages WHERE user=? AND id=?");
        $message->execute(array($username->username,$messageid));
		}else{
			header('location: ' .URL.'/user/messages/');
		}
        return $message->fetch();
    }
	
	
	/**
	 * deletemessage()
	 * 
	 * @param mixed $username
	 * @param mixed $messageid
	 * @return
	 */
	public function deletemessage($username,$messageid)
    {
		if(!empty($messageid)){
        $message = $this->db->prepare("DELETE FROM messages WHERE user=? AND id=?");
        $message->execute(array($username->username,$messageid));
		}else{
			header('location: ' .URL.'/user/messages/');
		}
	     	header('location: ' .URL.'/user/messages/');
    }
	
	/**
	 * addmessage()
	 * 
	 * @param mixed $title
	 * @param mixed $usermessage
	 * @param mixed $user
	 * @param mixed $userfrom
	 * @param mixed $type
	 * @return
	 */
	public function addmessage($title,$usermessage,$user,$userfrom,$type)
	{	
		$date = date("y-m-d h:i:s");
	    $message = $this->db->prepare("INSERT INTO 
		messages(title,message,user,whofrom,type,date) VALUES(?,?,?,?,?,?)");
        $message->execute(array($title,$usermessage,$user->username,$userfrom,$type,$date));
	}


	/**
	 * ticker()
	 * 
	 * @param mixed $type
	 * @param mixed $market
	 * @param mixed $buysell
	 * @param mixed $order
	 * @return
	 */
	public function ticker($type,$market,$buysell,$order=null)
	{
        $tickersHigh = $this->db->prepare("SELECT ".htmlentities($type,ENT_QUOTES)." FROM trades WHERE market=? ".htmlentities($buysell,ENT_QUOTES)."".htmlentities($order,ENT_QUOTES)."");
		$tickersHigh->execute(array(strtolower($market)));
		$tickerHigh = $tickersHigh->fetch();
		if($tickerHigh){
		return $tickerHigh->{$type};	
		}
	}
	
	/**
	 * crypto_rand_secure()
	 * 
	 * @param mixed $min
	 * @param mixed $max
	 * @return
	 */
	function crypto_rand_secure($min, $max) {
			$range = $max - $min;
			if ($range < 0) return $min; // not so random...
			$log = log($range, 2);
			$bytes = (int) ($log / 8) + 1; // length in bytes
			$bits = (int) $log + 1; // length in bits
			$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
			do {
				$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
				$rnd = $rnd & $filter; // discard irrelevant bits
			} while ($rnd >= $range);
			return $min + $rnd;
	}

	/**
	 * getToken()
	 * 
	 * @param mixed $length
	 * @return
	 */
	function getToken($length){
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		for($i=0;$i<$length;$i++){
			$token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
		}
		return $token;
	}

	/**
	 * createapi()
	 * 
	 * @param mixed $name
	 * @param mixed $user
	 * @return
	 */
	public function createapi($name,$user)
	{
		$key = $this->getToken("25");
		$secrect = $this->getToken("50");
		$date = date("d-m-y");
		$insertapi = $this->db->prepare("INSERT INTO api (`name`,`pubkey`,`secret`,`date`,`user`) 
		VALUES(?,?,?,?,?)");
		$insertapi->execute(array($name,$key,$secrect,$date,$user->username));
	}
	
	/**
	 * getapi()
	 * 
	 * @param mixed $user
	 * @return
	 */
	public function getapi($user)
	{
		$getapi = $this->db->prepare("SELECT * FROM api WHERE user=?");
		$getapi->execute(array($user->username));
		return $getapi->fetchAll();
	}
	
		/**
		 * bannedusers()
		 * 
		 * @return
		 */
		public function bannedusers()
	{
		$banlist = $this->db->prepare("SELECT * FROM banlist");
		$banlist->execute();
		return $banlist->fetchAll();
	}
	
	/**
	 * banuser()
	 * 
	 * @param mixed $user
	 * @param mixed $username
	 * @param mixed $reason
	 * @return
	 */
	public function banuser($user,$username,$reason)
	{
		$date = date("d-m-y");
		//harcoding this for the time being
		$banneduntil = "01-01-2025";
		$checkbanlist = $this->db->prepare("SELECT * FROM banlist WHERE username=?");
		$checkbanlist->execute(array($user));
		$banneduser = $checkbanlist->fetch();
		if(!$banneduser){
		$banlist = $this->db->prepare("INSERT INTO banlist(username,bannedby,
		banneduntil, reason,date) VALUES(?,?,?,?,?)");
		$banlist->execute(array($user,$username->username,$banneduntil,$reason,$date));
		
		}
	}
	
	public function unban($user)
	{
		$unban = $this->db->prepare("DELETE FROM banlist WHERE username=?");
		$unban->execute(array($user));
	}
    
    	/**
    	 * newcoin()
    	 * 
    	 * @param mixed $coin
    	 * @return
    	 */

	
	 public function cryptx()
	{

	}
	
	
	public function wallet($startcoin,$coin,$generate=null)
	{
	    
		$wallet = $coin->getnewaddress();
		if($generate == 'generate'):
		    $date = date("y-m-d h:i:s");
			$addwallet = $this->db->prepare("INSERT INTO addresses(address,coin,username,date,type) 
			VALUES(?,?,?,?,'withdraw')");
			$addwallet->execute(array($wallet,$startcoin,$_SESSION['user'],$date));
			return $wallet;
		endif;
		$checkwallet = $this->db->prepare("SELECT * FROM addresses WHERE username=? AND coin=? AND type='withdraw' ORDER BY date DESC");
		$checkwallet->execute(array($_SESSION['user'],$startcoin));
		$wallets = $checkwallet->fetch();
		$wallet = $coin->getnewaddress();
		if(!$wallets)
		{
			$date = date("y-m-d h:i:s");
			$addwallet = $this->db->prepare("INSERT INTO addresses(address,coin,username,date,type) 
			VALUES(?,?,?,?,'withdraw')");
			$addwallet->execute(array($wallet,$startcoin,$_SESSION['user'],$date));
			return $wallets;
		}else{
			return $wallets->address;
		}
	}
	
	public function withdraw($coin,$startcoin,$amount,$withdrawaddress)
	{
	    //initiate gettext because we're not including the header
		//using number format to stop 9.9E-5  type shit from happening
		//checkbalance
		//make sure their amount is more than 0.0001
		$minval = explode('.', $amount);
		if(strlen($minval[1]) > 4): header('location: ' .URL.'transfer/withdraw?error=4'); exit(); endif;
		$balance = $this->db->prepare("SELECT ".$coin." FROM user WHERE username=?");
		$balance->execute(array($_SESSION['user']));
		$userbalance = $balance->fetch();
		$validate= $startcoin->validateaddress($withdrawaddress);
		if($validate['isvalid'] == false): header('location: ' .URL.'transfer/withdraw?error=3'); die(); endif; 
		if($userbalance->$coin >= $amount && isset($withdrawaddress))
		{
			if($startcoin->getbalance() >= $amount )
			{
				$amounts = floatval(str_replace(",", "", number_format(($amount),4))) - 0.0002;
				
				$txid = $startcoin->sendtoaddress($withdrawaddress,$amounts);
				if($txid !=''){
				$newbalance = round($userbalance->$coin - $amount,6);
				$updatebalance = $this->db->prepare("UPDATE user SET btc=? WHERE username=?");
				$updatebalance->execute(array(number_format($newbalance,6),$_SESSION['user']));						
				$time = strtotime("now");
				$date = date("y-m-d h:i:s");
				$addwithdraw = $this->db->prepare("INSERT INTO 
				transactions(address,username,txid,amount,time,date,transaction,status,market) 
				VALUES(?,?,?,?,?,?,'withdraw','1',?)");
				$addwithdraw->execute(array(
				$withdrawaddress,
				$_SESSION['user'],
                $txid,
				number_format($amount,6),
				$time,
				$date,
				$coin));
                return true;
				}
			}
		}
	}


	public function userverifydetails($firstname, $lastname, $address1, $address2,
	$city,$zip,$state,$country,$dob,$username)
	{
		//stop people forging a post form to edit their details
		$checkifsubmit = $this->db->prepare("SELECT detailssubmitted FROM user WHERE username=?");
		$checkifsubmit->execute(array($username->username));
		$ifsubmitted = $checkifsubmit->fetch();
		if($ifsubmitted->detailssubmitted == 0){
		$updateuser = $this->db->prepare("UPDATE user SET
		firstname=?,lastname=?,address1=?, address2=?,city=?,zip=?,state=?,
		country=?,dob=?, detailssubmitted=1 WHERE username=?");
		$updateuser->execute(array($firstname, $lastname, $address1, 
		$address2,$city,$zip,$state,$country,$dob,$username->username));
		}
	}
	public function messagecount()
	{
		$checkifenabled = $this->db->prepare("SELECT messagenotify FROM user WHERE username=?");
		$checkifenabled->execute(array($_SESSION['user']));
		$ifenabled = $checkifenabled->fetch();
		if($ifenabled->messagenotify == 1){
			$messages = $this->db->prepare("SELECT messageread 
			FROM messages WHERE messageread='unread' 
			AND user=?");
			$messages->execute(array($_SESSION['user']));
			$messagecount = $messages->fetchAll();
			if($messagecount){
			echo '<span class="badge badge-success pull-right">'.count($messagecount).'</span>';
		}}
	}
	
	public function sendemail($to,$subject,$message,$site)
	{
		include APP."/libs/SMTPClass.php";
		include APP."/libs/SMTPconfig.php";
		$to   = $to;
		$from = $site->email;
		$subject = $subject;
		$body = file_get_contents(APP .'views/_templates/email/header.php') . 
		'			
		<table class="table_scale" width="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5d78f2" style="padding:0; margin: 0; ">
			<tr>
				<td width="600" bgcolor="#5d78f2" align="left" valign="top" style="padding: 30px 30px 0px 30px; font-size:13px ; color:#686868; font-family: Helvetica, Arial, sans-serif; line-height: 23px; ">
					<p style="text-transform: uppercase; font-family: Georgia, serif; font-size: 32px; color: #ffffff; line-height: 42px;">
						'.$subject.' 
						</p>
					</td>
				</tr>
			</table>
			<table class="table_scale" width="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5d78f2" style="padding:0; margin: 0; ">
				<tr>
					<td align="center" class="featured_left" bgcolor="#5d78f2" align="left" valign="top" width="330" style="padding: 10px 0px 30px 0px; font-size:13px ; color:#686868; font-family: Helvetica, Arial, sans-serif; line-height: 23px; ">
					<p style="font-family:  Helvetica, Arial, sans-serif; font-size: 18px; color: #ffffff; line-height: 28px; font-weight: normal;">
							  '.$message.'
					</p>
					<br />
					</td>
					<td class="spacer" width="30" align="left" bgcolor="#5d78f2" style="margin: 0 !important; padding: 0 !important; line-height: 0 !important;">
						&nbsp;
					</td>
					<td class="spacer" width="30" align="left" bgcolor="#5d78f2" style="margin: 0 !important; padding: 0 !important; line-height: 0 !important;">
						&nbsp;
					</td>
				</tr>
			</table>
			'.
		file_get_contents(APP .'views/_templates/email/footer.php'); 
		$SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body);
		$SMTPChat = $SMTPMail->SendMail();
	}
	
	public function homeorders($type)
	{
	    switch($type)
		{
			case 'homebuy':
				  $homebuy = $this->db->prepare("SELECT * FROM orders WHERE buysell='buy' ORDER BY time DESC LIMIT 5");
				  $homebuy->execute();
				  return $homebuy->fetchAll();	 	
			break;
			case 'homesell':
				 $homesell = $this->db->prepare("SELECT * FROM orders WHERE buysell='sell' ORDER BY time DESC LIMIT 5");
				 $homesell->execute();
				 return $homesell->fetchAll();	 	
			break;
			case 'hometrade':
				 $hometrade = $this->db->prepare("SELECT * FROM trades ORDER BY time DESC LIMIT 5");
				 $hometrade->execute();
				 return $hometrade->fetchAll(); 	
			break;
	    }
	}

	public function depositcoin()
	{
		$depositcoin = $this->db->prepare("SELECT * FROM coins WHERE enabled=1");
		$depositcoin->execute();
		return $depositcoin->fetchAll();
	}
	
	public function admintotaltrades($coin)
	{
		$totalval = $this->db->prepare("SELECT sum(amount) AS total FROM trades WHERE
		maincoin=?");
		$totalval->execute(array($coin));
		return $totalval->fetch(); 
	}
	
	public function twofackey($user)
	{
	    $checksecret = $this->db->prepare("SELECT twofackey FROM user WHERE username=?");
		$checksecret->execute(array($user));
		$secrets = $checksecret->fetch();
		if(!empty($secrets->twofackey))
		{
			return $secrets->twofackey;
		}else{
			$ga = new PHPGangsta_GoogleAuthenticator();
	        $secret = $ga->createSecret();
			$insertkey = $this->db->prepare("UPDATE user SET twofackey=? WHERE username=?");
			$insertkey->execute(array($secret,$user));
			return $secret;
		}
	}
	
	public function sitenews($url)
	{
		$news = $this->db->prepare("SELECT * FROM news WHERE page=? OR page=? ORDER BY date DESC");
		$news->execute(array($url,'all'));
		$sitesnews = $news->fetch();
		if($sitesnews):
			if($sitesnews->enabled == 1):
				if($url == $sitesnews->page):
					echo '<div class="alert alert-info col-sm-6 col-sm-offset-3">'.$sitesnews->title.'</div>';
				endif;
			endif;
	    endif;
	}
	
	public function addnews($title, $message, $url)
	{
		$date = date("y-m-d h:i:s");
		$addnews = $this->db->prepare("INSERT INTO news(title,message,page,enabled) VALUES(?,?,?,1)");
        $addnews->execute(array(
            $title, 
			$message, 
			$url));
        header('location: ' .ADMINURL.'/news/');
	}
	
	    public function news()
    {
        $news = $this->db->prepare("SELECT * FROM news");
        $news->execute();
        return $news->fetchAll();
    }
	
	public function editnews($id)
    {
        $getnews = $this->db->prepare("SELECT * FROM news WHERE id=?");
        $getnews->execute(array($id));
        return $getnews->fetch();
    }
	
    public function tickets($user,$type=null,$admin=null)
    {
		if(isset($type)): 
			$tickets = $this->db->prepare("SELECT * FROM support WHERE user=? AND status=? ORDER BY lastupdate DESC");
		    $tickets->execute(array($user,$type));
		else:
			$tickets = $this->db->prepare("SELECT * FROM support WHERE user=? ORDER BY lastupdate DESC");
		    $tickets->execute(array($user));
		endif;
		if(isset($admin)):
			$tickets = $this->db->prepare("SELECT * FROM support ORDER BY lastupdate DESC");
		    $tickets->execute();
		endif;
        return $tickets->fetchAll();
    }
	
	public function ticket($user,$id)
	{
        if(!empty($user)): 
			$tickets = $this->db->prepare("SELECT * FROM support WHERE user=? AND id=?");
		    $tickets->execute(array($user,$id));
		else:
			$tickets = $this->db->prepare("SELECT * FROM support WHERE id=?");
		    $tickets->execute(array($id));
		endif;
		return $tickets->fetch();
	}
	
	public function ticketreplies($id)
	{
		$tickets = $this->db->prepare("SELECT * FROM tickets WHERE mainticket=?");
		$tickets->execute(array($id));
		return $tickets->fetchAll();
	}
	
	public function addticket($title,$category,$status,$message,$user)
	{
		$date = date("y-m-d h:i:s");
		$addticket = $this->db->prepare("INSERT INTO support(title,category,priority,
		message,user,lastupdate,date) VALUE(?,?,?,?,?,?,?)");
		$addticket->execute(array($title,$category,$status,$message,$user,$date,$date));
		if($addticket): return true; endif;
	}
	
	public function addticketreply($message,$user,$ticket)
	{
		$date = date("y-m-d h:i:s");
		//add the reply
		$addticket = $this->db->prepare("INSERT INTO tickets(message,user,
		date,mainticket) VALUE(?,?,?,?)");
		$addticket->execute(array($message,$user,$date,$ticket));
		//update last update time
		$lastupdate = $this->db->prepare("UPDATE support SET lastupdate=? WHERE id=?");
		$lastupdate->execute(array($date,$ticket));
		if($addticket): return true; endif;
	}
	
	
	public function gettext()
	{
		include(APP."/libs/languages/libs/streams.php");
		include(APP."/libs/languages/libs/gettext.php");

		define('LOCALE', 'en_GB');

		define('SESSION_LOCALE_KEY', 'locale');
		define('DEFAULT_LOCALE', 'en_GB');
		define('LOCALE_REQUEST_PARAM', 'lang');
		define('WEBSITE_DOMAIN', 'messages');

		if (array_key_exists(LOCALE_REQUEST_PARAM, $_REQUEST)) {
			$current_locale = $_REQUEST[LOCALE_REQUEST_PARAM];
			$_COOKIE[SESSION_LOCALE_KEY] = $current_locale;
		} elseif (array_key_exists(SESSION_LOCALE_KEY, $_COOKIE)) {
			$current_locale = $_COOKIE[SESSION_LOCALE_KEY];
		} else {
			$current_locale = DEFAULT_LOCALE;
		}
		//will eventually stick this all in the model file
		putenv("LC_TIM=en_GB");
		putenv("LC_MESSAGES=$current_locale");
		setlocale(LC_MESSAGES, $current_locale);
		
		bindtextdomain(WEBSITE_DOMAIN, $_SERVER['DOCUMENT_ROOT'] . '/lang');
		bind_textdomain_codeset(WEBSITE_DOMAIN, 'UTF-8');
		textdomain(WEBSITE_DOMAIN);
	}
	
	public function checkapi($data,$message)
	{
        $userkey = $data['sig'];
		$pubkey = $data['pubkey'];
		$key = $this->db->prepare("SELECT * FROM api WHERE pubkey=?");
		$key->execute(array($pubkey));
		$priv_key = $key->fetch();
		if(!$priv_key): return false; die(); endif;
	    // Data submitted
        $computed_signature = base64_encode(hash_hmac('sha1', $message, $priv_key->secret, TRUE));
		if($computed_signature == $userkey) {
			return $priv_key->user;
		}else{
		    return false;
		}
	
	}
	
	public function transactions($user)
	{
		$transaction = $this->db->prepare("SELECT * FROM transactions WHERE username=? ORDER BY date DESC");
		$transaction->execute(array($user->username));
		return $transaction->fetchAll();
	}
	public function deposits($user,$market)
	{
		$transaction = $this->db->prepare("SELECT * FROM transactions WHERE username=? AND market=? AND transaction='deposit' ORDER BY date DESC");
		$transaction->execute(array($user->username,$market));
		return $transaction->fetchAll();
	}	
	public function withdraws($user,$market)
	{
		$transaction = $this->db->prepare("SELECT * FROM transactions WHERE username=? AND market=? AND transaction='withdraw' ORDER BY date DESC");
		$transaction->execute(array($user->username,$market));
		return $transaction->fetchAll();
	}
	public function admintransactions()
	{
		$transaction = $this->db->prepare("SELECT * FROM transactions");
		$transaction->execute();
		return $transaction->fetchAll();
	}
	public function payees($username,$coin)
	{
		$address = $this->db->prepare("SELECT * FROM addresses WHERE username=? ".$coin." AND type='payee'");
		$address->execute(array($username->username));
		return $address->fetchAll();
	}
	
	public function openhomeorders($market,$buysell)
	{
		$orders = $this->db->prepare("SELECT * FROM orders WHERE market=? AND buysell=?");
		$orders->execute(array($market,$buysell));
		return $orders->fetchAll();		
	}

}

?>