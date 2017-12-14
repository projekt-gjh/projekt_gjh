<?php
	SESSION_START();
?>

<html>
	<body>
	
	
	<?php
		$mysqli=new mysqli( "localhost",
			 				"12danco",
							"7UaN6ZL9dwGz",
							"12danco");
		mysqli_set_charset($mysqli,"utf8");
	
		$users = $mysqli->query("SELECT * FROM users");
		$row = $users->fetch_assoc();
		
		if(isset($_POST["Login"])){
			if($_POST['meno']==$row['meno'] and $_POST['heslo']==$row['heslo']){
				$_SESSION['prihlaseni']=1;
			}
			else{
				?>
				<br> zle prihlasovacie udaje
				<?php
 			}
		}
		
	if(isset($_POST["Logout"])){
		SESSION_UNSET();
	}
	
	if(isset($_POST["Insert"])){
		$text1=$_POST['text1'];
		$text2=$_POST['text2'];
		$mysqli->query("INSERT INTO userst VALUES('$text1','$text2')");
	}
	
		
		if(isset($_SESSION['prihlaseni'])){
	?>
	<form action="stranka_login.php" method="post">
		LOGGED IN! <br>
		
		<input type="text" name="text1" value="text1">
		<br>
		<input type="text" name="text2" value="text2">
		<br>
		
		<input type="submit" value="pridať" name="Insert">	
		<input type="submit" value="odhlásiť" name="Logout">	
	</form>
	<?php
		}
	else{
	?>	
	LOGIN <br>
	<form action="stranka_login.php" method="post">
		meno:
		<input type="text" name="meno" value="meno">
		<br>
		heslo:
		<input type="password" name="heslo" value="heslo">
		<br>
		<input type="submit" value="prihlásiť" name="Login">	
		<br>
	</form>	
	<?php
		}
	?>	
	
	
	</body>	
</html>