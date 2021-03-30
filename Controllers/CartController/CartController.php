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
            $id = intval($var['id']);
            $subTotal = 0;
        
            $cart->addToCart(new CartItem($id, $var['title'], $quantity, $price)); 
         
        } elseif ($_REQUEST['action'] === 'deleteCartItem') { 
            $id = intval($var['id']);
            $cart->deleteCartItem($id); 
         
        } elseif ($_REQUEST['action'] === 'updateItemQuantity') { 
            $cart = []
            foreach($this->cart as $item){
                if($item->id == intval($var['cartId']){
                    $cart[] = new CartItem($item->id, $item->description, intval($var['quantity'], $item->price);
                }
                else{
                    $cart[] = new CartItem($item->id, $item->description, $item->quantity, $item->price);
                }
            }
            $this->cart = $cart;
    }
} 
}

/*
 * returnJsonHttpResponse
 * @param $success: Boolean
 * @param $data: Object or Array
 */
function returnJsonHttpResponse($success, $data)
{
    // remove any string that could create an invalid JSON 
    // such as PHP Notice, Warning, logs...
    ob_clean();

    // this will clean up any previously added headers, to start clean
    header_remove(); 

    // Set the content type to JSON and charset 
    // (charset can be set to something else)
    header("Content-type: application/json; charset=utf-8");

    // Set your HTTP response code, 2xx = SUCCESS, 
    // anything else will be error, refer to HTTP documentation
    if ($success) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }
    
    // encode your PHP Object or Array into a JSON string.
    // stdClass or array
    echo json_encode($data);

    // making sure nothing is added
    exit();
}
 
// Redirect to the specific page 
header("Location: $redirectLoc"); 
exit();