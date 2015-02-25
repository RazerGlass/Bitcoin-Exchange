<?php 

class Api extends Controller
{
	public function index()
	{
		require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';
        require APP . 'views/api/index.php';
        require APP . 'views/_templates/footer.php';
	}
	
	public function ticker()
	{
		header('Content-Type: application/json');
		$market = isset($_GET['ticker']) ? strtoupper(htmlspecialchars($_GET['ticker'],ENT_QUOTES)) : '';
        $tickerHigh = $this->model->ticker("price",$market," AND buysell='buy'"," ORDER BY PRICE DESC");
		$tickerLOW = $this->model->ticker("price",$market," AND buysell='buy'"," ORDER BY PRICE ASC");
		$tickerAVG = $this->model->ticker("avg(price)",$market," AND buysell='buy'","");
		$tickerLAST = $this->model->ticker("price",$market," AND buysell='buy'"," ORDER BY DATE DESC");
		$tickerVOL = $this->model->ticker('sum(amount)',$market,'','');
        $tickerBuy = $this->model->ticker("avg(price)",$market,"AND buysell='buy' AND date > DATE_SUB(NOW(), INTERVAL 1 DAY)","");
        $tickerSell = $this->model->ticker("avg(price)",$market,"AND buysell='sell' AND date > DATE_SUB(NOW(), INTERVAL 1 DAY)","");

		//$ticker = $this->model->ticker($market);
		$result = array();
		if ($this->model->coins($market) == false):
            array_push($result, array('error' => 'invalid market'));
			echo json_encode(array("ticker" => $result));
		    die();
        endif;
		array_push($result, array('market' => $market,
		                          'high'   => round($tickerHigh,4),
								  'low'    => round($tickerLOW,4),
								  'avg'    => round($tickerAVG,4),
								  'last'   => round($tickerLAST,4),
                                  'vol'    => round($tickerVOL,4),
								  'buy'    => round($tickerBuy,4),
								  'sell'    => round($tickerSell,4),
                                  'server_time' => strtotime('now')							  
								  ));
			echo json_encode(array("ticker" => $result));
	}

	
	
	
	public function orders()
	{
	    header('Content-Type: application/json');
	    $data = isset($_GET['data']) ? $_GET['data'] : '' ;
        $data = json_decode(stripslashes($data), TRUE);
        $message = $data['data'];
        $result = array();
		if($this->model->checkapi($data,$message)  == false): 
		    array_push($result, array('success' => false,
			                          'error' => 'invalid api'));
			echo json_encode(array("result" => $result));
		endif;
		if($message == 1): 
		$orders = $this->db->prepare("SELECT * FROM orders WHERE user=?"); 
		$orders->execute(array($this->model->checkapi($data,$message)));
        $openorder = $orders->fetchAll();
		foreach($openorder as $openorders ):
			array_push($result, array('id'        => $openorders->id,
			                          'market'    => $openorders->market,
			                          'amount'    => $openorders->amount,
                                      'cost'      => $openorders->cost,
 									  'price'     => $openorders->price,
									  'buysell'   => $openorders->buysell,
									  'beforefee' => $openorders->beforefee));
			endforeach;
		endif;
		echo json_encode(array("orders" => $result));
			
}
	
	public function deleteorder()
	{
	    header('Content-Type: application/json');
	    $data = isset($_GET['data']) ? $_GET['data'] : '' ;
        $data = json_decode(stripslashes($data), TRUE);
        $message = $data['data'];
        $result = array();
		if($this->model->checkapi($data,$message)  == false): 
		    array_push($result, array('success' => false,
			                          'error' => 'invalid api'));
			echo json_encode(array("result" => $result));
			die();
		endif;
		if(!empty($message)): 
            $orders = $this->db->prepare("SELECT * FROM orders WHERE id=? AND user=?"); 
            $orders->execute(array($message,$this->model->checkapi($data,$message)));
            $check = $orders->fetch();
			if($check){
            $deleteorder = $this->db->prepare("DELETE FROM orders WHERE id=? AND user=?"); 
            $deleteorder->execute(array($message,$this->model->checkapi($data,$message)));
                array_push($result, array('success' => true,
                                          'deleted' => $message));
                echo json_encode(array("result" => $result));
                die();
            }else{
			    array_push($result, array('success' => false));
			    echo json_encode(array("result" => $result));
			    die();
			}
		endif;
	}
	
	
		public function transactions()
	{
	    header('Content-Type: application/json');
	    $data = isset($_GET['data']) ? $_GET['data'] : '' ;
        $data = json_decode(stripslashes($data), TRUE);
        $message = $data['data'];
        $result = array();
		if($this->model->checkapi($data,$message)  == false): 
		    array_push($result, array('success' => false,
			                          'error' => 'invalid api'));
			echo json_encode(array("result" => $result));
			die();
		endif;
		if($message == 1): 
		$transactions = $this->db->prepare("SELECT * FROM transactions WHERE username=?"); 
		$transactions->execute(array($this->model->checkapi($data,$message)));
        $transaction = $transactions->fetchAll();
		foreach($transaction as $alltransactions ):
			array_push($result, array('address'    => $alltransactions->address,
			                          'txid'       => $alltransactions->txid,
                                      'amount'     => $alltransactions->amount,
 									  'type'       => $alltransactions->transaction,
									  'time'       => $alltransactions->time));
			endforeach;
		endif;
		echo json_encode(array("transactions" => $result));
}

}

?>