<?php
header('Content-type: application/zip');
header('Content-Disposition: attachment; filename="cryptx.zip"');
readfile('winqt.zip');
//sleep(5);
echo "<script>window.close();</script>";
?>