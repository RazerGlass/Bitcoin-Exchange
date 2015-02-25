<?php
/* Add your CSS files to this array (THESE ARE ONLY EXAMPLES) */
$cssFiles = array(
  "css/xenon-core.css",
  "css/xenon-forms.css",
  "css/xenon-components.css",
  "css/xenon-skins.css",
  "css/charts/style.css",
  "css/bootstrap.css",
  "js/datatables/dataTables.bootstrap.css"
);
 

/**
 * Ideally, you wouldn't need to change any code beyond this point.
 */
$buffer = "";
foreach ($cssFiles as $cssFile) {
  $buffer .= file_get_contents($cssFile);
}

// Remove comments
$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

// Remove space after colons
$buffer = str_replace(': ', ':', $buffer);

// Remove whitespace
$buffer = str_replace(array("\r\n", "\r", "\n", "\t"), '', $buffer);

// Collapse adjacent spaces into a single space
$buffer = ereg_replace(" {2,}", ' ',$buffer);

// Remove spaces that might still be left where we know they aren't needed
$buffer = str_replace(array('} '), '}', $buffer);
$buffer = str_replace(array('{ '), '{', $buffer);
$buffer = str_replace(array('; '), ';', $buffer);
$buffer = str_replace(array(', '), ',', $buffer);
$buffer = str_replace(array(' }'), '}', $buffer);
$buffer = str_replace(array(' {'), '{', $buffer);
$buffer = str_replace(array(' ;'), ';', $buffer);
$buffer = str_replace(array(' ,'), ',', $buffer);

// Enable GZip encoding.
ob_start("ob_gzhandler");

// Enable caching
header('Cache-Control: public');

// Expire in one day
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');

// Set the correct MIME type, because Apache won't set it for us
header("Content-type: text/css");

// Write everything out
echo($buffer);
?>