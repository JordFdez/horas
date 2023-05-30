<?php

session_start();
include("../include/bbddconexion.php");

$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$email = $_REQUEST['email'];
$pass = $_REQUEST['pass'];
$estado = $_REQUEST['estado'];
$horario = $_REQUEST['buscar_horario'];
$rol = $_REQUEST['buscar_rol'];
$id = $_REQUEST['id_user'];


if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['save'])) {
    $query = "update users set name='$nombre', last_name='$apellido', email='$email', password='$pass', type='$estado', schedule_id=(select id from schedules where name='$horario'), rol_id=(select id from roles where name='$rol') where users.id=$id ";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    if ($consulta){
        echo "<script language='javascript'>
                alert('¡¡ Usuario actualizado !!');
                window.location.replace('./usuario.php');
                </script>";
    }
    } 
    else if (isset($_REQUEST['close'])) {
        header('Location:./usuario.php');
    }
}

?>

