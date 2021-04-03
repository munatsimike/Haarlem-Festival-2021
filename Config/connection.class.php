<?php
declare(strict_types=1);

class Connection extends PDO
{
  private static $instance = null;
 
  private const SERVER   =  "mysql:host=localhost;dbname=hfitteam4_db";
  private const USERNAME =  "root";
  private const PASSWORD =  "";

  private function __construct()
  {
        parent::__construct(self::SERVER, self::USERNAME, self::PASSWORD);
        parent::setAttribute(PDO::ERRMODE_EXCEPTION, PDO::FETCH_ASSOC);
  }
 
    public static function getInstance()
    {
      if (self::$instance == null)
      {
        self::$instance = new Connection();
      }
  
      return self::$instance;
    }
  
}

?>
