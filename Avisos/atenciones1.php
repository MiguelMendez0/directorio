<?php
include_once 'database.php';
session_start();




$host_central = "192.168.90.2";
$community = "gl1v4qctFYad";

//OID from MIBs of ZTE-C300

$oidNameOnt = '.1.3.6.1.4.1.3902.1012.3.28.1.1.2';
$oidTypeNameOnt ='.1.3.6.1.4.1.3902.1012.3.28.1.1.1';
$oidDescription ='.1.3.6.1.4.1.3902.1012.3.28.1.1.3';
$oidDistance ='.1.3.6.1.4.1.3902.1012.3.11.4.1.2';
$oidRxOlt = '1.3.6.1.4.1.3902.1015.1010.11.2.1.2'; 
$oidTimeUp = '.1.3.6.1.4.1.3902.1012.3.50.11.2.1.20';

$oidPrueb = '.1.3.6.1.4.1.3902.1012.3.28.2.1';

//-----------------------------------------------------
//ARRAY of SNMP 
snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
$nameOnt =snmpwalk($host,$community,$oidNameOnt);
$typeNameOnt =snmpwalk($host,$community,$oidTypeNameOnt);
$description =snmpwalk($host,$community,$oidDescription);
$distance =snmpwalk($host,$community,$oidDistance);
$rxOlt = snmpwalk($host, $community, $oidRxOlt); 

//$prueb = snmpget($host, $community, $oidPrueb);

//----------------------------------------------------

/*
if ($prueb === false) {
    echo "Failed to get value from OID $prueb";
} else {
    
    foreach($prueb as $x => $y){
        echo "$x : $y <br>";
    }
   
}
*/    
//SSH PHP
/*
        $start=microtime(true);
        if (!($resource=@ssh2_connect("192.168.90.38",22))) {
                echo "[FAILED]<br />";
                exit(1);
        }
        $end=microtime(true);
        print $delta=$end - $start;

        // Authentification by login/passwd
        
        if (!@ssh2_auth_password($resource,"parrilla","Mko0nji9!")) {
                echo "[FAILED]<br />";
                exit(1);
        }

        

                                                                                                                          
        // We need a shell
        
        if (!($stdio = @ssh2_shell($resource,"xterm", null, 80, 24, SSH2_TERM_UNIT_CHARS))) {
                echo "[FAILED]<br />";
                exit(1);
        }
                                                                                                                                        
        // Execution of any command
        // Be careful to add an '\n' at the  end of the command
        $start=microtime(true);
        $command = 'show gpon onu detail-info gpon-onu_1/2/1:1';
        fwrite($stdio,$command .PHP_EOL);
        sleep(1);
        $end=microtime(true);
        print $delta3=$end-$start;                                                                                                                              
        // IMPORTANT
        // For some obscur reasons, just after ur command, u need to make a sleep to be sure, that the command has reached the server and is running
        
        
        // Then u can fetch the stream to see what happens on stdio
        
        while($line = fgets($stdio)) {
                flush();
                echo $line."<br />";
        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                               
        // It's always cleaner to close all stream
        
        fclose($stdio);
        */
if (!isset($_SESSION['rol'])) {
    header('location: login.php');
}else{
    if ($_SESSION['rol'] == 3) {
        header('location: login.php');
    }
}


    if(isset($_POST['save'])){
        
        $usuario=$_SESSION['id'];
        $contrato=$_POST['contrato'];
        $cliente=$_POST['cliente'];
        $razon= $_POST['razon'];
        $hora=$_POST['hora'];
        $fecha=$_POST['fecha'];
        $solucion=$_POST['solucion'];
        $transferencia=$_POST['transferencia'];
        $tipo=$_POST['tipo'];
        $query = "INSERT INTO atenciones(AtencionUsuario, AtencionContrato, AtencionNCliente, AtencionRazon, AtencionHora, AtencionFecha, AtencionSolucion, AtencionTransferencia, AtencionTipo) VALUES('$usuario', '$contrato','$cliente','$razon','$hora','$fecha','$solucion','$transferencia','$tipo')";
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
    <title>Atenciones</title>
    <!--BOOSTRAP-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin.css">
    <!--FONTAWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--CSS STYLE-->
    <link rel="stylesheet" href="CSS/nav-admin.css">
    <link rel="stylesheet" href="CSS/lista-usuarios.css">
</head>
<body>
    <?php require_once 'includes/nav-admin.php'; ?>
    <h1 class="admin">SNMP</h1>
    <?php if(false) { ?>
    <div class="container p-4">
        <div class="row">
                <div class="col-md-4">
                    <div class="card card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="contrato" class="form-control" placeholder="NO. CONTRATO" required autofocus>                               
                            </div>
                            <div class="form-group">
                                <input type="text" name="cliente" class="form-control" placeholder="NOMBRE DEL CLIENTE" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="text" name="razon" class="form-control" placeholder="RAZON" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="time" name="hora" class="form-control" placeholder="HORA" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="date" name="fecha" class="form-control" placeholder="FECHA" required autofocus>
                            </div>
                            <div class="form-group">
                              <select name="solucion" class="form-control" required autofocus>
                                <option value="" disabled selected>SOLUCION</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                              </select>
                            </div>

                            <div class="form-group">
                                <input type="text" name="transferencia" class="form-control" placeholder="SE TURNO A" required autofocus>
                            </div>
                            <div class="form-group">
                            <select name="tipo" class="form-control" required autofocus>
                                <option value="" disabled selected>TIPO DE ATENCION</option>
                                <option value="1">Chat</option>
                                <option value="2">Telefónica</option>
                              </select>
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
                                    
                                    <th>ATENCION</th>
                                    <th>NO.CONTRATO</th>
                                    <th>NOMBRE DEL CLIENTE</th>
                                    <th>RAZON</th>
                                    <th>HORA</th>
                                    <th>FECHA</th>
                                    <th>SOLUCION 1A</th>
                                    <th>SE TURNO A </th> 
                                    <th>TIPO DE ATENCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $id_usuario = $_SESSION['id'];
                                    $query="SELECT * FROM atenciones a INNER JOIN usuario u ON a.AtencionUsuario = u.id_usuario WHERE u.id_usuario = ?";
                                    // Prepara la sentencia
                                    $stmt = mysqli_prepare($conn, $query);

                                    // Enlaza el parámetro
                                    mysqli_stmt_bind_param($stmt, "i", $id_usuario); // "i" indica que el parámetro es un entero

                                    // Ejecuta la consulta
                                    mysqli_stmt_execute($stmt);

                                    // Obtén los resultados
                                    $result = mysqli_stmt_get_result($stmt);
                                    while($row=mysqli_fetch_array($result)) {
                                        $tipo_atencion = $row ['AtencionTipo'];
                                        $solucion = $row ['AtencionSolucion'];
                                        ?>
                                    <tr>
                                        
                                        <td><?php echo $row ['AtencionId']?></td>
                                        <td><?php echo $row ['AtencionContrato']?></td>
                                        <td><?php echo $row ['AtencionNCliente']?></td>
                                        <td><?php echo $row ['AtencionRazon']?></td>
                                        <td><?php echo $row ['AtencionHora']?></td>
                                        <th><?php echo $row ['AtencionFecha']?></th>
                                        <th><?php if ($solucion == 1) {
                                            echo 'Si';    
                                        } else if ($solucion == 2) {
                                            echo 'No';
                                        }
                                        ?></th>
                                        <th><?php echo $row ['AtencionTransferencia']?></th>
                                        <th><?php if ($tipo_atencion == 1) {
                                            echo 'Chat';    
                                        } else if ($tipo_atencion == 2) {
                                            echo 'Telefonica';
                                        }
                                        ?></th>
                                        <!--<td><a href="atenciones.php?id=<?php echo $row['AtencionId']?>" class="btn btn-secondary"><i class="fas fa-marker"></i></a>
                                        <a href="atenciones.php?id=<?php echo $row['AtencionId']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>-->
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
    <?php } ?>

    <section id="container">
    <?php if(true) { ?>                            
    <table class="lista_usuarios">

            <tr>
                <th>Nombre ONU</th>
                <th>Modelo ONU</th>
                <th>Zona</th>
                <th>RX OLT</th>
                <th>Distancia</th>
                
            </tr>
            <?php 
               
               
                for ($i = count($nameOnt) - 1; $i >= 0; $i--) {
                    //$row = $nameOnt[$i];
                    
                
                    // Aquí puedes trabajar con los datos de $tipo_atencion y $solucion
                    // Por ejemplo: echo $tipo_atencion;
                
            ?>

                    <tr>
                            <td><?php echo $nameOnt[$i]; ?> </td>
                            <td><?php echo $typeNameOnt[$i]; ?> </td>
                            <td><?php echo $description[$i]; ?> </td>
                            <td><?php echo $rxOlt[$i]; ?> </td>
                            <td><?php echo $distance[$i]; ?> </td>                            
                            </tr>
         <?php                   
                    }
        
                ?>
        </table>
    
    </section>
    <?php } ?>

</body>
</html>