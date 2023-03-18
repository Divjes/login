<!DOCTYPE html>
<html>
  <head>
    <title>Escribe tu correo</title>
  </head>
  <body>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/phpmailer/src/SMTP.php';
// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "login";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Comprobar si la conexión se ha establecido correctamente
if (!$conn) {
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}

// Comprobar si se ha enviado el formulario
if (isset($_POST["submit"])) {
    // Obtener el correo electrónico del formulario
    $email = $_POST["email"];

    // Generar una contraseña aleatoria
    $password = generateRandomPassword();
    // Actualizar la contraseña en la base de datos
    $sql = "UPDATE usuarios SET password='$password' WHERE correo='$email'";

    if (mysqli_query($conn, $sql)) {
        echo "La contraseña se ha actualizado correctamente.";
    } else {
        echo "Error al actualizar la contraseña: " . mysqli_error($conn);
    }
}

// Función para generar una contraseña aleatoria
function generateRandomPassword() {
    $length = 8;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters_length = strlen($characters);
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $characters_length - 1)];
    }

    return $password;
}


if (isset($_POST["submit"])) {
  $mail = new PHPMailer(true);
  
  try {
      //Server settings
      $mail->SMTPDebug = 2;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'divan_leonardo@hotmail.com';                     //SMTP username
      $mail->Password   = 'Osunapadilla';                               //SMTP password
      $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom('divan_leonardo@hotmail.com', 'Mailer');
      $mail->addAddress($email, 'Mailer');     //Add a recipient
     // $mail->addAddress('ellen@example.com');               //Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');
  
      //Attachments
    //  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
  
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Buenas';
      $mail->Body    = 'Esta es su nueva contraseña: '.$password;
      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
      $mail->send();
      echo 'Message has been sent';
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

?>




    <h1>NUEVA CONTRASEÑA</h1>
    <form method="POST">
      <label for="username">Correo:</label>
      <input type="email" name="email" required>

      <button type="submit" name="submit" value="Enviar Correo">Enviar</button>
    </form>
  </body>
</html>