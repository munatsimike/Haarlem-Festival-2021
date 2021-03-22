<?php

	abstract class Ticket
	{
		public int $ID = 0;
		public float $price = 0;
		public string $date;
		public string $start = "";
		public string $end = "";
		public string $venue;
		public string $address;
		public int $seats;


		public function __construct(string $title, int $id, float $price , string $date, string $start, string $end, string $venue, string $seats) 
		{ 
			$this->title = $title;
			$this->id = $id;
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
