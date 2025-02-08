<?php
include 'database.php';
    session_start();

    if (!isset($_SESSION['rol'])) {
        header('location: login.php');
    }else{
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contactos</title>
    <!--CSS STYLE-->
    <link rel="stylesheet" href="CSS/nav-admin.css">
    <link rel="stylesheet" href="CSS/lista-usuarios.css">
</head>
<body>
    
    <?php require_once 'includes/nav-admin.php'; ?> 
    <h1 class="header">Avisos importantes</h1>
    <section id = "container_avisos">

        <table class="lista_avisos">
            <tr>
                <th id="th_estado">ESTADO AVISO</th>
                <th id="th_fecha_inicio">FECHA INICIO</th>
                <th id="th_hora_inicio">HORA DE INICIO</th>
                <th id="th_hora_final">HORA DE FINALIZACION</th>
                <th id= "aviso_descripcion">AVISO DESCRIPCION</th>
                <th id="aviso_hoy"><a href="contactos.php?filtro=1">AVISO HOY</a></th>
            </tr>
        <?php
            
            


            if(empty($_GET['filtro']) ){
                $query=mysqli_query($conn, "SELECT * FROM contactos WHERE status = 1");    
            }elseif($_GET['filtro'] == 1){
                $query=mysqli_query($conn, "SELECT c.id_contactos, c.nombre, c.email, c.telefono, c.asunto, c.mensaje, c.fecha FROM contactos c WHERE c.email = CURDATE(); ");
            }
            
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {
            ?>        
                    <tr>
                            <td ><?php echo $data["nombre"]; ?> </td>
                            <td><?php echo $data["email"]; ?></td>
                            <td><?php echo $data["telefono"]; ?></td>
                            <td><?php echo $data["asunto"]; ?></td>
                            <td><?php echo $data["mensaje"]; ?></td>
                            <td><a class="link-edit" href="eliminar-bitacora.php?eliminar=<?php echo $data['id_contactos'];?>">Finalizar</a></td>
                            
                            </tr>
         <?php                   
                        }
                    }
        
                ?>
        </table>

    </section>
</body>
</html>