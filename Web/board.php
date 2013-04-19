<?php require "objects.php";?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
		<title>Sassy Chess Board</title>
		<link rel = "stylesheet" type="text/css" href="style.css" media="screen"/>
	</head>
	<body>
	<?php
		$swag = new Board();
		if ($_GET["id"] == 5)
			$swag->move_piece('e' , 2 , 'e' , 4);
			
		
			
		
		
		
		
		echo "<table>";
		for ($j=8; $j>=1; $j--)
		{
			echo "<tr>";
			for ($i='a'; $i<='h'; $i++)
			{
				echo "<td>";
				$square = $swag->squares[$i][$j];
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