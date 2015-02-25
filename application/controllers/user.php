<?php

class User extends Controller
{
    public function index()
    {
        header('location: ' . URL . '/index');
		exit();
    }

    public function login()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        if (!$this->model->user() == '')
        {
            header('location: ' . URL . 'dashboard');
			exit();
        }
		$this->model->sitenews($_GET['url']);
		
		//get the user's variables
        $email = isset($_POST['mail']) ? $this->model->encrypt(strtolower($_POST['mail'])) : '';
        $password = isset($_POST['pass']) ? $_POST['pass'] : '';
        $cookie = isset($_POST['remember']) ? 'rememberme' : null;
		$twocode = isset($_POST['twocode']) ? $_POST['twocode'] : '';
        $userchecks = $this->model->UserCheck($email);
		if($userchecks){
		require APP . 'libs/GoogleAuthenticator.php';
		$ga = new PHPGangsta_GoogleAuthenticator();
		}
		//make sure there's a hidden input name=check_submit
        if (array_key_exists('check_submit', $_POST))
        {	
			//make sure it's been submitted
            if (isset($_POST) && $email != '' && $password != '')
            {
	            //check brute force attack. Logins table check failed
				 $date = date("y-m-d h:i:s");
				 $dateto = date("y-m-d h:i:s",strtotime("-15 minutes"));
                 $checkbrute = $this->db->prepare("SELECT * FROM logins WHERE ip=? AND status='Unsuccessful login' AND date BETWEEN ? AND ? ORDER BY date DESC ");
                 $checkbrute->execute(array($_SERVER["REMOTE_ADDR"],$dateto,$date));   
				 $checkbrutetimes = $checkbrute->fetchAll();
				 $checkbrutelast = $this->db->prepare("SELECT * FROM logins WHERE ip=? AND status='Unsuccessful login' AND date BETWEEN ? AND ? ORDER BY date DESC ");
                 $checkbrutelast->execute(array($_SERVER["REMOTE_ADDR"],$dateto,$date));   
		         $lastbrute = $checkbrutelast->fetch();
				 //$remaining = $lastbrute->date  $lastbrute->date;
				 if(count($checkbrutetimes) >= 5)
				 {
				   echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> You have tried to login too many times unsuccessfully. Try again in 15 minutes 
					  </div>
					  </div>
					  </div>';
				      require APP . 'views/user/login.php';
					  require APP . 'views/_templates/footer.php';
					  die();
				 }
			
			
				//assign variables to user fields
                foreach ($userchecks as $usercheck)
                {
                    $p = $usercheck->password;
                    $p_salt = $usercheck->passwordsalt;
                    $id = $usercheck->id;
                    $username = $usercheck->username;
                    $whitelistip = explode(",", $usercheck->ipwhitelist);
					//needs removing -- bad security
                    $site_salt = "subinsblogsalt";
                    $salted_hash = hash('sha256', $password . $site_salt . $p_salt);
					$secret = $this->model->twofackey($usercheck->username);
					$oneCode = $ga->getCode($secret);
                }

				//make sure the user account doesn't have ips in the whitelist
                if (!empty($usercheck->ipwhitelist) && in_array($_SERVER["REMOTE_ADDR"], $whitelistip, true) ||
                    empty($usercheck->ipwhitelist))
                {
				 //if the user account has enabled two factor security
				 if($usercheck->twofactor == 1 && empty($twocode))
				 {
				    require APP . 'views/user/loginauth.php';
					require APP . 'views/_templates/footer.php';
					die();
				 }
				 
				 // okay, check to see if the passwords, and codes match
				 if(!empty($twocode)){
				 echo $twocode .'<br/>';
				 echo $oneCode.'<br/>';
				 echo $password.'<br/>';
				 echo $p;
				 if($password == $p && $twocode == $oneCode)
				 {
					if($usercheck->loginnotify == 1):
					//if they have a login notification
					$this->model->sendemail($this->model->decrypt($email),'Login notification','
					You have just logged in with an IP address of: '.$_SERVER['SERVER_ADDR'].'. If this is not you, 
					please contact support <u>as soon as possible<u>',$site);
					endif;
					//awesome, they match, login the user
					 if ($cookies = 'rememberme')
                        {
                            $_SESSION['user'] = $username;
                            setcookie("XE_RememberMe", $username, time() + 10 * 365 * 24 * 60 * 60, '/');
							$this->model->newtoken();
                        } else
                        {
                            $_SESSION['user'] = $username; 
					        $this->model->newtoken();
                        }

                        //add to logins so user can view who's tried logging in
                        $date = date("y-m-d h:i:s");
                        $addlogin = $this->db->prepare("INSERT INTO logins(email,date,ip,status) VALUES(?,?,?,?)");
                        $addlogin->execute(array(
                            $email,
                            $date,
                            $_SERVER["REMOTE_ADDR"],
                            'Successful login'));
                        header("Location:" . URL . "dashboard");
						exit();
				 } else
                    {
						//well that sucks. Wrong information.
                        $date = date("y-m-d h:i:s");
                        $addlogin = $this->db->prepare("INSERT INTO logins(email,date,ip,status) VALUES(?,?,?,?)");
                        $addlogin->execute(array(
                            $email,
                            $date,
                            $_SERVER["REMOTE_ADDR"],
                            'Unsuccessful login'));
                        echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Wrong Authentication
					  </div>
					  </div>
					  </div>';
				      require APP . 'views/user/loginauth.php';
					  require APP . 'views/_templates/footer.php';
					  die();
                    }
					}
					//if the account doesn't have 2factor enabled
				 if ($p == $salted_hash)
                    {	
					
					if($usercheck->loginnotify == 1):
					//if they have a login notification
					$this->model->sendemail($this->model->decrypt($email),'Login notification','
					You have just logged in with an IP address of: '.$_SERVER['SERVER_ADDR'].'. If this is not you, 
					please contact support <u>as soon as possible<u>',$site);
					endif;
					
						//awesome. log them in
                        if ($cookies = 'rememberme')
                        {
                            $_SESSION['user'] = $username;
                            setcookie("XE_RememberMe", $username, time() + 10 * 365 * 24 * 60 * 60, '/');
                            $this->model->newtoken();
						} else
                        {
                            $_SESSION['user'] = $username; 
					        $this->model->newtoken();
                        }

                        //add to logins so user can view who;s tried logging in
                        $date = date("y-m-d h:i:s");
                        $addlogin = $this->db->prepare("INSERT INTO logins(email,date,ip,status) VALUES(?,?,?,?)");
                        $addlogin->execute(array(
                            $email,
                            $date,
                            $_SERVER["REMOTE_ADDR"],
                            'Successful login'));
                        header("Location:" . URL . "dashboard");
						exit();
                    } else
                    {
						//aww that sucks. Wrong info
                        $date = date("y-m-d h:i:s");
                        $addlogin = $this->db->prepare("INSERT INTO logins(email,date,ip,status) VALUES(?,?,?,?)");
                        $addlogin->execute(array(
                            $email,
                            $date,
                            $_SERVER["REMOTE_ADDR"],
                            'Unsuccessful login'));
                        echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Username/Password is Incorrect.
					  </div>
					  </div>
					  </div>';
                    }
                } else
                {
                    $date = date("y-m-d h:i:s");
                    $addlogin = $this->db->prepare("INSERT INTO logins(email,date,ip,status) VALUES(?,?,?,?)");
                    $addlogin->execute(array(
                        $email,
                        $date,
                        $_SERVER["REMOTE_ADDR"],
                        'Unsuccessful login'));
                    echo '
				      <div class="row row-centered">
					  <div class="col-md-3"></div>
                      <div class="col-md-5">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Your IP address is not on the whitelist for this account
					  </div>
					  </div>
					  </div>';
                    require APP . 'views/user/login.php';
                    require APP . 'views/_templates/footer.php';
                    exit();
                }
            }
        }
        // load views
        require APP . 'views/user/login.php';
        require APP . 'views/_templates/footer.php';
    }

    public function register()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		$this->model->sitenews($_GET['url']);
	    $referer = isset($_GET['referer']) ? htmlentities($_GET['referer'],ENT_QUOTES) : '';  
        require APP . 'views/user/register.php';
        require APP . 'views/_templates/footer.php';
    }

    public function registerusers()
    {
        $site = $this->model->site();
        //if passwords no set then set to null value
        $password = isset($_POST['password']) ? $_POST['password'] : '';
		$passwordrepeat = isset($_POST['passwordrepeat']) ? $_POST['passwordrepeat'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? strtolower($_POST['email']) : '';
		$referer = isset($_POST['referer']) ? $_POST['referer'] : '';  
        //our input names, we don't want them skipping inputs
        $required_fields = array(
            "username",
            "password",
			"passwordrepeat",
            "email",
            "securityq1",
            "securitya1",
            "securityq2",
            "securitya2");
        //check to see what inputs they have completed
			if ($_POST['terms'] == 'no')
            {
                echo '
					  <div class="col-md-6">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> You must accept our terms of service
					  </div>
					  </div>';
                die;
            }

		if($password != $passwordrepeat):
                echo '
					  <div class="col-md-6">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Passwords do not match
					  </div>
					  </div>';
                die;
		endif;
		//check empty vars
        foreach ($required_fields as $field)
        {
            if (!strlen($_POST[$field])):
                echo '
					  <div class="col-md-5">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Fields cannot be empty. Try again.
					  </div>
					  </div>';
                die;
            endif;
			
			
        }

        //set fields to check
        $checkinputs = array(
            "username",
            "password",
            "email",
            "securityq1",
            "securitya1",
            "securityq2",
            "securitya2");
        //check to see if they're trying to hack our website.
        foreach ($checkinputs as $validinputs)
        {
            if (!ctype_alnum($_POST[$field])):
                echo '
					  <div class="col-md-5">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Only Letters and numbers allowed
					  </div>
					  </div>';
                die;
            endif;
        }

        //check to see if a user already exists with supplied details
        $registerusercheck = $this->model->registercheckuser($username, $email);
        if (isset($_POST['submit']))
        {
            //see if password and username is set before proceeding
            if (isset($_POST['username']) && isset($_POST['password']))
            {

                //if the user already exists tell the registee
                if ($registerusercheck != 0)
                {
                    echo '
					  <div class="col-md-5">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> That username/email already exists, please try again!
					  </div>
					  </div>';
                    //don't run anything else
                    die;
                }
                //generate a random string for our salted passwords.
                //Safety is number 1 priority http://i.imgur.com/wFvhsx0.jpg
                function rand_string($length)
                {
                    $str = "";
                    $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $size = strlen($chars);
                    for ($i = 0; $i < $length; $i++)
                    {
                        $str .= $chars[rand(0, $size - 1)];
                    }
                    return $str;
                }

                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                {
                    echo '<div class="col-md-5">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Not a valid email address
					  </div>
					  </div>';
                    die;
                }

                //set the post inputs
                $password = $_POST['password'];
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);

                if (!$uppercase || !$lowercase || !$number || strlen($password) < 8)
                {
                    // tell the user something went wrong
                    echo '<div class="col-md-5">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Password didn\'t meet requirements
					  </div>
					  </div>';
                    die;
                }
                $site_salt = "subinsblogsalt";
                $p_salt = rand_string(20);
                $salted_hash = hash('sha256', $password . $site_salt . $p_salt);
                //great stuff. Now we register the user.
                $registeruser = $this->model->registeruser($_POST['username'], $salted_hash, $p_salt,
                    $this->model->encrypt(strtolower($_POST['email'])), $this->model->encrypt($_POST['securityq1']), 
					$this->model->encrypt($_POST['securitya1']), $this->model->encrypt($_POST['securityq2']),
                    $this->model->encrypt($_POST['securitya2']),$referer);
                //generate the email activation code
                if ($site->emailverify = 1)
                {
					$code = uniqid();
                    $emailactivate = $this->model->emailactivation($code,$this->model->decrypt($_POST['email']));
                    $this->model->sendemail($this->model->decrypt(strtolower($_POST['email'])),$site->sitename . " - "
					 . "Email Verification", 
'<p style="color: rgb(15,33,5);font-family: &quot;Helvetica Neue&quot; , Helvetica , Arial , &quot;Liberation Sans&quot; , FreeSans , sans-serif;line-height: 24.0px;margin: 0.0px;">
Please verify this email address with CryptXE. We require verified email addresses for users to start trading.
</p>
<p style="color: rgb(15,33,5);font-family: &quot;Helvetica Neue&quot; , Helvetica , Arial , &quot;Liberation Sans&quot; , FreeSans , sans-serif;line-height: 24.0px;margin: 20.0px 0.0px 0.0px;">
To verify, simply click this link: <a href="'.URL.'user/activationcode?code='.$code.'&user='.$this->model->decrypt($_POST['email']).'" class="blue no-decoration" href="" style="color: rgb(0,160,255);text-decoration: none;" target="_blank">'.URL.'user/activationcode?code='.$code.'&user='.$this->model->decrypt($_POST['email']).'</a>
<br>
</p>
',$site);
					echo '
                      <div class="col-md-5">
					  <div class="alert alert-success">
					  <strong>Welcome</strong> you have successfully registered. Please Verify your email
					  </div>
					  </div>';	
                } else
                {
                    echo '
                      <div class="col-md-5">
					  <div class="alert alert-success">
					  <strong>Welcome</strong> you have successfully registered. Please Verify your email
					  </div>
					  </div>';
                }
            }
        }
    }


    public function edit()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
			exit();
        }
        $site = $this->model->site();
        $user = $this->model->user();
		$this->model->isverified($user, $site);
	    $this->model->isbanned($user, $site);
		$this->model->isemailverified($user, $site);
		$this->model->sitenews($_GET['url']);
        $this->model->twofacverify($user);
        require APP . 'views/user/edit.php';
        require APP . 'views/_templates/footer.php';
    }

	
    public function information()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
			exit();
        }
        $username = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($username, $site);
		$this->model->isbanned($username, $site);
        $this->model->isemailverified($username, $site);
		$this->model->sitenews($_GET['url']);		
		$this->model->twofacverify($username);
        $timeline = $this->model->timeline($username->username);
        require APP . 'views/user/timeline.php';
        require APP . 'views/_templates/footer.php';
    }

    public function messages()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
			exit();
        }
        $username = $this->model->user();
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $messages = $this->model->messages($username, $type);
        $site = $this->model->site();
		$this->model->isverified($username, $site);
		$this->model->isbanned($username, $site);
        $this->model->isemailverified($username, $site);
		$this->model->sitenews($_GET['url']);		
		$this->model->twofacverify($username);
        require APP . 'views/user/messages.php';
        require APP . 'views/_templates/footer.php';
    }

    public function message()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
			exit();
        }
        $username = $this->model->user();
        $messageid = isset($_GET['message']) ? $_GET['message'] : '';
		//mark message as read
		if(isset($messageid))
		{
			$markasread = $this->db->prepare("
			UPDATE messages SET messageread='read' WHERE id=? AND user=?");
			$markasread->execute(array($messageid,$username->username));
		}
        $messages = $this->model->message($username, $messageid);
        $site = $this->model->site();
		$this->model->isverified($username, $site);
	    $this->model->isbanned($username, $site);
        $this->model->isemailverified($username, $site);
		$this->model->sitenews($_GET['url']);		
		$this->model->twofacverify($username);
        require APP . 'views/user/message.php';
        require APP . 'views/_templates/footer.php';
    }

    public function deletemessage()
    {
        SESSION_START();
        if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
			exit();
        }
        $username = $this->model->user();
        $messageid = isset($_GET['message']) ? $_GET['message'] : '';
        $messages = $this->model->deletemessage($username, $messageid);
    }


    public function editinformation()
    {
        SESSION_START();
        $user = $this->model->user();
        if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
			exit();
        }
        //let's update their info
		$csfr = isset($_POST['token']) ? $_POST['token'] : '';
		if(!$csfr == $_SESSION['token']) { echo 'Invalid Token'; die(); }
        $email = isset($_POST['email']) ? $this->model->encrypt($_POST['email']) : '';
        //set the post inputs
        $password = isset($_POST['password']) ? $_POST['password'] : '';
		$expandedsidebar = !empty($_POST['expandedsidebar']) ? 1 : 0;		
		$expandedchat = !empty($_POST['expandedchat']) ? 1 : 0;
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8)
        {
            // tell the user something went wrong
            echo '<div class="col-md-4 col-md-offset-4">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Password didn\'t meet requirements
					  </div>
					  </div>';
            die;
        }

        function rand_string($length)
        {
            $str = "";
            $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $size = strlen($chars);
            for ($i = 0; $i < $length; $i++)
            {
                $str .= $chars[rand(0, $size - 1)];
            }
            return $str;
        }
        $site_salt = "subinsblogsalt";
        $p_salt = rand_string(20);
        $salted_hash = hash('sha256', $password . $site_salt . $p_salt);
        $sql1 = $this->db->prepare("UPDATE user SET email=?, password=?,
		passwordsalt=?, sidebaropen=?,chatbaropen=? WHERE username=?");
        $sql1->execute(array(
            $email,
            $salted_hash,
            $p_salt,
			$expandedsidebar,
			$expandedchat,
            $user->username));
		//add message
			$this->model->newtoken();
			$this->model->addmessage("You have updated your account information",
			"You have recently updated your account information. If you did
			not make these changes please contact support <b><u>as soon as possible</u></b>",$user,"System","account");
        echo '<div class="col-md-4 col-md-offset-4">
					  <div class="alert alert-success">
					  <strong>Updated!</strong> Your information has been updated
					  </div>
					  </div>';

    }

    public function security()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		if ($this->model->user() == '')
        {
            header('location: ' . URL . 'user/login');
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
        $whitelistips = $this->model->whitelistips($user->email);
        $userlogins = $this->model->userlogins($user->email);
        require APP . 'views/user/security.php';
        require APP . 'views/_templates/footer.php';
    }
	
    public function logout()
    {
	    session_start();
		if (isset($_GET["token"]) && $_GET["token"] == $_SESSION["token"]) {
		session_unset();
		session_destroy();
		$_SESSION = array();
        }
        //PUT THAT COOKIE DOWN, NOW! (Arnie reference)
        if (isset($_COOKIE['XE_RememberMe']))
        {
            unset($_COOKIE['XE_RememberMe']);
            setcookie('XE_RememberMe', null, -1, '/');
        }
        header("Location: " . URL);
		exit();
    }

    public function verifyidentity()
    {
        $uploaddir = '/userverify';
        $uploadfile = $uploaddir . basename($_FILES['advancedDropzone']['name']);
        echo "<p>";
        if (move_uploaded_file($_FILES['advancedDropzone']['tmp_name'], $uploadfile))
        {
            echo "File is valid, and was successfully uploaded.\n";
        } else
        {
            echo "Upload failed";
        }
    }

    public function addwhitelistip()
    {
        SESSION_START();
        $user = $this->model->user();
        $ipwhitelist = isset($_POST['ipwhitelist']) ? $_POST['ipwhitelist'] . ',' : '';
        if (isset($ipwhitelist))
        {
            $ips = $user->ipwhitelist . $ipwhitelist;
            $this->model->updatewhitelist($user, $ips);
			//add message so user knows
		    $this->model->addmessage("You have added a whitelist IP",
			"You have recently added a whitelist IP from our system. You will no longer be
			able to login with another IP unless you add them too. The IP that was deleted 
			is: ".$ipwhitelist."",$user,"System","account");
			$this->model->newtoken();
			header('location: ' . URL . 'user/security?error=no');
			exit();
        }else{
			header('location: ' . URL . 'user/security?error=6');
		}
    }

    public function deleteipwhitelist()
    {
        SESSION_START();
        $user = $this->model->user();
        $ipwhitelist = isset($_GET['ip']) ? $_GET['ip'] . ',' : '';
        if (isset($ipwhitelist))
        {
            $newwhitelist = str_replace($ipwhitelist, "", $user->ipwhitelist);
            $this->model->updatenewwhitelist($user, $newwhitelist);
			//add message
			$this->model->newtoken();
			$this->model->addmessage("You have deleted a whitelist IP",
			"You have recently delete a whitelist IP from our system. You will no longer be
			able to login with that IP if you have another IP set. The IP that was deleted 
			is: ".$ipwhitelist."",$user,"System","account");
            header('location: ' . URL . 'user/security');
		   exit();
        }
    }
	
	public function api()
	{
	    require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        $user = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($user, $site);
	    $this->model->isbanned($user, $site);
        $this->model->isemailverified($user, $site);
		$this->model->sitenews($_GET['url']);		
		$this->model->twofacverify($user);
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		$this->model->error($error);
		$apis = $this->model->getapi($user);
        require APP . 'views/user/api.php';
        require APP . 'views/_templates/footer.php';
	}
	
	public function deleteapi()
	{
	    require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        $user = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($user, $site);
	    $this->model->isbanned($user, $site);
        $this->model->isemailverified($user, $site);
		$this->model->sitenews($_GET['url']);		
		$this->model->twofacverify($user);
		$id = isset($_GET['api']) ? $_GET['api'] : '';
		if(isset($id)):
			$deleteapi = $this->db->prepare("DELETE FROM api WHERE id=? AND user=?");
			$deleteapi->execute(array($id,$user->username));
		    header('location: ' . URL . 'user/api?error=no');
		endif;
        require APP . 'views/user/api.php';
        require APP . 'views/_templates/footer.php';
		}
		
	public function generateapi()
	{
		SESSION_START();
	    $user = $this->model->user();
        $site = $this->model->site();
		$this->model->isverified($user, $site);
		$this->model->isbanned($user, $site);
        $this->model->isemailverified($user, $site);
		$name = !empty($_POST['name']) ? $_POST['name'] : 'n/a';
		$crsf = isset($_POST['token']) ? $_POST['token'] : ''; 
		if(!$crsf == $_SESSION['token']) { header('location: ' . URL . 'user/api?error=5'); }
		if(isset($_POST['submit'])){
		    $createapi = $this->model->createapi($name,$user);
			$this->model->newtoken();
	        header('location: ' . URL . 'user/api?error=no');
		}else{
		header('location: ' . URL . 'user/api');
		exit();
		}
	}

	
	   public function veridetails()
    {
		SESSION_START();
        if ($this->model->user() == '')
        {
            header('location: ' . URL . '/user/login');
			exit();
        }
        $site = $this->model->site();
        $user = $this->model->user();
	    $this->model->isbanned($user, $site);
        $firstname = isset($_POST['firstname']) ? $this->model->encrypt($_POST['firstname']) : '584B744E7543434F306C4141645345412F727A326F45387844626E4B3576514873456B326C557631566E453D';
        $lastname = isset($_POST['lastname']) ? $this->model->encrypt($_POST['lastname']) : '584B744E7543434F306C4141645345412F727A326F45387844626E4B3576514873456B326C557631566E453D';
        $address1 = isset($_POST['address1']) ? $this->model->encrypt($_POST['address1']) : '584B744E7543434F306C4141645345412F727A326F45387844626E4B3576514873456B326C557631566E453D';
		$address2 = isset($_POST['address2']) ? $this->model->encrypt($_POST['address2']) : '584B744E7543434F306C4141645345412F727A326F45387844626E4B3576514873456B326C557631566E453D';
		$city = isset($_POST['city']) ? $this->model->encrypt($_POST['city']) : '584B744E7543434F306C4141645345412F727A326F45387844626E4B3576514873456B326C557631566E453D';
		$zip = isset($_POST['zip']) ? $this->model->encrypt($_POST['zip']) : '584B744E7543434F306C4141645345412F727A326F45387844626E4B3576514873456B326C557631566E453D';
		$state = isset($_POST['state']) ? $this->model->encrypt($_POST['state']) : '584B744E7543434F306C4141645345412F727A326F45387844626E4B3576514873456B326C557631566E453D';
		$country = isset($_POST['country']) ? $this->model->encrypt($_POST['country']) : '584B744E7543434F306C4141645345412F727A326F45387844626E4B3576514873456B326C557631566E453D';
		$dob = isset($_POST['dob']) ? $_POST['dob'] : '584B744E7543434F306C4141645345412F727A326F45387844626E4B3576514873456B326C557631566E453D';
		
        if(isset($_POST['submit'])){	
		   $j = 0; // Variable for indexing uploaded image.
          if (!file_exists(URL_PUB."/userverify/" . $_SESSION['user'] . "/"))
         {
           mkdir(URL_PUB."/userverify/" . $_SESSION['user'] . "/", 0777);
         }
           $target_path = URL_PUB."/userverify/" . $_SESSION['user'] . "/"; // Declaring Path for uploaded images.
           for ($i = 0; $i < count($_FILES['file']['name']); $i++)
        {
			// Loop to get individual element from the array
			$validextensions = array(
            "jpeg",
            "jpg",
            "png"); // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['file']['name'][$i])); // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1]; // Set the target path with a new name of image.
        $j = $j + 1; // Increment the number of uploaded images according to the files in array.
        if (($_FILES["file"]["size"][$i] < 100000000)
            // Approx. 10mb files can be uploaded.
            && in_array($file_extension, $validextensions))
        {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path))
            {
                $checkupload = $this->db->prepare("SELECT verifyimg FROM user WHERE username=?");
                $checkupload->execute(array($_SESSION['user']));
                $verimgs = $checkupload->fetch();
                $allimgs = $verimgs->verifyimg .",". $target_path;
                $insert = $this->db->prepare("UPDATE user SET verifyimg=? WHERE username=?");
                $insert->execute(array($allimgs,$_SESSION['user']));
				$this->model->userverifydetails($firstname, $lastname, $address1, $address2,$city,$zip
		       ,$state,$country,$dob,$user);
			    $this->model->newtoken();
				$this->model->addmessage("You have submitted verification details",
				"You have recently submitted information for our user verification.
				Our team will verify this <b><u>as soon as possible</u></b>",$user,"System","account");
				header('location: ' . URL . 'dashboard');
				exit();
                // If file moved to uploads folder.
    
            } else
            { //  If File Was Not Moved.
                echo $j . ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else
        { //   If File Size And File Type Was Incorrect.
            echo $j . ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }

		}
			header('location: ' . URL . 'dashboard');
			exit();
    }
	
	public function activationcode()
	{
		SESSION_START();
		$user = isset($_GET['user']) ? $_GET['user'] : '';
		$code = isset($_GET['code']) ? $_GET['code'] : '';
		
		if(isset($code) && isset($user)){
		$this->model->activatecode($code,$user);
		}
	}
	
	public function passreset()
	{
	    require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		$this->model->sitenews($_GET['url']);
		$site = $this->model->site();
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		if(empty($email))
		{
		   require APP . 'views/user/passreset.php';
		}
		$secanswer = isset($_POST['secanswer']) ? $this->model->encrypt($_POST['secanswer']) : '';
		$secanswer2 = isset($_POST['secanswer2']) ? $this->model->encrypt($_POST['secanswer2']) : '';
		if(!empty($email))
		{ 
			
			$selectuser = $this->db->prepare("SELECT username,email,
			security_question1,security_answer1,security_question2,
            security_answer2 FROM user WHERE email=?");
			$selectuser->execute(array($this->model->encrypt($email)));
			$user = $selectuser->fetch();
			if($user){
				if(isset($_POST['submit'])){
				if($secanswer == $user->security_answer1 && $secanswer2 == $user->security_answer2)
				  {
				   echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-success">
					  <strong>Password Reset!</strong> Please check your email
					  </div>
					  </div>
					  </div>';
					$pass = uniqid();
					function rand_string($length)
                    {
                    $str = "";
                    $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $size = strlen($chars);
                    for ($i = 0; $i < $length; $i++)
                    {
                        $str .= $chars[rand(0, $size - 1)];
                    }
                    return $str;
                    }
				    $site_salt = "subinsblogsalt";
			        $p_salt = rand_string(20);
                    $salted_hash = hash('sha256', $pass . $site_salt . $p_salt);
					$update = $this->db->prepare("UPDATE user SET password=?, passwordsalt=? WHERE email=?");
					$update->execute(array($salted_hash,$p_salt,$this->model->encrypt($email)));
					//update site message to let the user know

					$this->model->sendemail($email,'Password Reset','
					You have applied for a password reset your new password is ' .$pass. ' 
					Please change this default password <u><b>as soon as possible</b></u>',$site);
					$this->model->addmessage("Password Reset",
					"You have recently changed your password. If you did not do
					this please contact support <u><b>as soon as possible</b></u>",$user,"System","account");
				}else{
				   echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Wrong security answers
					  </div>
					  </div>
					  </div>';
				}
				}
				require APP . 'views/user/passresetsec.php';
			}else{
			     echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> Email is not associated with an account
					  </div>
					  </div>
					  </div>';
				require APP . 'views/user/passreset.php';
			}
		}
			require APP . 'views/_templates/footer.php';
	}	
	
	public function twofactor()
	{
		require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		$this->model->sitenews($_GET['url']);		
		$user = $this->model->user();
        if ($this->model->user() == '')
        {
           header('location: ' . URL . 'user/login');
		   exit();
        }
		require APP . 'libs/GoogleAuthenticator.php';
		$ga = new PHPGangsta_GoogleAuthenticator();
		$secret = $this->model->twofackey($user->username);
		$userkey = isset($_POST['2key']) ? $_POST['2key'] : '';
		$usercode = isset($_POST['2code']) ? $_POST['2code'] : '';
		$oneCode = $ga->getCode($secret);
		if($user->twofactor == 1)
		{
		    header('location: ' . URL . 'dashboard');
			exit();
		}
        require APP . 'views/user/twofactor.php';
		if(isset($userkey) && isset($usercode))
		{
			if($usercode == $oneCode && $userkey == $secret)
			{
				$checkResult = $ga->verifyCode($secret, $oneCode, 2);
				if ($checkResult) {
					$updateuser = $this->db->prepare("UPDATE user SET twofactor=? WHERE username=?");
					$updateuser->execute(array('1',$user->username));
					$this->model->newtoken();
					$this->model->addmessage("You have completed 2factor Authentication",
			        "You have added Two Factor Authentication to your account. This will
					make your account much more secure",$user,"System","account");
   
					 echo '
				      <div class="row row-centered">
                      <div class="col-sm-6 col-sm-offset-3">
					  <div class="alert alert-success">
					  <strong>Well done</strong> Two Factor Authentication Complete
					  </div>
					  </div>
					  </div>';
				} else {
					echo 'FAILED';
				}				
			}
		}
		require APP . 'views/_templates/footer.php';
	}
	
	public function refer()
	{
	    require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		$this->model->sitenews($_GET['url']);
        $user = $this->model->user();
		$referinfo = $this->model->referinfo($user);
        require APP . 'views/user/refer.php';
        require APP . 'views/_templates/footer.php';
	}
	
	public function pricing()
	{
	    require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		$this->model->sitenews($_GET['url']);		
	    if (!$this->model->user() == '')
        {
            header('location: ' . URL . 'dashboard');
			exit();
        }
        require APP . 'views/user/pricing.php';
        require APP . 'views/_templates/footer.php';
	}

}
