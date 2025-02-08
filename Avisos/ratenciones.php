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
        
        $usuario=$_SESSION['id'];
        $contrato=$_POST['contrato'];
        $cliente=$_POST['cliente'];
        $razon= $_POST['razon'];
        $hora=$_POST['hora'];
        $fecha=$_POST['fecha'];
        $solucion=$_POST['solucion'];
        $transferencia=$_POST['transferencia'];
        $tipo=$_POST['tipo'];
        $clasificacionp=$_POST['clasificacionp'];
        $clasificacions=$_POST['clasificacions'];
        $query = "INSERT INTO atenciones(AtencionUsuario, AtencionContrato, AtencionNCliente, AtencionRazon, AtencionProblema, AtencionCSolucion, AtencionHora, AtencionFecha, AtencionSolucion, AtencionTransferencia, AtencionTipo) VALUES('$usuario', '$contrato','$cliente','$razon','$clasificacionp','$clasificacions','$hora','$fecha','$solucion','$transferencia','$tipo')";
        $result=mysqli_query($conn,$query);
        if (!$result) {
            echo '<script language="javascript">alert("No se ha podido guardar");</script>';
        }else {
            echo '<script language="javascript">alert("Se ha guardado con exito");</script>';
        }
        
        
    }

?>


<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar usuario</title>
    <!---CSS STYLE-->
    <link rel="stylesheet" href="CSS/form-registro.css">
    <link rel="stylesheet" href="CSS/nav-admin.css">
    <link rel="stylesheet" href="CSS/admin.css">

</head>
<body>
    <?php require_once 'includes/nav-admin.php'; ?>
    <?php if(empty($_GET['aviso']) ) { ?>

        <?php 
$query = "SELECT * FROM contactos WHERE status = 1 ORDER BY id_contactos DESC LIMIT 5";  // Asume que 'id' es la clave primaria de la tabla y la columna por la que quieres ordenar

// Prepara la sentencia
$stmt = mysqli_prepare($conn, $query);

// Ejecuta la consulta
mysqli_stmt_execute($stmt);

// Obtén los resultados
$result = mysqli_stmt_get_result($stmt);

// Almacena los resultados en un array
$avisos = [];
while ($row = mysqli_fetch_array($result)) {
    $avisos[] = $row; // Almacena cada fila en el array $avisos
}

// Recorre el array en orden inverso (si es necesario)
for ($i = 0; $i < count($avisos); $i++) {
    $row = $avisos[$i];
    // Aquí puedes trabajar con los datos de $row
    // Ejemplo: echo $row['campo'];

            ?>

        <a href="contactos.php"><div class="tabla_detalles">
        <table id="tabla_avisos<?php if ($i>0) { echo $i + 1;}?>"> 
            <thead>
            <tr>
                <th>AVISOS</th>
            </tr>
            <tr>
                <td><?php echo ($row ['mensaje']); ?></td>
            </tr>
            
            </tr>
        </table>
    </div>
    </a>
    <?php } ?>
    <!--<div class="tabla_detalles">
        <table id="tabla_avisos2"> 
            <thead>
           
            <tr>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, voluptatum voluptatibus atque ex ea aliquid consequatur ipsa! Debitis nobis dolore nesciunt adipisci natus porro, numquam nostrum maxime magni, error possimus!</td>
            </tr>
            
            </tr>
        </table>
    </div>
    <div class="tabla_detalles">
        <table id="tabla_avisos3"> 
            <thead>
           
            <tr>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, voluptatum voluptatibus atque ex ea aliquid consequatur ipsa! Debitis nobis dolore nesciunt adipisci natus porro, numquam nostrum maxime magni, error possimus!</td>
            </tr>
            
            </tr>
        </table>
    </div>
    <div class="tabla_detalles">
        <table id="tabla_avisos4"> 
            <thead>
        
            <tr>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, voluptatum voluptatibus atque ex ea aliquid consequatur ipsa! Debitis nobis dolore nesciunt adipisci natus porro, numquam nostrum maxime magni, error possimus!</td>
            </tr>
            
            </tr>
        </table>
    </div>
    <div class="tabla_detalles">
        <table id="tabla_avisos5"> 
            <thead>
            
            <tr>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, voluptatum voluptatibus atque ex ea aliquid consequatur ipsa! Debitis nobis dolore nesciunt adipisci natus porro, numquam nostrum maxime magni, error possimus!</td>
            </tr>
            
            </tr>
        </table>
    </div>
-->
<?php 
$query = "SELECT * FROM juntas WHERE estado = 1 ORDER BY id_junta DESC LIMIT 5";  // Asume que 'id' es la clave primaria de la tabla y la columna por la que quieres ordenar

// Prepara la sentencia
$stmt = mysqli_prepare($conn, $query);

// Ejecuta la consulta
mysqli_stmt_execute($stmt);

// Obtén los resultados
$result = mysqli_stmt_get_result($stmt);

// Almacena los resultados en un array
$incidencias = [];
$increment = 1;
while ($row = mysqli_fetch_array($result)) {
    $incidencias[] = $row; // Almacena cada fila en el array $avisos



    // Aquí puedes trabajar con los datos de $row
    // Ejemplo: echo $row['campo'];
    $increment = $increment + 1;
            ?>
    <a href="bitacora.php"><div class="tabla_detalles">
        <table id="tabla<?php echo $increment; ?>"> 
        <thead>
            <tr>
                <th colspan="2">INCIDENCIAS</th>
            </tr>
            <tr>
                <td>ZONA</td>
                <td><?php echo $row ['asistidos']; ?></td>
            </tr>
            <tr>
                <td>TARJETA/PUERTO</td>
                <td><?php echo $row ['tarjeta']; ?>/<?php echo $row ['puerto']; ?></td>
            </tr>
            <tr>
                <td>CLIENTES AFECTADOS</td>
                <td><?php echo $row ['caidos']; ?></td>
            </tr>
        </table>
    </div>
    </a>
    <?php } ?>
    <!--<div class="tabla_detalles">
        <table id="tabla3"> 
        <thead>
                <td>ZONA</td>
                <td>POMOCA</td>
            </tr>
            <tr>
                <td>TARJETA/PUERTO</td>
                <td>1/3</td>
            </tr>
            <tr>
                <td>CLIENTES AFECTADOS</td>
                <td>5</td>
            </tr>
        </table>
    </div>
    <div class="tabla_detalles">
        <table id="tabla4"> 
            <tr>
                <td>ZONA</td>
                <td>POMOCA</td>
            </tr>
            <tr>
                <td>TARJETA/PUERTO</td>
                <td>1/3</td>
            </tr>
            <tr>
                <td>CLIENTES AFECTADOS</td>
                <td>5</td>
            </tr>
        </table>
    </div>
    <div class="tabla_detalles">
        <table id="tabla5"> 
            <tr>
                <td>ZONA</td>
                <td>POMOCA</td>
            </tr>
            <tr>
                <td>TARJETA/PUERTO</td>
                <td>1/3</td>
            </tr>
            <tr>
                <td>CLIENTES AFECTADOS</td>
                <td>5</td>
            </tr>
        </table>
    </div>
    <div class="tabla_detalles">
        <table id="tabla5"> 
            <tr>
                <td>ZONA</td>
                <td>POMOCA</td>
            </tr>
            <tr>
                <td>TARJETA/PUERTO</td>
                <td>1/3</td>
            </tr>
            <tr>
                <td>CLIENTES AFECTADOS</td>
                <td>5</td>
            </tr>
        </table>
    </div>

    <div class="tabla_detalles">
        <table id="tabla6"> 
            <tr>
                <td>ZONA</td>
                <td>POMOCA</td>
            </tr>
            <tr>
                <td>TARJETA/PUERTO</td>
                <td>1/3</td>
            </tr>
            <tr>
                <td>CLIENTES AFECTADOS</td>
                <td>5</td>
            </tr>
        </table>
    </div>-->

  <div class="login-box">
      
        <h1>Registro de Atenciones</h1>
        <form action="ratenciones.php" method="POST" >
            <!---Nombre--->
            <label for="nombre">No. Contrato</label>
            <input name="contrato"type="text" placeholder="NO. CONTRATO" required>
            <!---cliente--->
            <label for="cliente">Cliente</label>
            <input name="cliente"type="text" placeholder="NOMBRE DEL CLIENTE" required>
            <!---clasificacion del problema--->
            <label for="clasificacionp">Clasificacion del Problema</label>
            <select name="clasificacionp" id="" required>
            <option disabled selected>Seleccionar</option>
            <option value="CABLE/FIBRA BAJO">CABLE/FIBRA BAJO</option>
            <option value="LED LOS ENCENDIDO">LED LOS ENCENDIDO</option>
            <option value="NAVEGACION LENTA">NAVEGACIÓN LENTA</option>
            <option value="NO SE HA ATENDIDO REPORTE">NO SE HA ATENDIDO REPORTE</option>
            <option value="NO SE TERMINO DE GENERAR REPORTE POR WHAT">NO TERMINO DE GENERAR REPORTE POR WHAT</option>
            <option value="PROBLEMAS CON EL ACCESO A CIERTAS PAGINAS">PROBLEMAS CON EL ACCESO A CIERTAS PAGINAS</option>
            <option value="PROBLEMAS NIVELES OPTICOS">PROBLEMAS NIVELES ÓPTICOS</option>
            <option value="REALIZO PAGO Y CONTINUA SIN SERVICIO">REALIZO PAGO Y CONTINUA SIN SERVICIO</option>
            <option value="SEGUIMIENTO DE PAGO CONTRA-INSTALACION">SEGUIMIENTO DE PAGO CONTRA-INSTALACION</option>
            <option value="SEGUIMIENTO DE TRABAJO">SEGUIMIENTO DE TRABAJO</option>
            <option value="SEÑAL DE INTERNET INESTABLE">SEÑAL DE INTERNET INESTABLE</option>
            <option value="SIN NAVEGACION INTERNET">SIN NAVEGACIÓN INTERNET</option>
            <option value="SIN SEÑAL AMBOS SERVICIOS">SIN SEÑAL AMBOS SERVICIOS</option>
            <option value="SIN SERVICIO POR FALLA GENERAL">SIN SERVICIO POR FALLA GENERAL</option>
            <option value="SIN SERVICIO, POR MANIPULACION DEL CLIENTE">SIN SERVICIO, POR MANIPULACIÓN DEL CLIENTE</option>
            <option value="SOLICITUD CAMBIO DE CONTRASEÑA">SOLICITUD CAMBIO DE CONTRASEÑA</option>
            <option value="SOLICITUD CAMBIO DE PAQUETE">SOLICITUD CAMBIO DE PAQUETE</option>
            <option value="SOLICITUD DE ACTUALIZACION DE DATOS">SOLICITUD DE ACTUALIZACION DE DATOS</option>
            <option value="SOLICITUD DE CAMBIO DE DOMICILIO">SOLICITUD DE CAMBIO DE DOMICILIO</option>
            <option value="SOLICITUD DE CANCELACION">SOLICITUD DE CANCELACIÓN</option>
            <option value="SOLICITUD DE FECHA DE INSTALACION">SOLICITUD DE FECHA DE INSTALACIÓN</option>
            <option value="SOLICITUD DE INFORMACION SOBRE PAGOS/DEUDAS">SOLICITUD DE INFORMACIÓN SOBRE PAGOS/DEUDAS</option>
            <option value="SOLICITUD DE REUBICACION DEL MODEM DENTRO DEL DOMICILIO">SOLICITUD DE REUBICACION DEL MODEM DENTRO DEL DOMICILIO</option>
            </select>
            <br>
            <!---clasificacion de la solucion--->
            <label for="clasificacions">Clasificacion de la Solución</label>
            <select name="clasificacions" id="" required>
            <option disabled selected>Seleccionar</option>
            <option value="ACTUALIZACION DE DATOS">ACTUALIZACIÓN DE DATOS</option>
            <option value="ACTUALIZACION DE ONT">ACTUALIZACIÓN DE ONT</option>
            <option value="ATENUACION DE LA LINEA">ATENUACIÓN DE LA LINEA</option>
            <option value="CAMBIO DE CONTRASEÑA">CAMBIO DE CONTRASEÑA</option>
            <option value="CAMBIO DE DOMICILIO">CAMBIO DE DOMICILIO</option>
            <option value="CLIENTE EN CORTE POR FALTA DE PAGO">CLIENTE EN CORTE POR FALTA DE PAGO</option>
            <option value="CLIENTE NO SE ENCUENTRA EN EL DOMICILIO">CLIENTE NO SE ENCUENTRA EN EL DOMICILIO</option>
            <option value="CONECTOR SUELTO">CONECTOR SUELTO</option>
            <option value="EQUIPO DESCONFIGURADO">EQUIPO DESCONFIGURADO</option>
            <option value="FALLA GENERAL">FALLA GENERAL</option>
            <option value="HABILITACION DEL SERVICIO">HABILITACION DEL SERVICIO</option>
            <option value="LLAMADA DE CALIDAD">LLAMADA DE CALIDAD</option>
            <option value="MANTENIMIENTO">MANTENIMIENTO</option>
            <option value="MAS DISPOSITIVOS CONECTADOS">MAS DISPOSITIVOS CONECTADOS</option>
            <option value="NO TERMINO EL PROCESO DE WHAT">NO TERMINO EL PROCESO DE WHAT</option>
            <option value="REBOOT FULLSOLUTION">REBOOT FULLSOLUTION</option>
            <option value="RECONFIGURACION DE ONU">RECONFIGURACION DE ONU</option>
            <option value="RESET SOFTV">RESET SOFTV</option>
            <option value="RESYNC FULLSOLUTION">RESYNC FULLSOLUTION</option>
            <option value="SE AVISO A COBRANZA PARA CONTACTARSE CON EL CLIENTE">SE AVISO A COBRANZA PARA CONTACTARSE CON EL CLIENTE</option>
            <option value="SE BRINDA INFORMACION DEL SERVICIO">SE BRINDA INFORMACION DEL SERVICIO</option>
            <option value="SE CORRIGIO VELOCIDAD">SE CORRIGIO VELOCIDAD</option>
            <option value="SE DIO INFORMACION DE PAGOS/DEUDAS">SE DIO INFORMACIÓN DE PAGOS/DEUDAS</option>
            <option value="SEGUIMIENTO DE INSTALACION">SEGUIMIENTO DE INSTALACIÓN</option>
            <option value="SEGUIMIENTO DE REPORTE">SEGUIMIENTO DE REPORTE</option>
            <option value="SOPORTE EN PUNTO DE VENTA">SOPORTE EN PUNTO DE VENTA</option>
            </select>
            <br>
            <!---razon--->
            <label for="razon">Razon</label>
            <textarea name="razon"type="text" placeholder="RAZON" required></textarea>
            <!---hora--->
            <label for="hora">Hora</label>
            <input id="hora" name="hora" type="time" placeholder="HORA" readonly required>
            <!---fecha-->
            <label for="fecha">Fecha</label>
            <input id="fecha" name="fecha" type="date" placeholder="FECHA" readonly required>
            <!---solucion-->
            <label for="solucion">Solucion</label>
            <select name="solucion" id="solucion" required>
                <option value="" disabled selected>SOLUCION</option>
                <option value="1">Si</option>
                <option value="2">No</option>
            </select>
            <br></br>
            <!---transferencia-->
            <label for="transferencia">Transferencia</label>
            <input name="transferencia"type="text" placeholder="TRANSFERENCIA" required>
            <!---solucion-->
            <label for="tipo">Tipo de Atencion</label>
            <select name="tipo" id="tipo" required>
                <option value="" disabled selected>TIPO DE ATENCION</option>
                <option value="1">Chat</option>
                <option value="2">Telefonica</option>
            </select>
            <br></br>
            <input type="submit" name="save" value="Guardar Atencion">

            
        </form>
  </div>
  <script>
// Establece la fecha de hoy en el campo de fecha con la zona horaria local
const today = new Date();
const year = today.getFullYear();
const month = String(today.getMonth() + 1).padStart(2, '0'); // Meses comienzan desde 0
const day = String(today.getDate()).padStart(2, '0');
const formattedDate = `${year}-${month}-${day}`;
document.getElementById('fecha').value = formattedDate;


        // Función para establecer la hora actual en el campo "hora" cuando se carga la página
        function establecerHoraActual() {
        const fecha = new Date();
        const horas = fecha.getHours().toString().padStart(2, '0');
        const minutos = fecha.getMinutes().toString().padStart(2, '0');
        document.getElementById('hora').value = `${horas}:${minutos}`;
    }

    // Llama a la función cuando se carga la página
    window.onload = establecerHoraActual;
</script>

</div>
<?php } ?>
</body>
</html>