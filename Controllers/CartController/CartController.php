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

        if ($_REQUEST['action'] === 'addToCart') {
            $price = floatval($var['price']);
            $quantity = intval($var['quantity']);
            $seats = $var['seats'];
            $id = intval($var['id']);
            $subTotal = 0;
        
            if($price < 0){
                throw new exception("invalid price detected.");
            }
            
            if($quantity < 0){
                throw new exception("invalid quantity input.");
            }
            
            if($seats < $quantity){
                throw new exception("insufficient tickets available.");
            }

            if((int)$quantity > 0){
            $cart->addToCart(new CartItem($id, $var['title'], $quantity, $price, $seats)); 
            }
            die(json_encode(['action'=> 'addToCart']));
         
        } elseif ($_REQUEST['action'] === 'deleteCartItem') { 
            $id = intval($var['id']);
            $cart->deleteCartItem($id); 
            die(json_encode(['action'=> 'deleteCartItem', 'total'=>"€".Cart::getCartTotal()]));
         
        } elseif ($_REQUEST['action'] === 'updateItemQuantity') { 
            $quantity =  intval($var['quantity']);
            if($quantity > 0){
                $cart->updateQuantity(intval($var['cartId']), $quantity);
            }
            die(json_encode(['action'=> 'updateItemQuantity', 'total'=>"€".Cart::getCartTotal()]));

       }

} 
}

