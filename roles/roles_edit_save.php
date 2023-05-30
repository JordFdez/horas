<?php

session_start();
include("../include/bbddconexion.php");

$rol = $_REQUEST['rol'];
$id_rol = $_REQUEST['id_rol'];

    if (!$conn) {
        die("Conexion fallida:" . mysqli_connect_error());
    }
    else {
    if (isset($_REQUEST['save'])) {
            $query = "update users set rol_id=(select id from roles where name='$rol') where id=$id_rol ;";
            $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");

            if ($consulta){
            echo "<script language='javascript'>
                    alert('¡¡ Rol Actualizado !!');
                    window.location.replace('./roles.php');
                </script>";
            }
            else
            {
            echo "<script language='javascript'>
                    alert('¡¡ Error !!');
                    window.location.replace('./roles_edit.php');
                </script>";
            }
        } 
        else if (isset($_REQUEST['close'])) {
        header('Location:./roles.php');
    }
}


?>