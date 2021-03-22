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


		public function __construct(int $ID, float $price , string $date, string $start, string $end, Venue $venue, string $seats) 
		{ 
			$this->ID = $ID;
			$this->price = $price;
			$this->date = $date;
			$this->start = $start;
			$this->end = $end;
			$this->venue = $venue;
			$this->seats = $seats;
		} 

		abstract public function getTitle();
	}
?>
