<?php

class AddToCart
{
    public static function addToCart(Ticket $row) : void
    {
        $quantity = 1;
        $btnData = []; 
        $btnState = $qtyState = '';       
        //display add to cart btn
        if (in_array($row->ID, array_column(Cart::getCartItems(), 'id'))) {
            $quantity = Cart::getCartItems()[array_search($row->ID, array_column(Cart::getCartItems(), 'id'))]->quantity;
            $btnData = [ "class"=>"added-to-cart-btn", "title"=>"Added to Cart", "state"=>"Disabled"];

        } elseif ($row->price > 0) {
            $btnData = ["class"=>"add-to-cart-btn","title"=>"Add to Cart","state"=>""];
        }
        // display ticket quantity option
        echo "<td width='4%'>";
                    if ($row->price > 0 ) {
            echo "<section>
                        <div class='value-button' class='decrease' onclick='decreaseValue()' value='Decrease Value'></div>
                            <input type='number' min='1' max='$row->seats' class ='quantity' value='$quantity' ".$btnData['state']."/>
                            Seats: <span class ='seats'>$row->seats</span>
                        <div class='value-button' class='increase' onclick='increaseValue()' value='Increase Value'></div>
                    </section>";
                    } else {
                        echo "<p>FREE EVENT</p>";
                    }
                "<div class ='input-group'>";
                    
                //display add to cart btn
                if($btnData !== []){
                    echo "<button class ='" . $btnData['class'] . "' type='button' name = 'cart-btn' ".$btnData['state'].">
                        <span> <i class ='bi bi-cart4'style='font-size: 1.2rem'></i> </span> " . $btnData['title'] . " </button>";
                    }
            "</div>
            </td>";
    }
}
