<?php
	 session_start();
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administratíva</title>
	<link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="login_version_2.css" />
  </head>
	<body>
	
		<?php
			$mysqli=new mysqli( "localhost",
								"sindler.s",
								"kosper1",
								"sindler.s");
			mysqli_set_charset($mysqli,"utf8");
			
			$users = $mysqli->query("SELECT * FROM users");
			
			if(isset($_POST["Login"])){
				while($row = $users -> fetch_assoc()){
					if($_POST['meno']==$row['meno'] and password_verify($_POST['heslo'],$row['heslo'])){
						$_SESSION['logged']=1;
						echo "<meta http-equiv='refresh' content='0'>";
					}
				}
			}	
			
			
			if($_SESSION['logged']==1){
				if(isset($_POST["Insert"])){
					INCLUDE "stranka_insert.php";
				}
				if(isset($_POST["Delete"])){
					INCLUDE "stranka_delete.php";
				}
			}
			else{
		?>
				<div class="div_main">
					<div class="image_1"></div>
					<br><br>
					zle prihlasovacie udaje alebo nie ste prihlaseni
					<form action="stranka_login.php" method="post">
						<input class="login_button" type="submit" value="Prihlásiť sa">
					</form>
				<?php
			}
				?>
		<?php
			if(!isset($_POST["Insert"]) AND !isset($_POST["Delete"])){
				if($_SESSION['logged']==1){
		?>
		<div class="div_main">
			<div class="image_1"></div>
			<br>
				<form action="stranka_admin.php" method="post">
					<div class="centered_user_input">   
						<br>
						<input class="login_button" type="submit" value="Pridať event" name="Insert">	
						<br><br>
						<input class="login_button" type="submit" value="Vymazať event" name="Delete">	
					</div>
					<br>
				</form>
				<form action="stranka_login.php" method="post">
					<div class="centered_user_input">   
						<br><br>
						<input class="login_button" type="submit" value="Odhlásiť sa" name="Logout">	
					</div>
				</form>
		</div>	
		
		<?php
				}
			}
		?>
	</body>
</html>