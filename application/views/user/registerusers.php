<?php
$password = isset($_POST['password']) ? $_POST['password'] : '';
			$username = isset($_POST['username']) ? $_POST['username'] : '';
			
			$registerusercheck = $this->model->registercheckuser($username,$email);
          	if (isset($_POST['submit']))
	        { 
			if (isset($_POST['username']) && isset($_POST['password']))
		   {
			if ($registerusercheck != 0)
            {
				echo '<div class="col-md-3"></div>
					  <div class="col-md-5">
					  <div class="alert alert-danger">
					  <strong>Oh snap!</strong> That username already exists, please try again!
					  </div>
					  </div>';
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
			   $registeruser = $this->model->registeruser($_POST['username'], $salted_hash, $p_salt,
			   $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['securityq1'],
			   $_POST['securitya1'], $_POST['securityq2'], $_POST['securitya2']);
			   
               if (!$registeruser)
               {
                    echo "\nPDO::errorInfo():\n";
                    print_r($registeruser->errorInfo());
               }
			        $password = $_POST['password'];
			  } 
			}

?>