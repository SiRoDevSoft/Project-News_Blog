<?php


if(isset($_POST)){
    //Cargar la conexion a la base de datos
    require_once '../includes/conection.php';
        if(!isset($_SESSION)){   
            session_start();
        }
        $user=$_SESSION['user']['id'];
        //Recoger los valores del formulario de registro
        // mysqli_real_escape_string($conection, $_POST['name']) => Es para escapar de datos qu me pueden ocacionar conflictos en la base de datos, por si son guardados con comillas o caracteres extraños. Brinda mas seguridad al sistema
        $name = isset($_POST['name']) ? mysqli_real_escape_string($conection, $_POST['name']) : false;
        $surname = isset($_POST['surname']) ? mysqli_real_escape_string($conection, $_POST['surname']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conection,trim($_POST['email'])) : false;
    
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
            $incorrect['name'] = "No changes were made";
        }
        //Surname validation
        if(!empty($surname) && !is_numeric($surname) && !preg_match("/[0-9]/", $surname)){
            
            $surname_validate = true;
        }elseif (!empty($surname)){
            $surname_validate = false;
            $incorrect['surname'] = "This surname is not valid "; 
        }else{
            $incorrect['surname'] = "No changes were made ";
        }
        //Email validation
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            
            $email_validate = true;
        }elseif (!empty($email)){
            $email_validate = false;
            $incorrect['email'] = "This email is not valid ";
        }else{
            $incorrect['email'] = "No changes were made ";
        }
       
    
       
        $user_add = false;
    
        if(count($incorrect)==0){
          
                $user_add = true;

            //Consultamos si email no existe
            $sql_verify = "SELECT id, email FROM usuarios WHERE email='$email'";
            $isset_email=mysqli_query($conection, $sql_verify);
            $isset_user= mysqli_fetch_assoc($isset_email);
            
            
            //verificamos si email existe
            if($isset_user['id']==$user || empty($isset_user)){

                //Modificar usuarios en la tabla de usuarios en la base de datos
        
                $SQL = "UPDATE usuarios SET nombre='$name', apellidos='$surname', email='$email' WHERE id=$user";
                $save_query = mysqli_query ($conection, $SQL);
        
                    if($save_query){
                        $_SESSION['user']['nombre']=$name;
                        $_SESSION['user']['apellidos']=$surname;
                        $_SESSION['user']['email']=$email;

                    
                        $_SESSION['completed'] = "&#9989; Registration was completed successfully";
                    
                    }else{
                        $_SESSION['incorrect']['general'] = "&#9888; Registration could not be completed";
                        }
            }else{
                $_SESSION['incorrect']['general'] = "&#9888; Bad email: existing user";
            }
                   
    
        } else {
    
            $_SESSION['incorrect'] = $incorrect;
    
            
        }
    }
    header('Location: ../user_Data.php');
    
    
    