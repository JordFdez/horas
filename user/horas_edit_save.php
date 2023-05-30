<?php

session_start();
include("../include/bbddconexion.php");

$name_obra = $_REQUEST['buscar_obra'];
$cod_obra = $_REQUEST['cod_obra'];
$horas = $_REQUEST['horas'];
$fecha = $_REQUEST['fecha'];
$id_hours = $_REQUEST['id_hours'];
$id_works= $_REQUEST['id_works'];
$observacion = $_REQUEST['observacion'];

if (isset($_REQUEST['extra'])) {
    $hora_extra = "1";
} else {
    $hora_extra = "0";
}


if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 

else {
    if (isset($_REQUEST['act'])) {
        $query = "update hours set work_id=(select id from works where name like '%$name_obra%'), date='$fecha', hour='$horas', register=$hora_extra, comment='$observacion' where id=$id_hours ;";
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");

            if($consulta){
                echo "<script language='javascript'>
                    alert('¡¡ Hora actualizada !!');
                    window.location.replace('./horas_propias.php');
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
        header('Location:./horas_propias.php');
    }
}

?>