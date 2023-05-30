<?php

session_start();
include("../include/bbddconexion.php");

$nom_obra = $_REQUEST['nombre_obra'];
$cod_obra = $_REQUEST['cod_obra'];
$hora = $_REQUEST['horas'];
$hora_extra = $_REQUEST['hora_extra'];
$fecha = $_REQUEST['fecha'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['add'])) {
        if ($nombre_obra == "" | $cod_pbra == "" | $hora == "" | $hora_extra == "" | $fecha == "") {
            echo "<script language='javascript'>
            alert('¡¡ Faltan datos por rellenar !!');
            window.location.replace('./add_horas_valor.php');
            </script>";
        } 
        else {
            $query = "insert into hours values (NULL, '$nombre', '$apellido', '$email', MD5('$pass'), '$rol', '$estado', '$horario', now()) ";
            $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");


            if ($consulta) {

                echo "<script language='javascript'>
                alert('¡¡ Añadido con exito !!');
                window.location.replace('./horas.php');
                </script>";
            } else {
                echo "<script language='javascript'>
                alert('¡¡ Error al añadir las horas!!');
                window.location.replace('./horas.php');
                </script>";
            }
        }
    } 
    else if (isset($_REQUEST['close'])) {
        header('Location:./obras.php');
    }
}

?>