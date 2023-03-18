<!DOCTYPE html>
<html>
  <head>
    <title>Formulario de registro</title>
  </head>
  <body>
    <?php
      // Establecer la conexión a la base de datos
      $servername = "localhost";
      $username = "root";
      $password = "123456";
      $dbname = "login";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
 
      // Manejar el registro del usuario
      if (isset($_POST['registro'])) {
        $id = NULL;
        $username = $_POST['username'];
        $password = $_POST['password'];
        $correo = $_POST['correo'];
        $admin = $_POST['admin'];
        $query = "INSERT INTO usuarios (id, username, password, correo, admin) VALUES (NULL, '$username', '$password', '$correo', '$admin')";
        if (mysqli_query($conn, $query)) {
          echo "Registro exitoso";
        } else {
          echo "Error al registrar usuario: " . mysqli_error($conn);
        }
      }
      
      // Cerrar la conexión a la base de datos
      mysqli_close($conn);
    ?>
    <h1>Registrarse</h1>
    <form method="POST">
      <label for="username">Nombre de usuario:</label>
      <input type="text" id="username" name="username" required>
      <br>
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>
      <br>
      <label for="password">Correo:</label>
      <input type="text" id="correo" name="correo" required>
      <br>
      <label for="password">Admin:</label>
      <input type="radio" name="admin" value="1"> Si
      <input type="radio" name="admin" value="0"> No
      <br>
      <button type="submit" name="registro">Registrarse</button>
      <br>
      <a href="sesionadmin.php">Regresar</a>
    </form>
  </body>
</html>