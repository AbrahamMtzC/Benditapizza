<?php
if(!isset($_GET['id'])){
    header('Location: ../olvidarCon.php');
}
include "../../js/conexion.php";

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM administrador WHERE id = ?;");
$stmt->execute([$id]);
$administrador = $stmt->fetch(PDO::FETCH_OBJ);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'noreply@benditapizzamx.com';                     //SMTP username
    $mail->Password   = '7Gh#jk$1qW';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noreply@benditapizzamx.com', 'Bendita Pizza');
    
    $administrador->email ;
    $mail->addAddress($administrador->email);     //Add a recipient
    
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    //$mail->Subject = 'Asunto Test';
    //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    
    $mail->Subject = 'Recuperación de contraseña: Acceso restaurado a tu cuenta Bendita Pizza';
    $mail->CharSet = 'UTF-8';

    $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
        <style>
        body {
          font-family: Arial, sans-serif;
          background-color: #F9F9F9;
          padding: 20px;
        }
        
        .container {
          max-width: 600px;
          margin: 0 auto;
          background-color: #FFFFFF;
          border-radius: 5px;
          padding: 40px;
        }
        
        .title {
          text-align: center;
          font-size: 24px;
          color: #000000;
          margin-bottom: 20px;
        }
        
        .message {
          margin-bottom: 20px;
          color: #000000;
        }
        
        .instructions {
          font-weight: bold;
        }
        
        .new-password {
          margin-top: 30px;
          background-color: #FFC221;
          padding: 10px;
          font-weight: bold;
          border-radius: 5px;
        }
        
        .footer {
          text-align: center;
          margin-top: 40px;
          color: #666666;
        }
        </style>
        </head>
        <body>
          <div class="container">
            <div class="title">Recuperación de contraseña exitosa</div>
            <div class="message">
              <p>Estimado(a) usuario(a),</p>
              <p>Te informamos que hemos recibido una solicitud para ver tus datos de acceso en Bendita Pizza.</p>
              <p>A continuación, te proporcionamos tus datos de acceso:</p>
              <div class="instructions">
                <p><strong>Usuario:</strong> '. $administrador->usuario .'</p>
                <p><strong>Contraseña:</strong> '. $administrador->clave .'</p>
              </div>
              <p>Te recomendamos iniciar sesión de inmediato y cambiar tu contraseña para garantizar la seguridad de tu cuenta.</p>
              <p>Si no solicitaste ver esta información, ignora este correo.</p>
            </div>
            <div class="new-password">
              <p>Importante: Guarda tu contraseña de forma segura.</p>
            </div>
            <div class="footer">
              <p>Atentamente,</p>
              <p>El equipo de Bendita Pizza</p>
            </div>
          </div>
        </body>
        </html>';

    $mail->send();
    header("Location: ../index.php?msj=Se ha enviado un correo a la cuenta correspondiente.");
    exit;
    echo 'Enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar: {$mail->ErrorInfo}";
}