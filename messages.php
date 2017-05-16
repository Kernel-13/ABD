<?php 
session_start();
require('includes/db.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php require "includes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/messages.css">
	<title>Mensajes</title>
</head>
<body>
	<?php require "includes/navbar.php"; ?>
	<?php require "includes/functions.php"; ?>

	<?php 
	if (!isset($_SESSION['username'])) {
		echo '
		<div class="row section" style="text-align:center;">
			<h2> Debes estar registrado y haber iniciado sesión para poder ver / enviar mensajes </h2>
		</div>
		';
	} else {

		?>

		<div class="container">

			<!-- Message Management -->
			<div class="row">
				<div class="col-lg-12">
					<h3>Bandeja de Entrada</h3>
				</div>
				<div class="col-lg-12">

					<!-- Tabs -->
					<ul class="nav nav-tabs nav-justified">
						<li class="active"><a data-toggle="tab" href="#new">Recibidos</a></li>
						<li><a data-toggle="tab" href="#sent">Enviados</a></li>
					</ul>

					<!-- Tab Content -->
					<div class="tab-content">

						<!-- New  Messages -->
						<div id="new" class="tab-pane fade in active messages-container">

							<?php 
							$resultado = mostrarMensajes($mysqli, $_SESSION['user_id'], "nuevos");
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
													<h5 class="media-heading"> Tipo de Mensaje: '.$registro["message_type"].'</h5><br>
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
							?>
						</div>

						<!-- Sent Messages -->
						<div id="sent" class="tab-pane fade messages-container">

							<?php 
							$resultado = get_sent_messages($mysqli, $_SESSION['user_id']);
							$rows = mysqli_num_rows($resultado);
							if($rows > 0){
								while ($registro = $resultado->fetch_assoc()) {
									$receptor = get_username_from_id($mysqli, $registro["message_receiver"]);
									echo '
									<div class="row section">
										<div class="col-md-12 message">
											<div class="media">
												<div class="media-body media-right">
													<h4 class="media-heading"> Para: '.$receptor.'</h4>
													<h5 class="media-heading"> Asunto: '.$registro["message_issue"].'</h5>
													<h5 class="media-heading"> Tipo de Mensaje: '.$registro["message_type"].'</h5>
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
									<h2> No has enviado ningún mensaje</h2>
								</div>
								';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
	} ?>
	<?php 
	mysqli_close($mysqli);
	?>
</body>
</html>