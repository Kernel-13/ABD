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
	<?php header("Location: login.php"); ?>
	<?php 
	mysqli_close($mysqli);
	?>
</body>
</html>