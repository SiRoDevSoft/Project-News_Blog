<?PHP
//Conexión

$server="localhost";
$username= "root";
$password= ""; 
$database="blog";
$conection= mysqli_connect($server, $username,$password,$database);

mysqli_query($conection, "SET NAMES 'utf8'");

//Iniciar la session

if(!isset($_SESSION)){
    session_start();
}