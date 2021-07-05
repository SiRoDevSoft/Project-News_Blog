<?php
//Iniciar la sesion y la conexion a la base de datos
require_once '../includes/conection.php';
    if(!isset($_SESSION)){   
        session_start();
    }
// recoger los datos del formulario
if(isset($_POST)){
    $mail= trim($_POST['email']);
    $password= $_POST['pass'];

    // consulta para comprobar las credenciales del usuario
    $sql_search = "SELECT * FROM usuarios WHERE email= '$mail'";
    $login = mysqli_query($conection, $sql_search);

    if($login && mysqli_num_rows($login)==1){
        $user = mysqli_fetch_assoc($login);
       
        // Comprobar la contraseña con la funcion de VERIFY
       $verify = password_verify($password, $user['password']);
      
       
       //Comprobar la contraseña
       if($verify){

           //utilizar una session para guardar los datos del usuario logueado
           $_SESSION['user'] = $user;

           if(isset($_SESSION['login_error'])){
               session_unset($_SESSION['login_error']);
           }

       }else{

           //Si algo falla enviar una sesion con el fallo
           $_SESSION['login_error'] = "Login Incorrect!!";
       }

    } else {
        $_SESSION['error'] = "Login Incorrect!!";
    }

}
// var_dump($_SESSION['user']);
// redirigir al index
 header('Location: ../index.php');