<!DOCTYPE html>
<html>
<head>
	<title>Eliminar usuarios</title>
</head>
<body>

	<h1>Eliminar usuarios</h1>

	<?php
		// Conectar a la base de datos
		$conexion = mysqli_connect('localhost', 'root', '123456', 'login');

		// Verificar si hubo un error en la conexión
		if (mysqli_connect_errno()) {
			echo 'Error al conectar a la base de datos: ' . mysqli_connect_error();
			exit();
		}

		// Obtener todos los usuarios de la base de datos
		$sql = 'SELECT * FROM usuarios';
		$resultado = mysqli_query($conexion, $sql);

		// Verificar si hubo un error en la consulta
		if (!$resultado) {
			echo 'Error al obtener los usuarios: ' . mysqli_error($conexion);
			exit();
		}

		// Verificar si hay usuarios para mostrar
		if (mysqli_num_rows($resultado) > 0) {
			// Mostrar el formulario para eliminar usuarios
			echo '<form action="eliminar.php" method="post">';
			echo '<table>';
			echo '<tr>';
			echo '<th>ID</th>';
			echo '<th>Username</th>';
			echo '<th>Password</th>';
			echo '<th>Correo</th>';
			echo '<th>Admin</th>';
			echo '<th>Eliminar</th>';
			echo '</tr>';

			// Recorrer los usuarios y mostrarlos en una tabla
			while ($fila = mysqli_fetch_assoc($resultado)) {
				echo '<tr>';
				echo '<td>' . $fila['id'] . '</td>';
				echo '<td>' . $fila['username'] . '</td>';
				echo '<td>' . $fila['password'] . '</td>';
				echo '<td>' . $fila['correo'] . '</td>';
				echo '<td>' . $fila['admin'] . '</td>';
				echo '<td><input type="checkbox" name="eliminar[]" value="' . $fila['id'] . '"></td>';
				echo '</tr>';
			}

			echo '</table>';
			echo '<input type="submit" name="submit" value="Eliminar">';
			echo '</form>';
		} else {
			echo 'No hay usuarios para mostrar.';
		}

		// Cerrar la conexión a la base de datos
		mysqli_close($conexion);

        
        
	// Conectar a la base de datos
	$conexion = mysqli_connect('localhost', 'root', '123456', 'login');

	// Verificar si hubo un error en la conexión
	if (mysqli_connect_errno()) {
		echo 'Error al conectar a la base de datos: ' . mysqli_connect_error();
		exit();
	}

	// Verificar si se envió el formulario para eliminar usuarios
	if (isset($_POST['submit'])) {
		// Verificar si se seleccionó algún usuario para eliminar
		if (isset($_POST['eliminar']) && is_array($_POST['eliminar'])) {
			// Recorrer los usuarios seleccionados y eliminarlos de la base de datos
			foreach ($_POST['eliminar'] as $id) {
				$sql = "DELETE FROM usuarios WHERE id = $id";
				$resultado = mysqli_query($conexion, $sql);

				// Verificar si hubo un error al eliminar el usuario
				if (!$resultado) {
					echo 'Error al eliminar el usuario con ID ' . $id . ': ' . mysqli_error($conexion);
				}
			}

			// Mostrar un mensaje indicando que se eliminaron los usuarios seleccionados
			echo 'Se eliminaron los usuarios seleccionados.';
		} else {
			// Mostrar un mensaje indicando que no se seleccionó ningún usuario para eliminar
			echo 'No se seleccionó ningún usuario para eliminar.';
		}
	}

	// Cerrar la conexión a la base de datos
	mysqli_close($conexion);
?>
	
    <a href="sesionadmin.php">Regresar</a>
</body>
</html>