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
		
		// update number of seats after every successfuly transaction
		public function updateNumberOfSeats(int $ticketId , int $quantity) : void
		{
				$this->pdo->prepare("UPDATE event SET seats = (seats - :quantity) WHERE id = :id")
				      	  ->execute(['id'=>$ticketId, 'quantity'=>$quantity]);
		}
	}

?>
