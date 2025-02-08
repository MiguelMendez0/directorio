<?php 
// Información de la base de datos
$host = 'localhost:3306';
$dbname = 'directorio';
$username = 'root';
$password = '';

// Intentar conectarse a la base de datos
try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    die();
}
?>