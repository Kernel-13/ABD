<?php 
session_start();
require('includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php require "includes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/messages.css">
	<title>Creación de Grupos</title>
</head>
<body>

	<?php require "includes/navbar.php"; ?>
	<?php require "includes/functions.php"; ?>

	<?php 
	if (!isset($_SESSION['username'])) {
		echo '
		<div class="container-fluid">
			<div class="row section" style="text-align:center;">
				<h2> Debes estar registrado y haber iniciado sesión como Admin para poder crear grupos </h2>
			</div>
		</div>
		';
	} else {

		?>

		<div class="container">

		<?php // Envio de Mensaje
		
		if (isset($_POST['genre'])){

			$genre = mysqli_real_escape_string($mysqli,stripslashes($_POST['genre']));
			$name = mysqli_real_escape_string($mysqli,stripslashes($_POST['g-name']));

			$q0 = "SELECT * FROM grupos WHERE group_name='$name'";
			$usuarios = mysqli_query($mysqli,$q0) or die(mysql_error());
			$fila = mysqli_num_rows($usuarios);

			if($fila == 1){
				echo '
				<div class="row section" style="text-align:center;">
					<h5> Lo sentimos, pero el nombre escogido para el grupo ya existe. </h5>
				</div>
				';
			} else {


				if ($_POST['min-age'] < $_POST['max-age']) {

					$min = $_POST['min-age'];
					$max = $_POST['max-age'];

					// Insertamos el nuevo grupo en la lista de grupos
					$q1 = "INSERT INTO grupos(group_name, group_genre, group_min_age, group_max_age) VALUES('".$name."', '".$genre."', '".$min."', '".$max."')";

					if ($mysqli->query($q1) === TRUE) {
						echo '
						<div class="row section" style="text-align:center;">
							<h5> El grupo se ha creado con exito.</h5>
						</div>
						';
					} else {
						echo '
						<div class="row section" style="text-align:center;">
							<h5> A ocurrido un error al crear el grupo. </h5>
						</div>
						';
					}

					// Buscamos usuarios que puedan pertenecer al grupo creado
					$q2 = "SELECT * FROM usuarios WHERE user_genre='$genre' AND user_age BETWEEN '$min' AND '$max'";
					$usuarios = mysqli_query($mysqli,$q2) or die(mysql_error());
					$row = mysqli_num_rows($usuarios);

					if($row > 0){
						// Insertamos el nuevo grupo en la lista de grupos a los que pertenece el usuario
						while ($user = $usuarios->fetch_assoc()) {
							$this_user_groups = $user["user_groups"];
							$this_user_groups = $this_user_groups.",".$name;
							$id = $user["user_id"];

							$q3 = "UPDATE usuarios SET user_groups='$this_user_groups' WHERE user_id='$id'";
							// $aux = get_username_from_id($mysqli, $id);

							if ($mysqli->query($q3) === TRUE) {
							// OK
							} else {
							// NOT OK
							}
						}
					} 
				}
			}
		}

		?>

		<div class="row">
			<div class="col-lg-12">
				<h3> Creación de Grupos </h3>
				<br>
			</div>
			<div class="col-lg-12">
				<div class="row">
					<form method="post" action="" class="form-horizontal">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="col-md-12">
									<label class="sr-only" for="g-name"> Nombre del Grupo </label>
									<input class="form-control" type="text" id="g-name" name="g-name" required="required" placeholder="Nombre del Grupo" maxlength="20">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label class="sr-only" for="genre"> Género </label>
									<input class="form-control" type="text" id="genre" name="genre" required="required" placeholder="Género" maxlength="20">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label class="sr-only" for="min-age"> Edad Minima </label>
									<input class="form-control" type="number" id="min-age" min="14" max="99" name="min-age" required="required" placeholder="Edad Minima">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label class="sr-only" for="max-age"> Edad Maxima </label>
									<input class="form-control" type="number" id="max-age" min="14" max="99" name="max-age" required="required" placeholder="Edad Maxima">
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<input type="submit" name="submit" value="Crear" class="btn btn-info">
						</div>
					</form>
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