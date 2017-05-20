<?php 

function comando($mysqli, $query){
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	return $resultado;
}

function get_username_from_id($mysqli, $id){
	$query = "SELECT user_name FROM usuarios WHERE user_id='$id'";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$stuff = $resultado->fetch_assoc();
	return $stuff['user_name'];
}

function get_id_from_username($mysqli, $username){
	$query = "SELECT user_id FROM usuarios WHERE user_name='$username'";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$stuff = $resultado->fetch_assoc();
	return $stuff['user_id'];
}

function get_user_from_username($mysqli, $username){
	$query = "SELECT * FROM usuarios WHERE user_name='$username'";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$stuff = $resultado->fetch_assoc();
	return $stuff;
}

function get_sent_messages($mysqli, $sender, $table){

	$query = "SELECT * FROM $table WHERE message_sender='$sender' ORDER BY message_date DESC";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$rows = mysqli_num_rows($resultado);
	if($rows > 0){
		while ($mensaje = $resultado->fetch_assoc()) {
			echo '
			<div class="row section">
				<div class="col-md-12 message">
					<div class="media">
						<div class="media-body media-right">';
							if ($table == "mensajes_privados") {
								$receptor = get_username_from_id($mysqli, $mensaje["message_receiver"]);
								echo '<h4 class="media-heading"> Para: '.$receptor.'</h4>';
								echo '<h5 class="media-heading"> Asunto: '.$mensaje["message_issue"].'</h5>';
							} elseif ($table == "mensajes_grupales") {
								echo '<h4 class="media-heading"> Grupo: '.$mensaje["message_group"].'</h4>';
								echo '<h5 class="media-heading"> Asunto: '.$mensaje["message_issue"].'</h5>';
							} else {
								echo '<h4 class="media-heading"> Asunto: '.$mensaje["message_issue"].'</h4>';
							}
							echo '
							<h5 class="media-heading"> Fecha del Mensaje: '.$mensaje["message_date"].'</h5><br>
							<p>'.$mensaje["message_body"].'</p>
						</div>
					</div>
				</div>
			</div>
			';
		}
	} else {
		echo '
		<div class="row section" style="text-align:center;">
			<h2> No has enviado ningún mensaje</h2>
		</div>
		';
	}
}

function obtain_user_list($mysqli){
	$query = "SELECT * FROM usuarios";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	return $resultado;
}

function get_private_messages($mysqli, $usuario){
	$user = str_replace(" ", "%", $usuario);
	$query = "SELECT * FROM mensajes_privados WHERE message_receiver='$usuario' ORDER BY message_date DESC";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	// return $resultado;
	$rows = mysqli_num_rows($resultado);
	if($rows > 0){
		while ($registro = $resultado->fetch_assoc()) {
			$sender = get_username_from_id($mysqli, $registro["message_sender"]);
			echo '
			<div class="row section">
				<div class="col-md-12 message">
					<div class="media">
						<div class="media-body media-right">
							<h4 class="media-heading"> De: '.$sender.'</h4>
							<h5 class="media-heading"> Asunto: '.$registro["message_issue"].'</h5>
							<h5 class="media-heading"> Fecha del Mensaje: '.$registro["message_date"].'</h5><br>
							<p>'.$registro["message_body"].'</p>
						</div>
					</div>
				</div>
			</div>
			';
		}
	} else {
		echo '
		<div class="row section" style="text-align:center;">
			<h2> No tienes ningún mensaje nuevo</h2>
		</div>
		';
	}
}

function get_public_messages($mysqli){
	$query = "SELECT * FROM mensajes_publicos ORDER BY message_date DESC";
	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$rows = mysqli_num_rows($resultado);
	if($rows > 0){
		while ($mensaje = $resultado->fetch_assoc()) {
			$sender = get_username_from_id($mysqli, $mensaje["message_sender"]);
			echo '
			<div class="row section">
				<div class="col-md-12 message">
					<div class="media">
						<div class="media-body media-right">
							<h4 class="media-heading"> De: '.$sender.'</h4>
							<h5 class="media-heading"> Asunto: '.$mensaje["message_issue"].'</h5>
							<h5 class="media-heading"> Fecha del Mensaje: '.$mensaje["message_date"].'</h5><br>
							<p>'.$mensaje["message_body"].'</p>
						</div>
					</div>
				</div>
			</div>
			';
		}
	} else {
		echo '
		<div class="row section" style="text-align:center;">
			<h2> No tienes ningún mensaje nuevo</h2>
		</div>
		';
	}
}

function get_group_messages($mysqli, $userID){
	$user = str_replace(" ", "%", $userID);
	$no_messages = TRUE;

	$q_messages = "SELECT * FROM mensajes_grupales ORDER BY message_date DESC";
	$q_user = "SELECT user_groups FROM usuarios WHERE user_id='$user'";

	$res_messages = $mysqli->query($q_messages) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$res_user = $mysqli->query($q_user) or die ($mysqli->error. " en la línea ".(__LINE__-1));
	$user_data = $res_user->fetch_assoc();
	$user_groups = $user_data["user_groups"];
	$arr_groups = explode(",", $user_groups);

	$rows = mysqli_num_rows($res_messages);
	if($rows > 0){
		while ($mensajes = $res_messages->fetch_assoc()) {
			if (in_array($mensajes["message_group"], $arr_groups)) {
				$sender = get_username_from_id($mysqli, $mensajes["message_sender"]);
				echo '
				<div class="row section">
					<div class="col-md-12 message">
						<div class="media">
							<div class="media-body media-right">
								<h4 class="media-heading"> De: '.$sender.'</h4>
								<h5 class="media-heading"> Grupo: '.$mensajes["message_group"].'</h5>
								<h5 class="media-heading"> Asunto: '.$mensajes["message_issue"].'</h5>
								<h5 class="media-heading"> Fecha del Mensaje: '.$mensajes["message_date"].'</h5><br>
								<p>'.$mensajes["message_body"].'</p>
							</div>
						</div>
					</div>
				</div>
				';
				$no_messages = FALSE;
			}
		}
	} else {
		echo '
		<div class="row section" style="text-align:center;">
			<h2> No tienes ningún mensaje nuevo</h2>
		</div>
		';
		$no_messages = FALSE;
	}

	if ($no_messages) {
		echo '
		<div class="row section" style="text-align:center;">
			<h2> No tienes ningún mensaje nuevo</h2>
		</div>
		';
	}
}

?>