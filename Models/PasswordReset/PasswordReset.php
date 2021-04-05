<?php 

class PasswordReset {

  public string $email;
  public string $token; 
  public string $selector;
  public string  $tokenExpiryDate;

    public function __construct(string $email, string $token, string $selector, string $tokenExpiryDate) {
        $this->email = $email;
        $this->token = $token;
        $this->selector = $selector;
        $this->tokenExpiryDate = $tokenExpiryDate;
    }
}