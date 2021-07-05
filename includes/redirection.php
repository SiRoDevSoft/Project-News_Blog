<?php 
//Comprobamos si la sesion esta iniciada sino la iniciamos
if(!isset($_SESSION)){
session_start();
}

/* Para evitar entrar a funcionalidades sin identificarse se redirecciona 
 la pagina al inicio */
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}