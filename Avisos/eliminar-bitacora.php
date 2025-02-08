<?php
    include 'database.php';
    session_start();
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $query="UPDATE juntas SET estado ='0' WHERE id_junta = $id";
        $result=mysqli_query($conn,$query);
        if (!$result) {
            die("No se ha podido eliminar");
        }else{
            
            header("location: bitacora.php");
        }
    }

    if(!empty($_GET['eliminar'])){
        $status = $_GET['eliminar'];
        $query="UPDATE contactos SET status = '0' WHERE id_contactos = $status";
$result=mysqli_query($conn,$query);
if (!$result) {
    die("No se ha podido eliminar");
}else{
    
    header("location: contactos.php");
}
    }
?>