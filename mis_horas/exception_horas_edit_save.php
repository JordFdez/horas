<?php

session_start();
include("../include/bbddconexion.php");

$name_obra = $_REQUEST['buscar_obra'];
$cod_obra = $_REQUEST['cod_obra'];
$horas = $_REQUEST['horas'];
$fecha = $_REQUEST['fecha'];
$id_hours = $_REQUEST['id_hours'];
$id_works= $_REQUEST['id_works'];


if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 

else {
    if (isset($_REQUEST['act'])) {
        $query = "update exception_hours set exception_work_id=(select id from exception_works where name like '%$name_obra%'), date='$fecha', hour='$horas' where id=$id_hours ;";
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");

            if($consulta){
                echo "<script language='javascript'>
                    alert('¡¡ Hora actualizada !!');
                    window.location.replace('./resto_horas.php');
                    </script>";
            }

        else{
            echo "<script language='javascript'>
                    alert('¡¡ Error !!');
                    window.location.replace('./horas_propias.php');
                    </script>";
        }
    } 
    else if (isset($_REQUEST['close'])) {
        header('Location:./resto_horas.php');
    }
}

?>