<?php 
// Initialize shopping cart class 
require '../../myAutoLoader.php'; 

$cart = new Cart; 
 
// Default redirect page 
$redirectLoc = '../../index.php'; 

// Insert item to cart 

// check if it's an ajax request
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['cartItem'])) { 
        if ($_REQUEST['action'] === 'addToCart') {
        $cartItem = json_decode($_REQUEST['cartItem'], true); 
        $price = floatval($cartItem['price']);
        $quantity = intval($cartItem['quantity']);
        $id = intval($cartItem['id']);
        $subTotal = 0;
        
        $cart->addToCart(new CartItem($id, $cartItem['description'], $quantity, $price)); 
         
    } elseif ($_REQUEST['action'] == 'deleteCartItem') { 
        
        $id = strval($_REQUEST['id']);
        $cart->deleteCartItem($id); 
         
    } elseif ($_REQUEST['action'] == 'updatItemQuantity') { 

        $cartItem = json_decode($_REQUEST['cartItem'], true); 
        // Remove item from cart 
        $cart->updatItemQuantity($_REQUEST['cartItem']); 
        // Redirect to cart page 
        $redirectLoc = 'viewCart.php'; 
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