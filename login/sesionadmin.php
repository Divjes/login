<!DOCTYPE html>
<html>
<head>
	<title>Formulario con botones</title>
</head>
<body>
<?php
	// Conectar a la base de datos
	$conexion = mysqli_connect('localhost', 'root', '123456', 'login');

	// Verificar si hubo un error en la conexión
	if (mysqli_connect_errno()) {
		echo 'Error al conectar a la base de datos: ' . mysqli_connect_error();
		exit();
	}

	// Verificar si se envió el formulario para borrar todo
	if (isset($_POST['borrar'])) {
		// Ejecutar una consulta DELETE sin cláusula WHERE para borrar todos los registros de la tabla usuarios
		$sql = "DELETE FROM usuarios";
		if (mysqli_query($conexion, $sql)) {
			echo "Todos los registros han sido borrados exitosamente.";
		} else {
			echo "Error al borrar los registros: " . mysqli_error($conexion);
		}
	}

	// Cerrar la conexión a la base de datos
	mysqli_close($conexion);
?>
	<h1>SESION ADMIN</h1>

	<form action="" method="post">

  <input type="submit" name="alta" value="Dar de alta" formaction="registro.php">
	<input type="submit" name="eliminar" value="Eliminar" formaction="eliminar.php">
  <input type="submit" name="consultar" value="Consultar" formaction="consultar.php">

	</form>

</body>
</html>