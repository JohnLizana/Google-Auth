<?php 
include("config.php");
if(!empty($_SESSION['uid']))
{
    header("Location: device_confirmations.php");
}

include('class/userClass.php');
$userClass = new userClass();

require_once 'googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();

$errorMsgReg='';
$errorMsgLogin='';
if (!empty($_POST['loginSubmit'])) {
    $usernameEmail=$_POST['usernameEmail'];
    $password=$_POST['password'];
    if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 ){
        $uid=$userClass->userLogin($usernameEmail,$password,$secret);
        if($uid){
            $url=BASE_URL.'device_confirmations.php';
            header("Location: $url");
        }else{
            $errorMsgLogin="Rellene correctamente los campos.";
        }
    }
}

if (!empty($_POST['signupSubmit'])) {

	$username=$_POST['usernameReg'];
	$email=$_POST['emailReg'];
	$password=$_POST['passwordReg'];
    $name=$_POST['nameReg'];

	$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
	$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
	$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);

	if($username_check && $email_check && $password_check && strlen(trim($name))>0) {
    
        $uid=$userClass->userRegistration($username,$password,$email,$name,$secret);
        if($uid){
            $url=BASE_URL.'device_confirmations.php';
            header("Location: $url");
        }else{
            $errorMsgReg="El usuario o correo ya fue registrado.";
        }
    
	}
    else{
      $errorMsgReg="Rellene correctamente los campos.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Verificacion en 2 pasos</title>
    <link rel="stylesheet" type="text/css" href="style.css" charset="utf-8" />
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div id="container">
    <h1>Verificacion en 2 pasos</h1>
    <div id="login">
        <h4><i class="material-icons md-36">person_pin</i>Iniciar Sesión</h3>
        <form method="post" action="" name="login">
            <label>Usuario o correo</label>
            <input type="text" name="usernameEmail" autocomplete="off" />
            <label>Password</label>
            <input type="password" name="password" autocomplete="off"/>
            <div class="errorMsg"><?php echo $errorMsgLogin; ?></div>
            <input type="submit" class="btn btn-success" name="loginSubmit" value="Iniciar">
        </form>
    </div>

    <div id="signup">
        <h4><i class="material-icons md-36">card_membership</i> Registrarme</h4>
        <form method="post" action="" name="signup">
            <label>Nombre</label>
            <input type="text" name="nameReg" autocomplete="off" />

            <label>Correo</label>
            <input type="text" name="emailReg" autocomplete="off" />

            <label>Usuario</label>
            <input type="text" name="usernameReg" autocomplete="off" />

            <label>Contraseña</label>
            <input type="password" name="passwordReg" autocomplete="off"/>
            
            <div class="errorMsg"><?php echo $errorMsgReg; ?></div>
            <input type="submit" class="btn btn-success" name="signupSubmit" value="Registrarse">
        </form>
    </div>
</div>

</body>
</html>
