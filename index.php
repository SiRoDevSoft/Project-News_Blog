<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/logueo.php'; ?>
<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>ULTIMAS NOTICIAS</h1>

    <?php
        $new_entries = lastEntries($conection, $limit=true, null);
        
         if(!empty($new_entries)):
            
            while($inputs = mysqli_fetch_assoc($new_entries)):
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
    

    <div id="ver">
        <a href="entries.php">VER TODAS LAS ENTRADAS</a>
    </div>

   <!-- <div class="video">
   <iframe allow='encrypted-media' width='700' height='700' 
   marginwidth='0' marginheight='0' scrolling='no' frameborder='0' 
   allowfullscreen='yes' src='https://freefeds.com/stream/54013.html'></iframe>
   </div> -->

</div>
<!--Fin principal-->

<?php require_once 'includes/footer.php'; ?>