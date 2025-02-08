<?php
include_once 'database.php';
session_start();

if (isset($_SESSION['rol'])) {
  header('location: login.php');
}else{
  if ($_SESSION['rol'] != 1) {
      header('location: login.php');
  }
}
if (!empty($_GET)) {
    
   

    if (empty($_GET['nombre']) && empty($_GET['mensaje'])) {
      echo '<script language="javascript">alert("Escriba un nombre y mensaje");</script>'; 
    }else{
        $sql = "INSERT INTO contactos(nombre, email, telefono, asunto, mensaje) VALUES(:nombre, :email, :telefono, :asunto, :mensaje)";

        
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':nombre', $_GET['nombre']);
        $stmt->bindParam(':email', $_GET['email']);
        $stmt->bindParam(':telefono', $_GET['telefono']);
        $stmt->bindParam(':asunto', $_GET['asunto']);
        $stmt->bindParam(':mensaje', $_GET['mensaje']);
    
        if ($stmt->execute()) {
          echo '<script language="javascript">alert("Formulario enviado");</script>'; 
        }else{
          echo '<script language="javascript">alert("Error al enviar el formulario");</script>'; 
        }
    }
 
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GrupoAS</title>
    <!--BOOTSTRAP4-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--FONTAWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--GOOGLE FONT SIZE-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald&display=swap" rel="stylesheet">
    <!--CSS CUSTOME-->
<link rel="stylesheet" href="CSS/index.css">
<link rel="stylesheet" href="CSS/nav-index.css">
<!--ANIMATE CSS-->
<link rel="stylesheet" href="animate.min.css">
</head>
<body>
  <!--SideBar-->
  <div id="sidebar">
      <div class="toggle-btn">
        <span><h3>Inicia sesión</h3></span>
      </div>
      <ul>
        <li>
          <img src="img/Logo.jpg" alt="logotipo" class="Logo">
        </li>
        <li><a href="login.php">Inicia sesión</a></li>
      </ul>
    </div>
  <!--NAVEGACION-->
  <header id="fijo">
        <section id="menu">
            <ul>
            <a class="" href="#"><i class="fas fa-home"></i> Home </a>
            <a class="" href="#conocenos"><i class="fas fa-building"></i>Conócenos</a>
            <a class="" href="#acerca"><i class="fas fa-hands-helping"></i>Como te ayudamos</a>
            <a class="" href="#content"><i class="fas fa-envelope"></i>Contáctanos</a>
            <a class="" href="#maps"><i class="fas fa-envelope"></i>¿Dónde nos ubicamos?</a>
            </ul>
        </section>
    </header>
  <!--
  <nav class="navbar navbar-expand-lg navbar-dark bg-purple ">
    
      <a class="navbar-brand">Grupo Amor y Servicio</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fas fa-home"></i> Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#conocenos"><i class="fas fa-building"></i> Conocenos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#acerca"><i class="fas fa-hands-helping"></i>Como te ayudamos</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#content"><i class="fas fa-envelope"></i>Contactanos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#maps"><i class="fas fa-envelope"></i>¿Dondé nos ubicamos?</a>
              </li>
        </ul>
      </div>

  </nav>
-->
    <!--HEADER -->
    <header class="header">
<div class="header-content">
  <center>  <img src="img/descargar.jpg" alt="Grupo Logo" class="logo-index"></center>
    <h3 class= "titulo">Grupo Doble AA</h3>
    <p class="texto">"Yo soy responsable, 
Cuando cualquiera, 
Donde quiera, 
extienda su mano pidiendo ayuda, 
quiero que la mano de amor y servicio 
siempre esté ahí. 
Y por esto: 
yo soy responsable."</p>
</div>
    </header>

<!--SERVICES-->
<section class="services text-center bg-black">
<h3 class="titulo" id="conocenos">Conocenos</h3>
<div class="container grid-3">
 <div>
        <i class="fas fa-user-friends fa-5x"></i>
        <h3>Organización sin fines de lucro</h3>

        <p>El grupo de amor y servicio esta dispuesto a ayudar a cualquier persona que decida por voluntad propia buscar un cambio en su vida.</p>
 </div>
 <div>
        <i class="fas fa-birthday-cake fa-5x"></i>
        <h3>10 años ayudando gente</h3>
        <p>Tenemos un largo historial con gente que ha sido beneficiada con nuestra. Esto es debido a que aplicamos el 4to y 5to paso.</p>
 </div>
 <div>
        <i class="fas fa-handshake fa-5x"></i>
        <h3>Juntas para reflexionar</h3>
        <p>Nosostros llevamos las juntas de acuerdo al libro Alcohólicos anónimos. Lo anterior resulta en una gran ventaja ya que los temas que tratamos son pieza clave para la recuperación de la persona.</p>
 </div>
</div>
</section>

<!--ABOUT US-->
<section class="about bg-light">
<div id="acerca" class="container text-center">
  <div class="grid-2">
    <div class="center">
      <i class="fas fa-hands-helping fa-10x"></i>
    </div>
    <div >
      <h3 class="titulo">Apoyo a jovenes de padres alcohólicos </h3>
        <p>Tambien disponemos de ayuda a jovenes que tuvieron padres con problemas con el alcohol. Cuando una persona entra a la agrupación no debe olvidar que dejo un daño grande en su familia.</p>
    </div>

  </div>

</div>
</section>
<!--ABOUT US 2-->
<section class="about bg-black">
<div class="container text-center">
  <div class="grid-2">
    <div >
      <h3 class="titulo">Anonimato en el grupo </h3>
        <p>Lo que caracteriza a los grupo de 4to y 5to paso es el anonimato. Aquí nadie te va a juzgar debido a que todos traemos problemas y esto se ve reflejado en los compartimientos que tenemos a diario.</p>
    </div>
    <div class="center">
      <i class="fas fa-user-secret fa-10x"></i>
    </div>
  </div>
</div>
</section>
<!--Contacto-->
<section class="content" id="content">
<div class="formulario">
  <h1 class="titulo">Contacta<span>nos</span></h1>
  <div class="contact-wrapper">
    <div class="contact-form">
      <h3>Contactanos</h3>
      <form action="" method="GET">
        <p><label>Nombre completo</label>
          <input type="text" name="nombre">
        </p>
        <p>
          <label>Correo electronico</label>
          <input type="email" name="email">
        </p>
        <p>
          <label>Telefono</label>
          <input type="text" name="telefono">
        </p>
        <p>
          <label>Asunto</label>
          <input type="text"name="asunto">
        </p>
        <p class="block">
          <label>Mensaje</label>
          <textarea name="mensaje" rows="3"></textarea>
        </p>
        <p class="block">
          <button type="submit">
            Enviar
          </button>
        </p>
      </form>
    </div>
    <div class="contact-info">
      <h4>Más información</h4>
      <ul>
        <li><i class="fas fa-map-marker-alt"></i>Av. Francisco Javier Mina</li>
        <li><i class="fas fa-phone"></i>Av. 993 169 8778</li>
        <li><i class="fas fa-at"></i></i>GrupoAA@AmoryServicio.com</li>
      </ul>
      <p>En el grupo de amor y servicio 4to y 5to paso estamos dispuestos a ayudar a quien lo pida. Nuestras juntas son apartir de las 7 de la noche de lunes a viernes. 
      </p>
      <p>Grupo Amor y Servicio 4to y 5to Paso</p>
    </div>
  </div>
</div>
</section>
<!--MAPS-->
<section id="maps">
  <h1 class="titulo text-center">¿Dónde nos ubicamos?</h1>
  <div class="mapa">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d891.8876312457141!2d-92.92843617080973!3d17.985895799232658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85edd82e1f349b05%3A0xa0cc7839c3544d87!2sAv+Francisco+Javier+Mina+1109%2C+Mayito%2C+86098+Villahermosa%2C+Tab.!5e1!3m2!1ses!2smx!4v1560643100458!5m2!1ses!2smx" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
</section>
        <!--FOOTER-->
        <footer class="footer text-center bg-light">
                 <p>Grupo de amor y servicio &copy: 2019 - All right reserved.</p>
        </footer>
        <script src="JS/main.js" charset="utf-8"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
