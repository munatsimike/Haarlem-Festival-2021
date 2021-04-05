
<?php
      // Check for tokens
      $selector = $_GET['selector'];
      $token =  $_GET['token'];

      //  check if token  selector is in hexadeciaml format and display form
    if (isset($token) && isset($selector) && ctype_xdigit($selector) && ctype_xdigit( $token)) :
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>password reset</title>
    <?php 
      require_once "../partials/head.php";
    ?>
  </head>
  <body>
<!-- new password form --->
<div class="modal show" id="new-password" role="dialog">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-body">
            <div class="tab-content">

            <div class="row justify-content-center">
                <div class ="row"> <i class="bi bi-person-circle icons"></i></div>
            </div>

            <div class="row justify-content-center">
                 <div class = "row"><h5 class="modal-title">New password form</h5></div>
            </div>
                    <form action = "/Service/CMS/password-reset.php" id = "reset-password" method = "POST">
                        <input type="hidden" name="form-name" value = "new-password">
                        <div class="form-group">
                            <label for="pwd">New password:</label>
                            <input type="password" class="form-control" id="reset-password" placeholder="new password" name="reset-password">
                        </div>

                        <div class="form-group">
                            <label for="pwd">Confirm password:</label>
                            <input type="password" class="form-control" id="confirm-password" placeholder="confirm password" name="confirm-password">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Reset password</button>

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
      $('#new-password').modal('show');
      });
  });
</script>
<?php endif; ?>