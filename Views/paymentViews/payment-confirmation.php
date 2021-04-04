<?php 
require_once '../myAutoLoader.php';
if ( ! isset($_SESSION)) session_start();
// check if redirect is from checkout form
if (! isset($_GET['payment']) || $_GET['payment'] !== 'success') {
 header('Location:../../index.php');
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
          <h4 class="modal-title"><i class="bi bi-check-circle-fill" style = "color:#007DFF; font-size:1.4em;"></i> Payment Success</h4>
        </div>
        <div class="modal-body text-center">
          <?php
           echo "<p>Payment was processed successfuly. A receipt will be sent to<strong> ".$_SESSION['customer']->email."</strong></p>
                 <P>Thank you for your purchase.</p>";
            ?>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary btn-block" onclick="location.href='/Views/paymentViews/pdfReceipt.php?payment=success'" type="button" data-dismiss="modal">Close</button>

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
