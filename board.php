<?php
	class board
	{
		function build($i , $colour)
		{
			if ($i === 'a' or $i === 'h')
				return new rook($colour);
			if ($i === 'b' or $i === 'g')
				return new knight($colour);
			if ($i === 'c' or $i === 'f')
				return new bishop($colour);
			if ($i === 'd')
				return new queen($colour);
			if ($i === 'e')
				return new king($colour);
			return null;
		}
		
		function __construct()
		{
			for ($i = 'a'; $i<= 'h'; $i++)
			{
				$squares[$i][1] = $this->build($i , 1);
				$squares[$i][2] = new pawn(1);
				for ($j = 3; $j<= 6; $j++)
					$squares[$i][$j] = null;
				$squares[$i][7] = new pawn(0);
				$squares[$i][8] = $this->build($i , 0);
			}
		}
	}
	
	class piece
	{
		public $colour;
		function __construct($colour) #1 means white, 0 means black
		{
			$this->colour = $colour;
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