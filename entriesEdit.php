<?php require_once 'includes/redirection.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/logueo.php'; ?>
<?php

    $entrie = searchInputs($conection, $_GET['id']);
    if(!isset($entrie['id'])){
        header("Location:index.php");
            }else{
                
                $date= date_create($entrie['fecha']);
            }
    
           
        ?>
<div id="principal">
    <h1>Editar Tus Noticias</h1>

    <form action="actions/updateEntries.php?id=<?=$entrie['id']?>" method="POST">
        <?php 
            $entrieCategory = searchCategory($conection, $entrie['categoria_id']);

        ?>
        <h3>Noticia de <?=strtolower($entrieCategory['nombre'])?> creado el: <?=DATE_FORMAT($date,'d/m/Y')?></h3>

        <label for="title">Modificar Título a:</label>
        <input type="text" name="title" value="<?=$entrie['titulo']?>" />
        <?php echo isset($_SESSION['fail_entries']) ? viewError($_SESSION['fail_entries'], 'title') : ''; ?>

        <!-- Selector de categorias -->
        <label for="category">Modificar Categoria a: <?=$entrieCategory['nombre']?></label>
        <select name="category">
            <?php 
        //Listamos categorias
        $categoryId = newCategory($conection);

        if(!empty($categoryId)):

        while($Array_category = mysqli_fetch_assoc($categoryId)):

                ?>
            <option value="<?=$Array_category['id']?>">
                <?=strtoupper($Array_category['nombre'])?>
            </option>
            <?php 
                endwhile;
                endif; 
            ?>
                            
        </select>
        <?php echo isset($_SESSION['fail_entries']) ? viewError($_SESSION['fail_entries'], 'category') : ''; ?>


        <label for="link">Link:</label>
        <input type="url" name="link" value="<?=$entrie['link']?>" />
        <?php echo isset($_SESSION['fail_entries']) ? viewError($_SESSION['fail_entries'], 'link') : ''; ?>


        <label for="description">Descripcion:</label>
        <textarea name="description"><?=$entrie['descripcion']?></textarea>
        <?php echo isset($_SESSION['fail_entries']) ? viewError($_SESSION['fail_entries'], 'description') : ''; ?>

        <input type="submit" value="Guardar" />

    </form>

    <?php errorDelete(); ?>

</div>
<?php require_once 'includes/footer.php'; ?>