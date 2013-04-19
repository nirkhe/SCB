<?php
	class Board
	{
		public $squares;
		function build($i , $colour)
		{
			if ($i === 'a' or $i === 'h')
				return new Rook($colour);
			if ($i === 'b' or $i === 'g')
				return new Knight($colour);
			if ($i === 'c' or $i === 'f')
				return new Bishop($colour);
			if ($i === 'd')
				return new Queen($colour);
			if ($i === 'e')
				return new King($colour);
			return null;
		}
		
		function __construct()
		{
			for ($i = 'a'; $i<= 'h'; $i++)
			{
				$this->squares[$i][1] = $this->build($i , 1);
				$this->squares[$i][2] = new Pawn(1);
				for ($j = 3; $j<= 6; $j++)
					$this->squares[$i][$j] = null;
				$this->squares[$i][7] = new Pawn(0);
				$this->squares[$i][8] = $this->build($i , 0);
			}
		}
		
		public function get_board()
		{
			return $this->squares;
		}
		
		function move_piece($file0 , $rank0 , $file , $rank)
		{
			$this->squares[$file][$rank] = $this->squares[$file0][$rank0];
			$this->squares[$file0][$rank0] = null;
		}
		
	}
	
	class Piece
	{
		public $colour;
		function __construct($colour) #1 means white, 0 means black
		{
			$this->colour = $colour;
		}
	}
	class Pawn extends Piece {}
	class Rook extends Piece {}
	class Knight extends Piece {}
	class Bishop extends Piece {}
	class Queen extends Piece {}
	class King extends Piece {}
?>