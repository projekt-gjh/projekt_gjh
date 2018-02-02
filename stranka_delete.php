<html>
	<head>
	<title>Administratíva</title>
	<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
		
		<?php
			$mysqli=new mysqli( "localhost",
								"sindler.s",
								"kosper1",
								"sindler.s");
			mysqli_set_charset($mysqli,"utf8");
			
			$result = $mysqli->query("SELECT * FROM gjh_sutaze");
			
			function displayForm() {
				global $result, $mysqli;
				echo "<form action='stranka_delete.php' name='delete' method='post'>"; 
					while($row = $result->fetch_assoc()){
						echo "<input type='checkbox' name='mycheckbox[]' value='$row[ID]'> $row[competition_name] <br>"; 
						}
				echo "<br><input type='submit' value='Vymazat' name='Submit'>";		
				echo "</form>"; 			
			}		
			
			
			if(isset($_POST['Submit'])){
				if(empty($_POST['mycheckbox'])) { 
					return false; 
				}
				else{	
					$checked = $_POST['mycheckbox']; 
					foreach ($checked as $value) { 
						$mysqli->query("DELETE FROM gjh_sutaze WHERE ID = $value"); 
					}
					echo "označené položky boli vymazané";
					echo "<br>";
					echo "<form action='stranka_delete.php'>";
						echo "<input type='submit' value='späť na stránku' />";
					echo "</form>";
				}	
			}	
			else{
				displayForm();
			}
		?>

</html>		