<?php
// Enlazamos con el archivo de funcionalidades
require_once '../includes/helpers.php';
if(!isset($_POST)){
    // Conectar con la base de datos
    header("Location: ../index.php");

    
}
// var_dump($_POST);
// die("Hasta aqui llegaste...");

$destino = "Silvioro.ads11@gmail.com";
   


if(isset($_POST)){

    //Recoger los valores del formulario de contacto
    isset($_POST['name'])? $name=$_POST['name'] : false;
    isset($_POST['email'])? $email= $_POST['email']: false;
    isset($_POST['message'])? $msje = $_POST['message']: false;
}
    //Array de errores para luego utilizar alertas de errores
    $incorrect= array();

    //Validation name
    if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)){
        $name_validate = $name;
       
        }elseif(!empty($name)){
            $name_validate=true;
     
        $incorrect['name']="This name is not valid"; //Alerta si existe este error
        }
            
    //Email validation
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        
        $email_validate = true;
    }elseif (!empty($email)){
        $email_validate = false;
        $incorrect['email'] = "This email is not valid "; //Alerta si existe este error
    }else{
        $incorrect['email'] = "Email must not be empty "; //Alerta si existe este error
    }
    
     //Message validation
     if(!empty($msje)){
         $msje_validate= true;
     }else{
         $msje_validate = false;
         $incorrect['message'] = "This message is not valid"; //Alerta si existe este error
     }
//Estructurar el contenido de la informacion recibida
    if(count($incorrect) == 0){
        $content = "Nombre ". $name . "<br>Email: ".$email. "<br> MENSAJE: ".$msje;

    }else{
        $content = "null";
    }



//Utilizar la libreria de PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Instanciancion y habilitaciones de excepciones
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                        // Enable verbose debug output
    $mail->isSMTP();                                                              // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                                         // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                                     // Enable SMTP authentication
    $mail->Username   = 'Pruebasclientesercam@gmail.com'; //Se debe configurar en la cuenta el acceso. SMTP username
    $mail->Password   = 'XRMISSION3.0';                                           // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                           // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                                      // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('Pruebasclientesercam@gmail.com', 'Administrador de Usuarios');
    $mail->addAddress($destino, $name);                                       // Add a recipient


    

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Blog de Noticias';
    $mail->Body    = $content;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //Envio de mensaje

    $mail->send();
    echo'<script> alert("El mensaje se envío correctamente\nGracias por contactarse con nosotros.");
    window.location.replace("../index.php");</script>';
  
    
    //En caso de reportar algun error
} catch (Exception $e) {
    echo '<script>
    alert("El mensaje no se envío");
    window.location.replace("../index.php")
    </script>'." Mailer Error: {$mail->ErrorInfo }";
    
}


?>