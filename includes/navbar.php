<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand" href="index.php"><span>Kernel</span>-9</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<?php 
				echo '<li><a href="lists.php">Usuarios y Grupos del Sitio</a></li>';

				if (!isset($_SESSION['username'])) {
				} else {
					echo '<li><a href="messages.php">Bandeja de Entrada</a></li>';
					echo '<li><a href="outbox.php">Bandeja de Salida</a></li>';
					echo '<li><a href="compose.php">Componer Nuevo Mensaje</a></li>';
					;
				}
				?>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php 

				if (!isset($_SESSION['username'])) {
					echo '<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registrate</a></li>
					<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Iniciar Sesion</a></li>';
				} else {
					echo '
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Bienvenid@, '.$_SESSION['username'].' <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="compose.php">Componer Nuevo Mensaje</a></li>';
							if ($_SESSION['isAdmin'] == TRUE) {
								echo '<li><a href="create.php">Crear nuevo grupo</a></li>';
							}
							echo '
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>'
					;
				}

				?>
			</ul>
		</div>
	</div>
</nav>