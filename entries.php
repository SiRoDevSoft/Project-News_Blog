<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/logueo.php'; ?>
<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>TOTAL DE NOTICIAS</h1>

    <?php
        $new_entries = lastEntries($conection, null, null);
        if(!empty($new_entries)):
            
            while($inputs = mysqli_fetch_assoc($new_entries)):
                $date= date_create($inputs['fecha']);
    ?>
    <article class="entrada">
    
        <a href="<?=$inputs['link']?>">
            <h2> <?=$inputs['titulo']?>  <strong class="category-date">- <?=$inputs['categoria']?> - <?=DATE_FORMAT($date,'d/m/Y')?> </strong></h2>
            <strong class="autor">Autor: <?=$inputs['autor'] ?> </strong>
            <p>
               <?=substr($inputs['descripcion'], 0 , 210)?>... <strong class="more"> <a href="<?=$inputs['link']?>">[Leer más...]</a></strong>
            </p>
        </a>
    </article>

    <?php 
        
        endwhile;
        endif;
    ?>
    


</div>
<!--Fin principal-->

<?php require_once 'includes/footer.php'; ?>