<?php

session_start();
include("../include/bbddconexion.php");

$nombre = $_REQUEST['nombre'];
$L = $_REQUEST['L'];
$M = $_REQUEST['M'];
$X = $_REQUEST['X'];
$J = $_REQUEST['J'];
$V = $_REQUEST['V'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['add'])) {
        $query = "insert into schedules (id, name, L, M, X, J, V, created_at, total) values (NULL, '$nombre', '$L', '$M','$X', '$J', '$V', now(), $L+$M+$X+$J+$V) ";
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
        

        if ($consulta){

            echo "<script language='javascript'>
            alert('¡¡ Horario añadido con exito !!');
            window.location.replace('./horarios.php');
            </script>"; 

        }
        else{
            echo "<script language='javascript'>
            alert('¡¡ Error al añadir horario !!');
            window.location.replace('./add_horarios.php');
            </script>";
        }
    } 
    else if (isset($_REQUEST['close'])) {
        header('Location:./horarios.php');
    }
}
