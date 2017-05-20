<?php 
session_start();
require('includes/db.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php require "includes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/messages.css">
	<link rel="stylesheet" type="text/css" href="css/user-list.css">
	<title>Lista de Usuarios</title>
</head>
<body>
	<?php require "includes/navbar.php"; ?>
	<?php require "includes/functions.php"; ?>

	<div class="container">

		<!-- Message Management -->
		<div class="row">
			<div class="col-lg-12">
				<h2 style="text-align: center;" >Usuarios y Grupos Registrados en la Web</h2>
			</div>
			<div class="col-lg-12">

				<!-- Tabs -->
				<ul class="nav nav-tabs nav-justified">
					<li class="active"><a data-toggle="tab" href="#user_list">Usuarios</a></li>
					<li><a data-toggle="tab" href="#group_list">Grupos</a></li>
				</ul>

				<!-- Tab Content -->
				<div class="tab-content">

					<!-- User List -->
					<div id="user_list" class="tab-pane fade in active messages-container">

						<?php 
						$resultado = obtain_user_list($mysqli);
						$rows = mysqli_num_rows($resultado);
						if($rows > 0){
							echo '
							<div class="row" style="margin-top:25px;">
								<div class="col-md-12 message">
									<table>
										<tr>
											<th>Nombre de Usuario</th>
											<th>Edad</th>
											<th>Genero Preferido</th>
											<th>Grupos</th>
										</tr>';
										while ($usuario = $resultado->fetch_assoc()) {
											$user = get_username_from_id($mysqli, $usuario["user_id"]);
											$edad = $usuario["user_age"];
											$genero = $usuario["user_genre"];
											$grupos = $usuario["user_groups"];
											echo '
											<tr>
												<td>'.$user.'</td>
												<td>'.$edad.'</td>
												<td>'.$genero.'</td>
												<td>
													<ul style="padding: 0;list-style-type: none;">'
														;
														$groups = explode(",", $usuario["user_groups"]);
														foreach ($groups as $grupo) {
															echo '<li>'.$grupo.'</li>';
														}
														echo '
													</ul>
												</td>
											</tr>';
										}
										echo '
									</table>
								</div>
							</div>
							';
						} else {
							echo '
							<div class="row section" style="text-align:center;">
								<h2> No Existe ningun usuario registrado</h2>
							</div>
							';
						}
						?>
					</div>

					<!-- Group List -->
					<div id="group_list" class="tab-pane fade messages-container">

						<?php 

						$q0 = "SELECT * FROM grupos";
						$grupos = mysqli_query($mysqli,$q0) or die(mysql_error());
						$fila = mysqli_num_rows($grupos);
						if ($fila > 0) {
							echo '
							<div class="row" style="margin-top:25px;">
								<div class="col-md-12 message">
									<table>
										<tr>
											<th>Nombre del Grupo</th>
											<th>Género del Grupo</th>
											<th>Edad Mínima</th>
											<th>Edad Máxima</th>
										</tr>';
										while ($grupo = $grupos->fetch_assoc()) {
											$name = $grupo["group_name"];
											$genre = $grupo["group_genre"];
											$min = $grupo["group_min_age"];
											$max = $grupo["group_max_age"];
											echo '
											<tr>
												<td>'.$name.'</td>
												<td>'.$genre.'</td>
												<td>'.$min.'</td>
												<td>'.$max.'</td>
											</tr>';
										}
										echo '
									</table>
								</div>
							</div>
							';
						} else {
							echo '
							<div class="row section" style="text-align:center;">
								<h2> No existen ningún grupo por ahora</h2>
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
	mysqli_close($mysqli);
	?>
</body>
</html>