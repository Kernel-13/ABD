<?php 

$localhost = "localhost";
$username = "Kernel9";
$password = "knine";
$db = "kernel9";

$mysqli = new mysqli( $localhost, $username, $password,	$db);
if ( mysqli_connect_errno() ) {
	echo "Error de conexión a la BD: ".mysqli_connect_error();
	exit();
}

?>