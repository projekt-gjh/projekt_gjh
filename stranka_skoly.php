<!DOCTYPE html>
<html>
<head>
<title>Súťaže na GJH</title>
</head>
<body>

<h1>Súťaže na GJH</h1>
<p>Školské súťaže a olympiády</p>

<table>

	<tr><td><a href='stranka_skoly.php?type=tmf'>Turnaj Mladých Fyzikov</a></td></tr>
	<tr><td><a href='stranka_skoly.php?type=robot'>Robotika</a></td></tr>
	<tr><td><a href='stranka_skoly.php?type=debat'>Debatérsky klub</a></td></tr>
	<tr><td><a href='stranka_skoly.php?type=sjl'>Slovenský jazyk a literatúra</a></td></tr>
	<tr><td><a href='stranka_skoly.php?type=aj'>Anglický jazyk</a></td></tr>
	<tr><td><a href='stranka_skoly.php?type=nj'>Nemecký jazyk</a></td></tr>
	<tr><td><a href='stranka_skoly.php?type=mat'>Matematika</a></td></tr>
	<tr><td><a href='stranka_skoly.php?type=fyz'>Fyzika</a></td></tr>

</table>	

<?php
	$mysqli=new mysqli( "localhost",
			 			"sindler.s",
						"kosper1",
						"sindler.s");
	mysqli_set_charset($mysqli,"utf8");

	if(isset($_GET['type'])){
		if($_GET['type']=='nj'){
			$result = $mysqli->query("SELECT * FROM gjh_sutaze WHERE event_type='nj'");
			if(isset($_GET['id'])){
				$row = $result->fetch_assoc();
				$result = $mysqli->query("SELECT * FROM gjh_sutaze WHERE ID=$row[ID]");
				
			}	
			else{
				while($row=$result->fetch_assoc()){
					echo "<br><a href='stranka_skoly.php?type=nj&id=$row[ID]'>$row[competition_name]</a><br>";	
				}	
			} 
		}
	}
			
	$mysqli->close();	
?>
	
</body>
</html> 