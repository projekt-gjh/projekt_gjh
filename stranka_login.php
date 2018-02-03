<?php
	if(isset($_POST["Logout"])){
		session_unset();
		echo "<meta http-equiv='refresh' content='0'>";
	}
	 session_start();
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
	
		$_SESSION['logged']=0;
		
	     ?>	

	
	<?php
		if($_SESSION['logged']==0){
	?>
	  <div class="div_main">
		<div class="image_1"></div>
		<br>
		  <form action="stranka_admin.php" method="post">
		  <div class="centered_user_input">   
			  <input class="user_input_name" type="text" name="meno" placeholder="Username">
			  <br>
			  <input class="user_input_password" type="password" name="heslo" placeholder="Password">
			  <br>
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