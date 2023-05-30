<?php

session_start();
include("../include/bbddconexion.php");

$importe = $_REQUEST['importe'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    if (isset($_REQUEST['add'])) {
        if ($importe == "") {
            echo "<script language='javascript'>
        alert('¡¡ Faltan datos por rellenar !!');
        window.location.replace('./add_importe.php');
        </script>";
        } else {

            $query = "update importe_gasto set dieta_importe=($importe);";
            $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");


            if ($consulta) {

                echo "<script language='javascript'>
            alert('¡¡ Importe añadido con exito !!');
            window.location.replace('../horas_general/horas_todos.php');
            </script>";
            } else {
                echo "<script language='javascript'>
            alert('¡¡ Error al añadir importe !!');
            window.location.replace('./dieta.php');
            </script>";
            }
        }
    } else if (isset($_REQUEST['close'])) {
        header('Location:../horas_general/horas_todos.php');
    }
}
