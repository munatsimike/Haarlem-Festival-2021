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
        $_SESSION['cartTotal'] = 0;
    } 
     
    public static function cartTotal() : float
    { 
        return $_SESSION['cartTotal'] ?? 0; 
    }

    public static function cartItems() : array
    {  
        return $_SESSION['cartItems']; 
    }
  
    public function addToCart(CartItem $item) : void
    { 
        $this->cartItems = self::cartItems();
        if ( ! in_array($item->id, array_column($this->cartItems, 'id'))) {
            $this->cartItems[] = $item;
            $this->updateCart();
        }
    } 

    public function deleteCartItem(int $id) : void
    {
      $arr = self::cartItems();
      foreach($arr as $item){
            if ($item->id === $id) {
                continue;
            }

            $this->cartItems[] = $item;
      }
      $this->updateCart();
    }
    
    public function updateCart() : void
    { 
        foreach ($this->cartItems as $item) { 
            $_SESSION['cartTotal'] += $item->subTotal;
        } 
        $_SESSION['cartItems'] = $this->cartItems; 
    } 

}