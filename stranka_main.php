<!DOCTYPE html>
<html>
<head>
<title>Súťaže na GJH</title>

<style>

a{
	color:inherit;
}

a:link {
    text-decoration: none;
}

a:visited {
    text-decoration: none;
}	

a:hover {
    text-decoration: underline;
}

.grid-container {
	display: grid;
	grid-template-columns: auto auto auto auto auto auto auto;
	background-color: #ffffff;
}

.header {
	grid-area: 1 / 1 / 1 / 8;
	font-size: 30px;
	color: #009900;
}


</style>
</head>
<body>

<div class="grid-container">
	<div class="header"><a href='stranka_main.php'>Súťaže na GJH</a></div>
</div>

<table>

	<tr><td><a href='stranka_main.php?type=tmf'>Turnaj Mladých Fyzikov</a></td></tr>
	<tr><td><a href='stranka_main.php?type=robot'>Robotika</a></td></tr>
	<tr><td><a href='stranka_main.php?type=debat'>Debatérsky klub</a></td></tr>
	<tr><td><a href='stranka_main.php?type=sjl'>Slovenský jazyk a literatúra</a></td></tr>
	<tr><td><a href='stranka_main.php?type=aj'>Anglický jazyk</a></td></tr>
	<tr><td><a href='stranka_main.php?type=nj'>Nemecký jazyk</a></td></tr>
	<tr><td><a href='stranka_main.php?type=mat'>Matematika</a></td></tr>
	<tr><td><a href='stranka_main.php?type=fyz'>Fyzika</a></td></tr>

</table>	

<?php
	$mysqli=new mysqli( "localhost",
			 			"sindler.s",
						"kosper1",
						"sindler.s");
	mysqli_set_charset($mysqli,"utf8");
	if(isset($_GET['type'])){
		$result = $mysqli->query("SELECT * FROM gjh_sutaze WHERE event_type='".$_GET['type']."'");
		if(isset($_GET['id'])){
			$result = $mysqli->query("SELECT * FROM gjh_sutaze WHERE ID=".$_GET['id']."");	
			while($row=$result->fetch_assoc()){
				echo "<br>$row[competition_name]<br>";
				echo "<br>$row[day].$row[month].$row[year]";
				echo "<br>$row[minor_info]";
				echo "<br>$row[major_info]";
			}
		}	
		else{
			while($row=$result->fetch_assoc()){
				echo "<br><a href='stranka_main.php?type=".$_GET['type']."&id=$row[ID]'>$row[competition_name]</a><br>";	
			}	
		} 
	}
	else{
		$result = $mysqli->query("SELECT * FROM gjh_sutaze ORDER BY ID DESC LIMIT 2");
		echo "Najnovšie oznámené súťaže<br>";
		while($row=$result->fetch_assoc()){
			echo "<br><a href='stranka_main.php?type=$row[event_type]&id=$row[ID]'>$row[competition_name]</a><br>";
			echo "<br>$row[day].$row[month].$row[year]";
			echo "<br>$row[minor_info]<br>";
		}
	}
			
	$mysqli->close();	
?>
	
</body>
</html> 
