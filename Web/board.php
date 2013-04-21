<?php require "objects.php";?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
		<title>Sassy Chess Board</title>
		<link rel = "stylesheet" type="text/css" href="style.css" media="screen"/>
	</head>
	<body>
	
	<form action="" method="post" onsubmit="submit_button.disabled=true;return true;">
		From
		<input type="text" name="a"/>
		<input type="text" name="b"/>
		To
		<input type="text" name="c"/>
		<input type="text" name="d"/>
		<input name="submit_button" type="submit" value="Submit!"/>
	</form>
	
	<?php
		$id = (isset($_GET["id"]) ? $_GET["id"] : 0);
		$dsn = 'mysql:host=mysql.sassychessboard.com;dbname=sassychessboard';
		$user = 'sassyfolks';
		$password = 'Herd0fCarib0u';
		$con = new PDO($dsn , $user , $password);
		$result = $con->query("SELECT * FROM boards WHERE id = $id");
		foreach($result as $row)
		{    		
			$board = unserialize($row["board"]);
		}
		if (!isset($board))
		{
			$board = new Board();
			$serial_board = $con->quote(serialize($board));
			$con->query("INSERT INTO boards (id , board) VALUES ($id , $serial_board)");
		}
		
		if (isset($_POST["a"] , $_POST["b"] , $_POST["c"] , $_POST["d"]))
		{
			$a = $_POST["a"];
			$b = $_POST["b"];
			$c = $_POST["c"];
			$d = $_POST["d"];
			
			$board->move_piece($a , $b , $c , $d);
			$serial_board = $con->quote(serialize($board));
			$con->query("UPDATE boards SET board = $serial_board WHERE id = $id");
		}
        $con = null; #Disconnect
        
        					
		echo "<table>";
		for ($j=8; $j>=1; $j--)
		{
			echo "<tr>";
			for ($i='a'; $i<='h'; $i++)
			{
				echo "<td>";
				$square = $board->squares[$i][$j];
				if (isset($square))
				{
					echo ($square->colour==1 ? "White " : "Black ");
					echo get_class($square);
				}
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";	
	?>
	</body>
</html>