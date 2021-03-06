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
		<div class="container-fluid">
			<div class="row section" style="text-align:center;">
				<h2> Debes estar registrado y haber iniciado sesión para poder ver / enviar mensajes </h2>
			</div>
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
						<li class="active"><a data-toggle="tab" href="#private-messages">Mensajes Privados</a></li>
						<li><a data-toggle="tab" href="#group-messages">Mensajes Grupales</a></li>
						<li><a data-toggle="tab" href="#public-messages">Mensajes Publicos</a></li>
					</ul>

					<!-- Tab Content -->
					<div class="tab-content">

						<!-- New  Messages -->
						<div id="public-messages" class="tab-pane fade messages-container">
							<?php get_public_messages($mysqli); ?>
						</div>

						<!-- New  Messages -->
						<div id="group-messages" class="tab-pane fade messages-container">
							<?php get_group_messages($mysqli, $_SESSION['user_id']); ?>
						</div>

						<!-- New  Messages -->
						<div id="private-messages" class="tab-pane fade in active  messages-container">
							<?php get_private_messages($mysqli, $_SESSION['user_id']); ?>
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