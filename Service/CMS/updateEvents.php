<?php
// Initialize shopping cart class 
include_once  $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';

$cart = new Cart; 
 
// Default redirect page 
$redirectLoc = '../../index.php'; 

// Insert item to cart 

// check if it's an ajax request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { 
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['var'])) { 
        $var = json_decode($_REQUEST['var'], true); 
        $id = intval($var['id']);
        if ($_REQUEST['action'] === 'save') {
            $price = floatval($var['price']);
            $seats = $var['seats'];
            $date = $var['date'];
            $start= $var['start'];
            $end = $var['end'];
           
            die(json_encode('Success! event updated'));
        }
        
        if ($_REQUEST['action'] === 'delete') {
          //delete tickted with this id;
          die(json_encode('Success event deleted'));
        }
         
} 
}


