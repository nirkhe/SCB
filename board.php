<?php
	class board
	{
		function build($i , $colour, $row)
		{
			$position = new Array("row" => $i, "column" => $row);
			if ($i === 'a' or $i === 'h')
				return new rook($colour, $position);
			if ($i === 'b' or $i === 'g')
				return new knight($colour, $position);
			if ($i === 'c' or $i === 'f')
				return new bishop($colour, $position);
			if ($i === 'd')
				return new queen($colour, $position);
			if ($i === 'e')
				return new king($colour, $position);
			return null;
		}
		
		function __construct()
		{
			for ($i = 'a'; $i<= 'h'; $i++)
			{
				$squares[$i][1] = $this->build($i , 1, 1);
				$squares[$i][2] = new pawn(1, new Array("row" => $i, "column" =>  2));
				for ($j = 3; $j<= 6; $j++)
					$squares[$i][$j] = null;
				$squares[$i][7] = new pawn(0, new Array("row" => $i, "column" =>  7));
				$squares[$i][8] = $this->build($i , 0, 8);
			}
		}
		
		//Location is denoted by array of $row $column
		function get_piece($location)
		{
			return $squares[$location["row"]][$location["column"]];
		}
		
		function PGNNotate_move($initial_loc, $final_loc)
		{
			
		
		}
	}
	
	class piece
	{
		public $colour;
		public $position; //IDK if you want this Alec, I think it would be useful
		function __construct($colour, $position) #1 means white, 0 means black
		{
			$this->$colour = $colour;
			$this->$position = $position;
		}
	}
	class pawn extends piece {}
	class rook extends piece {}
	class knight extends piece {}
	class bishop extends piece {}
	class queen extends piece {}
	class king extends piece {}
	
	$board = new board();
?>