<?php

class Home extends Controller
{

    public function index()
    {
        // load views
        require APP . 'views/_templates/header.php';
		if (!$this->model->user() == '')
		{
			 header('location: '.URL.'dashboard/');
		}
		$market = isset($_GET['market']) ? strtolower($_GET['market']) : 'btc_usd';
        require APP . 'views/home/index.php';
        require APP . 'views/_templates/footer.php';
    }
	
	public function liveorders()
	{
		$buymarket = $this->model->homeorders('homebuy');
		$sellmarket = $this->model->homeorders('homesell');
		$trademarket = $this->model->homeorders('hometrade');
		require APP . 'views/home/liveorders.php';
	}

	public function datacharts()
	{
		$market = isset($_GET['market']) ? strtolower($_GET['market']) : 'btc_usd';
		if ($this->model->coins(strtoupper($market)) == false):
            $market = 'btc_usd';
        endif;
		
		$chart = $this->db->prepare("SELECT day(date) AS day, date, sum(amount) AS amount, avg(price) AS total FROM trades GROUP BY day(date)");
		$chart->execute(array($market));
		$chartdata = $chart->fetchAll();
	
		$result = array();
        foreach ($chartdata as $data)
        {
			
		   array_push($result,array(strtotime($data->date) * 1000,
		                            $data->amount,
									number_format($data->total,4)));
        }
		
		print json_encode($result, JSON_NUMERIC_CHECK);
	}
	
	public function language()
	{
		$language = isset($_GET['id']) ? $_GET['id'] : '';
		if(!empty($language)):
			//also probably add to user account but just set cookie ftb
			setcookie("locale", $language, time()+3600*24*365*10, '/'); 
			header('LOCATION: ./');
		endif;
	}
	
	
	
	public function order_book()
	{
	    require APP . 'views/_templates/header.php';
		require APP . 'views/_templates/sidebar.php';
		$market = isset($_GET['market']) ? strtolower($_GET['market']) : 'btc_usd';
        $buyorders = $this->model->openhomeorders($market,'buy');
		$sellorders = $this->model->openhomeorders($market,'sell');
		$trades = $this->model->TradesDashboard($market);
        require APP . 'views/home/order_book.php';
        require APP . 'views/_templates/footer.php';
	
	}
	
	
	


}
