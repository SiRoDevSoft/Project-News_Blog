<!-- BARRA LATERAL -->
<aside id="sidebar">

    <div id="search" class="block-true">
        <div class="box">
            <div class="container-1">
                <form action="search.php" method="post">
                <input type="search" id="search" name="search" placeholder="Search..." />
                <input id="button" type="submit" value="Buscar"></input>
                </form>
            </div>
        </div>
    </div>

    <!-- Bloque de logeo -->

    <?php if(isset($_SESSION['user'])): ?>
    <div id="user_login" class="block-true">
        <div class="text-alert">
            <h3>Bienvenido, <?= $_SESSION['user']['nombre'].' '.$_SESSION['user']['apellidos']; ?></h3>
            <!-- BOTONES DE SALIDA -->
            <a href="new_Entries.php" class="entradas">Crear entradas</a>
            <a href="new_Category.php" class="category">Crear categorias</a>
            <a href="user_Data.php" class="user">Mis datos</a>
            <a href="users/close/session.php" class="exit">Cerrar Sesión</a>

        </div>
    </div>
    <?php endif;?>



    <?php if(!isset($_SESSION['user'])): ?>
    <!-- Bloque de Login -->
    <div id="login" class="block-aside">
        <h3>Inicia sesión</h3>

        <?php if(isset($_SESSION['login_error'])): ?>
        <div id="error_login" class="block-alert">
            <h3>¡¡Error, <?= $_SESSION['login_error'];?></h3>
        </div>
        <?php endif; ?>

        <form action="users/login.php" method="POST">
            <label for="mail"> Email</label>
            <input type="email" name="email" placeholder="📧 Email" />

            <label for="pasword"> Password</label>
            <input type="password" name="pass" placeholder="🔐 Password" />

            <input type="submit" value="Login" />
        </form>
    </div>

    <!-- Bloque de registracion -->
    <div id="register" class="block-aside">
        <!-- MOSTRAR ERRORES -->
        <?php if(isset($_SESSION['completed'])): ?>

        <div class="alerta-exito">
            <?=$_SESSION['completed']?>
        </div>

        <?php elseif(isset($_SESSION['incorrect']['general'])): ?>
        <div class="warning">
            <?=$_SESSION['incorrect']['general'] ?>
        </div>

        <?php endif; ?>

        <h3>Registro</h3>

        <form action="users/register.php" method="POST">
            <label for="nombre"> Nombre</label>
            <input type="text" name="name" placeholder="Nombre" />
            <?php echo isset($_SESSION['incorrect']) ? viewError($_SESSION['incorrect'], 'name') : ''; ?>


            <label for="apellido"> Apellido</label>
            <input type="text" name="surname" placeholder="Apellido" />
            <?php echo isset($_SESSION['incorrect']) ? viewError($_SESSION['incorrect'], 'surname') : ''; ?>


            <label for="mail"> Email</label>
            <input type="email" name="email" placeholder="Email" />
            <?php echo isset($_SESSION['incorrect']) ? viewError($_SESSION['incorrect'], 'email') : ''; ?>

            <label for="password"> Password</label>
            <input type="password" name="pass" placeholder="Password" />
            <?php echo isset($_SESSION['incorrect']) ? viewError($_SESSION['incorrect'], 'pass') : ''; ?>

            <input type="submit" value="Registrar" name="register" />
        </form>

        <!-- Cierre de session -->
        <?php errorDelete(); ?>


    </div>
    <?php endif;?>
</aside>