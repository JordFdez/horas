<?php

session_start();

include("../include/bbddconexion.php");

$id = $_REQUEST['id'];
$name_aprobado = $_SESSION['name'];
$ape_aprobado = $_SESSION['last_name'];
$id_user = $_SESSION['id'];


if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select exception_hours.status, users.name as 'name_user', exception_works.code, exception_works.name, exception_hours.date, exception_hours.hour, exception_hours.id, exception_hours.who_approve from exception_hours, users, exception_works where users.id=exception_hours.user_id and exception_hours.exception_work_id=exception_works.id and exception_hours.id=$id ;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);

    $query2 = "select * from exception_works;";
    $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
    $num_filas2 = mysqli_num_rows($consulta2);

    if (isset($_REQUEST['delete'])) {
        $query3 = "delete from exception_hours where id=$id";
        $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
        echo "<script language='javascript'>
                alert('¡¡ Fila de hora eliminada !!');
                window.location.replace('./resto_horas.php');
                </script>";
    } 
    
}

?>
