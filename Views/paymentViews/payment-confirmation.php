<?php 
require_once '../myAutoLoader.php';
if ( ! isset($_SESSION)) session_start();

 $orderId = $_GET['orderId'];
// check if redirect is from checkout form
if (! isset($orderId) || ! is_numeric($orderId)) {
 header('Location:../../index.php');
}
  $orderController = new OrderController();
  $orderStatus = $orderController->fetchOrderStatus($orderId);

  $modalTitle = $email = null;
  $modalMessage = "Payment was not processed. Try again or use a different payment method";
  $redirectUrl = "../../Service/createPayment.php";
  $btnText = 'Proceed';

  switch ($orderStatus) {
    case PaymentStatus::PAID():
      $modalTitle = "Payment Success";
      $modalMessage = "Payment was processed successfuly. An invoice was sent to : ";
      $redirectUrl = "../../Service/pdfHandler.php?id=$orderId";
      $email = $_SESSION['customer']->email;
      $btnText = "Display Invoice";
    break;
    case PaymentStatus::FAILED():
      $modalTitle = "Payment Failed";
      break;
    case PaymentStatus::EXPIRED():
      $modalTitle = "Payment expired";
      break;
    case PaymentStatus::CANCELED():
      $modalTitle = "Payment Canceled";
      $modalMessage = "Payment was Canceled successfuly";
      $redirectUrl = "../../index.php";
      break;
} 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Payment</title>
    <?php  require_once "../partials/head.php";
         if ($orderStatus == PaymentStatus::OPEN() || $orderStatus == PaymentStatus::PENDING()) {
          echo "<meta http-equiv='refresh' content='5'>";
        }
    ?>
    <link rel="stylesheet" href="../../Service/Spinner/loading.css" />
    <script src="/path/to/../../Service/Spinner/loading.js"></script>
  </head>
  <body>
  <div hidden id="order_status"><?php echo (string)$orderStatus ?></div>
  <!-- Modal -->
  <div class="modal show" id="payment-confirmation" role="dialog">
  <div class="modal-dialog modal-m modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h4 class="modal-title"></i><?php echo $modalTitle ?></h4>
        </div>
        <div class="modal-body text-center">
           <p><?php echo $modalMessage ?><strong><?php echo $email?></strong></p>
           <P>Thank you for your purchase.</p>
        </div>
        <div class="modal-footer" method="post">
         <?php echo "<a class='btn btn-primary btn-block' href = $redirectUrl>$btnText</a>"?>
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
        if ($('#order_status').text() == "open" || $('#order_status').text() == "pending") {
          $.loading.start('Processing payment...');
        } else {
          $('#payment-confirmation').modal('show');
        }
        });
    });
</script>
