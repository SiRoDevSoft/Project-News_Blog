<?php

//Visualizar error
function viewError($invalid, $camp){
    $alert='';
    if(isset($invalid[$camp]) && !empty($camp)){
        $alert = '<div class="alerta-error">&#10060; '.$invalid[$camp].'</div>'; 
      
    }
    return $alert;
}
//Visualizar alertas sin cambios
function withoutChanges($invalid, $camp){
    $alert="";
    if(isset($invalid[$camp]) && !empty($camp)){
        $alert = '<div class="alerta-cambio">&#11093; '.$invalid[$camp].'</div>';
    }
    return $alert;
}

//Eliminar sesion con errores
function errorDelete(){
    $delete = false;
    if(isset($_SESSION['incorrect'])){
        $_SESSION['incorrect'] = null;
        $delete=true;
        // $delete= session_unset($_SESSION['incorrect']);
    }
    if(isset($_SESSION['fail_entries'])){
        $_SESSION['fail_entries'] = null;
        $delete=true;
        var_dump($_SESSION);
        die();
        // $delete= session_unset($_SESSION['fal_entries']);
    }
    if(isset($_SESSION['completed'])){
        $_SESSION['completed'] = null;
        $delete=true;
        // $delete= session_unset($_SESSION['completed']);
    }  
    
   
    return $delete;
}

//Agregar nuevas categorias
function newCategory($conection){ //Como no se reconocia la conexion a la base de datos se establece el parametro de la funcion con el nombre de la conexion a la base de datos
        $sql_category= "SELECT * FROM categorias ORDER BY id ASC";
        $category = mysqli_query($conection, $sql_category);

        $result= array();

        if($category && mysqli_num_rows($category)>=1){
            $result= $category;
        }
    return $result;

}

//Listar por categoria
function searchCategory($conection, $id){ //Como no se reconocia la conexion a la base de datos se establece el parametro de la funcion con el nombre de la conexion a la base de datos
        $sql_category= "SELECT * FROM categorias WHERE id= $id;";
        $category = mysqli_query($conection, $sql_category);

        $result= array();

        if($category && mysqli_num_rows($category)>=1){
            $result= mysqli_fetch_assoc($category);
        }
    return $result;

}
//Editar categorias 
function idnewEntrie($conection){
    $sql= "SELECT id FROM entradas ORDER BY id DESC LIMIT 1";
    $query = mysqli_query($conection, $sql);

    $result = array();
    if($query && mysqli_num_rows($query)>=1){
        $result= mysqli_fetch_assoc($query);
    }
return $result;

}


//Listar por entradas
function searchInputs($conection, $id){ 
        $sql_EntriesTable= "SELECT * FROM entradas WHERE id= $id;";
        
        $inputsResult = mysqli_query($conection, $sql_EntriesTable);

        $result= array();
        
        if($inputsResult && mysqli_num_rows($inputsResult)>=1){
            $result= mysqli_fetch_assoc($inputsResult);
        }
    return $result;

}


//Visualizar las ultimas entradas de noticias en la base de datos
function lastEntries($conection, $limit= null, $idCategory= null, $user=null, $search=null){
    $sql_entries= "SELECT E.*, C.nombre as 'categoria', 
                CONCAT(U.nombre,' ',U.apellidos) as 'autor'
                FROM entradas E 
                    INNER JOIN categorias C ON E.categoria_id = C.id 
                    INNER JOIN usuarios U ON E.usuario_id = U.id ";
                    
    if(!empty($idCategory)){
        $sql_entries.= "WHERE E.categoria_id = $idCategory";
      
    }  
    if(!empty($user)){
        $sql_entries.="WHERE E.usuario_id= $user";
    }
    if(!empty($search)){
        $sql_entries.="WHERE E.titulo LIKE '%$search%'";
    }
    
    $sql_entries.=" ORDER BY E.id DESC ";
     
    if($limit!=null){
        //Condicionamos un limite de entradas a mostrar en el blog
        $sql_entries.= "LIMIT 4";
    }
    $entries = mysqli_query($conection, $sql_entries);
    $result = array();

    if($entries && mysqli_num_rows($entries)>=1){
        $result = $entries;

    }
   
    return $result;

}

//Listar todas las noticias de usuarios
function listNews($conection, $id_user){ 
    $sql_list= "SELECT * FROM categorias WHERE id= $id_user;";
    $category = mysqli_query($conection, $sql_list);

    $result= array();

    if($category && mysqli_num_rows($category)>=1){
        $result= mysqli_fetch_assoc($category);
    }
return $result;

}

//Crar una funcion para buscar en el blog
function searchBlog($conection, $var){
    $sql_search= "SELECT * FROM entradas WHERE titulo LIKE '%$var%'";
    $search= mysqli_query($conection, $sql_search);

    $result= array();

    if($search && mysqli_num_rows($search)>=1){
        $result= mysqli_fetch_assoc($search);
    }
return $result;
}

function news($conection, $idNews){
    $sql_search= "SELECT E.*, CONCAT(U.nombre,' ',U.apellidos) AUTOR FROM entradas E INNER JOIN usuarios U ON E.usuario_id=U.id where E.id=$idNews";
    $search= mysqli_query($conection, $sql_search);

    
    if($search && mysqli_num_rows($search)>=1){
        $result= array();
       $result= mysqli_fetch_assoc($search);
    }
return $result;
}