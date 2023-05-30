<?php

session_start();
include("../include/bbddconexion.php");

$codigo = trim($_REQUEST['codigo']);
$nombre = trim($_REQUEST['nombre']);
$email = $_REQUEST['buscar_email'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if(isset($_REQUEST['add'])){
        if ($nombre == "" | $codigo == "" | $email == ""){
            echo "<script language='javascript'>
            alert('¡¡ Faltan datos por rellenar !!');
            window.location.replace('./works_add.php');
            </script>"; 
        }
        else {
            $query = "insert into works (id, code, name, user_id, created_at) values (NULL, '$codigo', '$nombre', (select id from users where email='$email'), now()) ";
            $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
            

            if ($consulta){

                echo "<script language='javascript'>
                alert('¡¡ Obra añadida con exito !!');
                window.location.replace('./obras.php');
                </script>"; 

            }
            else{
                echo "<script language='javascript'>
                alert('¡¡ Error al añadir obra !!');
                window.location.replace('./works_add.php');
                </script>";
            }
        }
    }
    else if(isset($_REQUEST['close'])){
        header('Location:./obras.php');
    }
}
