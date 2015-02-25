<?php 

  require_once 'jsonRPCClient.php';
 
  $bitcoin = new jsonRPCClient('http://cryptxe:corkish1@81.156.8.189:8332/');
 
  echo "<pre>\n";
  print_r($bitcoin->getnewaddress()); echo "\n";
  echo "</pre>";
?> 