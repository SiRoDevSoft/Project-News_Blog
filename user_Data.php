<?php 
    require_once 'includes/redirection.php';
    require_once 'includes/header.php'; 
    require_once 'includes/logueo.php'; 
    $user_nick =  $_SESSION['user']['nombre'];
    $user_surname= $_SESSION['user']['apellidos'];
    $user_mail= $_SESSION['user']['email'];
    $user_fecha= date_create($_SESSION['user']['fecha']);
?>
 <div id="principal">
        <h1>DATOS PERSONALES</h1>
        <div class="dataModify">

        <!-- Copiamos el formulario de registro -->
            <?php if(isset($_SESSION['completed'])): ?>
                        
                        <div class="alerta-exito"> 
                             <?=$_SESSION['completed']?>
                        </div>

                 <?php elseif(isset($_SESSION['incorrect']['general'])): ?>
                         <div class="warning"> 
                             <?=$_SESSION['incorrect']['general'] ?>
                         </div>

                 <?php endif; ?>

                <form action="actions/modifyData.php" method="POST">
                    <label for="nombre"> Nombre</label>
                    <input type="text" name="name" placeholder="Nombre" required="required"/> &#128395;
                    <?php echo isset($_SESSION['incorrect']) ? viewError($_SESSION['incorrect'], 'name') : ''; ?>


                    <label for="apellido"> Apellido</label>
                    <input type="text" name="surname" placeholder="Apellido" required="required"/>
                    <?php echo isset($_SESSION['incorrect']) ? viewError($_SESSION['incorrect'], 'surname') : ''; ?>
 

                    <label for="mail"> Email</label>
                    <input type="email" name="email" placeholder="Email" required="required"/>
                    <?php echo isset($_SESSION['incorrect']) ? viewError($_SESSION['incorrect'], 'email') : ''; ?>
                    
                    

                    <input type="submit" value="MODIFICAR" name="submitData"/>
                   
                </form>

                <!-- Cierre de session -->
                <?php errorDelete(); ?>
                
               
        </div>
            <div class="img_User" >
                <img  src="assets/img/user.png" title="user" /> 
                
            </div>
            <div class="block-data"> 
                <h4>Nombre: <?= $user_nick?></h4>                       
                <h4>Apellido: <?= $user_surname?></h4>                       
                <h4>Email: <?= $user_mail?></h4>                       
                <h4>Fecha Registro: <?= DATE_FORMAT($user_fecha, 'd/m/Y')?></h4>                       
                <a href="">Cambiar Imagen</a>
                
                
               
            </div>
            <a class="delete" href="actions/dropUser">Eliminar Cuenta</a>      


    </div>
    <!--Fin principal-->

<?php require_once 'includes/footer.php'; ?>