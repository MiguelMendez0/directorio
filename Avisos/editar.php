<?php
include_once 'database.php';
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: login.php');
}else{
    if ($_SESSION['rol'] != 1) {
        header('location: login.php');
    }
}
if (!empty($_POST)) {
    
        $idUsuario=$_POST['idUsuario'];
        $nombre=$_POST['nombre'];
        $telefono=$_POST['telefono'];
        $fecha=$_POST['fecha'];
        $sexo=$_POST['sexo'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $rol=$_POST['rol'];

        
        $query=mysqli_query($conn, "SELECT * FROM usuario 
                                    WHERE (username = '$username'
                                    AND  id_usuario != $idUsuario)
                                    OR (telefono = '$telefono' 
                                    AND id_usuario != $idUsuario)");
        $result=mysqli_fetch_array($query);

        if($result > 0){
            echo '<script language="javascript">alert("El usuario ya existe");window.location.href="editar.php"</script>';
        }else{
            if (empty($_POST['password'])) {
                $query2="UPDATE usuario
                        SET nombre = '$nombre', telefono = '$telefono',
                        fecha = '$fecha', sexo = '$sexo', username = '$username', id_tipo = '$rol'
                        WHERE id_usuario = $idUsuario ";
                $sql_update=mysqli_query($conn, $query2);    
            }else{
                $query2="UPDATE usuario
                        SET nombre = '$nombre', telefono = '$telefono',
                        fecha = '$fecha', sexo = '$sexo', username = '$username', password = '$password', id_tipo = '$rol'
                        WHERE id_usuario = $idUsuario ";
                $sql_update=mysqli_query($conn, $query2);   
            }
        if ($sql_update) {
            echo '<script language="javascript">alert("Cambios guardados");window.location.href="editar.php"</script>';
        }else{
            echo '<script language="javascript">alert("Error al actualizar");window.location.href="editar.php"</script>';
            }
        }
    }

   
    //Mostrar datos 
   if (empty($_GET['id'])) {
        header('location: lista-usuario.php');
    }
    $iduser=$_GET['id'];
    $con=mysqli_connect("localhost","root","","grupoas1");
    $query1="SELECT u.id_usuario, u.nombre, u.username, u.telefono, u.fecha, u.sexo, (u.id_tipo) as id_tipo, (t.rol) as rol from usuario u INNER JOIN tipo_usuario t on u.id_tipo = t.id_tipo
    where id_usuario= $iduser ";
    $sql=mysqli_query($con, $query1);
    $result=mysqli_num_rows($sql);
    if($result == 0){
        header('location: lista-usuario.php');
    }else{
        $option='';
        while ($data =mysqli_fetch_array($sql)) {
            $iduser=$data['id_usuario'];
            $nombre=$data['nombre'];
            $username=$data['username'];
            $telefono=$data['telefono'];
            $fecha=$data['fecha'];
            $sexo=$data['sexo'];
            $idrol=$data['id_tipo'];
            $rol=$data['rol'];
            if($idrol==1){
                $option='<option value = "'.$idrol.'" select> '.$rol.' </option> ';
            }else if($idrol == 2){
                $option='<option value = "'.$idrol.'" select> '.$rol.' </option> ';
            }elseif($idrol == 3){
                $option='<option value = "'.$idrol.'" select> '.$rol.' </option> ';
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
    <title>Actualizar usuario</title>
    <!---CSS STYLE-->
    <link rel="stylesheet" href="CSS/form-registro.css">
    <link rel="stylesheet" href="CSS/nav-admin.css">
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <?php require_once 'includes/nav-admin.php'; ?>
  <div class="login-box">
      
        <h1>Actualizar usuario</h1>
        <form action="#" method="POST" >
            <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
            <!---Nombre--->
            <label for="nombre">Nombre</label>
            <input name="nombre"type="text" placeholder="Ingresa nombre" value="<?php echo $nombre; ?>">
            <!---telefono--->
            <label for="telefono">Telefono</label>
            <input name="telefono"type="text" placeholder="Ingresa telefono" value="<?php echo $telefono; ?>">
            <!---fecha--->
            <label for="fecha">Fecha</label>
            <input name="fecha"type="date" placeholder="Ingresa fecha" value="<?php echo $fecha; ?>">
            <!---sexo--->
            <label for="sexo">Sexo</label>
            <input name="sexo"type="text" placeholder="Ingresa sexo"  value="<?php echo $sexo; ?>">
            <!---Username-->
            <label for="username">Usuario</label>
            <input name="username"type="text" placeholder="Ingresa Usuario" value="<?php echo $username; ?>">
            <!---Password-->
            <label for="password">Contraseña</label>
            <input name="password"type="password" placeholder="Ingresa Contraseña" >
            <label for="rol">Tipo usuario</label>
            
    <?php
        $query_rol=mysqli_query($con, "SELECT * FROM tipo_usuario");
        $result_rol=mysqli_num_rows($query_rol);
        ?>
            <select name="rol" id="rol" class="noitemone">
        <?php
        echo $option;
        if($result_rol > 0){
            while($rol =mysqli_fetch_array($query_rol)){
                ?>
                <option value="<?php echo $rol["id_tipo"]; ?>"><?php echo $rol["rol"] ?></option>
    <?php
            }
        }
        ?>
            </select>
            <input type="submit" value="Actualizar usuario">

            
        </form>
  </div>
</body>
</html>