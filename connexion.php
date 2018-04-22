<?php
	/* 
		Connexion au serveur et sélection de la base de donnée
	*/
	
	$mysqli = new mysqli("localhost", "user", "pass", "db");			
	$mysqli->set_charset("utf8");
	
?>
