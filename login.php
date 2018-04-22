<?php
	session_start();

	// login
	@$action = $_REQUEST['action'];
	@$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	@$username = $_REQUEST['username'];
	@$userpass = $_REQUEST['userpass'];

	if($action == "Login")
	{
		// script de connexion à la DB
		include('connexion.php');

		$query = "SELECT * FROM login WHERE user_name = '$username' AND user_pass = '$userpass'"; 
		$result = $mysqli->query($query) or die($mysqli->error);
		$nombre = $result->num_rows;
		
		$nombre > 0 ? connecter() : erreurLogin();	
		echo var_dump($nombre);
	}
	
	function connecter()
	{	
		$_SESSION["logged"] = true;
		echo "<script>window.history.go(-1);</script>";
	}

	function erreurLogin()
	{
		echo "<h2>Connexion</h2><p>Erreur lors de la tentative de connexion.<br><br> Veuillez réessayer.</p>";
	}

?>
