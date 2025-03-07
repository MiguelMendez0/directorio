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
        $solucion=$_POST['solucion'];
        $reporte=$_POST['reporte'];
        $tecnico=$_POST['tecnico'];
        $horaFinal=$_POST['hora-final'];
        $hora=$_POST['hora'];
        $fecha=$_POST['fecha'];
        $query = "INSERT INTO atencionesm(AtencionMUsuario, AtencionMContrato, AtencionNMCliente, AtencionMRazon, AtencionMSolucion, AtencionMReporte, AtencionMTecnico, AtencionMHora, AtencionMHoraFinal, AtencionMFecha) VALUES('$usuario', '$contrato','$cliente','$razon','$solucion','$reporte','$tecnico','$hora', '$horaFinal','$fecha')";
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
        <form action="ratencionesm.php" method="POST" >
            <!---Nombre--->
            <label for="contrato">No. Contrato</label>
            <input name="contrato"type="text" placeholder="NO. CONTRATO" required>
            <!---cliente--->
            <label for="cliente">Cliente</label>
            <input name="cliente"type="text" placeholder="NOMBRE DEL CLIENTE" required>
            <!---razon--->
            <label for="razon">Razon</label>
            <textarea name="razon"type="text" placeholder="RAZON" required></textarea>
            <!---solucion-->
            <label for="solucion">Solucion</label>
            <textarea name="solucion" type="text" placeholder="SOLUCION" required></textarea>
            <!---no. reporte-->
            <label for="reporte">No. Reporte</label>
            <input name="reporte" type="text" placeholder="NO. REPORTE" required>
            <!---tecnico-->
            <label for="tecnico">Tecnico</label>
            <select name="tecnico" id="">
            <option disabled selected>Seleccionar</option>
            <option value="Aram Noé Carreón Ríos">Aram Noé Carreón Ríos</option>
            <option value="Carlos Alberto Alvarez Alejó">Carlos Alberto Alvarez Alejó</option>
            <option value="Carlos Francisco Perez Hernandez">Carlos Francisco Perez Hernandez</option>
            <option value="Daniel Olguin Ramirez">Daniel Olguin Ramirez</option>
            <option value="Domitilo Ceferino Coronel">Domitilo Ceferino Coronel</option>
            <option value="Gabriel de Jesus Lopez Guzmán">Gabriel de Jesus Lopez Guzmán</option>
            <option value="Gustavo Ivan Rodriguez Angel">Gustavo Ivan Rodriguez Angel</option>
            <option value="Heber Isai Ramos Hernandez">Heber Isai Ramos Hernandez</option>
            <option value="Isacc Hernandez Diaz">Isacc Hernandez Diaz</option>
            <option value="Jesus Andres Aguirre Villanueva">Jesus Andres Aguirre Villanueva</option>
            <option value="Jose Enrique Asencio Nuñez">Jose Enrique Asencio Nuñez</option>
            <option value="Jose Guadalupe Osorio">Jose Guadalupe Osorio</option>
            <option value="Jose Rodrigo Ramos Hernandez">Jose Rodrigo Ramos Hernandez</option>
            <option value="Juan Antonio Avendaño Villalpando">Juan Antonio Avendaño Villalpando</option>
            <option value="Juan Carlos Cerino Castro">Juan Carlos Cerino Castro</option>
            <option value="Juan Pablo Leon Rivera">Juan Pablo Leon Rivera</option>
            <option value="Julio Cupil Frias">Julio Cupil Frias</option>
            <option value="Lazaro Landero Garcia">Lazaro Landero Garcia</option>
            <option value="Lázaro Ramírez Sanchez">Lázaro Ramírez Sanchez</option>
            <option value="Lorenzo Benjamín Lázaro Cordova">Lorenzo Benjamín Lázaro Cordova</option>
            <option value="Manuel Antonio Mendez Dennis">Manuel Antonio Mendez Dennis</option>
            <option value="Wilber Carrillo Cordoba">Wilber Carrillo Cordoba</option>
            <option value="Pedro Enrique Laguna Hernandez">Pedro Enrique Laguna Hernandez</option>
            <option value="Osvaldo Perez Hernandez">Osvaldo Perez Hernandez</option>
            <option value="Angel Rodriguez">Angel Rodriguez</option>
            <option value="Jorge Alberto Rodriguez Hernandez">Jorge Alberto Rodriguez Hernandez</option>
            <option value="Yadira Ramos - Pichucalco">Yadira Ramos - Pichucalco</option>
            <option value="Rocio González - Jalapa">Rocio González - Jalapa</option>
            <option value="Marcela Dias - Teapa">Marcela Dias - Teapa</option>
            <option value="Marbella Sala - Teapa">Marbella Sala - Teapa</option>
            <option value="Cobranza">Cobranza</option>
            <option value="Cajera">Cajera</option>
            <option value="Oscar Mendez - Chihuahua">Oscar Mendez - Chihuahua</option>
            <option value="NOC">NOC</option>
            <option value="Naun Hernandez Lopez">Naun Hernandez Lopez</option>
            <option value="Gerardo Lopez Cortazar">Gerardo Lopez Cortazar</option>
            <option value="Soporte Tecnico">Soporte Tecnico</option>
            <option value="Lider de Zona">Lider de Zona</option>
            </select>
            <!---hora inicio--->
            <label for="hora">Hora</label>
            <input id="hora" name="hora" type="time" placeholder="HORA" required>
            <!---hora final--->
            <label for="hora-final">Hora Final</label>
            <input id="hora-final" name="hora-final" type="time" placeholder="HORA FINAL" required>
            <!---fecha-->
            <label for="fecha">Fecha</label>
            <input id="fecha" name="fecha" type="date" placeholder="FECHA" required>
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