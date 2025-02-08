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
    <h1 class="header">GPON Clientes</h1>
    <section id="container_historial">

        <table class="lista_historial">
            <tr>
                <th>
                    <form action="genexcelg.php" method="POST">
                        <button type="submit">Exportar Datos</button>
                    </form>
                    <form action="genexcelgf.php" method="POST">
                        <label for="fecha_inicio">Fecha inicio:</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" max="<?= date('Y-m-d'); ?>" required>

                        <label for="fecha_fin">Fecha fin:</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" max="<?= date('Y-m-d'); ?>" required>

                        <button type="submit">Exportar</button>
                    </form>



                    AGENTE
                </th>

            </tr>
            <?php 
                $id_usuario = $_SESSION['id'];
                $query=mysqli_query($conn, "SELECT * FROM usuario WHERE id_tipo = 2");
                $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {  
            ?>
            <tr>
                <td><a
                        href="historialag.php?id_usuario=<?php echo $data["id_usuario"]?>"><?php echo $data["nombre"]; ?></a>
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