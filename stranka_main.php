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
	grid-template-columns: 150px auto auto auto auto auto auto auto auto auto;
	background-color: #f6f4f8;
}
.header {
	padding-left: 10px;
	grid-area: 1 / 1 / 1 / 11;
	font-size: 30px;
	color: #ffffff;
	background-color: #027202;
}

.menu {
	grid-area: 2 / 1 / 40 /1;
	background-color: #ffffff;
	font-size: 20px;
}

.article1 {
	grid-area: 3/5/8/10;
	background-color: #ffffff;
}

.article2 {
	grid-area: 10/5/15/10;
}

</style>
</head>
<body>

<div class="grid-container">
	<div class="header"><a href='stranka_main.php'>Súťaže na GJH</a></div>

<div class="menu">
	<a href='stranka_main.php?type=tmf'>Turnaj Mladých Fyzikov</a>
	<a href='stranka_main.php?type=robot'>Robotika</a>
	<a href='stranka_main.php?type=debat'>Debatérsky klub</a>
	<a href='stranka_main.php?type=sjl'>Slovenský jazyk a literatúra</a>
	<a href='stranka_main.php?type=aj'>Anglický jazyk</a>
	<a href='stranka_main.php?type=nj'>Nemecký jazyk</a>
	<a href='stranka_main.php?type=mat'>Matematika</a>
	<a href='stranka_main.php?type=fyz'>Fyzika</a>
</div>

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
		echo "Najnovšie oznámené súťaže <br>";
		$i=0;
		while($row=$result->fetch_assoc()){
			$i++;
			if($i==1){
				echo "<div class='article1'>";
				echo "<br><a href='stranka_main.php?type=$row[event_type]&id=$row[ID]'>$row[competition_name]</a><br>";
				echo "<br>$row[day].$row[month].$row[year]";
				echo "<br>$row[minor_info]<br>";
				echo "</div>";
			}
			else{
				echo "<div class='article2'>";
				echo "<br><a href='stranka_main.php?type=$row[event_type]&id=$row[ID]'>$row[competition_name]</a><br>";
				echo "<br>$row[day].$row[month].$row[year]";
				echo "<br>$row[minor_info]<br>";
				echo "</div>";
			}
			
		}
	}
			
	$mysqli->close();	
?>
	
</div>	
</body>
</html> 
