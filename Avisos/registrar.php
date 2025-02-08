<?php
include_once 'database.php';
session_start();

if (!isset($_SESSION['rol'])) {
    header('location: login.php');
}else{
    if (($_SESSION['rol'] != 1) && ($_SESSION['rol'] != 2 ) && ($_SESSION['rol'] != 5) && ($_SESSION['rol'] != 4)) {
        header('location: login.php');
    }
}

if (!empty($_POST)) {
    
   

    if (empty($_POST['sexo']) ) {
        /*echo '<script language="javascript">alert("Todos los campos son obligatorios");</script>';*/

    }else{
        $password=$_POST['password'];
        $sql = "INSERT INTO usuario(nombre, telefono, fecha, sexo, username, password, id_tipo) VALUES(:nombre, :telefono, :fecha, :sexo, :username, :password, :id_tipo)";
        
        
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        $stmt->bindParam(':fecha', $_POST['fecha']);
        $stmt->bindParam(':sexo', $_POST['sexo']);
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id_tipo', $_POST['rol']);
        if ($stmt->execute()) {
            echo '<script language="javascript">alert("Cuenta creada");window.location.href="registrar.php"</script>';

        }else{
            echo '<script language="javascript">alert("No se ha podido generar la cuenta");window.location.href="registrar.php"</script>';

        }
    }
    
    if(empty($_GET['aviso'])  ){

        echo '<script language="javascript">alert("Todos los campos son obligatorios");</script>';
    }else{
        $sql1 = "INSERT INTO contactos(nombre, email, telefono, asunto, mensaje, fecha, status) VALUES(:nombre, :email, :telefono, :asunto, :mensaje, :fecha, '1')";
        
        
        $stmt1 = $connection->prepare($sql1);
        $stmt1->bindParam(':nombre', $_POST['nombre']);
        $stmt1->bindParam(':email', $_POST['email']);
        $stmt1->bindParam(':telefono', $_POST['telefono']);
        $stmt1->bindParam(':asunto', $_POST['asunto']);
        $stmt1->bindParam(':mensaje', $_POST['mensaje']);
        $stmt1->bindParam(':fecha', $_POST['fecha']);
        
        if ($stmt1->execute()) {
            echo '<script language="javascript">alert("Aviso creado");window.location.href="registrar.php"</script>';

        }else{
            echo '<script language="javascript">alert("No se ha podido generar la cuenta");window.location.href="registrar.php"</script>';

        }
    }
  
 
}
    
?>


<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar usuario</title>
    <!---CSS STYLE-->
    <link rel="stylesheet" href="CSS/form-registro.css">
    <link rel="stylesheet" href="CSS/nav-admin.css">
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <?php require_once 'includes/nav-admin.php'; ?>
    <?php if(empty($_GET['aviso']) ) { ?>
  <div class="login-box">
      
        <h1>Formulario de registro</h1>
        <form action="registrar.php" method="POST" >
            <!---Nombre--->
            <label for="nombre">Nombre</label>
            <input name="nombre"type="text" placeholder="Ingresa nombre" required>
            <!---telefono--->
            <label for="telefono">Telefono</label>
            <input name="telefono"type="text" placeholder="Ingresa telefono" required>
            <!---fecha--->
            <label for="fecha">Fecha</label>
            <input name="fecha"type="date" placeholder="Ingresa fecha" required>
            <!---sexo--->
            <label for="sexo">Sexo</label>
            <input name="sexo"type="text" placeholder="Ingresa sexo" required>
            <!---Username-->
            <label for="username">Usuario</label>
            <input name="username"type="text" placeholder="Ingresa Usuario" required>
            <!---Password-->
            <label for="password">Contraseña</label>
            <input name="password"type="password" placeholder="Ingresa Contraseña" required>
            <label for="rol">Tipo usuario</label>
            <select name="rol" id="rol" required>
                <?php 
                    $query="SELECT * FROM tipo_usuario";
                    $result=mysqli_query($conn,$query);
                    $row=mysqli_num_rows($result);
                ?>
                <?php if($row > 0){while($rol=mysqli_fetch_array($result)){ ?>
                <option value="<?php echo $rol['id_tipo']; ?>"> <?php echo $rol['rol'] ?> </option>
                <?php }}?>
            </select>
            <input type="submit" value="Registrar usuario">

            
        </form>
  </div>
    <?php }else { ?>
    <?php if($_GET['aviso'] == 1) { ?>
    <div class="login-box">
      
      <h1>Registrar Aviso</h1>
      <form action="registrar.php?aviso=1" method="POST" >
          <!---Aviso--->
          <label for="nombre">Estado Aviso</label>
          <input name="nombre"type="text" placeholder="Ingresa Estado Aviso" required>
          <!---Fecha Estimada--->
          <label for="email">Fecha Inicio</label>
          <input name="email"type="date" placeholder="Ingresa Fecha de Inicio" required>
          <!---Hora de inicio--->
          <label for="telefono">Hora Inicio</label>
          <input name="telefono"type="time" placeholder="Ingresa Hora de Inicio" required>
          <!---Hora de finalizacion--->
          <label for="asunto">Hora Final</label>
          <input name="asunto"type="time" placeholder="Ingresa Hora Final" required>
          <!---Descripcion-->
          <label for="mensaje">Descripcion</label>
          <input name="mensaje"type="text" placeholder="Ingresa Descripcion" required>
          <!---Fecha-->
          <label for="fecha">Fecha Creacion</label>
          <input id="fecha" name="fecha"type="date" placeholder="Ingresa Fecha de creacion" required readonly>
         
          
          <input type="submit" value="Registrar Aviso">

          
      </form>

      <script>
    // Establece la fecha de hoy en el campo de fecha
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('fecha').value = today;
</script>
</div>
    <?php } } ?>
</body>
</html>