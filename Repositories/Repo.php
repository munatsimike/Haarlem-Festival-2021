<?php	
	 abstract class Repo
	{
		protected PDO $pdo;

		public function __construct()
		{ 
			//gets database connection instance from Connection class
			try{
				$this->pdo = connection::getInstance();
			} catch (Exception $error) {
				throw $error;
			}
		}
		
	}

?>
