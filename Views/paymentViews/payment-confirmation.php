<?php 
require_once '../myAutoLoader.php';
if ( ! isset($_SESSION)) session_start();

 $orderId = $_GET['orderId'];
// check if redirect is from checkout form
if (! isset($orderId) || ! is_numeric($orderId)) {
 header('Location:../../index.php');
}
  $modalTitle = $modalMessage = $redirectUrl = $email = null;
  $orderController = new OrderController();
  $orderStatus = $orderController->fetchOrderStatus($orderId);

if ($orderStatus == PaymentStatus::PAID()) {
  $modalTitle = "Payment Success";
  $modalMessage = "Payment was processed successfuly. A receipt will be sent to : ";
  $redirectUrl = //'/Service/pdfHandler.php?status=paid';
  $email = $_SESSION['customer']->email;
} 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>payment success</title>
    <?php 
      require_once "../partials/head.php";
    ?>
  </head>
  <body>
  <!-- Modal -->
  <div class="modal show" id="payment-confirmation" role="dialog">
  <div class="modal-dialog modal-m modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h4 class="modal-title"><i class="bi bi-check-circle-fill" style = "color:#007DFF; font-size:1.4em;"></i><?php echo $modalTitle ?></h4>
        </div>
        <div class="modal-body text-center">
           <p><?php echo $modalMessage ?><strong><?php echo $email?></strong></p>
           <P>Thank you for your purchase.</p>
        </div>
        <div class="modal-footer">
          <form action="/Service/pdfHandler.php?status=paid">
            <input type="hidden" id="custId" name="custId" value="3487">
            <input type="hidden" id="custId" name="custId" value="3487">  
           <button class="btn btn-primary btn-block" type="submit" data-dismiss="modal">Proceed</button>
          </form>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
  </body>
</html>
<script>
    $(function() {
      $(window).on('load', function() {
        $('#payment-confirmation').modal('show');
        });
    });
</script>
