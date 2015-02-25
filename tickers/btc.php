<?php
//won't be left like this. 
if (!defined('access') or !access) die('This file cannot be directly accessed.');
/**class BTC_Ticker
{
	function checkOnline($domain) {
		   $curlInit = curl_init($domain);
		   curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
		   curl_setopt($curlInit,CURLOPT_HEADER,true);
		   curl_setopt($curlInit,CURLOPT_NOBODY,true);
		   curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
		   //get answer
		   $response = curl_exec($curlInit);
		   curl_close($curlInit);
		   if ($response) return true;
		   return false;
	}
     function price($currency, $time)
     {
		  if($this->checkOnline('http://blockchain.info/ticker')) { 
          $data = file_get_contents("http://blockchain.info/ticker");
          $data = json_decode($data, true);
          $spot_last = $data[$currency][$time];
          return $spot_last;
		  }else{
		   return 'Error';
		  }
     }
}
$coinTicker = new BTC_Ticker;
*/
class BTC_Ticker
{
     function price($currency, $time)
     {
          $data = file_get_contents("https://btc-e.com/api/2/btc_".strtolower($currency)."/ticker");
          $data = json_decode($data, true);
          $spot_last = $data['ticker'][$time];
          return $spot_last;
     }
}
$coinTicker = new BTC_Ticker;