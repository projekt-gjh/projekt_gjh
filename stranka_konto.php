<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Vytvorenie nového účtu</title>
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
			
			$users = $mysqli->query("SELECT * FROM `users`");
			$add=1;
			
			if(isset($_POST['Create'])){
				while($row = $users -> fetch_assoc()){
					if($_POST['meno'] == $row['meno']){
						echo "zadané meno už existuje!";
						$add=0;
					}
				}
				
				
				if($_POST['heslo1'] == $_POST['heslo2']){
					$pw = Password_hash($_POST['heslo1'], PASSWORD_DEFAULT);
					if($add==1 AND isset($_POST['meno'])){
						if($_POST['meno']!=""){
							$mysqli->query("INSERT INTO `users` VALUES(NULL,'".$_POST['meno']."','$pw')");
							echo "konto vytvorené";
						}	
						else{
							echo "zadajte meno";
						}
					}
				}
				else{
					echo "heslá sa nezhodujú!";
				}
			}
			
		?>

		<div class="div_main">
			<div class="image_1"></div>
			<br>
				<form action="stranka_konto.php" method="post">
					<div class="centered_user_input">   
						<input class="user_input_name" type="text" name="meno" placeholder="Username">
						<br>
						<input class="user_input_password" type="password" name="heslo1" placeholder="Password">
						<br>
						<p1>Overenie hesla</p1>
						<input class="user_input_password" type="password" name="heslo2" placeholder="Password">
						<br><br>
						<input class="login_button" type="submit" value="Vytvoriť konto" name="Create">	
					</div>
					<br>
				</form>
		</div>
	