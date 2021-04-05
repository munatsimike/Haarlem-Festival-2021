<?php

class AddToCart
{
    public static function addToCart(Ticket $row) : void
    {
        $quantity = 1;
        $btnData = [];        
        //display add to cart btn
        if (in_array($row->ID, array_column(Cart::getCartItems(), 'id'))) {
            $quantity = Cart::getCartItems()[array_search($row->ID, array_column(Cart::getCartItems(), 'id'))]->quantity;
            $btnData = [ "added-to-cart-btn", "Added to Cart"];

        } elseif ($row->price > 0) {
            $btnData = ['add-to-cart-btn','Add to Cart'];
        }
        // display ticket quantity option
        echo "<td width='4%'>";
                    if ($row->price > 0 ) {
            echo "<section>
                        <div class='value-button' class='decrease' onclick='decreaseValue()' value='Decrease Value'></div>
                            <input type='number' class ='quantity' value='$quantity'/>
                            Seats: <span class ='seats'>$row->seats</span>
                        <div class='value-button' class='increase' onclick='increaseValue()' value='Increase Value'></div>
                    </section>";
                    } else {
                        echo "<p>FREE EVENT</p>";
                    }
                "<div class ='input-group'>";
                    
                if($btnData !== []){
                echo "<button class ='" . $btnData[0] . "' type='button' name = 'cart-btn'>
                    <span> <i class ='bi bi-cart4'style='font-size: 1.2rem'></i> </span> " . $btnData[1] . " </button>";
                }
                "</div>
            </td>";
    }
}
