 <?php
include('config.php');

if(empty($_SESSION['uid'])){
	header("Location: index.php");
}

include('class/userClass.php');

$userClass = new userClass();
$userDetails=$userClass->userDetails($_SESSION['uid']);
$secret=$userDetails->google_auth_code;
$email=$userDetails->email;

require_once 'googleLib/GoogleAuthenticator.php';

$ga = new GoogleAuthenticator();

$qrCodeUrl = $ga->getQRCodeGoogleUrl($email, $secret,'Verificacion Google Mobee');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Verifica tu sesión</title>
	<link rel="stylesheet" type="text/css" href="style.css" charset="utf-8">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/materialize.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<div id="container">
		<h3>Verifica tu sesión con Google Authenticator</h3>
		<div id='device'>
			<p>Ingresa el codigo de verificación de Google Authenticator.</p>
			<div id="img">
				<img src='<?php echo $qrCodeUrl; ?>' />
			</div>

			<form method="post" action="home.php">
			<label>Ingresa tu código aquí</label>
			<input type="text" name="code" />
			<input type="submit" class="btn btn-success" value="Verificar" />
			</form>
		</div>
		<div style="text-align:center">
			<h5>Obten Google Authenticator Para tu smartphone</h5>
			<a href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank"><img class='app' src="images/appstore.png" /></a>
			<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank"><img class="app" src="images/playstore.png" /></a>
		</div>	
		<h5><a href="<?php echo BASE_URL; ?>logout.php">Salir</a></h5>
	</div>
</body>
</html>
