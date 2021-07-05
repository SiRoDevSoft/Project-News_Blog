<?php


if(isset($_POST)){
//Cargar la conexion a la base de datos
require_once '../includes/conection.php';
    if(!isset($_SESSION)){   
        session_start();
    }
    //Recoger los valores del formulario de registro
    // mysqli_real_escape_string($conection, $_POST['name']) => Es para escapar de datos qu me pueden ocacionar conflictos en la base de datos, por si son guardados con comillas o caracteres extraños. Brinda mas seguridad al sistema
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conection, $_POST['name']) : false;
    $surname = isset($_POST['surname']) ? mysqli_real_escape_string($conection, $_POST['surname']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conection,trim($_POST['email'])) : false;
    $password = isset($_POST['pass']) ? mysqli_real_escape_string($conection, $_POST['pass']) : false;

    //Array de errores
    $incorrect = array();


    //Validar la informacion antes de guardar los datos en la base de datos

    //Name validation
    if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)){
        
        $name_validate = true;
    }elseif (!empty($name)){
        $name_validate = false;
        $incorrect['name'] = "This name is not valid ";
    }else{
        $incorrect['name'] = "This field must not be empty ";
    }
    //Surname validation
    if(!empty($surname) && !is_numeric($surname) && !preg_match("/[0-9]/", $surname)){
        
        $surname_validate = true;
    }elseif (!empty($surname)){
        $surname_validate = false;
        $incorrect['surname'] = "This surname is not valid "; 
    }else{
        $incorrect['surname'] = "This field must not be empty ";
    }
    //Email validation
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        
        $email_validate = true;
    }elseif (!empty($email)){
        $email_validate = false;
        $incorrect['email'] = "This email is not valid ";
    }else{
        $incorrect['email'] = "Email must not be empty ";
    }
    //Password validation
    if(!empty($password)){          
            $pass_validate = true;
        }else{
            $pass_validate = false;
            $incorrect['pass'] = "This password field must not be empty ";
    }

    if(strlen($password)<8){
        echo "Password must be longer than 8 characters ";
        $pass_validate = false;
        $incorrect['pass'] = "This password is not valid ";
    }

    $user_add = false;

    if(count($incorrect)==0){

            $user_add = true;

        // CIFRAR LA CONTRASEÑA

        $pass_secure = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
            
        //insertar usuarios en la tabla de usuarios en la base de datos

        $SQL = "INSERT INTO usuarios VALUES (null, '$name', '$surname', '$email', '$pass_secure', CURDATE());";
        $save_query = mysqli_query ($conection, $SQL);

        // var_dump(mysqli_error($conection));
        // die();

            if($save_query){
               
                 $_SESSION['completed'] = "&#9989; Registration was completed successfully";
               

            } else {
                $_SESSION['incorrect']['general'] = "&#9888; Registration could not be completed";
            }

            // var_dump($password);
            // var_dump($pass_secure);
            // var_dump(password_verify($password, $pass_secure));
                // header('Location:../usuarios.php');
               

    } else {

        $_SESSION['incorrect'] = $incorrect;

        
    }
}
header('Location: ../index.php');
// header('Location:../usuarios.php');

