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
    <h1 class="header">ATENCIONES</h1>
    <section id = "container_atenciones">
    
        <table class="lista_atenciones">
            <tr>
                <th>NO. CONTRATO</th>
                <th>NOMBRE DEL CLIENTE</th>
                <th>RAZON</th>
                <th>SOLUCION</th>
                <th>NO. REPORTE</th>
                <th>TECNICO</th>
                <th>HORA</th>
                <th>FECHA</th>
            </tr>
            <?php 
                $id_usuario = $_SESSION['id'];
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
                
                    // Aquí puedes trabajar con los datos de $tipo_atencion y $solucion
                    // Por ejemplo: echo $tipo_atencion;
                
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