<?php
require_once('class.phpmailer.php');
$mail = new PHPMailer(true); 
//Exemple de message en HTML
$message='<html>
<head>
<title>Hearthstone</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px; font-family: Trebuchet MS, Arial, Verdana, sans-serif;" alink="#BA8200" vlink="#6E9334" link="#BA8200">
';
$message.=$_REQUEST["message"];
$message.='<br />
<a href="mailto:stages-imm@cjonquiere.qc.ca?subject=Offre de stages">stages-imm@cjonquiere.qc.ca</a> <br />          
<img src="http://www.techniquesmedia.com/stages/img/ATM-IMM.gif">
</td> 
</table><!--****************************************************************--></body></html>';
try {
	$mail->AddAddress('stages-imm@cjonquiere.qc.ca');
	$mail->SetFrom('stages-imm@cjonquiere.qc.ca', 'Cégep de Jonquière');
	$mail->Subject = $titre;
	$mail->MsgHTML($message);
	$mail->Send();
	} catch (phpmailerException $e) {
		echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
		echo $e->getMessage(); //Boring error messages from anything else!
	}

echo"<p>Votre carte est envoyée !</p>";
echo"<p><a href='index.php'>Accueil</a></p>";				
?>