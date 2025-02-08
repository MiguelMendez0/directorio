<?php 
@session_start();


?>

<div id="sidebar">
      <div class="toggle-btn">
        
      </div>
      <ul>
        <li>
          <img src="img/LOGO_FASTNET.png" alt="logotipo" class="Logo">
        </li>
        <li><a href="contactos.php">Inicio</a></li>
        <?php if ($_SESSION['rol'] == 1) { ?>
        <li><a href="registrar.php">Registrar usuario</a></li>
        <li><a href="lista-usuario.php">Lista de usuarios</a></li>
        <?php }?>
        
        <?php if (($_SESSION['rol'] == 2) or ($_SESSION['rol'] == 1) or ($_SESSION['rol'] == 5) or ($_SESSION['rol'] == 4)) { ?>
          <li><a href="registrar.php?aviso=1">Registrar Aviso</a></li>
        <li><a href="bitacora.php">Incidencias</a></li>
        <?php }?>
        <?php if ($_SESSION['rol'] == 2) { ?>
        <li><a href="atenciones.php">Atenciones Telefonicas</a></li>
        <li><a href="ratenciones.php">Registrar Atenciones</a></li>
        <?php }?>
        <?php if ($_SESSION['rol'] == 5) { ?>
        <li><a href="atencionesm.php">Atenciones Telefonicas</a></li>
        <li><a href="ratencionesm.php">Registrar Atenciones</a></li>
        <?php }?>
        <?php if ($_SESSION['rol'] == 4) { ?>
        <li><a href="historial.php">Historial de Atenciones</a></li>
        <li><a href="historialm.php">Atenciones Mesa de Ayuda</a></li>
        <?php }?>
        <li><a href="cerrar.php">Cerrar sesion</a></li>
      </ul>
    </div>