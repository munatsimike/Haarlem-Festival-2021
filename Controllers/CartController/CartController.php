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
        
            $cart->addToCart(new CartItem($id, $var['title'], $quantity, $price, $seats)); 
            die(json_encode(['action'=> 'addToCart']));
         
        } elseif ($_REQUEST['action'] === 'deleteCartItem') { 
            $id = intval($var['id']);
            $cart->deleteCartItem($id); 
            die(json_encode(['action'=> 'delete', 'total'=>Cart::getCartTotal()]));
         
        } elseif ($_REQUEST['action'] === 'updateItemQuantity') { 
            $cart = [];
            foreach($this->cart as $item){
                if($item->id == intval($var['cartId'])){
                    $cart[] = new CartItem($item->id, $item->description, intval($var['quantity']), $item->price);
                }
                else{
                    $cart[] = new CartItem($item->id, $item->description, $item->quantity, $item->price);
                }
            }
            $this->cart = $cart;
       }
} 
}

