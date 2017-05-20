<?php 
session_start();
require('includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php require "includes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/session-style.css">
	<title>Inicio de Sesión</title>
</head>
<body>

	<?php require "includes/navbar.php"; ?>

	<?php 
	if (isset($_SESSION['username'])) {
		header("Location: index.php");
	} else {

		?>

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-offset-4 col-lg-4">

					<?php

					if (isset($_POST['username'])){

						$username = stripslashes($_POST['username']);
						$username = mysqli_real_escape_string($mysqli,$username);
						$password = stripslashes($_POST['password']);
						$password = mysqli_real_escape_string($mysqli,$password);

						$query = "SELECT * FROM usuarios WHERE user_name='$username'";
						$result = mysqli_query($mysqli,$query) or die(mysql_error());
						$rows = mysqli_num_rows($result);
						$registro = $result->fetch_assoc();

						if($rows==1 && password_verify($password, $registro['user_pass'])) {
							$_SESSION['username'] = $registro['user_name'];
							$_SESSION['user_id'] = $registro['user_id'];
							if ($registro['user_isAdmin'] == TRUE) {
								$_SESSION['isAdmin'] = TRUE;
							} else {
								$_SESSION['isAdmin'] = FALSE;
							}
							header("Location: messages.php");
						} else {
							echo '
							<div class="panel panel-info" style="text-align: center;">
								<div class="panel-heading">
									Intento Fallido
								</div>
								<div class="panel-body" style="color: gray;">
									<h3>El usuario o contraseña introducido son incorrectos!</h3><br>
									<h4>Por favor, intenta iniciar sesion de nuevo visitando <a href="login.php">esta pagina</a></h4>
									<h4>O bien, si no estas registrado, registrate en <a href="register.php">este enlace</a></h4>
								</div>
							</div>
							';
						}
					} else { ?>

					<div class="panel panel-info">
						<div class="panel-heading">
							Inicio de Sesión
						</div>
						<div class="panel-body">
							<form action="" method="post" class="form-horizontal">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text"  class="form-control" name="username" id="username" placeholder="Nombre de Usuario" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12"> 
										<input type="password" class="form-control" name="password" required="required" id="pass" placeholder="Password">
									</div>
								</div>
								<div class="form-group"> 
									<div class="col-sm-12 submitButton">
										<button type="submit" class="btn btn-success">Iniciar Sesión</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php } ?>
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