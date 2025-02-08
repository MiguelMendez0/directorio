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
    <section id = "container_historial">
    
        <table class="lista_historial">
            <tr>
                <th><form action="genexcelmg.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?php  echo $id_usuario ?>"> <!-- Cambia el valor según el usuario -->
        <button type="submit">Exportar Datos</button>
    </form>AGENTE</th>
                
            </tr>
            <?php 
                $id_usuario = $_SESSION['id'];
                $query=mysqli_query($conn, "SELECT * FROM usuario WHERE id_tipo = 5");
                $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {  
            ?>
                    <tr>
                            <td><a href="historialagm.php?id_usuario=<?php echo $data["id_usuario"]?>"><?php echo $data["nombre"]; ?></a></td>
                                                        
                            </tr>
         <?php                   
                    }
                }
        
                ?>
        </table>
    

    

    </section>
</body>
</html>