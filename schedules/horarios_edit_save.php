<?php

session_start();
include("../include/bbddconexion.php");

$id_schedules = $_REQUEST['id_schedules'];
$name = $_REQUEST['name'];
$lunes = $_REQUEST['L'];
$martes = $_REQUEST['M'];
$miercoles = $_REQUEST['X'];
$jueves = $_REQUEST['J'];
$viernes = $_REQUEST['V'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['act'])) {
        $query = "update schedules set name='$name', L=$lunes, M=$martes, X=$miercoles, J=$jueves, V=$viernes, total=($lunes+$martes+$miercoles+$jueves+$viernes) where id=$id_schedules; ";
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");

        echo "<script language='javascript'>
                alert('¡¡ Horario Actualizado !!');
                window.location.replace('./horarios.php');
            </script>";
    } 
    else if (isset($_REQUEST['close'])) {
        header('Location:./horarios.php');
    }
}

?>