<?php 
require_once '../includes/conection.php';
require_once '../includes/helpers.php';

if (isset($_SESSION['user'])) {
    $inputUser=$_GET['id']; //Recoge el id de la entrada a eliminar
    $category=$_GET['C']; //Recoge el id de la categoria a eliminar
    
    $sessionUser=$_SESSION['user']['id']; //Recoge los datos de la sesion del usuario

    $queryDelete="DELETE FROM entradas WHERE usuario_id = $sessionUser AND id= $inputUser";

    $query_Delete = mysqli_query($conection, $queryDelete);

    //Create register delete
    $detail="News deleted";
    
    if($query_Delete){

        $sql_insertRegister = "INSERT INTO registro VALUES (null,' $inputUser','$category','$sessionUser',NOW(),'$detail');";
        $save_query = mysqli_query($conection, $sql_insertRegister);
    }
}

header("Location:../index.php"); //Redirigir al inicio de la pagina
?>
