<?php
declare(strict_types=1);

class Connection
{
  private PDO $conn;
 
  private const SERVER   =  "mysql:host=localhost;dbname=hfitteam4_db";
  private const USERNAME =  "root";
  private const PASSWORD =  "";
  private const OPTIONS  =  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS];

  public static function DBConnection() : PDO
  {
    try {
          return $conn ?? $conn = new PDO(self::SERVER, self::USERNAME, self::PASSWORD, self::OPTIONS);

      } catch (PDOException $e) {

         throw ConnectionFailureException::database();
    }
  }
}

?>
