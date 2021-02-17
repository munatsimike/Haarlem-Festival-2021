<?php
echo "<td width= '2%' class = 'price'>
	€ $row->price
</td>
<td width='4%'>
	<section>
		<div class='value-button' id='decrease' onclick='decreaseValue()' value='Decrease Value'></div>
		<input type='number' class ='quantity' id='number' value='1' size='4' class ='quantity' />
				Seats: $row->seats
		<div class='value-button' id='increase' onclick='increaseValue()' value='Increase Value'></div>
	</section>
	<input id ='add-to-cart-btn' type='submit' value='Add to Cart' name = 'cart-btn'>
</td>";

		