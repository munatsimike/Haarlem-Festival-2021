
<?php

class ErrorLog {

  public function __construct (string $error)
  {
    error_log($error, 1, 'hfestival21@gmail.com');
  }
    
}