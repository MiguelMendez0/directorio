<?php
    include 'database.php';
    session_start();
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $query="SELECT j.asistidos, j.concepto, j.fecha, j.afectadoNumero, j.tecnicoAsignado, u.nombre FROM juntas j INNER JOIN usuario u ON j.id_usuario = u.id_usuario WHERE id_junta = $id";
        $result=mysqli_query($conn,$query);
        if (mysqli_num_rows($result) == 1) {
            $row =mysqli_fetch_array($result);
            $fecha =$row['fecha'];
            $concepto=$row['concepto'];
            $asistidos=$row['asistidos'];
            $afectado=$row['afectadoNumero'];
            $tecnico=$row['tecnicoAsignado'];
            $nombre=$row['nombre'];
            
        }
    }
    if (isset($_POST['update'])) {
        
        $fecha=$_POST['fecha'];
        $concepto=$_POST['concepto'];
        $asistidos=$_POST['asistidos'];
        $afectado=$_POST['afectadoNumero'];
        $tecnico=$_POST['tecnicoAsignado'];
        $query="UPDATE juntas SET concepto='$concepto', asistidos='$asistidos', afectadoNumero='$afectado', tecnicoAsignado='$tecnico' WHERE id_junta = $id";
        $result=mysqli_query($conn,$query);
        if ($result) {
            echo '<script language="javascript">alert("Se ha actualizado");window.location.href="bitacora.php"</script>';
        }
        echo '<script language="javascript">alert("Error al actualizar");window.location.href="bitacora.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar</title>
    <!--BOOSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <form action="editar-bitacora.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="form-group">

                        <div class="form-group">
                        <label for="asistidos">Zona</label>
                            <input type="text" name="asistidos" value="<?php echo $asistidos; ?>" class="form-control"
                            placeholder="Actualiza la asistencia">
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="concepto">GPON</label>
                            <textarea name="concepto" rows="2" class="form-control" placeholder="Actualiza la información"><?php echo $concepto; ?></textarea>
                        </div>
                        <div class="form-group">
                        <label for="afectadoNumero">Afectados</label>
                            <input type="text" name="afectadoNumero" value="<?php echo $afectado; ?>" class="form-control"
                            placeholder="Actualiza los afectados">
                        </div>
                        <div class="form-group">
                        <label for="tecnicoAsignado">Tecnico</label>
                            <input type="text" name="tecnicoAsignado" value="<?php echo $tecnico; ?>" class="form-control"
                            placeholder="Actualiza al tecnico">
                        </div>
                        <button class="btn btn-primary btn-success btn-block" name="update">Actualizar</button>
                        <a href="bitacora.php" class="btn btn-secondary btn-lg btn-block">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>