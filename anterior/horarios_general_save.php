<?php

session_start();
include("./include/bbddconexion.php");

$name = $_REQUEST['name'];
$lunes = $_REQUEST['L'];
$martes = $_REQUEST['M'];
$miercoles = $_REQUEST['X'];
$jueves = $_REQUEST['J'];
$viernes = $_REQUEST['V'];

if(isset($_REQUEST['add'])){

    if ($lunes == "" | $martes == "" | $miercoles == "" | $jueves == "" | $viernes == ""){
        echo "<script language='javascript'>
            alert('Rellene todos los campos');
            window.location.replace('./horarios_general_add.php');
        </script>";
    }

    else {
        if (!$conn) {
            die("Conexion fallida:" . mysqli_connect_error());
        } 
        else {
            $query = "insert into schedules (id, name, L, M, X, J, V, total) values (NULL, '$name', '$lunes', '$martes', '$miercoles', '$jueves', '$viernes', 0 ) ;";
            $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
            

            if ($consulta){
                $query2 = "update schedules set total=(select sum(L+M+X+J+V) ) where id=(select id order by id desc limit 1);";
                $consulta2 = mysqli_query($conn, $query2) or die ("Fallo en la consulta");

                if ($consulta2){
                    echo "<script language='javascript'>
                            alert('¡¡ Horario añadido con exito !!');
                            window.location.replace('./horarios_general.php');
                        </script>";
                }
                else {
                    print "error consulta 2";
                }
            }
            else {
                print "error consulta 1";
            }
        }
 
    }

}


?>