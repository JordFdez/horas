<?php

session_start();
include("../include/bbddconexion.php");
$user_id = $_SESSION['id'];

$nombre = $_REQUEST['buscar_exception_obra'];
$fecha = $_REQUEST['fecha'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['add'])) {
    if ($nombre == "" | $fecha == ""){
        echo "<script language='javascript'>
        alert('¡¡ Faltan datos por rellenar !!');
        window.location.replace('./add_exception_horas.php');
        </script>"; 
    }
    else {
        
            if ($nombre == "VACACIONES" || $nombre == "FESTIVO"|| $nombre == "BAJA LABORAL"){

                $query_todo = "insert into exception_hours (id, hour, user_id, exception_work_id, status, date) values (NULL, (select L from schedules where id=(select schedule_id from users where id=$user_id)), $user_id, (select id from exception_works where name like '%$nombre%'), 'NO APROBADA', '$fecha' );";
                $consulta_todo = mysqli_query($conn, $query_todo) or die ("Fallo en la consulta");

                if ($consulta_todo){
                    echo "<script language='javascript'>
                alert('¡¡ Horario añadido con exito !!');
                window.location.replace('./resto_horas.php');
                </script>"; 
                }
            
                else{
                    echo "<script language='javascript'>
                alert('¡¡ Error al añadir horario !!');
                window.location.replace('./add_exception_horas.php');
                </script>";
                }
            }

            else{
                $hora = $_REQUEST['hora'];

                $query1 = "insert into exception_hours (id, hour, user_id, exception_work_id, status, date) values (NULL, $hora, $user_id, (select id from exception_works where name like '$nombre'), 'NO APROBADA', '$fecha' ); ";
                $consulta1 = mysqli_query($conn, $query1) or die ("Fallo en la consulta 2");
                if ($consulta1) {
                    echo "<script language='javascript'>
                alert('¡¡ Horario añadido con exito !!');
                window.location.replace('./resto_horas.php');
                </script>";
                } else {
                    echo "<script language='javascript'>
                alert('¡¡ Error al añadir horario !!');
                window.location.replace('./add_exception_horas.php');
                </script>";
                }
            }
        }
    }
    else if(isset($_REQUEST['close'])){
        header('Location:./resto_horas.php');
    }
}
