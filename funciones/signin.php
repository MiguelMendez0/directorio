<?php
require 'db.php';


function usuarioExiste($email, $pdo) {

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);


    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE UsuarioEmail = :email");

    $stmt->execute(array(':email' => $email));

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($user !== false);
}


function registrarUsuario($email, $password, $pdo) {

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_SANITIZE_STRING);


    if (usuarioExiste($email, $pdo)) {
        return false;
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {

        $stmt = $pdo->prepare("INSERT INTO usuarios (UsuarioEmail, UsuarioPass, UsuarioPrivilegio) VALUES (:email, :password, 1)");

        $stmt->execute(array(':email' => $email, ':password' => $hashed_password));

        return true;
        
    } catch (PDOException $e) {

        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}


if (($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin'])) && ($sesion['UsuarioPrivilegio'] == 2)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    //registrarUsuario($email, $password, $pdo);

    if (registrarUsuario($email, $password, $pdo)) {
        $message = 'registro';
    } else {
        $message = 'existe';
    }
}
?>
