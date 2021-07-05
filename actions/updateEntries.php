<?php
if(isset($_POST)){
    // Conectar con la base de datos
    require_once '../includes/conection.php';

    //Guardamos la sesion del usuario com el id de user para guardar la nueva entrada
    $user=$_SESSION['user']['id'];
    // recogemos los datos recibidos del formulario y los asignamos en variables
    $entrieId= isset($_GET['id']) ? mysqli_real_escape_string($conection,$_GET['id']) : false;
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
        $sql_updatetEntries = "UPDATE entradas SET categoria_id='$category', titulo='$title', descripcion='$description', link='$link' WHERE `entradas`.`id` = $entrieId;";
        $save_query = mysqli_query($conection, $sql_updatetEntries);
        
        //Creation of Registers for admin
        $detail= "News Modification";
        
        if ($save_query) {
            $sql_insertRegister = "INSERT INTO registro VALUES (null,'$entrieId','$category','$user',NOW(),'$detail');";
            $save_query = mysqli_query($conection, $sql_insertRegister);    
        }
        header('Location:../index.php');
       
    }else{
        
        $_SESSION["fail_entries"]= $fail;
        header('Location:../new_Entries.php');
    }
    

}
