<?php 
session_start();
require('includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php require "includes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/messages.css">
	<title>Componer Mensaje</title>
</head>
<body>

	<?php require "includes/navbar.php"; ?>

	<div class="container">

		<?php // Envio de Mensaje
		if (isset($_POST['asunto']) && isset($_POST['mensaje'])){

			$mensaje = mysqli_real_escape_string($mysqli,stripslashes($_POST['mensaje']));
			$asunto = mysqli_real_escape_string($mysqli,stripslashes($_POST['asunto']));
			$tipo = 'Privado';
			$read = FALSE;

			if (isset($_POST['receptor']) && !isset($_POST['grupo'])) { // Mensaje Privado
				
				// Mirar si existe usuario receptor
				$receptor = mysqli_real_escape_string($mysqli,stripslashes($_POST['receptor']));
				$q1 = "SELECT * FROM usuarios WHERE user_name='$receptor'";
				$resultado = mysqli_query($mysqli,$q1) or die(mysql_error());
				$array = $resultado->fetch_assoc();
				$row = mysqli_num_rows($resultado);
				if($row == 1){

					$q2 = "INSERT INTO mensajes(message_sender, message_receiver, message_issue, message_body, message_type, message_read)
					VALUES('".$_SESSION['user_id']."', '".$array['user_id']."', '".$asunto."', '".$mensaje."', '".$tipo."', '".$read."')";


					if ($mysqli->query($q2) === TRUE) {
						echo '
						<div class="row section" style="text-align:center;">
							<h5> El mensaje se ha enviado con exito. (Mensaje Privado)</h5>
						</div>
						';
					} else {
						echo '
						<div class="row section" style="text-align:center;">
							<h5> A ocurrido un error. (Privado) </h5>
						</div>
						';
					}

				} else {
					echo '
					<div class="row section" style="text-align:center;">
						<h5> El mensaje no se pudo enviar debido a que el usuario receptor no existe. </h5>
					</div>
					';
				}
			} elseif (isset($_POST['grupo'])  && !isset($_POST['receptor'])) { // Mensaje Grupal
				/*
				// Mensaje Grupal
				// Mirar si existe usuario receptor
				$tipo = 'Grupo';
				$q1 = "SELECT * FROM usuarios WHERE user_name='$receptor'";
				$resultado = mysqli_query($mysqli,$q1) or die(mysql_error());
				$array = $resultado->fetch_assoc();
				$row = mysqli_num_rows($resultado);
				if($row == 1){
				//Existe usuario
					$q2 = "INSERT INTO mensajes(message_sender, message_receiver, message_issue, message_body, message_type) VALUES(".$_SESSION['user_id'].", ".$array['user_id'].", $asunto, $mensaje, $tipo)";
					if ($mysqli->query($q2) === TRUE) {
						echo '
						<div class="row section" style="text-align:center;">
							<h5> El mensaje se ha enviado con exito. </h5>
						</div>
						';
					} else {
						echo '
						<div class="row section" style="text-align:center;">
							<h5> A ocurrido un error. </h5>
						</div>
						';
					}

				} else {
					echo '
					<div class="row section" style="text-align:center;">
						<h5> El mensaje no se pudo enviar debido a que el usuario receptor no existe. </h5>
					</div>
					';
				}
				*/
			} elseif (!isset($_POST['grupo'])  && !isset($_POST['receptor'])) { // Mensaje Publico
				
				$tipo = 'Publico';
				$q1 = "SELECT * FROM usuarios";
				$resultado = mysqli_query($mysqli,$q1) or die(mysql_error());
				$row = mysqli_num_rows($resultado);
				if($row > 0){
					$all_ok = FALSE;
					while ($registro = $resultado->fetch_assoc()) {
						$q2 = "INSERT INTO mensajes(message_sender, message_receiver, message_issue, message_body, message_type, message_read)
						VALUES('".$_SESSION['user_id']."', '".$registro['user_id']."', '".$asunto."', '".$mensaje."', '".$tipo."', '".$read."')";					

						if ($_SESSION['user_id'] != $registro['user_id']) {
							if ($mysqli->query($q2) === TRUE) {
								$all_ok = TRUE;
							} else {
								$all_ok = FALSE;
							}
						}
					}
					if ($all_ok) {
						echo '
						<div class="row section" style="text-align:center;">
							<h5> Los mensajes se han enviado con exito. </h5>
						</div>
						';
					} else {
						echo '
						<div class="row section" style="text-align:center;">
							<h5> A ocurrido un error al enviar los mensajes. (Publico)</h5>
						</div>
						';
					}
				} else {
					echo '
					<div class="row section" style="text-align:center;">
						<h5> El mensaje no se pudo enviar debido a que el usuario receptor no existe. </h5>
					</div>
					';
				}
			}
		}

		?>

		<div class="row">
			<div class="col-lg-12">
				<h3>Selecciona el tipo de mensaje que deseas enviar:</h3>
				<br>
			</div>
			<div class="col-lg-12">

				<!-- Tabs -->
				<ul class="nav nav-tabs nav-justified">
					<li class="active"><a data-toggle="tab" href="#private-message">Enviar Mensaje Privado</a></li>
					<li><a data-toggle="tab" href="#public-message">Enviar Mensaje Publico</a></li>
					<li><a data-toggle="tab" href="#group-message">Enviar Mensaje Grupal</a></li>
				</ul>

				<!-- Tab Content -->
				<div class="tab-content">

					<!-- New  Messages -->
					<div id="private-message" class="tab-pane fade in active messages-container">

						<!-- Sending a Private Message -->
						<div class="row">
							<div class="col-lg-12">
								<h3>Enviar Mensaje</h3>
							</div>
							<form method="post" action="" class="form-horizontal">
								<div class="col-lg-12">
									<div class="form-group">
										<div class="col-md-12">
											<label class="sr-only" for="receptor"> Destinatario </label>
											<input class="form-control" type="text" id="receptor" name="receptor" required="required" placeholder="Destinatario" maxlength="20">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<label class="sr-only" for="asunto"> Asunto </label>
											<input class="form-control" type="text" id="asunto" name="asunto" required="required" placeholder="Asunto" maxlength="50">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<label class="sr-only" for="mensajes"> Mensaje </label>
											<textarea class="form-control" name="mensaje" required="required" id="mensajes" placeholder="Escribe aquí tu mensaje" maxlength="500"></textarea>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<input type="submit" name="submit" value="Enviar" class="btn btn-success">
								</div>
							</form>
						</div>
					</div>

					<!-- Public Messages -->
					<div id="public-message" class="tab-pane fade messages-container">
						<div class="row">
							<div class="col-lg-12">
								<h3>Enviar Mensaje</h3>
							</div>
							<form method="post" action="" class="form-horizontal">
								<div class="col-lg-12">
									<div class="form-group">
										<div class="col-md-12">
											<label class="sr-only" for="asunto"> Asunto </label>
											<input class="form-control" type="text" id="asunto" name="asunto" required="required" placeholder="Asunto" maxlength="50">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<label class="sr-only" for="mensajes"> Mensaje </label>
											<textarea class="form-control" name="mensaje" required="required" id="mensajes" placeholder="Escribe aquí tu mensaje" maxlength="500"></textarea>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<input type="submit" name="submit" value="Enviar" class="btn btn-success">
								</div>
							</form>
						</div>
					</div>

					<!-- Group Messages -->
					<div id="group-message" class="tab-pane fade messages-container">
						<div class="row">
							<div class="col-lg-12">
								<h3>Enviar Mensaje</h3>
							</div>
							<form method="post" action="" class="form-horizontal">
								<div class="col-lg-12">
									<div class="form-group">
										<div class="col-md-12">
											<label class="sr-only" for="receptor"> Grupo Destinatario </label>
											<input class="form-control" type="text" id="receptor" name="grupo" required="required" placeholder="Grupo Destinatario" maxlength="20">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<label class="sr-only" for="asunto"> Asunto </label>
											<input class="form-control" type="text" id="asunto" name="asunto" required="required" placeholder="Asunto" maxlength="50">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<label class="sr-only" for="mensajes"> Mensaje </label>
											<textarea class="form-control" name="mensaje" required="required" id="mensajes" placeholder="Escribe aquí tu mensaje" maxlength="500"></textarea>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<input type="submit" name="submit" value="Enviar" class="btn btn-success">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
	mysqli_close($mysqli);
	?>
</body>
</html>