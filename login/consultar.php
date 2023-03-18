<!DOCTYPE html>
<html>
  <head>
    <title>Eres usuario</title>
  </head>
  <body>
    
    <h1>Eres usuario</h1>
    <?php
      // Establecer la conexión a la base de datos
      $servername = "localhost";
      $username = "root";
      $password = "123456";
      $dbname = "login";
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      // Verificar si hubo un error en la conexión
      if (mysqli_connect_errno()) {
        echo 'Error al conectar a la base de datos: ' . mysqli_connect_error();
        exit();
      }

      // Ejecutar una consulta SELECT para obtener todas las columnas de la tabla usuarios
      $sql = "SELECT * FROM usuarios";
      $result = mysqli_query($conn, $sql);

      // Mostrar los resultados en una tabla HTML
      echo "<table>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["password"] . "</td><td>" . $row["correo"] . "</td></tr>";
      }
      echo "</table>";

      // Cerrar la conexión a la base de datos
      mysqli_close($conn);
    ?>
    
  </body>
</html>