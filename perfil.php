<?php
include('config.php');
include('class/userClass.php');
include('session.php');


$userClass = new userClass();
$userDetails=$userClass->userDetails($_SESSION['uid']);
$userDetails=$userClass->userDetails($session_uid);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perfil</title>
    <link rel="stylesheet" type="text/css" href="style.css" charset="utf-8" />
    <link rel="stylesheet" href="css/materialize.css">
</head>
<body>
	<div id="container">
<h1>Datos <?php echo $userDetails->name; ?></h1>

<pre>
    <?php print_r($userDetails);?>
</pre>


<h4><a href="<?php echo BASE_URL; ?>logout.php">Logout</a></h4>
</div>
</body>
</html>