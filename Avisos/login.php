 <?php
  include_once 'database.php';
  session_start();

 
  

  
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query=mysqli_query($conn,"SELECT * FROM usuario WHERE username ='$username' AND password = '$password' ");
    $results=mysqli_num_rows($query);
    if ($results > 0) {
      //validar rol
      $data = mysqli_fetch_array($query);
      $_SESSION['rol'] = $data['id_tipo'];
      $_SESSION['id']=$data['id_usuario'];
      
      switch ($_SESSION['rol']) {
        case 1:
            header('location: contactos.php');
          break;
        case 2:
            header('location: contactos.php');
          break;

        case 3:
            header('location: contactos.php');
          break;
        case 4:
            header('location: contactos.php');
          break;
        case 5:
            header('location: contactos.php');
          break;
        default:
          break;
      }
    }else{
      //no existe el ususario
      echo "el ususario o contraseña son incorrectos";
    }


  }

 ?>

<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="CSS/form-login.css?v=<?php echo time();?>">
</head>
<body>
  <div class="login-box">
      <img class="avatar" src="img/LOGO_FASTNET.png" alt="Fondo">
        <h1>Inicia sesión aqui</h1>
        <form action="#" method="POST" >
            <!---Username-->
            <label for="username">Usuario</label>
            <input name="username"type="text" placeholder="Ingresa Usuario" required>

            <!---Password-->
            <label for="password">Contraseña</label>
            <input name="password" id="password" type="password" placeholder="Ingresa Contraseña" required> 
            <label for="checkboxpass" id="mostrarpass">Mostrar Contraseña</label><input type="checkbox" id="checkboxpass">
            <a href="http://intranet.fast-net.net">Regresar al inicio</a>
            <input type="submit" value="Iniciar Sesión">

            
        </form>
  </div>
  <script>
        document.getElementById('checkboxpass').addEventListener('change', function() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = this.checked ? 'text' : 'password'; 
        });
    </script>

</body>
</html>