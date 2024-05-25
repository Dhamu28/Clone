
<?php
// Show only errors, ignore notices and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors', 1);

try{
    // Establish SQLite3 connection
    $db = new db($database);
}
    catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

    

// Clean data for SQLite3
// array_walk($_REQUEST, function(&$string) use ($db) { 
//     $string = $db->escapeString($string);
// });

extract($_REQUEST);
?>
