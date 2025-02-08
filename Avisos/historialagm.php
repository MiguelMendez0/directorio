<?php


include 'database.php';
    session_start();

    if (!isset($_SESSION['rol'])) {
        header('location: login.php');
    }else{
        
    } 

    $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
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
    <h1 class="header">ATENCIONES POR AGENTE</h1>
    <section id = "container_historial">
    
        <table class="lista">
        <tr>
                <th><form action="genhaexcelm.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?php  echo $id_usuario ?>"> <!-- Cambia el valor según el usuario -->
        <button type="submit">Exportar Datos</button>
    </form>NO. CONTRATO</th>
                <th>NOMBRE DEL CLIENTE</th>
                <th>RAZON</th>
                <th>SOLUCION</th>
                <th>NO. REPORTE</th>
                <th>TECNICO</th>
                <th>HORA</th>
                <th>FECHA</th>
            </tr>
            <?php 
                
                $query = "SELECT * FROM atencionesm a INNER JOIN usuario u ON a.AtencionMUsuario = u.id_usuario WHERE u.id_usuario = ?";

                // Prepara la sentencia
                $stmt = mysqli_prepare($conn, $query);
                
                // Enlaza el parámetro
                mysqli_stmt_bind_param($stmt, "i", $id_usuario); // Indica que el parámetro es un entero
                
                // Ejecuta la consulta
                mysqli_stmt_execute($stmt);
                
                // Obtén los resultados
                $result = mysqli_stmt_get_result($stmt);
                
                // Almacena los resultados en un array
                $atenciones = [];
                while ($row = mysqli_fetch_array($result)) {
                    $atenciones[] = $row; // Almacena cada fila en el array $atenciones
                
                }
                // Recorre el array en orden inverso
                for ($i = count($atenciones) - 1; $i >= 0; $i--) {
                    $row = $atenciones[$i];

                
                
            ?>
                            <tr>
                            <td><?php echo $row["AtencionMContrato"]; ?> </td>
                            <td><?php echo $row["AtencionNMCliente"]; ?></td>
                            <td><?php echo $row["AtencionMRazon"]; ?></td>
                            <td><?php echo $row["AtencionMSolucion"]; ?></td>
                            <td><?php echo $row["AtencionMReporte"]; ?></td>
                            <td><?php echo $row["AtencionMTecnico"]; ?></td>
                            <td><?php echo $row["AtencionMHora"]; ?></td>
                            <td><?php echo $row["AtencionMFecha"]; ?></td>
                                                        
                            </tr>
         <?php                   
                    }
                
        
                ?>
        </table>
    

    

    </section>
</body>
</html>