<?php
require_once 'database.php';

session_start();

    if (!isset($_SESSION['rol'])) {
        header('location: login.php');
    }else{
        if ($_SESSION['rol'] != 1) {
            header('location: login.php');
        }
    }
    if (isset($_SESSION['id'])) {
        $identificador=$_SESSION['id'];
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de usuarios</title>
    <!--CSS STYLE-->
    <link rel="stylesheet" href="CSS/nav-admin.css">
    <link rel="stylesheet" href="CSS/lista-usuarios.css">
</head>
<body>
    <?php require_once 'includes/nav-admin.php'; ?> 
    <h1 class="header">Lista usuario</h1>
    <section id = "container">

        <table class="lista_usuarios">
            <tr>
                <!--<th>ID</th>-->
                <th>NOMBRE</th>
                <th>USUARIO</th>
                <th>TELEFONO</th>
                <th>FECHA DE INGRESO</th>
                <th>SEXO</th>
                <th>ROL</th>
                <th>ACCIONES</th>
            </tr>
        <?php
            
            $query=mysqli_query($conn, "SELECT u.id_usuario, u.nombre, u.username, u.telefono, u.fecha, u.sexo, t.rol FROM usuario u INNER JOIN tipo_usuario t ON u.id_tipo = t.id_tipo WHERE estatus = 1 ORDER BY u.id_usuario ASC");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {
            ?>        
                    <tr>
                            <!--<td><?php echo $data["id_usuario"]; ?> </td>-->
                            <td><?php echo $data["nombre"]; ?></td>
                            <td><?php echo $data["username"]; ?></td>
                            <td><?php echo $data["telefono"]; ?></td>
                            <td><?php echo $data["fecha"]; ?></td>
                            <td><?php echo $data["sexo"]; ?></td>
                            <td><?php echo $data['rol']; ?></td>
                            <td>
                                    
                                    <!--<a class="link-edit" href="editar.php?id=<?php echo $data['id_usuario']; ?>">Editar</a>-->
                                <?php if($data["id_usuario"] != 1){ ?>
                                    <a  class="link-delete" href="eliminar.php?id=<?php echo $data['id_usuario']; ?>">Eliminar</a>
                                <?php } ?>
                                </td>
                            </tr>
         <?php                   
                        }
                    }
        
                ?>
        </table>

    </section>
</body>
</html>