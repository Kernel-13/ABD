<?php 
session_start();
require('includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php require "includes/header.php"; ?>
	<title>Formulario de Registro</title>
</head>
<body >
	<?php require "includes/navbar.php"; ?>
	<?php require "includes/functions.php"; ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-offset-4 col-lg-4">

				<?php

				if (isset($_POST['username'])){

					$username = stripslashes($_POST['username']);
					$username = mysqli_real_escape_string($mysqli,$username);

					$email = stripslashes($_POST['email']);
					$email = mysqli_real_escape_string($mysqli,$email);

					$password = stripslashes($_POST['password']);
					$password = mysqli_real_escape_string($mysqli,$password);
					$secure_password=password_hash($password, PASSWORD_BCRYPT);

					$query = "SELECT * FROM usuarios WHERE user_name='$username'";
					$result = mysqli_query($mysqli,$query) or die(mysql_error());
					$rows = mysqli_num_rows($result);
					if($rows==1){
						echo '
						<div class="panel panel-info" style="text-align: center;">
							<div class="panel-heading">
								Registro Fallido
							</div>
							<div class="panel-body" style="color: gray;">
								<h3>El nombre de usuario introducido ya ha sido registrado!</h3><br>
								<h4>Por favor, intenta registrarte con un nuevo nombre de usuario visitando <a href="registro.php">esta pagina</a></h4>
								<h4>O bien, si ya estas registrado, inicia sesión en <a href="login.php">este enlace</a></h4>
							</div>
						</div>
						';
					} else {
						$registro = "INSERT INTO usuarios(user_name, user_email, user_pass) VALUES ('$username', '$email', '$secure_password')";
						if ($mysqli->query($registro) === TRUE) {
							$id = get_id_from_username($mysqli, $username);
							$_SESSION['username'] = $username;
							$_SESSION['user_id'] = $id;
							header("Location: messages.php");
						} else {
							echo '
							<div class="panel panel-info" style="text-align: center;">
								<div class="panel-heading">
									Registro Fallido
								</div>
								<div class="panel-body" style="color: gray;">
									<h3>A ocurrido un error a la hora de registrarte</h3><br>
									<h4>Por favor, intentalo de nuevo visitando <a href="registro.php">esta pagina</a></h4>
									<h4>O bien, si ya estas registrado, inicia sesión en <a href="login.php">este enlace</a></h4>
								</div>
							</div>
							';
						}
					}
				} else { ?>
				
				<div class="panel panel-info">
					<div class="panel-heading">
						Registro
					</div>
					<div class="panel-body">
						<form method="post" action="" class="form-horizontal">					
							<div class="form-group">
								<div class="col-sm-12"> 
									<h5>Usuario</h5>
									<input type="text" name="username" class="form-control" required="required" id="user" placeholder="Nombre de Usuario">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<h5>Email</h5>
									<input type="email" name="email" class="form-control" id="email" placeholder="Email" required="required">
								</div>
							</div>	
							<div class="form-group">
								<div class="col-sm-12"> 
									<h5>Contraseña</h5>
									<input type="password" name="password" class="form-control" required="required" id="pass" placeholder="Indique su contraseña">
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-12 submitButton">
									<button type="submit" class="btn btn-default">Registrarse</button>
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
	mysqli_close($mysqli);
	?>
</body>
</html>