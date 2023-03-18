<?php
  // Establecer la conexión a la base de datos
  $servername = "localhost";
  $username = "root";
  $password = "123456";
  $dbname = "login";
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Manejar el inicio de sesión del usuario
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($fila = mysqli_fetch_assoc($result)) {
      // Iniciar la sesión si el usuario es autenticado correctamente
      session_start();
      $_SESSION['id'] = $fila["id"];
      $_SESSION['username'] = $fila["username"];
      $_SESSION['admin'] = $fila["admin"];

      // Redireccionar al usuario o al administrador dependiendo de su tipo
      if ($_SESSION['admin'] == 1) {
        header("Location: sesionadmin.php");
      } else {
        header("Location: sesionusuario.php");
      }
    } else {
      echo "Nombre de usuario o contraseña incorrectos";
    }
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Formulario de inicio de sesión</title>
  </head>
  <body>
    <h1>Iniciar sesión</h1>
    <form method="POST">
      <label for="username">Nombre de usuario:</label>
      <input type="text" id="username" name="username" required>
      <br>
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>
      <br>
      <button type="submit" name="login">Iniciar sesión</button>
    </form>
    <br>
    <a href="correo.php"> Olvide mi contraseña</a>
  </body>
</html>