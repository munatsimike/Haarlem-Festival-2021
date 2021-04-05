<?php

class AddToCart
{
    public static function addToCart(Ticket $row) : void
    {
<<<<<<< HEAD
        $quantity = 1;
        $btnData = []; 
        $btnState = $qtyState = '';       
        //display add to cart btn
        if (in_array($row->ID, array_column(Cart::getCartItems(), 'id'))) {
            $quantity = Cart::getCartItems()[array_search($row->ID, array_column(Cart::getCartItems(), 'id'))]->quantity;
            $btnData = [ "added-to-cart-btn", "Added to Cart"];
            $btnState = $qtyState = "Disabled";       

        } elseif ($row->price > 0) {
            $btnData = ['add-to-cart-btn','Add to Cart'];
        }
=======
>>>>>>> 77335cfde01bbd17b23943c18a0ac6ce4a296e0a
        // display ticket quantity option
        echo "<td width='4%'>";
                    if ($row->price > 0 ) {
            echo "<section>
                        <div class='value-button' class='decrease' onclick='decreaseValue()' value='Decrease Value'></div>
<<<<<<< HEAD
                            <input type='number' min='1' max='$row->seats' class ='quantity' value='$quantity' $qtyState/>
=======
                            <input type='number' class ='quantity' value='1'/>
>>>>>>> 77335cfde01bbd17b23943c18a0ac6ce4a296e0a
                            Seats: <span class ='seats'>$row->seats</span>
                        <div class='value-button' class='increase' onclick='increaseValue()' value='Increase Value'></div>
                    </section>";
                    } else {
                        echo "<p>FREE EVENT</p>";
                    }
                "<div class ='input-group'>";
                    
<<<<<<< HEAD
                if($btnData !== []){
                echo "<button class ='" . $btnData[0] . "' type='button' name = 'cart-btn' $btnState>
                    <span> <i class ='bi bi-cart4'style='font-size: 1.2rem'></i> </span> " . $btnData[1] . " </button>";
=======
                //display add to cart btn
                if (in_array($row->ID, array_column(Cart::getCartItems(), 'id'))) {
                echo  "<button class ='added-to-cart-btn' type='button' name = 'cart-btn'>
                        <span> <i class ='bi bi-cart4'style='font-size: 1.2rem'></i> </span> Added to Cart</button>";

                } elseif ($row->price > 0) {
                    echo  "<button class ='add-to-cart-btn' type='button' name = 'cart-btn'>
                            <span> <i class ='bi bi-cart4'style='font-size: 1.2rem'></i> </span> Add to Cart</button>";
>>>>>>> 77335cfde01bbd17b23943c18a0ac6ce4a296e0a
                }
            "</div>
            </td>";
    }
}
