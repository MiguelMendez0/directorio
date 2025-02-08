<?php

if (isset($_SESSION['user_id'])) {
    
  $stmt = $pdo->prepare('SELECT UsuarioId, UsuarioEmail, UsuarioPrivilegio FROM usuarios WHERE UsuarioId = :id');
  $stmt->bindParam(':id', $_SESSION['user_id']);
  $stmt->execute();
  $results = $stmt->fetch(PDO::FETCH_ASSOC);

  $sesion = null;

  if (count($results) > 0) {
    $sesion = $results;
  }
  //var_dump($results);
}

?>