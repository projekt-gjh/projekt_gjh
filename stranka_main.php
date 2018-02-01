<!DOCTYPE html>
<html>
<head>
<title>Súťaže na GJH</title>
<link rel="shortcut icon" href="favicon.ico" />
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
	grid-auto-rows: 1cm;
	grid-template-columns: 10% 10% 10% 10% 10% 10% 10% 10% 10% 10%;
	padding: 40px;
	display: grid;
	background-color: #f6f4f8;
	
}
.header {
	padding-left: 10px;
	grid-area: 1 / 1 / 1 / 11;
	font-size: 30px;
	color: #ffffff;
	background-color: #027202;
	border: 2px solid inherit;
	border-radius: 8px 8px 0 0;
}

.menu {
	padding-left: 10px;
	grid-area: 2 / 1 / 10 /3;
	background-color: #ffffff;
	font-size: 18px;
}

.menu a { 
	color:inherit;
	display:block;
	padding: 5px 2px;
}

.article1 {
	margin: 40px 60px;
	grid-area: 3/4/8/11;
	background-color: #ffffff;
}

.article2 {
	margin: 40px 60px;
	grid-area: 8/4/13/11;
	background-color: #ffffff;
}

.event_list {
	grid-area: 3 / 4 / 10 /7;
	font-size: 15px;
}

.event_list a {
	padding:0;
	color:inherit;
}

.event_name{
	grid-area: 2 / 4 / 3 /7;
}

.event_date{
	grid-area: 3 / 4 / 4 /7;
}

.event_info{
	grid-area: 4 / 4 / 10 /9;
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
	<a href='stranka_main.php?type=ostatne'>Ostatné</a>
</div>

<?php
	$mysqli=new mysqli( "localhost",
			 			"sindler.s",
						"kosper1",
						"sindler.s");
	mysqli_set_charset($mysqli,"utf8");
	if(isset($_GET['type'])){
		if(isset($_GET['id'])){
			$result = $mysqli->query("SELECT * FROM gjh_sutaze WHERE ID=".$_GET['id']."");	
			while($row=$result->fetch_assoc()){
				echo "<div class='event_name'>";
				echo "$row[competition_name]";
				echo "</div>";
				echo "<div class='event_date'>";
				echo "$row[day].$row[month].$row[year]";
				echo "</div>";
				echo "<div class='event_info'>";
				echo "$row[major_info]";
				echo "</div>";
			}
		}	
		else{
			echo "<div class='event_list'>";
			$count = $mysqli->query("SELECT COUNT(*) FROM gjh_sutaze WHERE event_type='".$_GET['type']."'");
			$row=$count->fetch_assoc();
			if($row['COUNT(*)']==0){
				echo "Nie sú ohlásené žiadne súťaže tohto typu";
			}
			else{
				$result = $mysqli->query("SELECT * FROM gjh_sutaze WHERE event_type='".$_GET['type']."' ORDER BY school_year ASC");
				?>	
				<form action="stranka_main.php?type=<?php echo $_GET['type']; ?>" method="post">
						<?php
						$years = array();
						while($row=$result->fetch_assoc()){
							$add = 0;
							$unit = $row['school_year'];
							for ($i=0; $i < count($years); $i++){
								if($unit == $years[$i]){
									++$add;
								}
							}
							if($add == 0){
								array_push($years, $unit);
							}
						}
						echo "<select name='filter'>";
						for ($i=0; $i < count($years); $i++){
							if(isset($_POST['filtrovat'])){
								if($years[$i] == $_POST['filter']){
									echo "<option value='".$years[$i]."' selected>".$years[$i]."</option>";
								}
								else{
									echo "<option value='".$years[$i]."'>".$years[$i]."</option>";	
								}	
							}
							else{
								echo "<option value='".$years[$i]."'>".$years[$i]."</option>";
							}
						}
						echo "</select>";
						?>
					<input type="submit" value="Filtrovať" name='filtrovat'>
				</form>	
				<?php
					if(isset($_POST['filtrovat'])){
						echo "školský rok ";
						echo $_POST['filter'];
						echo "<br>";
						$result = $mysqli->query("SELECT * FROM gjh_sutaze WHERE event_type='".$_GET['type']."' AND school_year='".$_POST['filter']."'");
					}
					else{
						$result = $mysqli->query("SELECT * FROM gjh_sutaze WHERE event_type='".$_GET['type']."'");
					}
	
					while($row=$result->fetch_assoc()){
						echo "<a href='stranka_main.php?type=".$_GET['type']."&id=$row[ID]'>$row[competition_name]</a><br>";
					}
					echo "</div>";	
				}
		} 
	}
	else{
		$result = $mysqli->query("SELECT * FROM gjh_sutaze ORDER BY ID DESC LIMIT 2");
		echo "<div class='event_list'>";
		echo "Najnovšie oznámené súťaže <br>";
		echo "</div>";
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
