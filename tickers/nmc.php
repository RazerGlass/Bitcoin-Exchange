<?php

if (!defined('access') or !access) die('This file cannot be directly accessed.');
class NMC_Ticker
{
     function price($currency, $time)
     {
          $data = file_get_contents("https://btc-e.com/api/2/nmc_".strtolower($currency)."/ticker");
          $data = json_decode($data, true);
          $spot_last = $data['ticker'][$time];
          return $spot_last;
     }
}
$coinTicker = new NMC_Ticker;
