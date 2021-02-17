<?php
if(isset($_GET['paymentId'])){
  require_once('phpqrcode/qrlib.php');
  Qrcode::png('payment id : '.$_GET['paymentId']);
 }
