<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Help extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/sidebar.php';
		$guides = $this->model->helpguides();
        require APP . 'views/help/guide.php';
        require APP . 'views/_templates/footer.php';
    }

    public function faq()
    {
        // load views
        require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/sidebar.php';
		$faqs = $this->model->faqs();
		$this->model->sitenews($_GET['url']);		
        require APP . 'views/help/faq.php';
        require APP . 'views/_templates/footer.php';
    }

    public function tickets()
    {
        // load views
        require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/sidebar.php';
        require APP . 'views/home/tickets.php';
        require APP . 'views/_templates/footer.php';
    }
	
	    public function tos()
    {
        // load views
        require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/sidebar.php';
        require APP . 'views/help/tos.php';
        require APP . 'views/_templates/footer.php';
    }
	
		public function guide()
		{
        require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/sidebar.php';
		$guides = $this->model->helpguides();
        require APP . 'views/help/guide.php';
        require APP . 'views/_templates/footer.php';
		}
		
	    public function viewguides()
       {
	    $url = $_GET['url'];
		$viewguide = $this->model->viewguide($url);
        require APP . 'views/help/viewguides.php';
       }
	   
		public function mobile()
		{
        require APP . 'views/_templates/header.php';
        require APP . 'views/help/mobile.php';
        require APP . 'views/_templates/footer.php';
		}
		
		public function contact()
	{
	    require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/sidebar.php';
        require APP . 'views/help/contact.php';
        require APP . 'views/_templates/footer.php';
	
	}
    
	
}
