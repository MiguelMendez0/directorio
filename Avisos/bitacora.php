<?php
include_once 'database.php';
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: login.php');
}else{
    if ($_SESSION['rol'] == 3) {
        header('location: login.php');
    }
}


    if(isset($_POST['save'])){
        
        $asistencia=$_POST['asistencia'];
        $caidas=$_POST['caidas'];
        $tarjeta= $_POST['tarjeta'];
        $puerto= $_POST['puerto'];
        $reporte=$_POST['reporte'];
        $descripcion=$_POST['descripcion'];
        $id=$_SESSION['id'];
        $query = "INSERT INTO juntas(asistidos, caidos, tarjeta,puerto,reporte, descripcion,id_usuario, estado) VALUES('$asistencia', '$caidas', '$tarjeta','$puerto','$reporte', '$descripcion','$id','1')";
        $result=mysqli_query($conn,$query);
        if (!$result) {
            echo '<script language="javascript">alert("No se ha podido guardar");</script>';
        }else {
            echo '<script language="javascript">alert("Se ha guardado con exito");</script>';
        }
        
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bitacora</title>
    <!--BOOSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="CSS/nav-admin.css">
    <!--FONTAWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    
</head>
<body>
    <?php require_once 'includes/nav-admin.php'; ?>
    <h1 class="admin">Incidencias clientes</h1>
    <div class="container p-4">
        <div class="row">
                <div class="col-md-4">
                    <div class="card card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="asistencia" class="form-control" placeholder="ZONA" require>
                            </div>
                            <div class="form-group">
                                <input type="number" name="tarjeta" class="form-control" placeholder="TARJETA" require>                               
                            </div>
                            <div class="form-group">
                                <input type="number" name="puerto" class="form-control" placeholder="PUERTO" require>                               
                            </div>
                            <div class="form-group">
                                <input type="number" name="reporte" class="form-control" placeholder="NO. REPORTE" require>
                            </div>
                            <div class="form-group">
                                <input type="number" name="caidas" class="form-control" placeholder="NUMERO AFECTADOS" require>
                            </div>
                            <div class="form-group">
                                <input type="text" name="descripcion" class="form-control" placeholder="OBSERVACION" require>
                            </div>
                            <input type="submit" class="btn btn-primary btn-success btn-block" name="save" value="Guardar">
                            <a href="contactos.php" class="btn btn-secondary btn-lg btn-block">Regresar</a>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>FECHA</th>
                                    <th>ZONA</th>
                                    <th>GPON</th>
                                    <th>NUMERO AFECTADOS</th>
                                    <th>REPORTE</th>
                                    <th>DESCRIPCION</th>
                                    <th>CALL CENTER</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query="SELECT j.id_junta, j.asistidos, j.caidos, j.fecha, j.tarjeta, j.puerto, j.reporte, j.descripcion, u.nombre FROM juntas j INNER JOIN usuario u ON j.id_usuario = u.id_usuario WHERE j.estado = '1' ORDER BY fecha DESC";
                                    $result=mysqli_query($conn,$query);
                                    while($row=mysqli_fetch_array($result)) {?>
                                    <tr>
                                        <td><?php echo $row ['fecha']?></td>
                                        <td><?php echo $row ['asistidos']?></td>
                                        <td><?php echo $row ['tarjeta']?>/<?php echo $row ['puerto']?></td>
                                        <td><?php echo $row ['caidos']?></td>
                                        <td><?php echo $row ['reporte']?></td>
                                        <td><?php echo $row ['descripcion']?></td>
                                        <td><?php echo $row ['nombre']?></td>
                                        <td><!--<a href="editar-bitacora.php?id=<?php echo $row['id_junta']?>" class="btn btn-secondary"><i class="fas fa-marker"></i></a>-->
                                        <a href="eliminar-bitacora.php?id=<?php echo $row['id_junta']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                </div>
        </div>
    </div>

    <!--SCRIPT-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>