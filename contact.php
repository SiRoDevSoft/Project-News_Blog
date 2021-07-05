<?php require_once 'includes/header.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="contact-title">
    <h1 >CONTACTANOS</h1>

    <?php ?>
    <div class="contact">
        <h3>Cuentanos lo que sucede..</h3>

        <form action="actions/contacto.php" method="POST">
            <label for="nombre"> Nombre</label>
            <input type="text" name="name" placeholder="Nombre" />
            <?php echo isset($_SESSION['incorrect']) ? viewError($_SESSION['incorrect'], 'name') : ''; ?>

            <label for="email"> Email</label>
            <input type="email" name="email" placeholder="Email" />
            <?php echo isset($_SESSION['incorrect']) ? viewError($_SESSION['incorrect'], 'email') : ''; ?>

            <label for="message">Mensaje</label>
            <textarea name="message" placeholder="Escribe aquí.."></textarea>
            <?php echo isset($_SESSION['fail_entries']) ? viewError($_SESSION['fail_entries'], 'description') : ''; ?>

            <input type="submit" value="Contactar" name="register" />
        </form>
    </div>
        <!-- Cierre de session -->
        <?php errorDelete(); ?>

<!--Fin principal-->

<?php require_once 'includes/footer.php'; ?>