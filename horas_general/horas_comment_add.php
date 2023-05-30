<?php

session_start();
include("../include/bbddconexion.php");

$observ= $_REQUEST['observacion'];
$hour_id = $_REQUEST['hour_id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if(isset($_REQUEST['update'])){
    if ($observ == "") {
        echo "<script language='javascript'>
        alert('¡¡ Escriba alguna observación !!');
        window.location.replace('./horas_comment.php');
        </script>";
    } 
    else {
        $query = "update hours set comment='$observ' where id=$hour_id";
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
        

        if ($consulta) {

            echo "<script language='javascript'>
            alert('¡¡ Observacion añadida con exito !!');
            window.location.replace('./horas_todos.php');
            </script>";
        } else {
            echo "<script language='javascript'>
            alert('¡¡ Error !!');
            window.location.replace('./horas_todos.php');
            </script>";
        }
    }
}
else if (isset($_REQUEST['close'])){
    header("Location:./horas_todos.php");
}
}

?>