<?php

session_start();
include("../include/bbddconexion.php");

$importe = $_REQUEST['importe'];
$user = $_REQUEST['buscar_user'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    if (isset($_REQUEST['add'])) {
        if ($importe == "") {
            echo "<script language='javascript'>
        alert('¡¡ Faltan datos por rellenar !!');
        window.location.replace('./horas.php');
        </script>";
        } else {

            $query = "update importe_gasto set horas_importe=($importe) where user_id=(select id from users where email='$user');";
            $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");


            if ($consulta) {

                echo "<script language='javascript'>
            alert('¡¡ Importe añadido con exito !!');
            window.location.replace('../horas_general/horas_todos.php');
            </script>";
            } else {
                echo "<script language='javascript'>
            alert('¡¡ Error al añadir importe !!');
            window.location.replace('./horas.php');
            </script>";
            }
        }
    } else if (isset($_REQUEST['close'])) {
        header('Location:../horas_general/horas_todos.php');
    }
}
