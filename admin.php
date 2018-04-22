<?php
	session_start();
	@$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Hearthstone Card Generator</title>
	<link rel="stylesheet" href="fonts/stylesheet.css">
	<link rel="stylesheet" href="adminstyles.css">

</head>
<body>
	<div id="main">
		<h3><a href="index.php">Home</a></h3>
		<h3><a href="deconnexion.php">Logout</a></h3>
		<div id="section">
			<?php

			if( !$logged) afficherLogin();
			else afficherUpload();


			function afficherLogin()
			{
				echo "<h3>Administration panel</h3><form method='post' action='login.php'>
				  <p>Username : </p><input type='text' name='username' size='30'>
				  <p>Password : </p><input type='password' name='userpass' size='30'>
				  <br>
				  <input name='action' type='submit' name='action' value='Login'>
				</form>";
			}

			function afficherUpload()
			{
				echo "<h3>Upload an Artwork</h3>
				<div class='upload'>
				<form method='post' action='upload.php' enctype='multipart/form-data'>
					<p>Browse for your image :</p><br><input type='file' name='avatar'>
					<br><br><input type='submit' name='action' value='Upload'>
				</form>
				</div>";
			}

			?>
		</div>
	</div>
</body>
</html>