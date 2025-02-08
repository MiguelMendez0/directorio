<?php 
require 'db.php';

function verificarCredenciales($email, $password, $pdo) {

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_SANITIZE_STRING);


    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE UsuarioEmail = :email");

    $stmt->execute(array(':email' => $email));

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['UsuarioPass'])) {
            $_SESSION['user_id'] = $user['UsuarioId'];
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (verificarCredenciales($email, $password, $pdo)) {
        $message = 'login'; // Indica éxito
    } else {
        $message = 'error'; // Indica error
    }
}
?>