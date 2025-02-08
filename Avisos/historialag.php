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
                <th><form action="genhaexcel.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?php  echo $id_usuario ?>"> <!-- Cambia el valor según el usuario -->
        <button type="submit">Exportar Datos</button>
    </form>NO. CONTRATO</th>
                <th>NOMBRE DEL CLIENTE</th>
                <th>RAZON</th>
                <th>HORA</th>
                <th>FECHA</th>
                <th>SOLUCION</th>
                <th>TRANSFERENCIA</th>
                <th>TIPO</th>
            </tr>
            <?php 
                
                $query = "SELECT * FROM atenciones a INNER JOIN usuario u ON a.AtencionUsuario = u.id_usuario WHERE u.id_usuario = ?";

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
                    $tipo_atencion = $row['AtencionTipo'];
                    $solucion = $row['AtencionSolucion'];
                
                
            ?>
                            <tr>
                            <td><?php echo $row["AtencionContrato"]; ?> </td>
                            <td><?php echo $row["AtencionNCliente"]; ?></td>
                            <td><?php echo $row["AtencionRazon"]; ?></td>
                            <td><?php echo $row["AtencionHora"]; ?></td>
                            <td><?php echo $row["AtencionFecha"]; ?></td>
                            <td><?php if ($solucion == 1) {
                                echo 'Si';
                            } else if ($solucion ==2) {
                                echo 'No';
                            } ?></td>
                            <td><?php echo $row["AtencionTransferencia"]; ?></td>
                            <td><?php if ($tipo_atencion == 1) {
                                echo 'Chat';
                            } else if ($tipo_atencion == 2) {
                                echo 'Telefonica';
                            } ?></td>
                                                        
                            </tr>
         <?php                   
                    }
                
        
                ?>
        </table>
    

    

    </section>
</body>
</html>