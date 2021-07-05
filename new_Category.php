<?php 
    require_once 'includes/redirection.php';
    require_once 'includes/header.php'; 
    require_once 'includes/logueo.php'; 
?>

    <div id="principal">
        <h1>CATEGORIAS</h1>

        <form action="actions/category.php" method="POST">
            <h2 class="title_newCategory">Crear nuevas categorias</h2>
            <label for="name">Nombre de la categoria:</label>
            <input type="text" name="name" placeholder="Escribe aquí.."/>

            <input type="submit" value="Guardar"/>
        
        </form>



    </div>
    <!--Fin principal-->

<?php require_once 'includes/footer.php'; ?>