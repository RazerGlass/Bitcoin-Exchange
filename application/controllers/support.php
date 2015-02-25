<?php

class Support extends Controller
{

    public function index()
    {	
        // load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		
	    if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		
		$user = $this->model->user();
		$type = isset($_GET['type']) ?  $_GET['type'] : '';
		//switch between open and closed
		switch($type):
			case 'open':
				 $tickets = $this->model->tickets($user->username,'0');
			break;
			case 'closed':
				 $tickets = $this->model->tickets($user->username,'1');
			$type = '';
			break;
			default:
				 $tickets = $this->model->tickets($user->username);
		endswitch;
		
		$all = count($tickets);
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		$this->model->error($error);
        require APP . 'views/support/index.php';
        require APP . 'views/_templates/footer.php';
    }
	
	public function newticket()
	{
        // load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		
	    if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;

		$user = $this->model->user();
		$tickets = $this->model->tickets($user->username);
        $all = count($tickets);	
		$title = isset($_POST['title']) ? $_POST['title'] : '';
		$categories = isset($_POST['category']) ? $_POST['category'] : '';
		$status = isset($_POST['status']) ? $_POST['status'] : '';
		$message = isset($_POST['message']) ? $_POST['message'] : '';
		
		switch($categories):
			case 'account':
				$category = 'Account';
			break;
			case 'general':
				$category = "General";
			break;
			case 'technical':
				$category = "Technical";
			break;
			default:
			    $category = 'Other';
		endswitch;
		if(isset($_POST['check_submit'])):
			//I could check if vars are empty but fuck it.
			$addticket = $this->model->addticket($title,$category,$status,$message,$user->username);
			if($addticket == true):
				header('location: ' . URL . '/support?error=no');
				exit();
			endif;
		endif;		
		require APP . 'views/support/new.php';
        require APP . 'views/_templates/footer.php';
	}
	
	public function admin()
	{
		// load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		
		if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		
		/*
		 * I am creating this because I don't want support staff to access the main
		 * admin control panel, so I can set them a role of support and they can access
         * this page and other staff pages
        */		 
		if (!$this->model->isstaff() == true):
            header('location: ' . URL . '/index');
			exit();
        endif;
		
		$tickets = $this->model->tickets($user->username,'0','all');
		$all = count($tickets);
		

        require APP . 'views/support/index.php';
        require APP . 'views/_templates/footer.php';
	}
	
	public function ticket()
	{
		// load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
		
		if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		
		$user = $this->model->user();
		$id = isset($_GET['id']) ? $_GET['id'] : ''; 
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		$this->model->error($error);
		
		//check to see if the submit owns the ticket
		$checkticket = $this->db->prepare("SELECT * FROM support WHERE user=? AND id=?");
	    $checkticket->execute(array($user->username,$id));
	    $ownsticket = $checkticket->fetch();
		
		//doesn't own it, redirect them
			if (!$this->model->isstaff() == true):
				if(count($ownsticket->id) == 0):
					header('location: ' . URL . '/support/?error=8');
					exit();
				endif;
			endif;
		
		//is staff, above all peasants
		if ($this->model->isstaff() == true):
            $tickets = $this->model->ticket('',$id);
			else:
			$tickets = $this->model->ticket($user->username,$id);
		endif;
		$ticketreply = $this->model->ticketreplies($id);
		$all = count($tickets);
		
        require APP . 'views/support/ticket.php';
        require APP . 'views/_templates/footer.php';
	}
	
	public function reply()
	{
		//intiate user stuff
		ob_start();
		SESSION_START();
		
		if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		$user = $this->model->user();
		
		//if it's been submitted
		if(isset($_POST['check_submit'])):
			
			//get the ticket id
		    $ticket =  isset($_POST['ticket']) ? $_POST['ticket'] : '';
		
		    //get the reply message
		    $message = isset($_POST['message']) ? $_POST['message'] : '';
			
			//check if it's staff or the owned ticket user
			$checkticket = $this->db->prepare("SELECT * FROM support WHERE user=? AND id=?");
			$checkticket->execute(array($user->username,$ticket));
			$ownsticket = $checkticket->fetch();
		
			//doesn't own it, redirect them
			if (!$this->model->isstaff() == true):
				if(count($ownsticket->id) == 0):
					header('location: ' . URL . '/support/?error=8');
					exit();
				endif;
			endif;
			//I could check if vars are empty but fuck it
			    $addticket = $this->model->addticketreply($message,$user->username,$ticket);
				header('location: ' . URL . '/support/?error=8');
			if($addticket == true):
				header('location: ' . URL . '/support/ticket/?id='.$ticket.'&error=no');
				exit();
			endif;	
		endif;
	}
	
	public function resolved()
	{
		ob_start();
		SESSION_START();
		
		if ($this->model->user() == ''):
            header('location: ' . URL . '/user/login');
			exit();
        endif;
		if (!$this->model->isstaff() == true):
		    header('location: ' . URL . 'support');
			exit();
		endif;
		
		//get the ticket id
		$ticket = isset($_GET['id']) ? $_GET['id'] : '';
		$type = isset($_GET['ticket']) ? $_GET['ticket'] : '';
		switch($type):
		    case 'close':
			     $update = $this->db->prepare("UPDATE support SET status='1' WHERE id=?");
			break;
			case 'open':
				 $update = $this->db->prepare("UPDATE support SET status='0' WHERE id=?");
			break;
			default:
			     $update = $this->db->prepare("UPDATE support SET status='1' WHERE id=?");
		endswitch;
		$update->execute(array($ticket));
		if($update):
			header('location: ' . URL . 'support/?error=no');
			exit();
		endif;
	}
}
?>