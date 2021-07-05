<?php require_once 'includes/helpers.php'; ?>
<?php require_once 'includes/conection.php'; ?>
<?php

$search = $_POST['search'];

    if(!isset($search)){
 
        header("Location:index.php");
        
    } 
    $Search = lastEntries($conection, true, null, null, $search) ;
    
    if(!empty($Search)){
        $var=0;
        while(mysqli_fetch_assoc($Search)){
             $var=$var+1;
        }
    }else{
        $var=0;
    }

    
   
    // Creamos la pagina de resultados encontrados
    require_once 'includes/header.php';
    require_once 'includes/logueo.php'; 
      ?>
        
    <!-- CAJA PRINCIPAL -->
    <div id="principal">
    <h1>[<?=$var?>] Resultados encontrados: "<?=$search?>"</h1>
    
    
    <?php        
    $Total = lastEntries($conection, true, null, null, $search) ;
        if(empty($Total)) : 
            ?>

        </br>
           <p>No se encontraron resultados</p>
        </br>
        <?php
        endif;
        if(!empty($Total)):
        
            
            while($inputs = mysqli_fetch_assoc($Total)):
                
                $date= date_create($inputs['fecha']);
            
    ?>
    <article class="entrada">
    
        <a href="news.php?id=<?=$inputs['categoria_id']?>&n=<?=$inputs['id']?>">
            <h2> <?=$inputs['titulo']?>  <strong class="category-date">- <?=$inputs['categoria']?> - <?=DATE_FORMAT($date,'d/m/Y')?> </strong></h2>
            <strong class="autor">Autor: <?=$inputs['autor'] ?> </strong>
            <p>
               <?=substr($inputs['descripcion'], 0 , 210)?>... <strong class="more">[Leer más...]</strong>
            </p>
        </a>
    </article>

    <?php 
     
    endwhile;
    
   
    endif;
  
    ?>
    
    

</div></br>
<!--Fin principal-->

<?php require_once 'includes/footer.php'; ?>