<?php

	// réception des variables formulaire
	@$type = $_REQUEST['type'];
	@$rarity = $_REQUEST['rarity'];
	@$artwork = $_REQUEST['artwork'];
	@$mana = $_REQUEST['mana'];
	@$attack = $_REQUEST['attack'];
	@$health = $_REQUEST['health'];
	@$cardName = $_REQUEST['cardName'];
	@$description = $_REQUEST['description'];
	@$yourName = $_REQUEST['yourName'];
	@$yourEmail = $_REQUEST['yourEmail'];
	@$email = $_REQUEST['email'];
	@$color = $_REQUEST['color'];
	@$imageName = $_REQUEST['imageName'];
	@$step = $_REQUEST['step'];

	if($step == 1){
		if(empty($rarity)) echo "You have to choose a rarity.<br>";
		if(empty($artwork)) echo "You have to choose your artwork.";
	}

	else if($step == 2){
		// création du JSON
		$validation = array(

			'mana' => array(
				'valid'=>true,
				'error'=>'Value between 0-10',
				'value'=>$mana
			),
			'attack' => array(
				'valid'=>true,
				'error'=>'Value between 0-10',
				'value'=>$attack
			),
			'health' => array(
				'valid'=>true,
				'error'=>'Value between 0-10',
				'value'=>$health
			),
			'cardName' => array(
				'valid'=>true,
				'error'=>'Card name is empty or not valid<br>',
				'value'=>strip_tags($cardName)
			),
			'desc' => array(
				'valid'=>true,
				'error'=>'Card description is empty or not valid<br>',
				'value'=>strip_tags($description)
			)
		);

		if( empty($mana) 	 || $mana < 0 	|| $mana > 10 	|| !ctype_digit($mana) ) 		$validation['mana']['valid'] = false;
		if( empty($attack)   || $attack < 0 	|| $attack > 10 || !ctype_digit($attack) )  $validation['attack']['valid'] = false;
		if( empty($health) 	 || $health < 0 	|| $health > 10 || !ctype_digit($health) )  $validation['health']['valid'] = false;
		if( empty($cardName) ) $validation['cardName']['valid'] = false;
		if( empty($description) ) $validation['desc']['valid'] = false;
		
		echo json_encode($validation);		
	}
	else if($step == 3){

		$imageName = saveImage($_POST['imageData']);
		echo $imageName;
	}
	else if($step == 4){
		$yourName = trim(strip_tags($yourName));

		/*
		// insertion mysqli
		include('connexion.php');
		$query = "INSERT INTO card (url, type, rarity, artwork, mana, attack, health, cardName, color, description, yourName, yourEmail, email)
		 VALUES ('$imageName', '$type', '$rarity', '$artwork', '$mana', '$attack', '$health', '$cardName', '$color', '$description', '$yourName', '$yourEmail', '$email');";
		$mysqli->query($query) or die( mysql_error() );
		*/
	
		require_once('class.phpmailer.php');
		$mail = new PHPMailer(true); 
		//Exemple de message en HTML
		$titre = $yourName.'\'s Hearthstone Card';
		$message="<html>
		<head>
		<title>$titre</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		</head>
		<body style='background: #$color;margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px; font-family: Trebuchet MS, Arial, Verdana, sans-serif;'
		alink='#BA8200' vlink='#6E9334' link='#BA8200'>";
		$message.= "<h1>$yourName sent you this Hearthstone Card!</h1>";
		$message.= "<img src='http://patlamontagne.com/hearthstone/img/cards/$imageName'>";
		$message.='<br /></td> 
		</table><!--****************************************************************--></body></html>';
		try {
			$mail->AddAddress("$email");
			$mail->SetFrom("$yourEmail", "$yourName");
			$mail->Subject = $titre;
			$mail->MsgHTML($message);
			$mail->Send();
			} catch (phpmailerException $e) {
				echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
				echo $e->getMessage(); //Boring error messages from anything else!
			}
		echo "<h1>Mail sent!</h1>";
	}

	

	function saveImage($base64img){
		list($type, $base64img) = explode(';', $base64img);
		list(, $base64img)      = explode(',', $base64img);
		$base64img = base64_decode($base64img);

		$name = uniqid().'.png';
	    $file = 'img/cards/'.$name;
	    file_put_contents($file, $base64img);
	    return $name;
	}

?>