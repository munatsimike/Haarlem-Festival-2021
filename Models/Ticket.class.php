<?php

	abstract class Ticket
	{
		public int $ID = 0;
		public float $price = 0;
		public string $date;
		public string $start = "";
		public string $end = "";
		public Venue $venue;
		public int $seats;

		public function __construct()
    	{
			$arguments = func_get_args();
			$numberOfArguments = func_num_args();

			if (method_exists($this, $fun='__construct'.$numberOfArguments)) {
				call_user_func_array(array($this, $fun), $arguments);
			}
    	}

		public function __construct3(int $ID, float $price , string $seats)
		{
			$this->ID = $ID;
			$this->price = $price;
			$this->seats = $seats;

		}

		public function __construct7(int $ID, float $price , string $date, string $start, string $end, Venue $venue, string $seats) 
		{ 
			$this->__construct3($ID, $price , $seats);

			$this->date = $date;
			$this->start = $start;
			$this->end = $end;
			$this->venue = $venue;
		} 

		abstract public function getTitle();
	}
?>
