<?php
// Enlazamos con el archivo de funcionalidades
require_once '../includes/helpers.php';
if(isset($_POST)){
    // Conectar con la base de datos
    require_once '../includes/conection.php';

    //Guardamos la sesion del usuario com el id de user para guardar la nueva entrada
    $user=$_SESSION['user']['id'];
    // recogemos los datos recibidos del formulario y los asignamos en variables
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conection,$_POST['title']) : false;
    $category = isset($_POST['category']) ? (int)$_POST['category']: false;
    $link = isset($_POST['link']) ? mysqli_real_escape_string($conection,$_POST['link']) : false;
    $description = isset($_POST['description']) ? mysqli_real_escape_string($conection,$_POST['description']) : false;
 

 
    //Validation
    $fail= array();
    
    if(empty($title)){
        $fail['title']= 'This title is not valid';
    }
    if(empty($category) && !is_numeric($category)){
        $fail['category']= 'The category is not correct';
    }
    if(empty($link)){
        $fail['link']= 'HTTP Error 404 not found';
    }
    if(empty($description)){
        $fail['description']= 'The description is not correct';
    }
   
    if(count($fail)==0){
        $sql_insertEntries = "INSERT INTO entradas VALUES (null,$user,$category,'$title','$description',CURDATE(),'$link');";
        $save_query = mysqli_query($conection, $sql_insertEntries);
        
        //Create register delete for admin
        $detail="New news added";
        
        if($save_query){
            $entrie_id= idnewEntrie($conection); //Consulta en la base de datos el nuevo registro agregado
            $id = $entrie_id['id'];  //Seleccionamos del array obtenido el id
            
            $sql_insertRegister = "INSERT INTO registro VALUES (null,'$id','$category','$user',NOW(),'$detail');";
            $save_query = mysqli_query($conection, $sql_insertRegister);

        }
        
        header('Location:../index.php');
       
    }else{
        
        $_SESSION["fail_entries"]= $fail;
        header('Location:../new_Entries.php');
    }
    

}
