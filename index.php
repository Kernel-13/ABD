<?php 
session_start();
require('includes/db.php');
?>

<!DOCTYPE html>
<html>
<head>
	<?php require "includes/header.php"; ?>
	<title>Inicio</title>
</head>
<body>

	<?php require "includes/navbar.php"; ?>
	
	<?php 
	if (isset($_SESSION['username'])) {
		header("Location: messages.php");
	} else {

		?>

		<div class="container">
			<div class="row"  style="text-align: center; color: gray;">
				<div class="col-12-md">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h2>Bienvenido a Kernel 9</h2>
						</div>
						<div class="panel-body">
							<h3>El lugar preferido para aquellas personas que viven por la música y buscan a personas que compartan sus gustos musicales</h3><br>
							<h4>Podrás disfrutar de todos nuestros servicios de mensajería con solo registrarte <a href="register.php">en este enlace</a></h4>
							<h4>O si ya tienes una cuenta con nosotros, puedes iniciar sesión haciendo click <a href="login.php">en este enlace</a></h4>
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