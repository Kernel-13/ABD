<?php 

function conectar($localhost, $username, $password, $db){

	$mysqli = new mysqli( $localhost, $username, $password,	$db);
	if ( mysqli_connect_errno() ) {
		echo "Error de conexión a la BD: ".mysqli_connect_error();
		exit();
	}

	return $mysqli;
}

function comando($mysqli, $query){
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	return $resultado;
}

function get_username_from_id($mysqli, $user){
	$query = "SELECT user_name FROM usuarios WHERE user_id='$user'";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$stuff = $resultado->fetch_assoc();
	return $stuff['user_name'];
}

function get_id_from_username($mysqli, $username){
	$query = "SELECT user_id FROM usuarios WHERE user_name='$username'";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$stuff = $resultado->fetch_assoc();
	return $stuff['user_name'];
}

function get_sent_messages($mysqli, $user){
	$query = "SELECT * FROM mensajes WHERE message_sender='$user'";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	return $resultado;
}

function mostrarMensajes($mysqli, $usuario, $tipo){

	$user = str_replace(" ", "%", $usuario);

	if ($tipo == "nuevos") {
		$query = "SELECT * FROM mensajes WHERE message_receiver='$usuario' AND message_read=0 ORDER BY message_date DESC";
	} elseif ($tipo == "leidos") {
		$query = "SELECT * FROM mensajes WHERE message_receiver='$usuario' AND message_read=1 ORDER BY message_date DESC";
	}

	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	return $resultado;
}

?>