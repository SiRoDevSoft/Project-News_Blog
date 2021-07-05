<?php require_once 'includes/redirection.php';?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/logueo.php'; ?>
<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>NOTICIAS</h1>

    <?php
        $new_entries = lastEntries($conection, null, null, $_SESSION['user']['id']);
        
         if(!empty($new_entries)):
            
            while($inputs = mysqli_fetch_assoc($new_entries)):
                $date= date_create($inputs['fecha']);
    ?>
    
        <article class="entrada" style= "display: inline-block; width: 80%; text-align: justify;">
        
            <a href="news.php?id=<?=$inputs['categoria_id']?>&n=<?=$inputs['id']?>">
                <h2> <?=$inputs['titulo']?>  <strong class="category-date">- <?=$inputs['categoria']?> - <?=DATE_FORMAT($date,'d/m/Y')?> </strong></h2>
                <strong class="autor">Autor: <?=$inputs['autor'] ?> </strong>
                <p>
                <?=substr($inputs['descripcion'], 0 , 210)?>... <strong class="more">[Leer más...]</strong>
                </p>
            </a>
            
        </article>
        <div style= "display: inline-block; width: 18%;">
           
            <a href="actions/entriesDelete.php?id=<?=$inputs['id']?>&C=<?=$inputs['categoria_id']?>" class="user">Eliminar</a>
            <a href="entriesEdit.php?id=<?=$inputs['id']?>" class="user">Modificar</a>    
        </div>

    <?php 
        
        endwhile;
        endif;
    ?>
    

    

   

</div>
<!--Fin principal-->

<?php require_once 'includes/footer.php'; ?>