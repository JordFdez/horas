<?php

session_start();
include("../include/bbddconexion.php");
$user_id = $_SESSION['id'];

$nombre = $_REQUEST['buscar_obra'];
$hora = $_REQUEST['hora'];
$fecha = $_REQUEST['fecha'];
$observacion = $_REQUEST['observacion'];

if(isset($_REQUEST['extra'])){
    $hora_extra = "1";
}
else{
    $hora_extra = "0";
}


if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    if (isset($_REQUEST['add'])) {
        if ($nombre == "" | $fecha == "" | $hora == "") {
            echo "<script language='javascript'>
            alert('¡¡ Faltan datos por rellenar !!');
            window.location.replace('./add_horas_propias.php');
            </script>";
        } 
        else {
            
                $query = "insert into hours (id, hour, user_id, work_id, status, date, register, comment) values (NULL, $hora, $user_id, (select id from works where name like '$nombre'), 'NO APROBADA', '$fecha', $hora_extra, '$observacion' );";
                $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");

                if ($consulta) {
                    echo "<script language='javascript'>
                alert('¡¡ Hora añadida con exito !!');
                window.location.replace('./horas_propias.php');
                </script>";
                } else {
                    echo "<script language='javascript'>
                alert('¡¡ Error al añadir horas !!');
                window.location.replace('./add_horas_propias.php');
                </script>";
                }
        }
    } 
    else if (isset($_REQUEST['close'])) {
        header('Location:./horas_propias.php');
    }
}
