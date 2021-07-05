<?PHP 
    require_once 'conection.php';
    require_once 'includes/helpers.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="./assets/style/style.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="./assets/style/sb-admin-2.css"/> --> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG NEWS</title>
</head>
<body>
    <!-- CABECERA -->
    <header id="header">
        <!--LOGO-->
        <div id="logo">
            <a href="index.php">
               BLOG DE NOTICIAS
            </a>
        </div>
    

    <!-- MENU -->
   
    <nav id="nav">
        <ul>
            <li>
            <a href="index.php"> INICIO</a>
            </li>
        </ul>
             <?php  
                $category_query = newCategory($conection); 
                if(!empty($category_query)):
                while($categories= mysqli_fetch_assoc($category_query)): ?>
                 
                <ul>
                    <li>
                        <a href="category.php?id=<?=$categories['id']?>"> <?=strtoupper($categories['nombre'])?> </a>
                    </li>
                </ul>   
             <?php 
                    endwhile;
                    endif;?>

        <ul>
            <li>
            <a href="contact.php"> CONTACTO</a>
            </li>
        </ul>
        <?php
         if(isset($_SESSION['user'])): ?>
        <ul>
            <li>
            <a href="userEntries.php"> MIS NOTICIAS</a>
            </li>
        </ul>
        <?php endif;?>
    </nav>
    <div class="clearfix"></div>
    </header>
    <div id="container">