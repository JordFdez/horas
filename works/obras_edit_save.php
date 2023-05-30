<?php

session_start();
include("../include/bbddconexion.php");

$id = $_REQUEST['id'];
$code = $_REQUEST['code'];
$name = $_REQUEST['name'];
$email = $_REQUEST['buscar_email'];


if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['save'])) {
    $query = "update works set code='$code', name='$name', user_id=(select id from users where email='$email') where id=$id;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");


    if ($consulta){

    echo "<script language='javascript'>
            alert('¡¡ Obra actualizada !!');
            window.location.replace('./obras.php');
        </script>";
    }

    else{
    echo "<script language='javascript'>
            alert('¡¡ Error en la actualizacion !!');
            window.location.replace('./obras.php');
        </script>";
    }
    }
    else if (isset($_REQUEST['close'])) {
        header('Location:./obras.php');
    }
}

?>