 <?php
include('config.php');
include('class/userClass.php');
error_reporting(0);
$userClass = new userClass();
$userDetails=$userClass->userDetails($_SESSION['uid']);

if($_POST['code']){
    $code=$_POST['code'];
    $secret=$userDetails->google_auth_code;
    require_once 'googleLib/GoogleAuthenticator.php';
    $ga = new GoogleAuthenticator();
    $checkResult = $ga->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance

    if ($checkResult) {
        $_SESSION['googleCode']=$code;
    } 
    else {
        echo 'Error';
    }
}

include('session.php');
$userDetails=$userClass->userDetails($session_uid);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="style.css" charset="utf-8" />
    <link rel="stylesheet" href="css/materialize.css">
</head>
<body>
	<div id="container">
<h1>Bienvenido <?php echo $userDetails->name; ?></h1>
<div class="center">
    <img src="images/tick.png" class="center" alt="">
</div>
<h4><a href="<?php echo BASE_URL.'perfil.php';?>">perfil</a></h4>
<h4><a href="<?php echo BASE_URL; ?>logout.php">Logout</a></h4>
</div>
</body>
</html>
