<?php

class Admincp extends Controller
{
    public function index()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';

        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $guides = $this->model->helpguides();
		$totalbtc = $this->model->admintotaltrades('btc');
		$totalltc = $this->model->admintotaltrades('ltc');
		$totalusd = $this->model->admintotaltrades('usd');
		$totalppc = $this->model->admintotaltrades('ppc');
		$totalnmc = $this->model->admintotaltrades('nmc');
		
		/*
		 *calculate profits get all sent to main wallet then divide users balance?
		 * I'm not sure if this will work, what if someone withdraws, and their balance
		 * goes to 0.. or we can get the wallet balance not all received...
         *
		 		 */
		  $balance = $this->model->totaluserbalance();
		  $btc = $this->model->btccoin();
		  $profit = round($btc->getbalance() - $balance->total,4);
		  

        require APP . 'views/admin/index.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }

    public function users()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
		if (!$this->model->isstaff() == true):
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
		endif;
        $users = $this->model->adminusers();
        require APP . 'views/admin/users.php';
        if ($this->model->isadmin() == true && $this->model->isstaff() == true):
		    require APP . 'views/_templates/sidebarright.php';
		elseif($this->model->isstaff() == true):
			require APP . 'views/_templates/modsidebar.php';
		endif;
        require APP . 'views/_templates/footer.php';
    }
		
    public function transactions()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/');
        }
		$transactions = $this->model->admintransactions();
        require APP . 'views/admin/transactions.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }
		
	    public function coins()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';

        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
		$coin = $this->model->coinlinks();
        require APP . 'views/admin/coins.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }
	
	 public function addcoin()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';

        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
		if(isset($_POST['add_coin'])):
			$coinname = isset($_POST['coinname']) ? $_POST['coinname'] : null;
			$cointitle = isset($_POST['cointitle']) ? $_POST['cointitle'] : null;
			$coindescription = isset($_POST['coindescription']) ? $_POST['coindescription'] : null;
			$enabled = isset($_POST['enabled']) ? 1 : 1;
			$rpc = isset($_POST['rpc']) ? $_POST['rpc'] : null;
			if (!$coinname == null && !$cointitle == null && !$coindescription == null)
			{
				$addcoin = $this->model->addcoin($coinname, $cointitle, $coindescription,$enabled,$rpc);
			}
			
		endif;
		
        require APP . 'views/admin/addcoin.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }
	
	public function deletecoin()
	{
	    SESSION_START();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $id = isset($_GET['id']) ? $_GET['id'] : '';
		$coinname = isset($_GET['coin']) ? $_GET['coin'] : '';
		if(isset($id)):
			$deletecoin = $this->db->prepare("DELETE FROM coins WHERE id=?");
			$deletecoin->execute(array($id));
			$deletecol = $this->db->prepare("ALTER TABLE user DROP COLUMN ".htmlentities($coinname)."");
            $deletecol->execute();
			header('location: ' . ADMINURL . '/coins');
		endif;
	}
	
     public function editcoin()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';

        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }		
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$coin = $this->model->editcoin($id);
        require APP . 'views/admin/editcoin.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }

    public function addguide()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';

        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }

        require APP . 'views/admin/addguide.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }

    public function settings()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        $setting = $this->model->site();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }

        require APP . 'views/admin/settings.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }

    public function updatesettings()
    {
        SESSION_START();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
		//I should've put these in an array or something.. too many lines of code
        $sitename = isset($_POST['sitename']) ? $_POST['sitename'] : '';
        $siteslogan = isset($_POST['slogan']) ? $_POST['slogan'] : '';
        $siteurl = isset($_POST['siteurl']) ? $_POST['siteurl'] : '';
        $sitekeywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
        $sitedescription = isset($_POST['description']) ? $_POST['description'] : '';
        $sitecoins = isset($_POST['coins']) ? $_POST['coins'] : '';
        $sitefee = isset($_POST['fees']) ? $_POST['fees'] : '';
        $vat = isset($_POST['vat']) ? $_POST['vat'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
		$emailverify = isset($_POST['emailverify']) ? '1' : '0';
		$idverify = isset($_POST['idverify']) ? '1' : '0';
		$maintenance = isset($_POST['maintenance']) ? '1' : '0';
        if (isset($sitename) && isset($siteslogan) && isset($siteurl) && isset($sitekeywords) &&
            isset($sitedescription) && isset($sitecoins) && isset($sitefee) && isset($vat) &&
            isset($address) && isset($emailverify) && isset($idverify) && isset($maintenance))
        {
            $update = $this->model->updatesettings($sitename, $siteslogan, $siteurl, $sitekeywords,
                $sitedescription, $sitecoins, $sitefee, $vat, $address, $phonenumber, $email,
				$emailverify, $idverify, $maintenance );
        }
        if ($update)
        {
            header('location: ' . ADMINURL . 'admin/settings');
        }
    }


    public function editguide()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $url = isset($_GET['gurl']) ? $_GET['gurl'] : '';
        $editguide = $this->model->editguide($url);
        require APP . 'views/admin/editguide.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }

    public function updateguide()
    {
        SESSION_START();

        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }

        $url = isset($_POST['gurl']) ? $_POST['gurl'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : null;

        if (!$message == null)
        {
            $updateguide = $this->model->updateguide($url, $message);
            header('location: ' . ADMINURL . '/index');
        }

    }

    public function guides()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        $guides = $this->model->helpguides();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }

        require APP . 'views/admin/guides.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }


    public function insertguide()
    {
        SESSION_START();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $url = isset($_POST['url']) ? $_POST['url'] : null;
        $message = isset($_POST['message']) ? $_POST['message'] : null;
        if (!$message == null && !$title == null && !$url == null)
        {
            $addguide = $this->model->addguide($title, $message, $url);
        }
    }

    public function verifyusers()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        $users = $this->model->useridverify();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        require APP . 'views/admin/verifyusers.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }

    public function edituser()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
		if (!$this->model->isstaff() == true):
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
		endif;
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $edituser = $this->model->edituser($id);
        if (!$edituser)
        {
            header('location: ' . ADMINURL . 'admin/');
        }
        require APP . 'views/admin/edituser.php';
		if ($this->model->isadmin() == true && $this->model->isstaff() == true):
		    require APP . 'views/_templates/sidebarright.php';
		elseif($this->model->isstaff() == true):
			require APP . 'views/_templates/modsidebar.php';
		endif;
        require APP . 'views/_templates/footer.php';
    }

    public function addfaq()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        require APP . 'views/admin/addfaq.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }
    public function faqs()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $faqs = $this->model->faqs();
        require APP . 'views/admin/faqs.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }

    public function insertfaq()
    {
        SESSION_START();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $message = isset($_POST['faq']) ? $_POST['faq'] : null;
        if (!$message == null && !$title == null)
        {
            $addfaq = $this->model->addfaq($title, $message);
        }
    }

    public function editfaq()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $editfaq = $this->model->editfaq($id);
        require APP . 'views/admin/editfaq.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }
	
		public function deletefaq()
	{
		session_start();
		$id = isset($_GET['id']) ? $_GET['id'] : ''; 
		if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
		if(isset($id))
		{
			$deletenews = $this->db->prepare("DELETE FROM faq WHERE id=?");
			$deletenews->execute(array($id));
			header('location: ' . ADMINURL . '/faqs');
		}
	}

    public function updatefaq()
    {
        SESSION_START();

        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }

        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : null;

        if (!$message == null)
        {
            $updatefaq = $this->model->updatefaq($id, $message);
            // header('location: ' .ADMINURL . '/index');
            echo 'error1';
        }

    }

    //add, view and edit pages
    public function addpage()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        require APP . 'views/admin/addpage.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }
    public function pages()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $pages = $this->model->pages();
        require APP . 'views/admin/pages.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }

    public function insertpage()
    {
        SESSION_START();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $message = isset($_POST['page']) ? $_POST['page'] : null;
		$purl = isset($_POST['purl']) ? $_POST['purl'] : null;
        if (!$message == null && !$title == null)
        {
            $addpage = $this->model->addpage($title, $message,$purl);
			header('location: ' .ADMINURL.'/pages/');
        }
    }

    public function editpage()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $editpage = $this->model->editpage($id);
        require APP . 'views/admin/editpage.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }

    public function updatepage()
    {
        SESSION_START();

        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }

        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : null;

        if (!$message == null)
        {
            $updatepage = $this->model->updatepage($id, $message);
            // header('location: ' .ADMINURL . '/index');
            echo 'error1';
        }

    }

    public function invalidid()
    {
        SESSION_START();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $user = isset($_GET['user']) ? $_GET['user'] : '';
        if (!$user == null)
        {
            $invalidid = $this->model->invalidid($user);
            header('location: ' . ADMINURL . '/edituser/?id=' . $user);
        }

    }

    public function validid()
    {
        SESSION_START();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $user = isset($_GET['user']) ? $_GET['user'] : '';

        if (!$user == null)
        {
            $validid = $this->model->validid($user);
            header('location: ' . ADMINURL . '/edituser/?id=' . $user);
        }

    }

    public function getuserimg()
    {
	    if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $img = isset($_GET['img']) ? htmlspecialchars($_GET['img'],ENT_QUOTES) : '';
		$user = isset($_GET['user']) ? $_GET['user'] : '';
        if (file_exists($img) && !empty($img))
        {
            $imginfo = getimagesize($img);
            header("Content-type: " . $imginfo['mime']);
            echo readfile($img);
        }
        header("Content-type: image/jpeg");
        echo readfile($img);
    }
	
	public function banneduser()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
		$bannedusers = $this->model->bannedusers();
        require APP . 'views/admin/banuser.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }
	
	public function banuser()
	{
		SESSION_START();
	    if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/');
        }
		$user = isset($_GET['user']) ? $_GET['user'] : '';
		$reason = isset($_POST['reason']) ? $_POST['reason'] : '';
        $username = $this->model->user();
		if(isset($user)){
		   $bantheuser = $this->model->banuser($user,$username,$reason);
		   header('location: ' . ADMINURL . '/banneduser');
		}
	}
	
		public function unban()
	{
		SESSION_START();
		if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
		$user = isset($_GET['username']) ? $_GET['username'] : '';
        $username = $this->model->user();
		if(isset($user)){
		   $unban = $this->model->unban($user);
		   header('location: ' . ADMINURL . '/banneduser');
		}
	}
	
	public function addnews()
	{
		require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/adminsidebar.php';		
		require APP . 'views/admin/addnews.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
	}
	
	public function insertnews()
	{
	    SESSION_START();
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $url = isset($_POST['page']) ? $_POST['page'] : null;
        $message = isset($_POST['message']) ? $_POST['message'] : null;
        if (!$message == null && !$title == null && !$url == null):
            $addnews = $this->model->addnews($title, $message, $url);
        endif;
	}

	public function news()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $newss = $this->model->news();
        require APP . 'views/admin/news.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }
	
	public function editnews()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';
        if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $editnews = $this->model->editnews($id);
        require APP . 'views/admin/editnews.php';
        require APP . 'views/_templates/sidebarright.php';
        require APP . 'views/_templates/footer.php';
    }
	
	public function deletenews()
	{
		session_start();
		$id = isset($_GET['id']) ? $_GET['id'] : ''; 
		if (!$this->model->isadmin() == true)
        {
            header('location: ' . URL . '/index');
        }
		if(isset($id))
		{
			$deletenews = $this->db->prepare("DELETE FROM news WHERE id=?");
			$deletenews->execute(array($id));
			header('location: ' . ADMINURL . '/news');
		}
	}
	
	public function modcp()
	{
		require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/adminsidebar.php';

        if (!$this->model->isstaff() == true)
        {
            header('location: ' . URL . '/index');
        }
		
		require APP . 'views/admin/modcp.php';
		
		if ($this->model->isadmin() == true && $this->model->isstaff() == true):
		    require APP . 'views/_templates/sidebarright.php';
		elseif($this->model->isstaff() == true):
			require APP . 'views/_templates/modsidebar.php';
		endif;
	}

}

?>