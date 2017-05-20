<?php 
session_start();
require('includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php require "includes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/session-style.css">
	<title>Formulario de Registro</title>
</head>
<body >
	<?php require "includes/navbar.php"; ?>
	<?php require "includes/functions.php"; ?>

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

						$username = mysqli_real_escape_string($mysqli,stripslashes($_POST['username']));
						$email = mysqli_real_escape_string($mysqli,stripslashes($_POST['email']));
						$genre = mysqli_real_escape_string($mysqli,stripslashes($_POST['genre']));
						$age = $_POST['age'];
						$password = mysqli_real_escape_string($mysqli,stripslashes($_POST['password']));

						$secure_password=password_hash($password, PASSWORD_BCRYPT);

						$q1 = "SELECT * FROM usuarios WHERE user_name='$username'";
						$q2 = "SELECT * FROM usuarios WHERE user_email='$email'";
						$reg1 = mysqli_query($mysqli,$q1) or die(mysql_error());
						$reg2 = mysqli_query($mysqli,$q2) or die(mysql_error());
						$rows1 = mysqli_num_rows($reg1);
						$rows2 = mysqli_num_rows($reg2);

						if($rows1==1){
							echo '
							<div class="panel panel-info" style="text-align: center;">
								<div class="panel-heading">
									Registro Fallido
								</div>
								<div class="panel-body" style="color: gray;">
									<h3>El nombre de usuario introducido ya ha sido registrado!</h3><br>
									<h4>Por favor, intenta registrarte con un nuevo nombre de usuario visitando <a href="register.php">esta pagina</a></h4>
									<h4>O bien, si ya estas registrado, inicia sesión en <a href="login.php">este enlace</a></h4>
								</div>
							</div>
							';
						} elseif ($rows2==1) {
							echo '
							<div class="panel panel-info" style="text-align: center;">
								<div class="panel-heading">
									Registro Fallido
								</div>
								<div class="panel-body" style="color: gray;">
									<h3>El email introducido ya ha sido registrado!</h3><br>
									<h4>Por favor, intenta registrarte con un nuevo email visitando <a href="register.php">esta pagina</a></h4>
									<h4>O bien, si ya estas registrado, inicia sesión en <a href="login.php">este enlace</a></h4>
								</div>
							</div>
							';
						} else {
							$registro = "INSERT INTO usuarios(user_name, user_email, user_pass, user_age, user_genre, user_groups) VALUES ('$username', '$email', '$secure_password', '$age', '$genre', 'General')";
							if ($mysqli->query($registro) === TRUE) {
								$id = get_id_from_username($mysqli, $username);
								$_SESSION['username'] = $username;
								$_SESSION['user_id'] = $id;
								$_SESSION['isAdmin'] = FALSE;

								$q3 = "SELECT * FROM grupos WHERE group_genre='$genre' AND group_min_age <= '$age' AND group_max_age >= '$age'";
								$possible_groups = mysqli_query($mysqli,$q3) or die(mysql_error());
								$rows3 = mysqli_num_rows($possible_groups);

								if ($rows3 > 0) {

									echo '
									<div class="row section" style="text-align:center;">
										<h5> Existe un grupo(s) para ti! </h5>
									</div>
									';

									$id = get_id_from_username($mysqli, $username);
									$q4 = "SELECT * FROM usuarios WHERE user_id='$id'";
									$aux = mysqli_query($mysqli,$q4) or die(mysql_error());

									$this_user_groups = $aux->fetch_assoc();
									$lista_grupos = $this_user_groups["user_groups"];

									while ($grupo = $possible_groups->fetch_assoc()) {
										$lista_grupos = $lista_grupos.",".$grupo["group_name"];
									}

									$q5 = "UPDATE usuarios SET user_groups='$lista_grupos' WHERE user_id='$id'";
								// $aux2 = get_username_from_id($mysqli, $id);

									if ($mysqli->query($q5) === TRUE) {
									// OK
									} else {
									// NOT OK
									}
								}

								header("Location: messages.php");
							} else {
								echo '
								<div class="panel panel-info" style="text-align: center;">
									<div class="panel-heading">
										Registro Fallido
									</div>
									<div class="panel-body" style="color: gray;">
										<h3>A ocurrido un error a la hora de registrarte</h3><br>
										<h4>Por favor, intentalo de nuevo visitando <a href="register.php">esta pagina</a></h4>
										<h4>O bien, si ya estas registrado, inicia sesión en <a href="login.php">este enlace</a></h4>
									</div>
								</div>
								';
							}
						}
					} else { ?>

					<div class="panel panel-info" style="margin-top: -75px;">
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
										<h5>Edad</h5>
										<input class="form-control" type="number" name="age" id="age" min="14" max="99" placeholder="Edad" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<h5>Género Musical Preferido</h5>
										<input type="text"  class="form-control" name="genre" id="genre" placeholder="Género Musical Preferido" required="required">
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
	} ?>

	<?php 
	mysqli_close($mysqli);
	?>
</body>
</html>