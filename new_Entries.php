<?php
    require_once 'includes/redirection.php';
    require_once 'includes/header.php'; 
    require_once 'includes/logueo.php'; 
?>

    <div id="principal">
        <h1>Nuevas Noticias</h1>

        <form action="actions/entries.php" method="POST">
            <h3>Agregar nueva información al blog</h3>
                
                <label for="title">Título:</label>
                <input type="text" name="title" placeholder="Escribe aquí.."/>
                <?php echo isset($_SESSION['fail_entries']) ? viewError($_SESSION['fail_entries'], 'title') : ''; ?>

                <label for="category">Categoria:</label>
                    <select name="category">
                        <?php
                            $categoryId = newCategory($conection);
                            if(!empty($categoryId)):
                            while ($Array_category = mysqli_fetch_assoc($categoryId)):
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
                <input type="url" name="link" placeholder="Escribe aquí.."/>
                <?php echo isset($_SESSION['fail_entries']) ? viewError($_SESSION['fail_entries'], 'link') : ''; ?>


                <label for="description">Descripcion:</label>
                <textarea name="description" placeholder="Escribe aquí.."></textarea>
                <?php echo isset($_SESSION['fail_entries']) ? viewError($_SESSION['fail_entries'], 'description') : ''; ?>

            <input type="submit" value="Guardar"/>
        
        </form>

        <?php errorDelete(); ?>

    </div>
    <!--Fin principal-->

<?php require_once 'includes/footer.php'; ?>