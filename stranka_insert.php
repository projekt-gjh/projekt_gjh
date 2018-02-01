<html>

<head>
	<title>Pridať súťaž</title>
<link rel="shortcut icon" href="favicon.ico" />

	<body>

		<?php
			$mysqli=new mysqli( "localhost",
								"sindler.s",
								"kosper1",
								"sindler.s");
			mysqli_set_charset($mysqli,"utf8");

			if(isset($_POST["Submit"])) {
				$name=$_POST['name'];
				$year=$_POST['year'];
				$month=$_POST['month'];
				$day=$_POST['day'];
				$type=$_POST['typ'];
				$minor_info=$_POST['minor_info'];
				$major_info=$_POST['major_info'];
				
				$insert=0;
				
				if((0 < $day) AND ($day < 31) AND (0 < $month) AND ($month < 7)){
					$schoolyear= "". ($year -1) ."/". $year ."";
					$insert++;
				}
				else if((0 < $day) AND ($day < 31) AND (8 < $month) AND ($month < 13)){
					$schoolyear= "". $year ."/". ($year +1) ."";
					$insert++;
				}
				
				if($insert <> 0){
					$mysqli->query("INSERT INTO gjh_sutaze VALUES(NULL,'$name','$year','$month','$day','$schoolyear','$type','$minor_info','$major_info')");
				}
				else{
					echo "neplatný dátum";
				}
			}
			
			$mysqli->close();		

		?>

	<form action="stranka_insert.php" method="post">

		názov:
		  <input type="text" name="name" >
		  <br><br>
		rok:
		  <input type="text" name="year" >
		  <br><br>  
		mesiac:
		  <input type="text" name="month" >
		  <br><br>  
		deň:
		  <input type="text" name="day" >
		  <br><br>    
		typ:
		<select name="typ">
			<option value="tmf">tmf</option>
			<option value="robot">robot</option>
			<option value="debat">debat</option>
			<option value="sjl">sjl</option>
			<option value="aj">aj</option>
			<option value="nj">nj</option>
			<option value="mat">mat</option>
			<option value="fyz">fyz</option>
			<option value="ostatne">ostatne</option>
		</select>  
		<br> <br>

		malé info:
		<br>
		<textarea style="resize:none" name="minor_info" cols="50" rows="13"></textarea>

		<br><br>

		veľké info:
		<br>
		<textarea style="resize:none" name="major_info" cols="50" rows="20"></textarea>
		<br><br>
		<input type="submit" value="Odoslat" name="Submit">
	</form>

	</body>
</html>