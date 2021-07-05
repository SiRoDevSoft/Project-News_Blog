<?php

if(isset($_POST)){
    require_once '../includes/conection.php';

   $name = isset($_POST['name']) ? mysqli_real_escape_string($conection,$_POST['name']) : false;

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

   if(count($incorrect)==0){
       $sql_insertCategory= "INSERT INTO categorias VALUES (null,'$name');";
       $save_query = mysqli_query ($conection, $sql_insertCategory);
       
   }
}
 header('Location: ../index.php');