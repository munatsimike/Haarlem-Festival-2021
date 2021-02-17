<?php

class AddToCart
{
    public static function addToCart(JazzTicket $row) : void
    {
        // display ticket quantity option
    echo "<td width='4%'>";
                if ($row->price > 0 ) {
           echo "<section>
                    <div class='value-button' class='decrease' onclick='decreaseValue()' value='Decrease Value'></div>
                        <input type='number' class ='quantity' value='1'/>
                        Seats: <span class ='seats'>$row->seats</span>
                    <div class='value-button' class='increase' onclick='increaseValue()' value='Increase Value'></div>
                </section>";
                } else {
                    echo "<p>FREE EVENT</p>";
                }
            "<div class ='input-group'>";
                
            //display add to cart btn
            if (in_array($row->id, array_column(Cart::cartItems(), 'id'))) {
            echo  "<button class ='added-to-cart-btn' type='button' name = 'cart-btn'>
                    <span> <i class ='bi bi-cart4'style='font-size: 1.2rem'></i> </span> Added to Cart</button>";

            } elseif ($row->price > 0) {
                echo  "<button class ='add-to-cart-btn' type='button' name = 'cart-btn'>
                        <span> <i class ='bi bi-cart4'style='font-size: 1.2rem'></i> </span> Add to Cart</button>";
            }
        "</div>
        </td>";
    }
}
