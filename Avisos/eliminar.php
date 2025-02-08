<?php
    include 'database.php';
    session_start();
    if(!empty($_POST)){
        $idusuario=$_POST['idUsuario'];
        
       /* $query_delete=mysqli_query($con,"DELETE FROM usuario
                                    WHERE id_usuario = $idusuario");*/
        $query_delete=mysqli_query($conn,"UPDATE usuario SET estatus = 0
                                    WHERE id_usuario =$idusuario");
        if ($query_delete) {
            header("location: lista-usuario.php");
        }else{
            echo "error al eliminar el usuario";
        }
    }
    if (!isset($_SESSION['rol'])) {
        header('location: login.php');
    }else{
        if ($_SESSION['rol'] != 1) {
            header('location: login.php');
        }
    }
        if (empty($_REQUEST['id']) || $_REQUEST['id']==1) {
            header('location: lista-usuario.php');
        }else{
            
            $idusuario= $_REQUEST['id'];
            
            $query1="SELECT u.nombre, u.username, t.rol
            FROM usuario u 
            INNER JOIN tipo_usuario t
            ON u.id_tipo = t.id_tipo
            WHERE u.id_usuario=$idusuario";
            $query=mysqli_query($conn,$query1);
        $result=mysqli_num_rows($query);
        if ($result > 0) {
            while($data = mysqli_fetch_array($query)){
                $nombre=$data['nombre'];
                $username=$data['username'];
                $rol = $data['rol'];
            }
        }else{
            header('location: lista-usuario.php');
            }
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eliminar usuario</title>
    <link rel="stylesheet" href="CSS/lista-usuarios.css">
    <style>
    .link-edit{
    color: #0ca4ce;
}
.link-delete{
    color: #f26b6b;
}
.data_delete{
    text-align: center;
}
.data_delete h2{
    font-size: 12pt;
}
.data_delete span{
    font-weight: bold;
    color: #4f72d4;
    font-size: 12pt;
}
.btn_cancel,.btn_ok{
    width: 124px;
    background: #478ba2;
    color: #fff;
    display: inline-block;
    padding: 5px;
    border-radius: 5px;
    cursor: pointer;
    margin: 15px;
    text-decoration: none;
}
.btn_cancel{
    background: green;
}
.data_delete form{
    background:initial;
    margin:auto;
    padding:20px 50px;
    border: 0;
}</style>
</head>
<body>
    <h1 class="header">Eliminar usuario</h1>
    <section id="container">
        <div class="data_delete">
            <h2>¿Esta seguro de eliminar el siguiente registro?</h2>
            <p>Nombre: <span><?php echo $nombre; ?></span></p>
            <p>Usuario: <span><?php echo $username; ?></span></p>
            <p>Tipo usuario: <span><?php echo $rol; ?></span></p>

            <form method="POST" action="">
                <input type="hidden" name="idUsuario" value="<?php echo $idusuario; ?>">
                <a href="lista-usuario.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
    </section>
</body>
</html>