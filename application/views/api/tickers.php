<?php
    if ($this->model->coins($market) == false):
          echo '{"success":0, "error":"Invalid pair name:"'.$market.'"}';
		  die();
    endif;
echo '{"';
echo $market;
echo '"';
echo ':{';
echo '"high":';
echo $tickerHigh;
echo ',"low":';
echo $tickerLOW;
echo ',"avg":';
echo $tickerAVG;
echo',"vol":';
echo $tickerVOL;
echo ',"last":';
echo $tickerLAST;
echo ',"buy":';
//sell = average all prices from selling orders
echo ',"sell":';
echo '}}';
 ?>