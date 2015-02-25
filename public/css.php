<?php

$files = array(
    
     "css/xenon-core.css",
  "css/xenon-forms.css",
  "css/xenon-components.css",
  "css/xenon-skins.css",
  "css/charts/style.css",
  "css/bootstrap.css",
  "js/datatables/dataTables.bootstrap.css"

);
    
$modified = 0;

foreach($files as $file) {        
    $age = filemtime($file);
    if($age > $modified) {
        $modified = $age;
    }
}

$offset = 60 * 60 * 24 * 7; // Cache for 1 weeks
header ('Expires: ' . gmdate ("D, d M Y H:i:s", time() + $offset) . ' GMT');

if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $modified) {
    header("HTTP/1.0 304 Not Modified");
    header ('Cache-Control:');
} else {
    header ('Cache-Control: max-age=' . $offset);
    header ('Content-type: text/css; charset=UTF-8');
    header ('Pragma:');
    header ("Last-Modified: ".gmdate("D, d M Y H:i:s", $modified )." GMT");
    
    function compress($buffer) {
        /* remove comments */
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        /* remove tabs, spaces, newlines, etc. */
        $buffer = str_replace(array("\r\n","\r","\n","\t",'  ','    ','     '), '', $buffer);
        /* remove other spaces before/after ; */
        $buffer = preg_replace(array('(( )+{)','({( )+)'), '{', $buffer);
        $buffer = preg_replace(array('(( )+})','(}( )+)','(;( )*})'), '}', $buffer);
        $buffer = preg_replace(array('(;( )+)','(( )+;)'), ';', $buffer);
        return $buffer;
    }
    
    ob_start('ob_gzhandler');

        foreach($files as $file) {
            if(strpos(basename($file),'.min.')===false) { //compress files that aren't minified
                ob_start("compress");
                    include($file);
                ob_end_flush();
            } else {
                include($file);
            }
        }
    
    ob_end_flush();
}

?>