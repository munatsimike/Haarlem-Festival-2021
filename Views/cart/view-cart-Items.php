<div class="modal fade" id="cart-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Your Shopping Cart</h5>
      </div>
      <div class="modal-body">
        <table class="table table-image">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Title</th>
              <th scope="col">Qty</th>
              <th scope="col">Price</th>
              <th scope="col">Total</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php
            if (Cart::getCartItems() !== []) {                    
                foreach (Cart::getCartItems() as $key=>$item) {
            echo  "<tr>
                        <input type ='hidden' class ='id'  value = '$item->id'>
                        <input type ='hidden' class ='cartId'  value = '$key'>
                        <td class='rowid'>". ($key+1) ."</td>
                        <td>$item->description</td>
                        <td>
                          <div class='value-button' id='decrease' onclick='decreaseValue()' value='Decrease Value'></div>
                              <input type='number' min=1 class ='cartQuantity' name ='cartQuantity' value=$item->quantity />
                          <div class='value-button' id='increase' onclick='increaseValue()' value='Increase Value'></div>
                        </td>
                        <td class = 'unitPrice'>€ $item->unitPrice</td>
                        <td id='subTotal$key'>€ " . $item->getSubTotal() . "</td>
                        <td>
                            <a href='#' class='trash btn btn-danger btn-sm' name ='trash'>
                            <i class='bi bi-trash-fill' style='font-size: 1.2rem; color: white;'></i>
                            </a>
                        </td>
                  </tr>";
                    }
            } else { 
                    echo "<tr><td colspan='5'><p><span><i class='bi bi-info-circle-fill icons'></i></span> Your cart is empty, add items .....</p></td>";
                }
            ?>
          </tbody>
        </table> 
        <div class="row">
            <div class='col-9'></div>
            <div class='col-3'>
              <h5>Total:<span id="price"><?php echo " ".'€'. Cart::getCartTotal()?></span></h5>
            </div>
        </div>
      </div>
      <div class="modal-footer border-top-0 d-flex justify-content-right">
        <?php
          if (Cart::getCartItems() !== []) {
           echo '<button onclick="location.href=\'/Views/paymentViews/checkout-form.php\'" type="button" class="btn btn-primary">Checkout</button>';

          }
        ?>
      </div>
    </div>
  </div>
</div>