<?php
	SESSION_START();
?>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="login_version_2.css">
  </head>
	<body>
	
	
	<?php
		$mysqli=new mysqli( "localhost",
			 				"sindler.s",
							"kosper1",
							"sindler.s");
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
  <div>
	  <form action="stranka_login.php" method="post">
		  LOGGED IN! <br>
		
		  <input type="text" name="text1" value="text1">
		  <br>
		  <input type="text" name="text2" value="text2">
		  <br>
		
		  <input type="submit" value="pridať" name="Insert">	
		  <input type="submit" value="odhlásiť" name="Logout">	
	  </form>
  <div>
	<?php
		}
	else{
	?>	
  <div class="div_main">
    <div>
      <img src="logo-spojene.png">
    </div>
    <br>
	  <form action="stranka_login.php" method="post">
      <div class="centered_user_input">
  		  <input class="user_input_name" type="text" name="meno" placeholder="Username" value="meno">
  		  <br>
  		  <input class="user_input_password" type="password" name="heslo" placeholder="Password" value="heslo">
  		  <br>
      </div>
      <div class="centered_login_button">
		    <input class="login_button" type="submit" value="Login" name="Login">	
      </div>
		  <br>
	  </form>
  </div>	
	<?php
		}
	?>	
	
	
	</body>	
</html>