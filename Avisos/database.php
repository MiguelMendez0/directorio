<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'grupoas1';

try {
    $connection=new PDO("mysql:host=$server;dbname=$database;",$username,$password );
} catch (PDOException $e) {
    die('La conexión fallo: '.$e->getMessage());
}
    $conn = @mysqli_connect($server,$username,$password,$database);
    mysqli_query($conn,"SET NAMES 'utf8'");
    if (!$conn) {
        echo "Error en la conexión";
    }
    


?>