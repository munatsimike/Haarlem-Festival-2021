<?php

	abstract class Ticket
	{
		public int $ID = 0;
		public float $price = 0;
		public string $date;
		public string $start = "";
		public string $end = "";
		public string $artist;
		public string $venue;
	}
?>
