<?php 
// Start session 
if( ! session_id()){ 
    session_start(); 
} 
 
class Cart 
{ 
    private $cartItems = []; 
     
    public function __construct()
    {
    } 
     
    public static function getCartTotal() : float
    {
        $total = 0;
        foreach ($_SESSION['cartItems'] as $item) { 
            $total += $item->getSubTotal();
        }  
        return $total;
    }

    public static function getCartItems() : array
    {  
        return $_SESSION['cartItems']; 
    }
  
    public function addToCart(CartItem $item) : void
    { 
        $this->cartItems = self::getCartItems();
        if ( ! in_array($item->id, array_column($this->cartItems, 'id'))) {
            $this->cartItems[] = $item;
            $this->updateCart();
        }
    } 

    public function deleteCartItem(int $id) : void
    {
      $arr = self::getCartItems();
      foreach($arr as $item){
            if ($item->id != $id) {
                $this->cartItems[] = $item;
            }
      }
      $this->updateCart();
    }
    
    public function updateQuantity(int $id, int $qty) : void
    { 
        foreach(self::getCartItems() as $key=>$item){
            if($key === $id){
                $this->cartItems[] = new CartItem($item->id, $item->description, $qty, $item->unitPrice, $item->seats);
            }
            else{
                $this->cartItems[] = new CartItem($item->id, $item->description ." ". $id, $item->quantity, $item->unitPrice, $item->seats);
            }
        }
        $this->updateCart();  
 
    }

    public function updateCart() : void
    { 
        $_SESSION['cartItems'] = $this->cartItems;
    } 

}