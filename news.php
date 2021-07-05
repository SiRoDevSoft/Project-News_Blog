<?php require_once 'includes/helpers.php'; ?>
<?php require_once 'includes/conection.php'; ?>
<?php
        $categoryId= searchCategory($conection, $_GET['id']);
        if(!isset($categoryId['id'])){
            header("Location:index.php");
        }
    ?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/logueo.php'; ?>
<!-- CAJA PRINCIPAL -->
<div id="principal">
    
    <?php
        $inputs = news($conection, $_GET['n']);
    ?>

    <h1>Noticia</h1>

    <?php
        
      
        if(!empty($inputs)):
            // var_dump($entries);
            // die();
           
                $date= date_create($inputs['fecha']);
    ?>
    <article class="entrada">
    
        <a href="<?=$inputs['link']?>">
            <h2> <?=$inputs['titulo']?>  <strong class="category-date">- <?=$categoryId['nombre']?> - <?=DATE_FORMAT($date,'d/m/Y')?> </strong></h2>
            <strong class="autor">Autor: <?=$inputs['AUTOR'] ?> </strong>
            <p>
               <?=substr($inputs['descripcion'], 0 , 210)?>... <strong class="more"><a href="<?=$inputs['link']?>">[Leer más...]</a></strong>
            </p>
        </a>
       
    </article>

    <?php 
        
       
    endif;
    ?>
   
    

</div>
<!--Fin principal-->

<?php require_once 'includes/footer.php'; ?>