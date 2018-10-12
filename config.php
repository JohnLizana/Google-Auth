<?php
session_start();
/* Configuracion de la base de datos */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'googleauth');
define("BASE_URL", "http://localhost/GoogleAuth/"); //Almacena donde se dirige la url


function getDB(){

	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	try {
		$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
		$dbConnection->exec("set names utf8");
		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbConnection;
    }catch (PDOException $e) {
    	echo 'Conexion fallida: ' . $e->getMessage();
	}

}
?>